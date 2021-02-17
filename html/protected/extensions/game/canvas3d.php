<?php

define('EPSILON', 0.03125);


class Point3D {
  public $x;
  public $y;
  public $z;

  public function __construct($x,$y,$z) {
    $this->x = $x;
    $this->y = $y;
    $this->z = $z;
  }

  public function rotateX($angle) {
    $rad = $angle * M_PI / 180;
    $cosa = cos($rad);
    $sina = sin($rad);
    $y = $this->y * $cosa - $this->z * $sina;
    $z = $this->y * $sina + $this->z * $cosa;
    return new Point3D($this->x, $y, $z);
  }

  public function rotateY($angle) {
    $rad = $angle * M_PI / 180;
    $cosa = cos($rad);
    $sina = sin($rad);
    $z = $this->z * $cosa - $this->x * $sina;
    $x = $this->z * $sina + $this->x * $cosa;
    return new Point3D($x, $this->y, $z);
  }

  public function rotateZ($angle) {
    $rad = $angle * M_PI / 180;
    $cosa = cos($rad);
    $sina = sin($rad);
    $x = $this->x * $cosa - $this->y * $sina;
    $y = $this->x * $sina + $this->y * $cosa;
    return new Point3D($x, $y, $this->z);
  }

  public function project($width,$height,$fov,$viewerDistance) {
    $factor = (float)($fov) / ($viewerDistance + $this->z);
    $x = $this->x * $factor + $width / 2;
    $y = -$this->y * $factor + $height / 2;
    return new Point3D($x,$y,$this->z);
  }
}

class canvas3d extends CApplicationComponent
{	public $canvas_width  = 800;	public $canvas_height = 600;
	public $faces;
	public $vertices;
	private $img;

	public $angleX = 0;
	public $angleZ = 0;
	public $angleY = 0;
	public $colors;
	public $fov = 256;
	public $cameraDistance = 14;
	public $copy = true;
	public $show_cordiates = true;

	public function init()
		{			$this->img = imagecreatetruecolor($this->canvas_width, $this->canvas_height);
			imagesavealpha($this->img, true);		}

	public function canvas_backgrouns($r = 0, $g = 0, $b = 0)
		{
			imagefill($this->img, 0, 0, imagecolorallocate($this->img, $r, $g, $b));		}

   	public function pixel($v,$r,$g,$b,$size = 8)
		{
			imagefilledellipse ( $this->img , $v->x, $v->y , $size , $size , imagecolorallocate($this->img,$r,$g,$b) );
            if ($this->show_cordiates)
			{				ImageString($this->img, 1, $v->x+5, $v->y-12, "x: ".round($v->x,2), imagecolorallocate($this->img,255,255,255));
				ImageString($this->img, 1, $v->x+5, $v->y-5, "y: ".round($v->y,2), imagecolorallocate($this->img,255,255,255));
				ImageString($this->img, 1, $v->x+5, $v->y+2, "z: ".round($v->z,2), imagecolorallocate($this->img,255,255,255));
			}
		}

	public function getRender()
	{		$t = array();

		/* Transform all the vertices. */
		foreach( $this->vertices as $v ) {
		  $t[] = $v->rotateX($this->angleX)->rotateY($this->angleY)->rotateZ($this->angleZ)->project($this->canvas_width,$this->canvas_height,$this->fov,$this->cameraDistance);
		}

		foreach($this->colors as $color ) {			if(count($color)==3) {				$im_colors[] = imagecolorallocate($this->img,$color[0],$color[1],$color[2]);			} else {				$im_colors[] = imagecolorallocatealpha($this->img,$color[0],$color[1],$color[2],$color[3]);			}

		}

		$avgZ = array();

		/* Calculate the average Z value of each face. */
		foreach( $this->faces as $index=>$f ) {
		  $avgZ["$index"] = ($t[$f[0]]->z + $t[$f[1]]->z + $t[$f[2]]->z + $t[$f[3]]->z) / 4.0;
		}
//		 print_r($avgZ);
		/* Sort the array in descending order. */
		arsort($avgZ);
        // print_r($avgZ);
		/* Draw the faces from back to front. */
		foreach( $avgZ as $index=>$z ) {
		  $f = $this->faces[$index];
		//  print_r($t[$f[1]]);
		  $points = array(
		    $t[$f[0]]->x,$t[$f[0]]->y,
		    $t[$f[1]]->x,$t[$f[1]]->y,
		    $t[$f[2]]->x,$t[$f[2]]->y,
//		    $t[$f[3]]->x,$t[$f[3]]->y
		  );
		  imagefilledpolygon($this->img,$points,3,$im_colors[$index]);
		}

		foreach( $avgZ as $index=>$z ) {
		  $f = $this->faces[$index];
		  $this->pixel($t[$f[0]],255,0,0);
		  $this->pixel($t[$f[1]],0,255,0);
		  $this->pixel($t[$f[2]],0,255,255);
		 // $this->pixel($t[$f[3]],255,0,255);
		}

		if ($this->copy) ImageString($this->img, 2, $this->canvas_width-220, $this->canvas_height-20, "Created by JDay for www.my-gs.info", imagecolorallocate($this->img,255,255,120));
		if ($this->show_cordiates)
			{				ImageString($this->img, 2, 10, 10, 'angleX: '.$this->angleX.'\'', imagecolorallocate($this->img,255,255,120));
				ImageString($this->img, 2, 10, 20, 'angleY: '.$this->angleY.'\'', imagecolorallocate($this->img,255,255,120));
				ImageString($this->img, 2, 10, 30, 'angleZ: '.$this->angleZ.'\'', imagecolorallocate($this->img,255,255,120));			}
		ob_start();
		imagepng($this->img);
		$imagedata = ob_get_contents();
		ob_end_clean();
		echo '<img src="data:image/png;base64,'.base64_encode($imagedata).'" alt="3D Render by Jday">';	}
}

?>
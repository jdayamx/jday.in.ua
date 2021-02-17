<?php

Yii::import("application.components.classes.map", true);

/*
bool CMap::Load (string strName)
{
// Preparing Map Name
for (int i = m_strName.length (); i < 29; i++)
{
m_strName.append ("0");
}
// Open File
ifstream Input ("Maps/" + strName + ".plg", ios::binary);
if (Input.good ())
{
// Read Map Name
for (int i = 0; i < 29; i++)
{
Input.read (&m_strName.at (i), sizeof (char));
}
// Read Block Types
EBlockType BlockTypes[100][100];
for (int i = 0; i < 100; i++)
{
for (int j = 0; j < 100; j++)
{
Input.read ((char*) &BlockTypes[i][j], sizeof (EBlockType));
}
}
// Close File
Input.close ();
// Clear Map Name
int StringEnd = static_cast<int> (m_strName.find ("0", 0));
if (StringEnd != string::npos)
{
for (int i = StringEnd; i < 29; i++)
{
m_strName.pop_back ();
}
}
// Update Block's Types
for (int i = 0; i < 100; i++)
{
for (int j = 0; j < 100; j++)
{
m_Blocks[i][j].SetType (BlockTypes[i][j]);
}
}
return true;
}
return false;
}

*/

class cs2d extends map{	public $header;
	public $file;
	private $data;

	/*
	function __construct($file) {		if(!$file) {
			$file = $this->object->id;
		}
		print_r($this->object);
       $this->LoadFile($file);
	}  */

	public function LoadFile($file) {
        if(!$file) {
			$file = $this->object->filename;
		}

		$ext = CFileHelper::getExtension($file);


		switch($ext) {
			case 'zip':

				$zip = Yii::app()->zip;
				$info = $zip->infosZip($file);
				foreach($info as $file=>$data) {					if(preg_match('~\.map~ui',$file)) $this->data = $data['Data'];				}
				//echo '<pre>'.print_r($info, true).'</pre>';
				//return false;
			break;			default:
				return false;		}

		$this->file = $file;
		$seek = 0;
		if(is_file($this->file)&&!$this->data) $this->data = file_get_contents($this->file);

		$this->header['header'] = mb_substr($this->data,$seek,strpos($this->data,PHP_EOL,$seek)); $seek += mb_strlen($this->header['header'])+1;
		$this->header['scroll_map'] = bindec(mb_substr($this->data,$seek,1)); $seek += 1;
		$this->header['unused1'] = bindec(mb_substr($this->data,$seek,1)); $seek += 1;
		$this->header['unused2'] = bindec(mb_substr($this->data,$seek,1)); $seek += 1;
		$this->header['unused3'] = bindec(mb_substr($this->data,$seek,1)); $seek += 1;
		$this->header['unused4'] = bindec(mb_substr($this->data,$seek,1)); $seek += 1;
		$this->header['unused5'] = bindec(mb_substr($this->data,$seek,1)); $seek += 1;
		$this->header['unused6'] = bindec(mb_substr($this->data,$seek,1)); $seek += 1;
		$this->header['unused7'] = bindec(mb_substr($this->data,$seek,1)); $seek += 1;
		$this->header['unused8'] = bindec(mb_substr($this->data,$seek,1)); $seek += 1;

		$this->header['uptime'] = bindec(mb_substr($this->data,$seek,2)); $seek += 2;
		$this->header['map_author_id'] = bindec(mb_substr($this->data,$seek,2)); $seek += 2;
		$this->header['unused1i'] = bindec(mb_substr($this->data,$seek,2)); $seek += 2;
		$this->header['unused2i'] = bindec(mb_substr($this->data,$seek,2)); $seek += 2;
		$this->header['unused3i'] = bindec(mb_substr($this->data,$seek,2)); $seek += 2;
		$this->header['unused4i'] = bindec(mb_substr($this->data,$seek,2)); $seek += 2;
		$this->header['unused5i'] = bindec(mb_substr($this->data,$seek,2)); $seek += 2;
		$this->header['unused6i'] = bindec(mb_substr($this->data,$seek,2)); $seek += 2;
		$this->header['unused7i'] = bindec(mb_substr($this->data,$seek,2)); $seek += 2;
		$this->header['unused8i'] = bindec(mb_substr($this->data,$seek,2)); $seek += 2;

		$this->header['map_author_name'] = mb_substr($this->data,$seek,strpos($this->data,PHP_EOL,$seek)-$seek); $seek += mb_strlen($this->header['map_author_name'])+2;
		$this->header['unused1s'] = mb_substr($this->data,$seek,strpos($this->data,PHP_EOL,$seek)-$seek); $seek += mb_strlen($this->header['unused1s'])+2;
		$this->header['unused2s'] = mb_substr($this->data,$seek,strpos($this->data,PHP_EOL,$seek)-$seek); $seek += mb_strlen($this->header['unused2s'])+2;
		$this->header['unused3s'] = mb_substr($this->data,$seek,strpos($this->data,PHP_EOL,$seek)-$seek); $seek += mb_strlen($this->header['unused3s'])+2;
		$this->header['unused4s'] = mb_substr($this->data,$seek,strpos($this->data,PHP_EOL,$seek)-$seek); $seek += mb_strlen($this->header['unused4s'])+2;
		$this->header['unused5s'] = mb_substr($this->data,$seek,strpos($this->data,PHP_EOL,$seek)-$seek); $seek += mb_strlen($this->header['unused5s'])+2;
		$this->header['unused6s'] = mb_substr($this->data,$seek,strpos($this->data,PHP_EOL,$seek)-$seek); $seek += mb_strlen($this->header['unused6s'])+2;
		$this->header['unused7s'] = mb_substr($this->data,$seek,strpos($this->data,PHP_EOL,$seek)-$seek); $seek += mb_strlen($this->header['unused7s'])+2;
		$this->header['unused8s'] = mb_substr($this->data,$seek,strpos($this->data,PHP_EOL,$seek)-$seek); $seek += mb_strlen($this->header['unused8s'])+2;
		$this->header['unused9s'] = mb_substr($this->data,$seek,strpos($this->data,PHP_EOL,$seek)-$seek); $seek += mb_strlen($this->header['unused9s'])+1;

		$this->header['map_xy'] = mb_substr($this->data,$seek,strpos($this->data,"x",$seek)-$seek); $seek += mb_strlen($this->header['map_xy'])+1;
		$this->header['map_tiles'] = mb_substr($this->data,$seek,strpos($this->data,"$",$seek)-$seek); $seek += mb_strlen($this->header['map_tiles'])+1;
		$this->header['map_CurrentSystemTime'] = mb_substr($this->data,$seek,strpos($this->data,"%",$seek)-$seek); $seek += mb_strlen($this->header['map_CurrentSystemTime'])+1;
		$this->header['map_SystemUpTime'] = mb_substr($this->data,$seek,strpos($this->data,PHP_EOL,$seek)-$seek); $seek += mb_strlen($this->header['map_SystemUpTime'])+1;

		$this->header['map_filename_tilset'] = trim(mb_substr($this->data,$seek,strpos($this->data,PHP_EOL,$seek)-$seek)); $seek += mb_strlen($this->header['map_filename_tilset'])+2;
		$this->header['map_number_tileset'] =  bindec(mb_substr($this->data,$seek,1)); $seek += 4;
		$this->header['map_width'] =  bindec(mb_substr($this->data,$seek,2)); $seek += 4;
		$this->header['map_height'] =  bindec(mb_substr($this->data,$seek,2)); $seek += 4;
		$this->header['map_filename_background_image'] = trim(mb_substr($this->data,$seek,strpos($this->data,PHP_EOL,$seek)-$seek)); $seek += mb_strlen($this->header['map_filename_background_image'])+2;


  		/*
  		STRING string which is built this way (map_xsize (in tiles) * map_ysize (in tiles)) + "x" + tile_count + "$" + CurrentSystemTime (HHMMSS) + "%" + SystemUpTime (in Milliseconds)
	STRING filename of the tilset image (without path but with extension, "aztec.bmp" for example)
	BYTE number of tiles required from this tileset (tile_count) -1 (because it starts at 0)
		(either full number of tiles in that set or at least frame of highest tile  that has been used in map)
	INT map width (map_xsize) in tiles -1 (because it starts at 0)
	INT map height (map_ysize) in tiles -1 (because it starts at 0)
	STRING filename of map background image (without path but with extension
	INT map background scroll x speed
	INT map background scroll y speed
	BYTE map background color red
	BYTE map background color green
	BYTE map background color blue

	----- Header Test
	STRING string to test if header is okay with value "ed.erawtfoslaernu" (unrealsoftware.de backwards)
  		*/
       // $this->header['tmp'] = explode(PHP_EOL,$this->data);
       //foreach($this->header as $key=>$val) $this->header[$key] = trim($val);
		//echo '[seek:'.$seek.']';
	}	public function init() {		echo '234';	}
}
?>
<?php
class studio
{
	public $_studiohdr_t = null;
	public $_studioseqhdr_t = null;
	public $_mstudiobone_t = null;
	public $_mstudiobonecontroller_t = null;
	public $_mstudiobbox_t = null;
	public $_mstudioseqgroup_t = null;
	public $_mstudiotexture_t = null;
	public $_mstudioseqdesc_t = null;

	//private $_mstudiopivot_t = null;
	//private $_mstudioevent_t = null;

	public function __construct($FileName) {
		$Handle = fopen(Yii::app()->basePath.'/..'.$FileName, 'rb');
		$this->studiohdr_t(fread($Handle, 244));  //176 mstudioseqdesc_t
		fseek($Handle, $this->_studiohdr_t['seqindex']);
		for($i=1;$i<=$this->_studiohdr_t['numseq'];$i++) {
			$this->mstudioseqdesc_t(fread($Handle, 176));
			//fseek($Handle, 76);
		}

		for($i=0;$i<count($this->_mstudioseqdesc_t);$i++) {

			fseek($Handle, $this->_mstudioseqdesc_t[$i]['pivotindex']);

			$this->_mstudioseqdesc_t[$i]['pivot']=$this->mstudiopivot_t(fread($Handle, 20));

			fseek($Handle, $this->_mstudioseqdesc_t[$i]['eventindex']);

			$this->_mstudioseqdesc_t[$i]['event']=$this->mstudioevent_t(fread($Handle, 76));

			ksort($this->_mstudioseqdesc_t[$i]);
		}
		/*fseek($Handle, $this->_studiohdr_t['seqindex']);
		for($i=1;$i<=$this->_studiohdr_t['numseq'];$i++) {
			$this->studioseqhdr_t(fread($Handle, 76));
			//fseek($Handle, 76);
		}*/
		fseek($Handle, $this->_studiohdr_t['boneindex']);
		for($i=1;$i<=$this->_studiohdr_t['numbones'];$i++) {
			$this->mstudiobone_t(fread($Handle, 112));
			//fseek($Handle, 112);
		}
		fseek($Handle, $this->_studiohdr_t['bonecontrollerindex']);
		for($i=1;$i<=$this->_studiohdr_t['numbonecontrollers'];$i++) {
			$this->mstudiobone_t(fread($Handle, 24));
			//fseek($Handle, 24);
		}
		fseek($Handle, $this->_studiohdr_t['seqgroupindex']);
		for($i=1;$i<=$this->_studiohdr_t['numseqgroups'];$i++) {
			$this->mstudioseqgroup_t(fread($Handle, 104));
			//fseek($Handle, 104);
		}
		fseek($Handle, $this->_studiohdr_t['textureindex']);
		for($i=1;$i<=$this->_studiohdr_t['numtextures'];$i++) {
			$this->mstudiotexture_t(fread($Handle, 80));
			//fseek($Handle, 80*$i);
		}

		fclose($Handle);
	}

    public function studiohdr_t($buffer) {
		$struct = 	"iid/".                             // Model format ID, such as "IDST" (0x49 0x44 0x53 0x54)
					"iversion/".                        // Format version number, such as 48 (0x30,0x00,0x00,0x00)
					"A64name/".                        	// The internal name of the model, padding with null bytes.
					"ilength/".                         // Data size of MDL file in bytes.
					"f3eyeposition/". 					// ideal eye position
					"f3min/".                          	// ideal movement hull size
					"f3max/".
					"f3bbmin/".
					"f3bbmax/".
					"iflags/".
					"inumbones/".						// bones
					"iboneindex/".
					"inumbonecontrollers/".            	// bone controllers
					"ibonecontrollerindex/".
					"inumhitboxes/".                   	// complex bounding boxes
					"ihitboxindex/".
					"inumseq/".                         // animation sequences
					"iseqindex/".
					"inumseqgroups/".                   // demand loaded sequences
					"iseqgroupindex/".
					"inumtextures/".                    // raw textures
					"itextureindex/".
					"itexturedataindex/".
					"inumskinref/".                     // replaceable textures
					"inumskinfamilies/".
					"iskinindex/".
					"inumbodyparts/".
					"ibodypartindex/".
					"inumattachments/".                 // queryable attachable points
					"iattachmentindex/".
					"isoundtable/".
					"isoundindex/".
					"isoundgroups/".
					"isoundgroupindex/".
					"inumtransitions/".             	// animation node to animation node transition graph
					"itransitionindex";
		$this->_studiohdr_t = unpack($struct, $buffer);
	}

	public function studioseqhdr_t($buffer) {
		$struct = 	"iid/".
					"iversion/".
					"A64name/".
					"ilength";
		$this->_studioseqhdr_t[] = unpack($struct, $buffer);
	}

	public function mstudiobone_t($buffer) {
		$struct = 	"A32name/".
					"iparent/".
					"iflags/".
					"i6bonecontroller/".
					"f6value/".
					"f6scale";
		$this->_mstudiobone_t[] = unpack($struct, $buffer);
	}

	public function mstudiobonecontroller_t($buffer) {
		$struct = 	"ibone/".
					"itype/".
					"fstart/".
					"fend/".
					"irest/".
					"iindex";
		$this->_mstudiobonecontroller_t[] = unpack($struct, $buffer);
	}

	public function mstudiobbox_t($buffer) {
		$struct = 	"ibone/".
					"igroup/".
					"f3bbmin/".
					"f3bbmax";
		$this->_mstudiobbox_t[] = unpack($struct, $buffer);
	}

	public function mstudioseqgroup_t($buffer) {
		$struct = 	"A32label/".   						// textual name
					"A64name/".                         // file name
					"icache/".                         	// cache index pointer
					"idata";                          	// hack for group 0
		$this->_mstudioseqgroup_t[] = unpack($struct, $buffer);
	}

	public function mstudioseqdesc_t($buffer) {
		$struct = 	"A32label/".  						// sequence label
					"ffps/".                            // frames per second
					"iflags/".                          // looping/non-looping flags
					"iactivity/".
					"iactweight/".
					"inumevents/".
					"ieventindex/".
					"inumframes/".
					"inumpivots/".
					"ipivotindex/".
					"imotiontype/".
					"imotionbone/".
					"f3linearmovement/".
					"iautomoveposindex/".
					"iautomoveangleindex/".
					"f3bbmin/".
					"f3bbmax/".
					"inumblends/".
					"ianimindex/".
					"i2blendtype/".
					"f2blendstart/".
					"f2blendend/".
					"iblendparent/".
					"iseqgroup/".
					"ientrynode/".
					"iexitnode/".
					"inodeflags/".
					"inextseq";
		$this->_mstudioseqdesc_t[] = unpack($struct, $buffer);
	}
	/*
	// sequence descriptions
typedef struct
{

	int					seqgroup;		// sequence group for demand loading

	int					entrynode;		// transition node at entry
	int					exitnode;		// transition node at exit
	int					nodeflags;		// transition rules

	int					nextseq;		// auto advancing sequences
} mstudioseqdesc_t;
*/
// events
	public function mstudioevent_t($buffer) {
		$struct = 	"iframe/".
					"ievent/".
					"itype/".
					"A64options";
		return unpack($struct, $buffer);
	}
	// pivots
	public function mstudiopivot_t($buffer) {
		$struct = 	"f3org/".
					"istart/".
					"iend";
		return unpack($struct, $buffer);
	}
/*
// attachment
typedef struct
{
	char				name[32];
	int					type;
	int					bone;
	vec3_t				org;	// attachment point
	vec3_t				vectors[3];
} mstudioattachment_t;

typedef struct
{
	unsigned short	offset[6];
} mstudioanim_t;

// animation frames
typedef union
{
	struct {
		byte	valid;
		byte	total;
	} num;
	short		value;
} mstudioanimvalue_t;



// body part index
typedef struct
{
	char				name[64];
	int					nummodels;
	int					base;
	int					modelindex; // index into models array
} mstudiobodyparts_t;


*/
	public function mstudiotexture_t($buffer) {
		$struct = 	"A64name/".
					"iflags/".
					"iwidth/".
					"iheight/".
					"iindex";
		$this->_mstudiotexture_t[] = unpack($struct, $buffer);
	}

/*

// skin families
// short	index[skinfamilies][skinref]

// studio models
typedef struct
{
	char				name[64];

	int					type;

	float				boundingradius;

	int					nummesh;
	int					meshindex;

	int					numverts;		// number of unique vertices
	int					vertinfoindex;	// vertex bone info
	int					vertindex;		// vertex vec3_t
	int					numnorms;		// number of unique surface normals
	int					norminfoindex;	// normal bone info
	int					normindex;		// normal vec3_t

	int					numgroups;		// deformation groups
	int					groupindex;
} mstudiomodel_t;


// vec3_t	boundingbox[model][bone][2];	// complex intersection info


// meshes
typedef struct
{
	int					numtris;
	int					triindex;
	int					skinref;
	int					numnorms;		// per mesh normals
	int					normindex;		// normal vec3_t
} mstudiomesh_t;

// triangles
#if 0
typedef struct
{
	short				vertindex;		// index into vertex array
	short				normindex;		// index into normal array
	short				s,t;			// s,t position on skin
} mstudiotrivert_t;
#endif
	*/

}


class hlmdl extends CComponent
{
	public $TexturesCount, $Path, $File, $FileName, $Version, $IsMDL, $head, $thead, $bhead, $bchead, $hbhead, $ahead, $sghead,$seqhead,$Textures_palette;

    private $FileHandle, $header, $Theader, $Bheader, $BCheader, $HBheader, $SGheader,$SQheader;

    public function __construct($FilePath = array('path'=>'','file'=>''))
		{
    		$this->FileName = $FilePath['path'].$FilePath['file'];
    		$this->File = $FilePath['file'];
    		$this->Path = $FilePath['path'];
    		$this->IsMDL = false;
			$this->header="A4id/".												// Model format ID, such as "IDST" (0x49 0x44 0x53 0x54)
					"Iversion/".                                                // Format version number, such as 48 (0x30,0x00,0x00,0x00)
					"A64name/".                                                 // The internal name of the model, padding with null bytes.
					"ilength/".                                             // Data size of MDL file in bytes.
					"f3eyeposition/".                                           // Position of player viewpoint relative to model origin
					"f3hull_min/".                                              // Corner of model hull box with the least X/Y/Z values
					"f3hull_max/".                                              // Opposite corner of model hull box
					"f3view_bbmin/".
					"f3view_bbmax/".
					"iflags/".                                                  // Binary flags in little-endian order.
					"ibone_count/".
					"ibone_offset/".
					"ibonecontroller_count/".
					"ibonecontroller_offset/".
					"ihitbox_count/".
					"ihitbox_offset/".
					"ilocalanim_count/".
					"ilocalanim_offset/".
					"ilocalseq_count/".
					"ilocalseq_offset/".
					"itexture_count/".
					"itexture_offset/".
					"itexture_data/".
					"iskinref_count/".
					"iskinfamilie_count/".
					"iskin_offset/".
					"ibodypart_count/".
					"ibodypart_offset/".
					"iattachments_count/".
					"iattachment_offset/".
					"isoundtable/".
					"isoundindex/".
					"isoundgroups/".
					"isoundgroupindex/".
					"inumtransitions/".
					"itransitionindex";
			$this->Theader= "A64name/".
							"Iflags/".
							"Iwidth/".
							"Iheight/".
							"Ioffset";
			$this->Bheader= "A32name/".
							"Iparent/".
							"Iflags/".
							"I6bonecontroller/".
							"f6value/".
							"f6scale";
			$this->BCheader="Ibone/".
							"Itype/".
							"fstart/".
							"fend/".
							"Irest/".
							"Iindex";
			$this->HBheader="Ibone/".
							"Igroup/".
							"f3bbmin/".
							"f3bbmax";
			$this->SGheader="A32label/".                                        // textual name
							"A64name/".                                         // file name
							"Icache/".                                          // cache index pointer
							"Idata";                                            // hack for group 0

			$this->SQheader="A32label/". 										// sequence label
							"ffps/".                                            // frames per second
							"Iflags/".                                          // looping/non-looping flags
							"Iactivity/".
							"Iactweight/".
							"Inumevents/".
							"Ieventindex/".
							"Inumframes/".                                       // number of frames per sequence
							"Inumpivots/".                                       // number of foot pivots
							"Ipivotindex/".
							"Imotiontype/".
							"Imotionbone/".
							"f3linearmovement/".
							"Iautomoveposindex/".
							"Iautomoveangleindex/".
							"f3bbmin/".                                          // per sequence bounding box
							"f3bbmax/".
							"Inumblends/".
							"Ianimindex/".                                       // mstudioanim_t pointer relative to start of sequence group data
																				// [blend][bone][X, Y, Z, XR, YR, ZR]
							"I2blendtype/".                                      // X, Y, Z, XR, YR, ZR
							"f2blendstart/".                                     // starting value
							"f2blendend/".                                       // ending value
							"Iblendparent/".                                     // sequence group for demand loading
							"Iseqgroup/".                                        // transition node at entry
							"Ientrynode/".                                       // transition node at exit
							"Iexitnode/".                                        // transition rules
							"Inodeflags/".                                       // auto advancing sequences
							"Inextseq";                                         // auto advancing sequences

    		$this->LoadFromFile();
  		}

  	public function LoadFromFile()
  		{
  			$this->FileHandle = fopen(Yii::app()->basePath.'/..'.$this->FileName, 'rb');
			$header = fread($this->FileHandle, 512);
			$this->head = unpack($this->header, $header);
			if ($this->head["id"]=='IDST') $this->IsMDL = true;
			if ($this->IsMDL)
				{
					// get textures info
					fseek($this->FileHandle, $this->head['texture_offset']);
					for ($i=1;$i<=$this->head['texture_count'];$i++)
					{
						$theader = fread($this->FileHandle, 80);
						$this->thead[$i] = unpack($this->Theader, $theader);
					}
					for ($i=1;$i<=$this->head['texture_count'];$i++)
					{
						fseek($this->FileHandle, $this->thead[$i]['offset']+($this->thead[$i]['width']*$this->thead[$i]['height']));
						for ($n=0; $n<=255; $n++)
						{
							$buffer = fread($this->FileHandle,3);
							$this->Textures_palette[$i][$n] = unpack('CR/CG/CB', $buffer);
						}
					}
					// get bones info
					fseek($this->FileHandle, $this->head['bone_offset']);
					for ($i=1;$i<=$this->head['bone_count'];$i++)
					{
						$Bheader = fread($this->FileHandle, 112);
						$this->bhead[$i] = unpack($this->Bheader, $Bheader);
					}
					//get bones controller info
					fseek($this->FileHandle, $this->head['bonecontroller_offset']);
					for ($i=1;$i<=$this->head['bonecontroller_count'];$i++)
					{
						$BCheader = fread($this->FileHandle, 24);
						$this->bchead[$i] = unpack($this->BCheader, $BCheader);
					}
					//get hitbox info
					fseek($this->FileHandle, $this->head['hitbox_offset']);
					for ($i=1;$i<=$this->head['hitbox_count'];$i++)
					{
						$HBheader = fread($this->FileHandle, 32);
						$this->hbhead[$i] = unpack($this->HBheader, $HBheader);
					}
					// get animation frames
					fseek($this->FileHandle, $this->head['localanim_offset']);
					for ($i=1;$i<=$this->head['localanim_count'];$i++)
					{
						$num = fread($this->FileHandle, 2);
						$ar = unpack("Cvalid/Ctotal", $num);
						$num = fread($this->FileHandle, 2);
						$this->ahead[$i] = unpack("svalue", $num);
						$this->ahead[$i]['num'] = $ar;
					}
					//get sequence groups info
					fseek($this->FileHandle, $this->head['localseq_offset']);
					for ($i=1;$i<=$this->head['localseq_count'];$i++)
					{
						$SGheader = fread($this->FileHandle, 104);
						$this->sghead[$i] = unpack($this->SGheader, $SGheader);
					}
					//Get local animation info
					fseek($this->FileHandle, $this->head['localanim_offset']);
					for ($i=1;$i<=$this->head['localanim_count'];$i++)
					{
						$SQheader = fread($this->FileHandle, 176);
						$this->seqhead[$i] = unpack($this->SQheader, $SQheader);
					}

				}
				$this->TexturesCount = $this->head['texture_count'];
		}
    public function Image($id)
		{
			if ($id<1||$id>$this->head['texture_count']) $id = 1;

			$img = imagecreatetruecolor($this->thead[$id]['width'],$this->thead[$id]['height']);

			fseek($this->FileHandle, $this->thead[$id]['offset']);
			$i = 0;
			//image data indexes
			$indexes = array();
			for ($y=0; $y<=$this->thead[$id]['height']-1; $y++)
				{
					for ($x=0; $x<=$this->thead[$id]['width']-1; $x++)
						{
							$indexes[$i+$y] = ord(fgetc($this->FileHandle));
							$i++;
						}
				}
			// Generate image
			$i = 0;
			for ($y=0; $y<=$this->thead[$id]['height']; $y++)
				{
					for ($x=0; $x<=$this->thead[$id]['width']; $x++)
						{
							imagesetpixel($img,$x,$y,imagecolorallocate($img,
								$this->Textures_palette[$id][isset($indexes[$i])?$indexes[$i]:0]["R"],
								$this->Textures_palette[$id][isset($indexes[$i])?$indexes[$i]:0]["G"],
								$this->Textures_palette[$id][isset($indexes[$i])?$indexes[$i]:0]["B"]
								));
							$i++;
						}
				}

			return $img;
		}
	public function ShowTexture($id = 1, $to_string = false)
	{
		if ($id<1||$id>$this->head['texture_count']) $id = 1;
		if (!is_dir(realpath('').$this->Path.'textures')) mkdir(realpath('').$this->Path.'textures',0777);
		if (!is_file(realpath('').$this->Path.'textures/'.$this->File.'_'.md5($this->thead[$id]['name']).'.png'))
			{
				imagepng($this->Image($id),realpath('').$this->Path.'textures/'.$this->File.'_'.md5($this->thead[$id]['name']).'.png');
				ob_start();
				imagepng($this->Image($id));
				$imagedata = ob_get_contents();
				ob_end_clean();
				if ($to_string)
					return  '<img src="data:image/png;base64,'.base64_encode($imagedata).'" alt="'.trim($this->thead[$id]['name'],"\x00..\x1F").'" title="'.trim($this->thead[$id]['name'],"\x00..\x1F").'">';
				else
					echo '<img src="data:image/png;base64,'.base64_encode($imagedata).'" alt="'.trim($this->thead[$id]['name'],"\x00..\x1F").'" title="'.trim($this->thead[$id]['name'],"\x00..\x1F").'">';
				unset($imagedata);
			} else {
				if ($to_string)
					return '<img src="'.$this->Path.'textures/'.$this->File.'_'.md5($this->thead[$id]['name']).'.png" title="'.trim($this->thead[$id]['name'],"\x00..\x1F").'">';
				else
					echo '<img src="'.$this->Path.'textures/'.$this->File.'_'.md5($this->thead[$id]['name']).'.png" title="'.trim($this->thead[$id]['name'],"\x00..\x1F").'">';
			}
	}
    public function ShowTextures()
		{
			$out = "<fieldset style=\width:340px;\><legend>Текстуры <b>$this->FileName</b>:</legend>";
			for ($i=1; $i<=$this->head['texture_count']; $i++)
			$out .= "<img src='mdltexture.php?id=$i' alt='".trim($this->thead[$i]['name'],"\x00..\x1F")."'>&nbsp;";
			$out .= "</fieldset>";
			return $out;
		}
    public function ShowPalette($id)
		{
			if ($id<1||$id>$this->head['texture_count']) $id = 1;

			$out = "<fieldset style=\width:340px;\><legend><span title='ID of Image'>[$id]</span> Палитра <b>".trim($this->thead[$id]['name'],"\x00..\x1F")."</b>:</legend><table width=100%>";
			$i=0;
			for ($y=1; $y<=16; $y++)
				{
					$out .= "<tr>";
					for ($x=1; $x<=16; $x++)
						{
							if($this->Textures_palette[$id][$i]['R']>=127)$r=0;else $r=250;
							if($this->Textures_palette[$id][$i]['G']>=127)$g=0;else $g=250;
							if($this->Textures_palette[$id][$i]['B']>=127)$b=0;else $b=250;
                            $out .= "<td align='center' title='R:{$this->Textures_palette[$id][$i]['R']} G:{$this->Textures_palette[$id][$i]['G']} B:{$this->Textures_palette[$id][$i]['B']}' style='color:RGB($r,$g,$b);font-size:9px;font-family:arial;Background:RGB(".$this->Textures_palette[$id][$i]['R'].",".$this->Textures_palette[$id][$i]['G'].",".$this->Textures_palette[$id][$i]['B'].");'>".($i+1)."</td>";
							$i++;
						}
					$out .= "</tr>";
				}
			$out .= "</table></fieldset>";
			return $out;
		}
    public function ShowInfo()
		{
			$out = "<table width=100%>";
			$out .= "<tr><td width=50%><b>Текстуры:</b> {$this->head['texture_count']}</td><td><b>Кости:</b> {$this->head['bone_count']}</td></tr>";
			$out .= "<tr><td width=50%><b>Скины:</b> {$this->head['skinfamilie_count']}</td><td><b>Контроллер кости:</b> {$this->head['bonecontroller_count']}</td></tr>";
			$out .= "<tr><td width=50%><b>Хитбоксы:</b> {$this->head['hitbox_count']}</td><td><b>Части тела:</b> {$this->head['bodypart_count']}</td></tr>";
			$out .= "<tr><td width=50%><b>Анимации:</b> {$this->head['localanim_count']}</td><td>&nbsp;</td></tr>";
			$out .= "</table>";
			$out .= "</fieldset>";
			return $out;
		}
	public function test()
	{
		$tt = New studio($this->FileName);
		echo '<pre>';
		print_r($tt);
		echo '</pre>';
	}
	public function __destruct()
		{
			fclose($this->FileHandle);
		}
}
?>
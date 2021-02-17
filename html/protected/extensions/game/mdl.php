<?php

class Vector3D
{
	public $x;
	public $y;
	public $z;
}


// header for demand loaded sequence group data

class mstudiobbox
{
	public $bone;
	public $group;
	public $bbmin;
	public $bbmax;
}

class MdlHeader
{	public $id;
	public $version;

	public $name;
	public $length;

	public $eyeposition;	// ideal eye position
	public $min;			// ideal movement hull size
	public $max;

	public $bbmin;			// clipping bounding box
	public $bbmax;

	public $flags;

	public $numbones;			// bones
	public $boneindex;

	public $numbonecontrollers;		// bone controllers
	public $bonecontrollerindex;

	public $numhitboxes;			// complex bounding boxes
	public $hitboxindex;

	public $numseq;				// animation sequences
	public $seqindex;

	public $numseqgroups;		// demand loaded sequences
	public $seqgroupindex;

	public $numtextures;		// raw textures
	public $textureindex;
	public $texturedataindex;

	public $numskinref;			// replaceable textures
	public $numskinfamilies;
	public $skinindex;

	public $numbodyparts;
	public $bodypartindex;

	public $numattachments;		// queryable attachable points
	public $attachmentindex;

	public $soundtable;
	public $soundindex;
	public $soundgroups;
	public $soundgroupindex;

	public $numtransitions;		// animation node to animation node transition graph
	public $transitionindex;}

class  TextureHeader
{	public $name;
	public $flags;
	public $width;
	public $heigh;
	public $offset;}

class mdl extends CApplicationComponent {	//public $data;
	public $filename;
	public $relpath;
	public $loaded = false;
	private $handle;
	public $header;
	public $textureInfos;
	public $studioseq;
	public $studioBones;
	public $studioBonesControllers;
	public $studioBoxes;
	public $studioSeqGroup;
	public $Skins;

	public function Load($src)
	{
		$this->loaded = false;
		$this->relpath = realpath($src);
		$tmp_path = explode('/',$this->relpath);
		$this->filename = $tmp_path[count($tmp_path)-1];
		$this->handle = fopen($this->relpath, "rb");
		$contents = stream_get_contents($this->handle);
		//$this->data = $contents;
		if(!$this->readHeader($contents)) return false;
		$this->readTextures($contents);
		$this->readStudioSeq($contents);
		$this->readBones($contents);
		$this->readBonesControllers($contents);
		$this->readBoxes($contents);
		$this->readSeqGroup($contents);
		$this->readSkinFamilies($contents);

		$this->loaded = true;
	}

	public function readStudioSeq($src)
	{		$seek = $this->header->seqindex;
		$this->studioseq = array();
		for($i = 0; $i < $this->header->numseq; $i++)
	    {
	    	$tmp = unpack("A32label/".  						// sequence label
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
					"inextseq", substr($src, $seek, 176));
	        $this->studioseq[] = $tmp;
	        $seek += 176;
	    }
	}
	// bones
	public function readBones($src) {		$seek = $this->header->boneindex;
  		$this->studioBones = array();
		for($i = 0; $i < $this->header->numbones; $i++)
	    {
	    	$tmp = unpack("A32name/iparent/iflags/i6bonecontroller/f6value/f6scale", substr($src, $seek, 112));
	        $this->studioBones[] = $tmp;
	        $seek += 112;
	    }	}

	// bone controllers
	public function readBonesControllers($src) {
		$seek = $this->header->bonecontrollerindex;
  		$this->studioBones = array();
		for($i = 0; $i < $this->header->numbonecontrollers; $i++)
	    {
	    	$tmp = unpack("ibone/itype/fstart/fend/irest/iindex", substr($src, $seek, 24));
	        $this->studioBonesControllers[] = $tmp;
	        $seek += 24;
	    }
	}
	// intersection boxes
	public function readBoxes($src) {
		$seek = $this->header->hitboxindex;
  		$this->studioBoxes = array();
		for($i = 0; $i < $this->header->numhitboxes; $i++)
	    {	    	$bb = new mstudiobbox;
	    	$tmp = unpack("ibone/igroup/f3bbmin/f3bbmax", substr($src, $seek, 32));
	    	$bb->bone = $tmp['bone'];
	    	$bb->group = $tmp['group'];
	    	$bbmin = new Vector3D;
	    	$bbmin->x = $tmp['bbmin1'];
	    	$bbmin->y = $tmp['bbmin2'];
	    	$bbmin->z = $tmp['bbmin3'];
	    	$bb->bbmin = $bbmin;
	    	$bbmax = new Vector3D;
	    	$bbmax->x = $tmp['bbmax1'];
	    	$bbmax->y = $tmp['bbmax2'];
	    	$bbmax->z = $tmp['bbmax3'];
	    	$bb->bbmax = $bbmax;
	        $this->studioBoxes[] = $bb;
	        $seek += 32;
	    }
	}
	// demand loaded sequence groups
	public function readSeqGroup($src) {
		$seek = $this->header->seqgroupindex;
  		$this->studioSeqGroup = array();
		for($i = 0; $i < $this->header->numseqgroups; $i++)
	    {
	    	$tmp = unpack("A32label/A64name/icache/idata", substr($src, $seek, 104));
	        $this->studioSeqGroup[] = $tmp;
	        $seek += 104;
	    }
	}
/*
// demand loaded sequence groups
typedef struct
{
	char				label[32];	// textual name
	char				name[64];	// file name
	cache_user_t		cache;		// cache index pointer
	int					data;		// hack for group 0
} mstudioseqgroup_t;*/

    public function readTextures($src) {    	$seek = $this->header->textureindex;
		$this->textureInfos = array();
		for($i = 0; $i < $this->header->numtextures; $i++)
	    {
	    	$tmp = unpack("A64n/".
							"If/".
							"Iw/".
							"Ih/".
							"Io", substr($src, $seek, 80));
	        $textureInfo = new TextureHeader;
	        $textureInfo->name = $tmp['n'];
	        $textureInfo->flags = $tmp['f'];
	        $textureInfo->width = $tmp['w'];
	        $textureInfo->heigh = $tmp['h'];
	        $textureInfo->offset = $tmp['o'];
	        $this->textureInfos[] = $textureInfo;
	        $seek += 80;
	    }    }
    /*
    // skin families
// short	index[skinfamilies][skinref]
    */

    public function readSkinFamilies($src) {
    	$seek = $this->header->skinindex;
		$this->Skins = array();
		for($i = 0; $i < $this->header->numskinfamilies; $i++)
	    {
	    	$tmp = unpack("S". $this->header->numskinref."skinref", substr($src, $seek, $this->header->numskinref*2));
	        $this->Skins[$i] = $tmp;
	        //$this->Skins[$i]['textures'] = $this->textureInfos[$tmp['tid2']];
	        $seek += $this->header->numskinref*2;
	    }
    }

	public function readHeader($src) {
		$this->header = New MdlHeader;
		$tmp = unpack(	'A4id/'.
						'Iversion/'.
						'A64name/'.
						'Ilength/'.
						'f3eyeposition/'.
						'f3min/'.
						'f3max/'.
						'f3bbmin/'.
						'f3bbmax/'.
						'Iflags/'.
						'Inumbones/'.
						'Iboneindex/'.
						'Inumbonecontrollers/'.
						'Ibonecontrollerindex/'.
						'Inumhitboxes/'.
						'Ihitboxindex/'.
						'Inumseq/'.
						'Iseqindex/'.
						'Inumseqgroups/'.
						'Iseqgroupindex/'.
						'Inumtextures/'.
						'Itextureindex/'.
						'Itexturedataindex/'.
						'Inumskinref/'.
						'Inumskinfamilies/'.
						'Iskinindex/'.
						'Inumbodyparts/'.
						'Ibodypartindex/'.
						'Inumattachments/'.
						'Iattachmentindex/'.
						'Isoundtable/'.
						'Isoundindex/'.
						'Isoundgroups/'.
						'Isoundgroupindex/'.
						'Inumtransitions/'.
						'Itransitionindex', $src);
		$this->header->id = $tmp['id'];		$this->header->version = $tmp['version'];
		$this->header->name = $tmp['name'];
		$this->header->length = $tmp['length'];
		$this->header->eyeposition = New Vector3D;
		$this->header->eyeposition->x = $tmp['eyeposition1'];
		$this->header->eyeposition->y = $tmp['eyeposition2'];
		$this->header->eyeposition->z = $tmp['eyeposition3'];        $this->header->min = New Vector3D;
		$this->header->min->x = $tmp['min1'];
		$this->header->min->y = $tmp['min2'];
		$this->header->min->z = $tmp['min3'];
		$this->header->max = New Vector3D;
		$this->header->max->x = $tmp['max1'];
		$this->header->max->y = $tmp['max2'];
		$this->header->max->z = $tmp['max3'];
		$this->header->bbmin = New Vector3D;
		$this->header->bbmin->x = $tmp['bbmin1'];
		$this->header->bbmin->y = $tmp['bbmin2'];
		$this->header->bbmin->z = $tmp['bbmin3'];
		$this->header->bbmax = New Vector3D;
		$this->header->bbmax->x = $tmp['bbmax1'];
		$this->header->bbmax->y = $tmp['bbmax2'];
		$this->header->bbmax->z = $tmp['bbmax3'];
		$this->header->flags= $tmp['flags'];
		$this->header->numbones= $tmp['numbones'];
		$this->header->boneindex= $tmp['boneindex'];
		$this->header->numbonecontrollers= $tmp['numbonecontrollers'];
		$this->header->bonecontrollerindex= $tmp['bonecontrollerindex'];
		$this->header->numhitboxes= $tmp['numhitboxes'];
		$this->header->hitboxindex= $tmp['hitboxindex'];
		$this->header->numseq= $tmp['numseq'];
		$this->header->seqindex= $tmp['seqindex'];
		$this->header->numseqgroups= $tmp['numseqgroups'];
		$this->header->seqgroupindex= $tmp['seqgroupindex'];
		$this->header->numtextures= $tmp['numtextures'];
		$this->header->textureindex= $tmp['textureindex'];
		$this->header->texturedataindex= $tmp['texturedataindex'];
		$this->header->numskinref= $tmp['numskinref'];
		$this->header->numskinfamilies= $tmp['numskinfamilies'];
		$this->header->skinindex= $tmp['skinindex'];
		$this->header->numbodyparts= $tmp['numbodyparts'];
		$this->header->bodypartindex= $tmp['bodypartindex'];
		$this->header->numattachments= $tmp['numattachments'];
		$this->header->attachmentindex= $tmp['attachmentindex'];
		$this->header->soundtable= $tmp['soundtable'];
		$this->header->soundindex= $tmp['soundindex'];
		$this->header->soundgroups= $tmp['soundgroups'];
		$this->header->soundgroupindex= $tmp['soundgroupindex'];
		$this->header->numtransitions= $tmp['numtransitions'];
		$this->header->transitionindex= $tmp['transitionindex'];
		//fseek($this->handle, 2);




		return true;
	}}

?>
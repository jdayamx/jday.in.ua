<?php

define('HEADER_LUMPS', 15);
define('MAX_MAP_HULLS', 4);
define('LUMP_ENTITIES', 0);
define('LUMP_PLANES', 1);
define('LUMP_TEXTURES', 2);
define('LUMP_VERTICES', 3);
define('LUMP_NODES', 5);
define('LUMP_TEXINFO', 6);
define('LUMP_FACES', 7);
define('LUMP_CLIPNODES', 9);
define('LUMP_LEAVES', 10);
define('LUMP_MARKSURFACES', 11);
define('LUMP_EDGES', 12);
define('LUMP_SURFEDGES', 13);
define('LUMP_MODELS', 14);
define('SIZE_OF_BSPNODE', 24);
define('SIZE_OF_BSPLEAF', 28);
define('SIZE_OF_BSPTEXTUREINFO', 40);
define('SIZE_OF_BSPMODEL', 64);
define('SIZE_OF_BSPMARKSURFACE', 2);
define('SIZE_OF_BSPPLANE', 20);
define('SIZE_OF_BSPVERTEX', 12);
define('SIZE_OF_BSPEDGE', 4);
define('SIZE_OF_BSPFACE', 20);
define('SIZE_OF_BSPSURFEDGE', 4);
define('MAXTEXTURENAME', 16);
define('MIPLEVELS', 4);
define('SIZE_OF_BSPCLIPNODE', 8);

class Entity
{
	public $properties;
	public function __construct($entityString) {		$this->properties = array();
		preg_match_all('|"(.*?)"\s+"(.*?)"|',$entityString,$out);
		for($i=0;$i<count($out[1]);$i++) {			$this->properties[trim($out[1][$i])] = trim($out[2][$i]);		}
		ksort($this->properties);	}
}

class BspClipNode
{
	public $plane;    // Index into planes
	public $children; // negative numbers are contents behind and in front of the plane
}

class BspMipTexture
{
	public $name;    // Name of texture, for reference from external WAD file
	public $width;   // Extends of the texture
	public $height;
	public $offsets; // Offsets to MIPLEVELS texture mipmaps, if 0 texture data is stored in an external WAD file
}

class BspTextureHeader
{
	public $textures; // Number of BSPMIPTEX structures
	public $offsets;  // Array of offsets to the textures
}

class BspEdge
{
	public $vertices; // Indices into vertex array
}

class BspPlane
{
    public $normal; // The planes normal vector
    public $dist;   // Plane equation is: vNormal * X = fDist
    public $type;   // Plane type, see vars
};

class Vector3D
{	public $x;
	public $y;
	public $z;}

class BspModel
{
	public $mins;      // Defines bounding box
	public $maxs;
	public $origin;    // Coordinates to move the coordinate system before drawing the model
	public $headNodes; // Indexes into nodes (first into world nodes, remaining into clip nodes)
	public $visLeafs;  // No idea
	public $firstFace; // Index and count into face array
	public $faces;
}

class BspTextureInfo
{	public $s;          // 1st row of texture matrix
	public $sShift;     // Texture shift in s direction
	public $t;          // 2nd row of texture matrix - multiply 1st and 2nd by vertex to get texture coordinates
	public $tShift;     // Texture shift in t direction
	public $mipTexture; // Index into mipTextures array
	public $flags;      // Texture flags, seems to always be 0}
class BspNode
{
   // public $plane;     // Index into pPlanes lump
    //public $children;  // If > 0, then indices into Nodes otherwise bitwise inverse indices into Leafs
	//public $mins;      // Bounding box
	//public $maxs;
	//public $firstFace; // Index and count into BSPFACES array
	//public $faces;
}

class BspLump
{
    public $offset; // File offset to data
    public $length; // Length of data
}

class BspHeader
{
    public $version;
    public $lumps;
}


class bsp extends CApplicationComponent {
	public $header;

    public $nodes;
    public $leaves;
    public $markSurfaces;
    public $planes;
    public $vertices; // actually not needed for rendering, vertices are stored in vertexBuffer. But just in case someone needs them for e.g. picking etc.
    public $edges;
    public $faces;
    public $surfEdges;
    public $textureHeader;
    public $mipTextures;
    public $textureInfos;
    public $models;
    public $clipNodes;

	/** Array of Entity objects. @see Entity */
	public $entities;

	/** References to the entities that are brush entities. Array of Entity references. */
	public $brushEntities;

	//
	// Calculated
	//

	/** Stores the missing wads for this bsp file */
	public $missingWads;

	/** Array (for each face) of arrays (for each vertex of a face) of JSONs holding s and t coordinate. */
	public $textureCoordinates;
	public $lightmapCoordinates;

	/**
	 * Contains a plan white 1x1 texture to be used, when a texture could not be loaded yet.
	 */
	public $whiteTexture;

	/**
	 * Stores the texture IDs of the textures for each face.
	 * Most of them will be dummy textures until they are later loaded from the Wad files.
	 */
	public $textureLookup;

	/** Stores the texture IDs of the lightmaps for each face */
	public $lightmapLookup;

	/** Stores a list of missing textures */
	public $missingTextures;

	/** An array (for each leaf) of arrays (for each leaf) of booleans. */
	public $visLists;

	//
	// Buffers
	//
	public $vertexBuffer;
	public $texCoordBuffer;
	public $lightmapCoordBuffer;
	public $normalBuffer;

	/** Holds start index and count of indexes into the buffers for each face. Array of JSONs { start, count } */
	public $faceBufferRegions;

	/** If set to true, all resources are ready to render */
	private $loaded = false;
	public $isPalette_exports = false;

	private $relpath = '';
	private $filename = '';
	//public $data = '';
	private $handle;
    public $skip_defaults = true;
	private $default_wads = array(
		'cached.wad',
		'decals.wad',
		'fonts.wad',
		'gfx.wad',
		'halflife.wad',
		'liquids.wad',
		'spraypaint.wad',
		'xeno.wad',

		'ajawad.wad',
		'cached.wad',
		'chateau.wad',
		'cs_747.wad',
		'cs_assault.wad',
		'cs_bdog.wad',
		'cs_cbble.wad',
		'cs_dust.wad',
		'cs_havana.wad',
		'cs_office.wad',
		'cstraining.wad',
		'cstrike.wad',
		'de_airstrip.wad',
		'de_aztec.wad',
		'decals.wad',
		'de_piranesi.wad',
		'de_storm.wad',
		'de_vertigo.wad',
		'iga_static.wad',
		'itsitaly.wad',
		'n0th1ng.wad',
		'prodigy.wad',
		'torntextures.wad',
		'tswad.wad',
	);

	private $default_spr = array(
		'320hud1.spr',
		'320hud2.spr',
		'320hud3.spr',
		'320hud4.spr',
		'320_logo.spr',
		'320_pain.spr',
		'320_train.spr',
		'640hud1.spr',
		'640hud2.spr',
		'640hud3.spr',
		'640hud4.spr',
		'640hud5.spr',
		'640hud6.spr',
		'640hud7.spr',
		'640hud8.spr',
		'640hud9.spr',
		'640_logo.spr',
		'640_pain.spr',
		'640_train.spr',
		'aexplo.spr',
		'agrunt1.spr',
		'animglow01.spr',
		'arrow1.spr',
		'ballsmoke.spr',
		'bexplo.spr',
		'bhit.spr',
		'bigspit.spr',
		'blast.spr',
		'blooddrop.spr',
		'blood.spr',
		'bloodspray.spr',
		'blueflare1.spr',
		'blueflare2.spr',
		'bluejet1.spr',
		'bm1.spr',
		'bolt1.spr',
		'b-tele1.spr',
		'bubble.spr',
		'camera.spr',
		'cexplo.spr',
		'cnt1.spr',
		'crosshairs.spr',
		'c-tele1.spr',
		'dexplo.spr',
		'dot.spr',
		'd-tele1.spr',
		'eexplo.spr',
		'enter1.spr',
		'e-tele1.spr',
		'exit1.spr',
		'explode1.spr',
		'explode2.spr',
		'fexplo1.spr',
		'fexplo.spr',
		'fire.spr',
		'flare1.spr',
		'flare2.spr',
		'flare3.spr',
		'flare4.spr',
		'flare5.spr',
		'flare6.spr',
		'gargeye1.spr',
		'gexplo.spr',
		'glow01.spr',
		'glow02.spr',
		'glow03.spr',
		'glow04.spr',
		'glow05.spr',
		'gwave1.spr',
		'hexplo.spr',
		'hotglow.spr',
		'iflagblue.spr',
		'iflagred.spr',
		'iplayerblue.spr',
		'iplayerdead.spr',
		'iplayerred.spr',
		'iplayer.spr',
		'iunknown.spr',
		'laserbeam.spr',
		'laserdot.spr',
		'lgtning.spr',
		'logo.spr',
		'mommablob.spr',
		'mommaspit.spr',
		'mommaspout.spr',
		'moths.spr',
		'mushroom.spr',
		'muz1.spr',
		'muz2.spr',
		'muz3.spr',
		'muz4.spr',
		'muz5.spr',
		'muz6.spr',
		'muz7.spr',
		'muz8.spr',
		'muzzleflash1.spr',
		'muzzleflash2.spr',
		'muzzleflash3.spr',
		'muzzleflash.spr',
		'nhth1.spr',
		'oriented.spr',
		'plasma.spr',
		'poison.spr',
		'portal1.spr',
		'redflare1.spr',
		'redflare2.spr',
		'richo1.spr',
		'richo2.spr',
		'rjet1.spr',
		'rope.spr',
		'sdrip1.spr',
		'shellchrome.spr',
		'shockwave.spr',
		'small_logo.spr',
		'smoke.spr',
		'spark1.spr',
		'spotlight01.spr',
		'spotlight02.spr',
		'spotlight03.spr',
		'spotlight04.spr',
		'steam1.spr',
		'stmbal1.spr',
		'streak.spr',
		'tele1.spr',
		'tile.spr',
		'tinyspit.spr',
		'voiceicon.spr',
		'vp_parallel_oriented.spr',
		'vp_parallel.spr',
		'wallpuff.spr',
		'wdrip2.spr',
		'white.spr',
		'wsplash3.spr',
		'WXplo1.spr',
		'xbeam1.spr',
		'xbeam2.spr',
		'xbeam3.spr',
		'xbeam4.spr',
		'xbeam5.spr',
		'xenobeam.spr',
		'xffloor.spr',
		'xfire2.spr',
		'xfireball3.spr',
		'xfire.spr',
		'xflare1.spr',
		'xflare2.spr',
		'xflare3.spr',
		'xsmoke1.spr',
		'xsmoke3.spr',
		'xsmoke4.spr',
		'xspark1.spr',
		'xspark2.spr',
		'xspark3.spr',
		'xspark4.spr',
		'xssmke1.spr',
		'yelflare1.spr',
		'yelflare2.spr',
		'zbeam1.spr',
		'zbeam2.spr',
		'zbeam3.spr',
		'zbeam4.spr',
		'zbeam5.spr',
		'zbeam6.spr',
		'zerogxplode.spr',
	);

	private $default_sky = array(
	'backalley',
	'badlands',
	'blue',
	'city1',
	'cx',
	'Des',
	'de_storm',
	'doom1',
	'DrkG',
	'forest',
	'green',
	'grnplsnt',
	'hav',
	'morningdew',
	'office',
	'snow',
	'snowlake_',
	'tornsky',
	'tsccity_',

	'2desert',
	'alien1',
	'alien2',
	'alien3',
	'black',
	'city',
	'cliff',
	'desert',
	'dusk',
	'morning',
	'neb1',
	'neb2b',
	'neb6',
	'neb7',
	'night',
	'space',
	'xen10',
	'xen8',
	'xen9',

	);


	public function Load($src)
	{		$this->loaded = false;		$this->relpath = realpath($src);
		$tmp_path = explode('/',$this->relpath);
		$this->filename = $tmp_path[count($tmp_path)-1];
		$this->handle = fopen($this->relpath, "rb");
		$contents = stream_get_contents($this->handle);
		//$this->data = $contents;
		//fclose($handle);

    	if(!$this->readHeader($contents)) return false;
    	$this->readNodes($contents);
    	$this->readLeaves($contents);
    	$this->readMarkSurfaces($contents);
	    $this->readPlanes($contents);
    	$this->readVertices($contents);
	    $this->readEdges($contents);
    	$this->readFaces($contents);
	    $this->readSurfEdges($contents);
    	$this->readMipTextures($contents);
    	$this->readTextureInfos($contents);
    	$this->readModels($contents);
    	$this->readClipNodes($contents);
		$this->loadEntities($contents);   // muast be loaded before textures
    	//$this->loadTextures($contents);   // plus coordinates
		$this->loadLightmaps($contents);  // plus coordinates
		//this.loadVIS(src);

		/*

	// FINALLY create buffers for rendering
	this.preRender();
	//this.loadMissingTextures();

    return true;
		*/
		$this->loaded = true;	}

	public function readHeader($src) {		$this->header = New BspHeader;
		$tmp = unpack("i", $src);
		$this->header->version = $tmp[1];
		fseek($this->handle, 2);


		if($this->header->version != 30) {
			return false;
		}

		$this->header->lumps = Array();
		$seek =4;
		for($i=0;$i<HEADER_LUMPS;$i++)
    	{
	        $lump = new BspLump;
	        $tmp = unpack("ioffset/ilength", substr($src,$seek,8));
	        $seek +=8;
	        $lump->offset = $tmp['offset'];
	        $lump->length = $tmp['length'];
	        $this->header->lumps[] = $lump;
	    }

		return true;	}

	public function readNodes($src)
	{		$seek = $this->header->lumps[LUMP_NODES]->offset;
		$this->nodes = Array();
		for($i = 0; $i < round($this->header->lumps[LUMP_NODES]->length / SIZE_OF_BSPNODE); $i++) {			$node = new BspNode;
			$tmp = unpack("Lplane/schildren1/schildren2/sm1/sm2/sm3/sa1/sa2/sa3/Sff/Sf", substr($src,$seek,SIZE_OF_BSPNODE));
			$node->plane = $tmp['plane'];
			$node->children = array();
			$node->children[] = $tmp['children1'];
	        $node->children[] = $tmp['children2'];
	        $node->mins = array();
		    $node->mins[] = $tmp['m1'];
        	$node->mins[] = $tmp['m2'];
	        $node->mins[] = $tmp['m3'];
	        $node->maxs = array();
	        $node->maxs[] = $tmp['a1'];
    	    $node->maxs[] = $tmp['a2'];
        	$node->maxs[] = $tmp['a3'];
        	$node->firstFace =$tmp['ff'];
	        $node->faces = $tmp['f'];
            $seek += SIZE_OF_BSPNODE;

			$this->nodes[] = $node;		}
	}

	public function readLeaves($src)
	{		$seek = $this->header->lumps[LUMP_LEAVES]->offset;
		$this->leaves = array();
		for($i = 0; $i < round($this->header->lumps[LUMP_LEAVES]->length / SIZE_OF_BSPLEAF); $i++) {			$leaf = new BspNode;
			$tmp = unpack("lcontent/lvisOffset/sm1/sm2/sm3/sa1/sa2/sa3/Sff/Sf/Cal1/Cal2/Cal3/Cal4", substr($src,$seek,SIZE_OF_BSPLEAF));
			$leaf->content =  $tmp['content'];
	        $leaf->visOffset =  $tmp['visOffset'];
        	$leaf->mins = array();
        	$leaf->mins[] = $tmp['m1'];
	        $leaf->mins[] = $tmp['m2'];
    	    $leaf->mins[] = $tmp['m3'];

			$leaf->maxs = array();
	        $leaf->maxs[] = $tmp['a1'];
    	    $leaf->maxs[] = $tmp['a2'];
        	$leaf->maxs[] = $tmp['a3'];

	        $leaf->firstMarkSurface = $tmp['ff'];

    	    $leaf->markSurfaces = $tmp['f'];

			$leaf->ambientLevels = array();
    	    $leaf->ambientLevels[] = $tmp['al1'];
        	$leaf->ambientLevels[] = $tmp['al3'];
	        $leaf->ambientLevels[] = $tmp['al3'];
    	    $leaf->ambientLevels[] = $tmp['al4'];


			$seek += SIZE_OF_BSPNODE;
			$this->leaves[] = $leaf;		}	}

	public function readTextureInfos($src)
	{		$seek = $this->header->lumps[LUMP_TEXINFO]->offset;
		$this->textureInfos = array();

		 for($i = 0; $i < round($this->header->lumps[LUMP_TEXINFO]->length / SIZE_OF_BSPTEXTUREINFO); $i++) {		 	$texInfo = new BspTextureInfo;
		 	$tmp = unpack("fs1/fs2/fs3/fs/ft1/ft2/ft3/ft/Lm/Lf", substr($src,$seek,SIZE_OF_BSPTEXTUREINFO));
		 	$texInfo->s = new Vector3D;
	        $texInfo->s->x = $tmp['s1'];
    	    $texInfo->s->y = $tmp['s2'];
        	$texInfo->s->z = $tmp['s3'];
        	$texInfo->sShift = $tmp['s'];
        	$texInfo->t = new Vector3D;
	        $texInfo->t->x = $tmp['t1'];
    	    $texInfo->t->y = $tmp['t2'];
        	$texInfo->t->z = $tmp['t3'];
        	$texInfo->tShift = $tmp['t'];
	        $texInfo->mipTexture = $tmp['m'];
    	    $texInfo->flags = $tmp['f'];

        	$seek += SIZE_OF_BSPTEXTUREINFO;
        	$this->textureInfos[] = $texInfo;		 }	}

	public function loadEntities($src)
	{		$seek = $this->header->lumps[LUMP_ENTITIES]->offset;
		$entityData = str_replace("\n",'',substr($src, $seek, $this->header->lumps[LUMP_ENTITIES]->length));
		//$entityData = substr($src, $seek, $this->header->lumps[LUMP_ENTITIES]->length);
		$this->entities = array();
		$this->brushEntities = array();
		preg_match_all('|\{(.*?)\}|',$entityData,$out);
		foreach ($out[1] as $entityString) {			$entity = new Entity($entityString);			if($this->isBrushEntity($entity))
				$this->brushEntities[] = $entity;

			$this->entities[] = $entity;		}
	}

	public function isBrushEntity($entity)
	{	    if ($entity->properties['model'] == null)
	        return false;

		if(substr($entity->properties['model'],0,1) != '*')
			return false; // external model
		return true;
	}

	public function findEntities($name)
	{
		$matches = array();
		for($i = 0; $i < count($this->entities); $i++)
		{
			$entity = $this->entities[$i];

			if($entity->properties['classname'] == $name)
				$matches[] = $entity;
		}
		return $matches;
	}

	public function getWadList()
	{		$worldspawn = $this->findEntities('worldspawn');
		$wads = array_filter(explode(';',$worldspawn[0]->properties['wad']));
		$wads_value = array();
		foreach ($wads as $wad)
		{
			if (strpos($wad,'\\') === false) {
				$tmp_wad =explode('/', $wad);
			} else {
				$tmp_wad =explode('\\', $wad);
			}
			if($this->skip_defaults) {				if (in_array(mb_strtolower($tmp_wad[count($tmp_wad)-1]), $this->default_wads)) continue;			}
			if (in_array(mb_strtolower($tmp_wad[count($tmp_wad)-2]),array('valve','cstrike'))) {				$wads_value[$tmp_wad[count($tmp_wad)-1]] = implode('/',array_slice($tmp_wad, count($tmp_wad)-2,2));			} else {				$wads_value[$tmp_wad[count($tmp_wad)-1]] = 'cstrike/'.implode('/',array_slice($tmp_wad, count($tmp_wad)-1,1));			}

		}
		return  $wads_value;	}

	public function getResurces()
	{
		$res = $this->WadList;
		$skt_bb = array('bk','dn','ft','lf','rt','up');
		$worldspawn = $this->findEntities('worldspawn');
		$skyname = $worldspawn[0]->properties['skyname'];
		if ($skyname&&in_array(mb_strtolower($skyname), $this->default_sky)) {            	if (in_array(substr($skyname,-2),$skt_bb)) $err = 1; else $err = 0;
				foreach ($skt_bb as $sk)
				{					$name = $skyname.$sk.'.tga';
					if($err)
					$res[$name] = '<font color=red>cstrike/gfx/env/'.str_replace(substr($skyname,-2),'<font color="darkviolett"><b><blink>'.substr($skyname,-2).'</blink></b></font>',$name).'</font>';
					else					$res[$name] = 'cstrike/gfx/env/'.$name;				}

		}

		foreach ($this->findEntities('cycler_sprite') as $ent) {			if (strpos($ent->properties['model'],'\\') === false) {
				$tmp_ent = explode('/', $ent->properties['model']);
			} else {
				$tmp_ent = explode('\\', $ent->properties['model']);
			}
			$res[$tmp_ent[count($tmp_ent)-1]] = (mb_strtolower($tmp_ent[0])!='cstrike'?'cstrike/':'').$ent->properties['model'];		}

		foreach ($this->findEntities('env_sprite') as $ent) {
			if (strpos($ent->properties['model'],'\\') === false) {
				$tmp_ent = explode('/', $ent->properties['model']);
			} else {
				$tmp_ent = explode('\\', $ent->properties['model']);
			}
			if($this->skip_defaults) {
				if (in_array(mb_strtolower($tmp_ent[count($tmp_ent)-1]), $this->default_spr)) continue;
			}
			$res[$tmp_ent[count($tmp_ent)-1]] = (mb_strtolower($tmp_ent[0])!='cstrike'?'cstrike/':'').$ent->properties['model'];
		}

		foreach ($this->findEntities('ambient_generic') as $ent) {
			if (strpos($ent->properties['message'],'\\') === false) {
				$tmp_ent = explode('/', $ent->properties['message']);
			} else {
				$tmp_ent = explode('\\', $ent->properties['message']);
			}
			$res[$tmp_ent[count($tmp_ent)-1]] = (mb_strtolower($tmp_ent[0])!='cstrike'?'cstrike/':'').(mb_strtolower($tmp_ent[1])!='sound'?'sound/':'').$ent->properties['message'];
		}

		return  $res;
	}

	public function GetShortInfo()
	{		$info = array();
		if($this->header) $info['version'] = $this->header->version;
		if($this->nodes) $info['nodes'] = count($this->nodes);
		if($this->leaves) $info['leaves'] = count($this->leaves);
		if($ent = $this->findEntities('worldspawn')) {			$info['mapversion'] = trim($ent[0]->properties['mapversion']);
			$info['MaxRange'] = trim($ent[0]->properties['MaxRange']);
			$info['skyname'] = trim($ent[0]->properties['skyname']);		}
		$ent_tmp = array();
		foreach($this->entities as $ent) {			$ent_tmp[$ent->properties['classname']] +=1;		}
		$info['entities'] = $ent_tmp;
		$info['markSurfaces'] = $this->markSurfaces;
		$info['models'] = count($this->models);
		if (isset($this->planes))
		{
			$info['planes'] = count($this->planes);
		}
		if (isset($this->vertices))
		{
			$info['vertices'] =  count($this->vertices);
		}
	    if (isset($this->edges))
		{
			$info['edges'] = count($this->edges);
		}
		if (isset($this->faces))
		{
			$info['faces'] =  count($this->faces);
		}
		if (isset($this->surfEdges))
		{
			$info['surfEdges'] = count($this->surfEdges);
		}
		if (isset($this->mipTextures))
		{//			$tex_tmp = array();
//			foreach($this->mipTextures as $tex) {
//				$tex_tmp[$tex->name] = $tex->width.'x'.$tex->height;
//			}
			$info['Textures'] = $this->Textures;
		}
		if (isset($this->clipNodes))
		{
			$ret['clipNodes'] = (array) $this->clipNodes;
		}
		$info['files'] = $this->Resurces;		return $info;	}
	public function GetInfo()
	{		$ret = array();
		if ($this->loaded)
		{			$ret['path'] = $this->relpath;
			$ret['filename'] = $this->filename;		}
/*
		if (isset($this->header))
		{			$ret['header'] = array('version'=>$this->header->version, 'lumps'=>$this->header->lumps);		}

		if (isset($this->nodes))
		{
			$ret['nodes'] = $this->nodes;
		}

        if (isset($this->leaves))
		{
			$ret['leaves'] = $this->leaves;
		}
		if (isset($this->textureInfos))
		{
			$ret['textureInfos'] = $this->textureInfos;
		}

		if (isset($this->entities))
		{
			$ret['entities'] = $this->entities;
		}

		if (isset($this->brushEntities))
		{
			$ret['brushEntities'] = (array) $this->brushEntities;
		}


    	if (isset($this->models))
		{
			$ret['models'] = (array) $this->models;
		}

	  	if (isset($this->markSurfaces))
		{
			$ret['markSurfaces'] = (array) $this->markSurfaces;
		}
		if (isset($this->planes))
		{
			$ret['planes'] = (array) $this->planes;
		}
*/		if (isset($this->vertices))
		{
			$ret['vertices'] = (array) $this->vertices;
		}
/*	    if (isset($this->edges))
		{
			$ret['edges'] = (array) $this->edges;
		}
		if (isset($this->faces))
		{
			$ret['faces'] = (array) $this->faces;
		}
		if (isset($this->surfEdges))
		{
			$ret['surfEdges'] = (array) $this->surfEdges;
		}
		if (isset($this->mipTextures))
		{
			$ret['mipTextures'] = (array) $this->mipTextures;
		}
		if (isset($this->clipNodes))
		{
			$ret['clipNodes'] = (array) $this->clipNodes;
		}
*/		if (isset($this->textureCoordinates))
		{
			$ret['textureCoordinates'] = (array) $this->textureCoordinates;
		}
		ksort($ret);
		return $ret;
	}

	public function readModels($src)
	{		$seek = $this->header->lumps[LUMP_MODELS]->offset;
		$this->models = array();
		for($i=0; $i < round($this->header->lumps[LUMP_MODELS]->length / SIZE_OF_BSPMODEL); $i++)
	    {	    	$model = new BspModel;
	    	$thn = array();
	    	for($j = 0; $j < MAX_MAP_HULLS; $j++) $thn[] = 'Ln'.$j;
	    	$tmp = unpack("fmi1/fmi2/fmi3/fma1/fma2/fma3/fv1/fv2/fv3/".implode('/',$thn)."/Lvl/Lff/Lf", substr($src, $seek, SIZE_OF_BSPMODEL));
	    	$model->mins = array();
	    	$model->mins[] = round($tmp['mi1'],2);
	    	$model->mins[] = round($tmp['mi2'],2);
	    	$model->mins[] = round($tmp['mi3'],2);
	    	$model->maxs = array();
	    	$model->maxs[] = round($tmp['ma1'],2);
	    	$model->maxs[] = round($tmp['ma2'],2);
	    	$model->maxs[] = round($tmp['ma3'],2);
	    	$model->origin = new Vector3D;
	    	$model->origin->x = round($tmp['v1'],2);
	        $model->origin->y = round($tmp['v2'],2);
	        $model->origin->z = round($tmp['v3'],2);
	        $model->headNodes = array();
	        for($j = 0; $j < MAX_MAP_HULLS; $j++) {	        	$model->headNodes[] = $tmp[(string) 'n'.$j];
	        	echo $tmp['n'+$j];	        }
            $model->visLeafs = $tmp['vl'];
	        $model->firstFace = $tmp['ff'];
	        $model->faces = $tmp['f'];
	        $this->models[] = $model;
	    	$seek += SIZE_OF_BSPMODEL;	    }
	}

	public function readMarkSurfaces($src)
	{		$seek = $this->header->lumps[LUMP_MARKSURFACES]->offset;
		$this->markSurfaces = array();
		for($i = 0; $i < round($this->header->lumps[LUMP_MARKSURFACES]->length / SIZE_OF_BSPMARKSURFACE); $i++) {			$tmp = unpack("Sms", substr($src, $seek, SIZE_OF_BSPMARKSURFACE));			$this->markSurfaces = $tmp['ms'];
			$seek += SIZE_OF_BSPMARKSURFACE;		}
	}

	public function readPlanes($src)
	{		$seek = $this->header->lumps[LUMP_PLANES]->offset;
		$this->planes = array();
		for($i = 0; $i < round($this->header->lumps[LUMP_PLANES]->length / SIZE_OF_BSPPLANE); $i++)
	    {	    	$tmp = unpack("fn1/fn2/fn3/fd/Lt", substr($src, $seek, SIZE_OF_BSPPLANE));	    	$plane = new BspPlane;
	    	$plane->normal = new Vector3D;
	        $plane->normal->x = $tmp['n1'];
	        $plane->normal->y = $tmp['n2'];
	        $plane->normal->z = $tmp['n3'];
	        $plane->dist =  round($tmp['d'],2);
	        $plane->type =  $tmp['t'];
	        $this->planes[] = $plane;
	        $seek += SIZE_OF_BSPPLANE;	    }
	}

	public function readVertices($src)
	{
	    $seek = $this->header->lumps[LUMP_VERTICES]->offset;
	    $this->vertices = array();
	    for($i = 0; $i < $this->header->lumps[LUMP_VERTICES]->length / SIZE_OF_BSPVERTEX; $i++)
	    {	    	$tmp = unpack("fx/fy/fz", substr($src, $seek, SIZE_OF_BSPVERTEX));
	        $vertex = new Vector3D;
	        $vertex->x = round($tmp['x'],2);
	        $vertex->y = round($tmp['y'],2);
	        $vertex->z = round($tmp['z'],2);
	        $this->vertices[] = $vertex;
	        $seek += SIZE_OF_BSPVERTEX;
	    }
	}

	public function readEdges($src)
	{		$seek = $this->header->lumps[LUMP_EDGES]->offset;
		$this->edges = array();
		for($i = 0; $i < round($this->header->lumps[LUMP_EDGES]->length / SIZE_OF_BSPEDGE); $i++)
	    {	    	$tmp = unpack("Sv1/Sv2", substr($src, $seek, SIZE_OF_BSPEDGE));
	        $edge = new BspEdge;
			$edge->vertices = array();
	        $edge->vertices[] = $tmp['v1'];
	        $edge->vertices[] = $tmp['v2'];
	        $this->edges[] = $edge;
	        $seek += SIZE_OF_BSPEDGE;
	    }
	}

	public function readFaces($src)
	{		$seek = $this->header->lumps[LUMP_FACES]->offset;
		$this->faces = array();	    for($i = 0; $i < round($this->header->lumps[LUMP_FACES]->length / SIZE_OF_BSPFACE); $i++)
	    {	    	$tmp = unpack("Sp/Sps/lfe/Se/Sti/Cs1/Cs2/Cs3/Cs4/Llo", substr($src, $seek, SIZE_OF_BSPFACE));
	        $face = new BspEdge;
	        $face->plane = $tmp['p'];
	        $face->planeSide = $tmp['ps'];
	        $face->firstEdge = $tmp['fe'];
	        $face->edges = $tmp['e'];
	        $face->textureInfo = $tmp['ti'];
			$face->styles = array();
	        $face->styles[] = $tmp['s1'];
	        $face->styles[] = $tmp['s2'];
	        $face->styles[] = $tmp['s3'];
	        $face->styles[] = $tmp['s4'];
	        $face->lightmapOffset = $tmp['lo'];
	        $this->faces[] = $face;
	        $seek += SIZE_OF_BSPFACE;
	    }
	}

	public function readSurfEdges($src)
	{		$seek = $this->header->lumps[LUMP_SURFEDGES]->offset;
		$this->surfEdges = array();
	    for($i = 0; $i < round($this->header->lumps[LUMP_SURFEDGES]->length / SIZE_OF_BSPSURFEDGE); $i++)
	    {	    	$tmp = unpack("lse", substr($src, $seek, SIZE_OF_BSPSURFEDGE));
	        $this->surfEdges[] = $tmp['se'];
	        $seek += SIZE_OF_BSPSURFEDGE;
	    }
	}

	public function readTextureHeader($src)
	{		$seek = $this->header->lumps[LUMP_TEXTURES]->offset;
	    $this->textureHeader = new BspTextureHeader;
	    $tmp = unpack("Lth", substr($src, $seek, 4));
	    $seek += 4;
	    $this->textureHeader->textures = $tmp['th'];
		$this->textureHeader->offsets = array();
	    for($i = 0; $i < $this->textureHeader->textures; $i++) {	    	$tmp = unpack("lth", substr($src, $seek, 4));	    	$this->textureHeader->offsets[] = $tmp['th'];
	    	$seek += 4;	    }
	}
	public function getTextures()
	{		$tex_ar = array();
		//$this->data
		$co = 0;
		if(count($this->mipTextures)>1) {			foreach ($this->mipTextures as $tex)
			{				if (!$tex->paldata) continue;
				$nn=1;
				$pp='<table border=1 width="500">';
				$seek = 0;
				for($i=0;$i<256;$i++)
				 {				 	if ($nn==1) $pp .= '<tr>';
				 	$pal[$i] = unpack('Cr/Cg/Cb', substr($tex->paldata, $seek, 3));
				 	//array( 'r'=>ord($tex_pal[$i*3]),'g'=>ord($tex_pal[$i*3]+1),'b'=>ord($tex_pal[$i*3]+2));
				 	$pp .= '<td width="16" style="background:RGB('.$pal[$i]['r'].','.$pal[$i]['g'].','.$pal[$i]['b'].');text-align:center;">'.$i.'</td>';
				 	if ($nn>=16) {$nn = 0;$pp .= '</tr>';}
				 	$nn++;
				 	$seek +=3;				 }
				 $pp .='</table>';
				$co++;
				$img = imagecreatetruecolor($tex->width, $tex->height);
		       	$i = 0;
		       	for ($y=0; $y<=($tex->height-1); $y++)
					{
						for ($x=0; $x<=($tex->width-1); $x++)
							{
								$indexes[$i+$y] = ord($tex->data[$i]);
								$i++;
							}
					}
				// Generate image
				$i = 0;
				for ($y=0; $y<=$tex->height; $y++)
					{
						for ($x=0; $x<=$tex->width; $x++)
							{
								imagesetpixel($img,$x,$y,imagecolorallocate($img,$pal[$indexes[$i]]['r'],$pal[$indexes[$i]]['g'],$pal[$indexes[$i]]['b']
								//imagesetpixel($img,$x,$y,imagecolorallocate($img,$indexes[$i],3,0
										//$this->Textures_palette[$id][isset($indexes[$i])?$indexes[$i]:0]["R"],
										//$this->Textures_palette[$id][isset($indexes[$i])?$indexes[$i]:0]["G"],
										//$this->Textures_palette[$id][isset($indexes[$i])?$indexes[$i]:0]["B"]
									));
								$i++;
							}
					}
				unset($indexes);
				$tex_ar[$tex->name]['size'] = $tex->width.'x'.$tex->height;
				if ($this->isPalette_exports) $tex_ar[$tex->name]['palette'] = $pp;
				unset($pal);
				//ob_start();
				if (!is_dir(realpath('uploads'))) mkdir(realpath('uploads'));
				if (!is_dir(realpath('uploads/Textures'))) mkdir(realpath('uploads/Textures'));
				if (!is_dir(realpath('uploads/Textures').'/'.$this->filename)) mkdir(realpath('uploads/Textures').'/'.$this->filename);
				imagepng($img,realpath('uploads/Textures').'/'.$this->filename.'/'.$this->filename.'_'.md5($tex->name).'.png');
				//$imagedata = ob_get_contents();
				//ob_end_clean();
				$tex_ar[$tex->name]['img'] = '<img src="/uploads/Textures/'.$this->filename.'/'.$this->filename.'_'.md5($tex->name).'.png" alt="'.trim($tex->name,"\x00..\x1F").'" title="'.trim($tex->name,"\x00..\x1F").'">';
				//$tex_ar[$tex->name]['img'] = '<img src="data:image/png;base64,'.base64_encode($imagedata).'" alt="'.trim($tex->name,"\x00..\x1F").'" title="'.trim($tex->name,"\x00..\x1F").'">';
				//if($co==5)break;			}
		}
		return $tex_ar;	}
	public function readMipTextures($src)
	{
	    $this->readTextureHeader($src);
		$this->mipTextures = array();
		for($j = 0; $j < MIPLEVELS; $j++) $ml[] = 'Lml'.$j;
		$seek_t = 0;
	    for($i = 0; $i < $this->textureHeader->textures; $i++)
	    {	    	$seek = $this->header->lumps[LUMP_TEXTURES]->offset + $this->textureHeader->offsets[$i];
	    	$tmp = unpack("A".MAXTEXTURENAME."n/Lw/Lh/".implode('/',$ml)."/", substr($src, $seek, SIZE_OF_BSPTEXTUREINFO));
	    	$miptex = new BspMipTexture;
	        $miptex->name = trim(str_replace(array("\n",'Qu'),'',$tmp['n']));
	        $miptex->width = $tmp['w'];
	       	$miptex->height = $tmp['h'];
			$miptex->offsets = array();
	       	for($j = 0; $j < MIPLEVELS; $j++) {	       		$miptex->offsets[] =$tmp[(string) 'ml'.$j];	       	}
	       	// Fetch color palette
	       	if($miptex->offsets[MIPLEVELS - 1]){
				$miptex->paldata = substr($src, $seek + $miptex->offsets[MIPLEVELS - 1] + (($miptex->width / 8) * ($miptex->height / 8)) + 2, 256*3+3);
          		$miptex->data =  substr($src, $seek + $miptex->offsets[0], $miptex->width*$miptex->height);
	       	} else {	       		//echo  substr($src, $seek +SIZE_OF_BSPTEXTUREINFO, $miptex->width*$miptex->height+100).'<br>';	       	}
	        $this->mipTextures[] = $miptex;
	    }
	}

	public function readClipNodes($src)
	{
	    $seek = $this->header->lumps[LUMP_CLIPNODES]->offset;
		$this->clipNodes = array();
	    for($i = 0; $i < round($this->header->lumps[LUMP_CLIPNODES]->length / SIZE_OF_BSPCLIPNODE); $i++)
	    {	    	$tmp = unpack("Lp/sc1/sc2", substr($src, $seek, SIZE_OF_BSPCLIPNODE));
	       	$clipNode = new BspClipNode;
	        $clipNode->plane = $tmp['p'];
			$clipNode->children = array();
	        $clipNode->children[] = $tmp['c1'];
	        $clipNode->children[] = $tmp['c2'];

	        $this->clipNodes[] = $clipNode;
	        $seek += SIZE_OF_BSPCLIPNODE;
	    }
	}

	public function dotProduct($a = array(), $b = array())
	{		$runningSum = 0;
		//foreach ((array) $a as $key=>$val) {			$runningSum += $a->x * $b->x;
			$runningSum += $a->y * $b->y;
			$runningSum += $a->z * $b->z;		//}
		return $runningSum;	}

	public function loadTextures($src)
	{
		$this->textureCoordinates = array();
	    for ($i = 0; $i < count($this->faces); $i++)
	    {
			$face = $this->faces[$i];
			$texInfo = $this->textureInfos[$face->textureInfo];

			$faceCoords = array();

	        for ($j = 0; $j < $face->edges; $j++)
	        {
	            $edgeIndex = $this->surfEdges[$face->firstEdge + $j];

				$vertexIndex = 0;
	            if ($edgeIndex > 0)
	            {
					$edge = $this->edges[$edgeIndex];
					$vertexIndex = $edge->vertices[0];
	            }
	            else
	            {
	                $edgeIndex *= -1;
					$edge = $this->edges[$edgeIndex];
					$vertexIndex = $edge->vertices[1];
	            }

				$vertex = $this->vertices[$vertexIndex];
				$mipTexture = $this->mipTextures[$texInfo->mipTexture];

				$coord = array(
					's' => ($this->dotProduct($vertex, $texInfo->s) + $texInfo->sShift) / $mipTexture->width,
	                't' => ($this->dotProduct($vertex, $texInfo->t) + $texInfo->tShift) / $mipTexture->height
				);

				$faceCoords[] = $coord;
	        }

			$this->textureCoordinates[] = $faceCoords;
	    }
     /*
		//
		// Texture images
		//

		// Create white texture
		this.whiteTexture =  pixelsToTexture(new Array(255, 255, 255), 1, 1, 3, function(texture, image)
		{
			gl.bindTexture(gl.TEXTURE_2D, texture);
			gl.texParameteri(gl.TEXTURE_2D, gl.TEXTURE_MIN_FILTER, gl.LINEAR);
			gl.texParameteri(gl.TEXTURE_2D, gl.TEXTURE_MAG_FILTER, gl.LINEAR_MIPMAP_LINEAR);
			gl.texParameteri(gl.TEXTURE_2D, gl.TEXTURE_WRAP_S, gl.REPEAT);
			gl.texParameteri(gl.TEXTURE_2D, gl.TEXTURE_WRAP_T, gl.REPEAT);
			gl.texImage2D(gl.TEXTURE_2D, 0, gl.RGB, gl.RGB, gl.UNSIGNED_BYTE, image);
			gl.generateMipmap(gl.TEXTURE_2D);
			gl.bindTexture(gl.TEXTURE_2D, null);
		});


		this.textureLookup = new Array(this.faces.length);
		this.missingTextures = new Array();

		for(var i = 0; i < this.mipTextures.length; i++)
		{
			var mipTexture = this.mipTextures[i];

			if(mipTexture.offsets[0] == 0)
			{
				//
				// External texture
				//

				// search texture in loaded wads
				var texture = this.loadTextureFromWad(mipTexture.name);

				if(texture != null)
				{
					// the texture has been found in a loaded wad
					this.textureLookup[i] = texture;

					console.log("Texture " + mipTexture.name + " found");
				}
				else
				{
					// bind simple white texture to do not disturb lightmaps
					this.textureLookup[i] = this.whiteTexture;

					// store the name and position of this missing texture,
					// so that it can later be loaded to the right position by calling loadMissingTextures()
					this.missingTextures.push({ name: mipTexture.name, index: i });

					console.log("Texture " + mipTexture.name + " is missing");
				}

				continue;
			}
			else
			{
				//
				// Load internal texture if present
				//

				// Calculate offset of the texture in the bsp file
				var offset = this.header.lumps[LUMP_TEXTURES].offset + this.textureHeader.offsets[i];

				// Use the texture loading procedure from the Wad class
				this.textureLookup[i] = Wad.prototype.fetchTextureAtOffset(src, offset);

				console.log("Fetched interal texture " + mipTexture.name);
			}
		}

		// Now that all dummy texture unit IDs have been created, alert the user to select wads for them
		this.showMissingWads();
		*/
	}

	public function loadLightmaps($src)
	{
	/*	this.lightmapCoordinates = new Array();
		this.lightmapLookup = new Array(this.faces.length);

		var loadedData = 0;
	    var loadedLightmaps = 0;

	    for (var i = 0; i < this.faces.length; i++)
	    {
			var face = this.faces[i];

			var faceCoords = new Array();

	        if (face.styles[0] != 0 || face.lightmapOffset == -1)
			{
				this.lightmapLookup[i] = 0;

				// create dummy lightmap coords
				for (var j = 0; j < face.edges; j++)
					faceCoords.push({ s: 0, t : 0});
				this.lightmapCoordinates.push(faceCoords);

				continue;
			}

			//* *********** QRAD **********

			var minU = 999999.0;
			var minV = 999999.0;
			var maxU = -99999.0;
			var maxV = -99999.0;

			var texInfo = this.textureInfos[face.textureInfo];

			for (var j = 0; j < face.edges; j++)
			{
				var edgeIndex = this.surfEdges[face.firstEdge + j];
				var vertex;
				if (edgeIndex >= 0)
					vertex = this.vertices[this.edges[edgeIndex].vertices[0]];
				else
					vertex = this.vertices[this.edges[-edgeIndex].vertices[1]];

				var u = Math.round(dotProduct(texInfo.s, vertex) + texInfo.sShift);
				if (u < minU)
					minU = u;
				if (u > maxU)
					maxU = u;

				var v = Math.round(dotProduct(texInfo.t, vertex) + texInfo.tShift);
				if (v < minV)
					minV = v;
				if (v > maxV)
					maxV = v;
			}

			var texMinU = Math.floor(minU / 16.0);
			var texMinV = Math.floor(minV / 16.0);
			var texMaxU = Math.ceil(maxU / 16.0);
			var texMaxV = Math.ceil(maxV / 16.0);

			var width = Math.floor((texMaxU - texMinU) + 1);
			var height = Math.floor((texMaxV - texMinV) + 1);

			//* *********** end QRAD *********

			//* ********** http://www.gamedev.net/community/forums/topic.asp?topic_id=538713 (last refresh: 20.02.2010) **********

			var midPolyU = (minU + maxU) / 2.0;
			var midPolyV = (minV + maxV) / 2.0;
			var midTexU = width / 2.0;
			var midTexV = height / 2.0;

			var coord;

			for (var j = 0; j < face.edges; ++j)
			{
				var edgeIndex = this.surfEdges[face.firstEdge + j];
				var vertex;
				if (edgeIndex >= 0)
					vertex = this.vertices[this.edges[edgeIndex].vertices[0]];
				else
					vertex = this.vertices[this.edges[-edgeIndex].vertices[1]];

				var u = Math.round(dotProduct(texInfo.s, vertex) + texInfo.sShift);
				var v = Math.round(dotProduct(texInfo.t, vertex) + texInfo.tShift);

				var lightMapU = midTexU + (u - midPolyU) / 16.0;
				var lightMapV = midTexV + (v - midPolyV) / 16.0;

				coord = {
					s : lightMapU / width,
					t : lightMapV / height
				}

				faceCoords.push(coord);
			}

			//* ********** end http://www.gamedev.net/community/forums/topic.asp?topic_id=538713 **********

			var pixels = new Uint8Array(src.buffer, this.header.lumps[LUMP_LIGHTING].offset + face.lightmapOffset, width * height * 3)

			var texture = pixelsToTexture(pixels, width, height, 3, function(texture, image)
			{
				gl.bindTexture(gl.TEXTURE_2D, texture);
				gl.texParameteri(gl.TEXTURE_2D, gl.TEXTURE_MIN_FILTER, gl.LINEAR);
				gl.texParameteri(gl.TEXTURE_2D, gl.TEXTURE_MAG_FILTER, gl.LINEAR_MIPMAP_LINEAR);
				gl.texParameteri(gl.TEXTURE_2D, gl.TEXTURE_WRAP_S, gl.CLAMP_TO_EDGE);
				gl.texParameteri(gl.TEXTURE_2D, gl.TEXTURE_WRAP_T, gl.CLAMP_TO_EDGE);
				gl.texImage2D(gl.TEXTURE_2D, 0, gl.RGBA, gl.RGBA, gl.UNSIGNED_BYTE, image);
				gl.generateMipmap(gl.TEXTURE_2D);
				gl.bindTexture(gl.TEXTURE_2D, null);
				//$('body').append('<span>Texture (' + image.width + 'x' + image.height + ')</span>').append(image);
			});

			this.lightmapLookup[i] = texture;
			this.lightmapCoordinates.push(faceCoords);

			loadedLightmaps++;
			loadedData += width * height * 3;
	    }

	    console.log('Loaded ' + loadedLightmaps + ' lightmaps, lightmapdatadiff: ' + (loadedData - this.header.lumps[LUMP_LIGHTING].length) + ' Bytes ');*/
	}

	public function getShortData()
	{		return base64_encode(serialize($this->ShortInfo));	}

	public function __destruct() {
    fclose($this->handle);
  	}

}
?>
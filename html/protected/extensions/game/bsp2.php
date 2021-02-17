<?php
//http://sourcelibs.googlecode.com/svn-history/r12/sourcelibs/bsplib.py
//http://www.bagthorpe.org/bob/cofrdrbob/bspformat.html
//!!!!!!!https://developer.valvesoftware.com/wiki/Source_BSP_File_Format
mb_internal_encoding('UTF-8');

define('HEADER_LUMPS', 63);
define('LUMP_ENTITIES', 0);
define('LUMP_PLANES', 1);
define('LUMP_TEXDATA', 2);
define('LUMP_VERTEXES', 3);
define('LUMP_VISIBILITY', 4);
define('LUMP_NODES', 5);
define('LUMP_TEXINFO', 6);
define('LUMP_FACES', 7);
define('LUMP_LIGHTING', 8);
define('LUMP_OCCLUSION', 9);
define('lump_Leafs', 10);
define('lump_Unused', 11);
define('LUMP_EDGES', 12);
define('LUMP_SURFEDGES', 13);
define('LUMP_MODELS', 14);
define('lump_Worldlight', 15);
define('lump_LeafFaces', 16);
define('lump_LeafBrushes', 17);
define('lump_Brushes', 18);
define('lump_Brushsides', 19);
define('lump_Areas', 20);
define('lump_', 21);
define('lump_', 22);
define('lump_', 23);
define('lump_', 24);
define('lump_', 25);
define('lump_', 26);
define('lump_', 27);
define('lump_', 28);
define('lump_', 29);
define('lump_', 30);
define('lump_', 31);
define('lump_', 32);
define('lump_', 33);
define('lump_', 34);
define('lump_', 35);
define('lump_', 36);
define('lump_', 37);
define('lump_', 38);
define('lump_', 39);
define('lump_', 40);
define('lump_', 41);
define('LUMP_CUBEMAPS', 42);
define('LUMP_TEXDATA_STRING_DATA', 43);
define('LUMP_TEXDATA_STRING_TABLE', 44);
define('lump_', 45);
define('lump_', 46);
define('lump_', 47);
define('lump_', 48);
define('lump_', 49);
define('lump_', 50);
define('lump_', 51);
define('lump_', 52);
define('lump_', 53);
define('lump_', 54);
define('lump_', 55);
define('lump_', 56);
define('lump_', 57);
define('lump_', 58);
define('lump_', 59);
define('lump_', 60);
define('lump_', 61);
define('lump_', 62);
define('lump_', 63);


class BspHeader
{
    public $ident;            // BSP file identifier
    public $version;          // BSP file version
    public $lumps = array();  // lump directory array
    public $mapRevision;
}

class BspLump
{
    public $fileofs;          // offset into file (bytes)
	public $filelen;          // length of lump(bytes)
	public $version;          // lump format version
	public $fourCC;
}

class bsp2 extends CApplicationComponent {
	private $loaded = false;
	private $relpath = '';
	private $filename = '';
	private $handle;
	public $header;
	private $lumps_info = array(
		0=>'LUMP_ENTITIES',
		1=>'LUMP_PLANES',
		2=>'LUMP_TEXDATA',
		3=>'LUMP_VERTEXES',
		4=>'LUMP_VISIBILITY',
		5=>'LUMP_NODES',
		6=>'LUMP_TEXINFO',
		7=>'LUMP_FACES',
		8=>'LUMP_LIGHTING',
		9=>'LUMP_OCCLUSION',
		10=>'LUMP_LEAFS',
		11=>'LUMP_FACEIDS',
		12=>'LUMP_EDGES',
		13=>'LUMP_SURFEDGES',
		14=>'LUMP_MODELS',
		15=>'LUMP_WORLDLIGHTS',
		16=>'LUMP_LEAFFACES',
		17=>'LUMP_LEAFBRUSHES',
		18=>'LUMP_BRUSHES',
		19=>'LUMP_BRUSHSIDES',
		20=>'LUMP_AREAS',
		21=>'LUMP_AREAPORTALS',
		22=>'LUMP_PORTALS', //LUMP_UNUSED0 LUMP_PROPCOLLISION
		23=>'LUMP_CLUSTERS', //LUMP_UNUSED1 LUMP_PROPHULLS
		24=>'LUMP_PORTALVERTS', //LUMP_UNUSED2 LUMP_PROPHULLVERTS
		25=>'LUMP_CLUSTERPORTALS', //LUMP_UNUSED3 LUMP_PROPTRIS
		26=>'LUMP_DISPINFO',
		27=>'LUMP_ORIGINALFACES',
		28=>'LUMP_PHYSDISP',
		29=>'LUMP_PHYSCOLLIDE',
		30=>'LUMP_VERTNORMALS',
		31=>'LUMP_VERTNORMALINDICES',
		32=>'LUMP_DISP_LIGHTMAP_ALPHAS',
		33=>'LUMP_DISP_VERTS',
		34=>'LUMP_DISP_LIGHTMAP_SAMPLE_POSITIONS',
		35=>'LUMP_GAME_LUMP',
		36=>'LUMP_LEAFWATERDATA',
		37=>'LUMP_PRIMITIVES',
		38=>'LUMP_PRIMVERTS',
		39=>'LUMP_PRIMINDICES',
		40=>'LUMP_PAKFILE',
		41=>'LUMP_CLIPPORTALVERTS',
		42=>'LUMP_CUBEMAPS',
		43=>'LUMP_TEXDATA_STRING_DATA',
		44=>'LUMP_TEXDATA_STRING_TABLE',
		45=>'LUMP_OVERLAYS',
		46=>'LUMP_LEAFMINDISTTOWATER',
		47=>'LUMP_FACE_MACRO_TEXTURE_INFO',
		48=>'LUMP_DISP_TRIS',
		49=>'LUMP_PHYSCOLLIDESURFACE', //LUMP_PROP_BLOB
		50=>'LUMP_WATEROVERLAYS',
		51=>'LUMP_LIGHTMAPPAGES', //LUMP_LEAF_AMBIENT_INDEX_HDR
		52=>'LUMP_LIGHTMAPPAGEINFOS',//LUMP_LEAF_AMBIENT_INDEX
		53=>'LUMP_LIGHTING_HDR',
		54=>'LUMP_WORLDLIGHTS_HDR',
		55=>'LUMP_LEAF_AMBIENT_LIGHTING_HDR',
		56=>'LUMP_LEAF_AMBIENT_LIGHTING',
		57=>'LUMP_XZIPPAKFILE',
		58=>'LUMP_FACES_HDR',
		59=>'LUMP_MAP_FLAGS',
		60=>'LUMP_OVERLAY_FADES',
		61=>'LUMP_OVERLAY_SYSTEM_LEVELS',
		62=>'LUMP_PHYSLEVEL',
		63=>'LUMP_DISP_MULTIBLEND',
	);

	public function Load($src)
	{
		$this->loaded = false;
		$this->relpath = realpath($src);
		$tmp_path = explode('/',$this->relpath);
		$this->filename = $tmp_path[count($tmp_path)-1];
		$this->handle = fopen($this->relpath, "rb");
		$contents = stream_get_contents($this->handle);
		//$this->data = $contents;
		//fclose($handle);

    	if(!$this->readHeader($contents)) return false;
    	//echo '<pre>'.print_r($this->readLump($contents, LUMP_FACES),true).'</pre>';
    	//echo '<pre>'.print_r($this->readLump($contents, LUMP_TEXDATA_STRING_TABLE),true).'</pre>';
    	//echo '<pre>'.print_r($this->readLump($contents, LUMP_TEXDATA_STRING_DATA),true).'</pre>';


    	//echo '<pre>'.print_r($this->readLump($contents, LUMP_TEXDATA),true).'</pre>';
    	//echo '<pre>'.print_r($this->readLump($contents, LUMP_LIGHTING),true).'</pre>';
    	//echo 'Lights: '.count($this->readLump($contents, LUMP_LIGHTING));

    	//echo '<pre>'.print_r($this->readLump($contents, LUMP_NODES),true).'</pre>';
    	//echo '<pre>'.print_r($this->readLump($contents, LUMP_ENTITIES),true).'</pre>';
    	$this->header->lumps['LUMP_ENTITIES']->data = $this->readLump($contents, LUMP_ENTITIES);
//    	$this->readNodes($contents);
  //  	$this->readLeaves($contents);
    //	$this->readMarkSurfaces($contents);
	  //  $this->readPlanes($contents);
    	//$this->readVertices($contents);
//	    $this->readEdges($contents);
  //  	$this->readFaces($contents);
	//    $this->readSurfEdges($contents);
    //	$this->readMipTextures($contents);
//    	$this->readTextureInfos($contents);
  //  	$this->readModels($contents);
    //	$this->readClipNodes($contents);
	//	$this->loadEntities($contents);   // muast be loaded before textures
    	//$this->loadTextures($contents);   // plus coordinates
//		$this->loadLightmaps($contents);  // plus coordinates
		//this.loadVIS(src);

		/*

	// FINALLY create buffers for rendering
	this.preRender();
	//this.loadMissingTextures();

    return true;
		*/
		$this->loaded = true;

	}

	public function readHeader($src) {
		$seek =0;
		$this->header = New BspHeader;
		$tmp = unpack("a4ident/iversion", substr($src,$seek,8));
		$this->header->ident = $tmp['ident'];
		$this->header->version = $tmp['version'];
		if($this->header->version != 20) {
			return false;
		}

		$this->header->lumps = Array();
		$seek =8;
		for($i=0;$i<HEADER_LUMPS;$i++)
    	{
	        $lump = new BspLump;
	        $tmp = unpack("ifileofs/ilength/iversion/a4fourCC", substr($src,$seek,16));
	        $seek +=16;
	        $lump->fileofs = $tmp['fileofs'];
	        $lump->filelen = $tmp['length'];
	        $lump->version = $tmp['version'];
	        if($lump->filelen) {	        	switch ($i) {	        		case LUMP_VERTEXES:
	        			$lump->fourCC = $lump->filelen/12;
	        		break;
	        		case LUMP_PLANES:
	        			$lump->fourCC = $lump->filelen/20;
	        		break;	        		case LUMP_LIGHTING:
	        			$lump->fourCC = $lump->filelen/4;
	        		break;
	        		case LUMP_FACES:
	        			$lump->fourCC = $lump->filelen/56;
	        		break;
	        		case LUMP_TEXDATA:
	        			$lump->fourCC = $lump->filelen/32;
	        		break;
                    case LUMP_TEXINFO:
	        			$lump->fourCC = $lump->filelen/72;
	        		break;
	        		case LUMP_CUBEMAPS:
	        			$lump->fourCC = $lump->filelen/16;
	        		break;
	        		case LUMP_VISIBILITY:
	        			$lump->fourCC = $lump->filelen/4;
	        		break;
	        		case LUMP_NODES:
	        			$lump->fourCC = $lump->filelen/32;
	        		break;
	        		case LUMP_MODELS:
	        			$lump->fourCC = $lump->filelen/24;
	        		break;
	        		case LUMP_EDGES:
	        			$lump->fourCC = $lump->filelen/8;
	        		break;
	        		case LUMP_SURFEDGES:
	        			$lump->fourCC = $lump->filelen/4;
	        		break;
	      			default:	        			$lump->fourCC = 0;
	        	}	        } else {	        	$lump->fourCC = 0;	        }
	        //$lump->fourCC = $tmp['fourCC'];
	        $this->header->lumps[$this->lumps_info[$i]?$this->lumps_info[$i]:$i] = $lump;
	        unset($lump);
	    }

	    $tmp = unpack("imapRevision", substr($src,$seek,4));
        $this->header->mapRevision = $tmp['mapRevision'];

		return true;
	}

	public function readLump($src, $lump) {
		$tmp = array();		$seek = $this->header->lumps[$this->lumps_info[$lump]?$this->lumps_info[$lump]:$lump]->fileofs;
		$length = $this->header->lumps[$this->lumps_info[$lump]?$this->lumps_info[$lump]:$lump]->filelen;		switch($lump) {

            case LUMP_FACES:
				if(!$length) return false;
				for($i=0;$i<($length/56);$i++)	{
					$tmp[] = unpack("Splanenum/cside/conNode/ifirstedge/snumedges/stexinfo/sdispinfo/ssurfaceFogVolumeID/c4styles/ilightofs/farea/i2LightmapTextureMinsInLuxels/i2LightmapTextureSizeInLuxels/iorigFace/SnumPrims/SfirstPrimID/IsmoothingGroups", substr($src, $seek,56));
					$seek += 56;
				}
			break;
			case LUMP_CUBEMAPS:
				if(!$length) return false;
				for($i=0;$i<($length/16);$i++)	{
					$tmp[] = unpack("I3origin/Isize", substr($src, $seek,16));
					$seek += 16;
				}
			break;			case LUMP_TEXDATA:
				for($i=0;$i<($length/32);$i++)	{
					$tmp[] = unpack("f3reflectivity/InameStringTableID/Iwidth/Iheight/Iview_width/Iview_height", substr($src, $seek,32));
					$seek += 32;
				}
			break;			case LUMP_TEXINFO:
				for($i=0;$i<($length/72);$i++)	{
					$tmp[] = unpack("f8textureVecs/f8lightmapVecs/Iflags/Itexdata", substr($src, $seek,72));
					$seek += 72;
				}			break;
			case LUMP_VISIBILITY:
				$tmp = unpack("inumclusters", substr($src, $seek ,4));
				$seek +=4;
				/*
				for($i=0;$i<$tmp['numclusters'];$i++)
    			{    				$tmp['byteofs'][] = unpack("I2offs", substr($src, $seek, 8));    				 $seek +=8;    			}*/
				//int	byteofs[numclusters][2]
			break;
			case LUMP_ENTITIES:
				$tmp1 = str_replace(PHP_EOL,'',substr($src, $seek, $length ));
				preg_match_all('/{(.*)}/U',$tmp1, $tmp2);
				foreach($tmp2[1] as $id=>$str) {					preg_match_all('/"(.*)"\s"(.*)"/U',$str, $tzz);
					$tmpm = array();
					foreach($tzz[1] as $ids=>$val){						$tmpm[$val] = $tzz[2][$ids];						//$tmp[$id][] = $val.'='.$tzz[2][$id];
					}
					//if($tmpm['classname']=='worldspawn') {					//	$tmp = $tmpm;					//} else {					$tmp[$tmpm['classname']][] = $tmpm;					//}				};
			break;
			case LUMP_LIGHTING:
				for($i=0;$i<($length/4);$i++)		    	{
					$tmp[$i] = unpack("Cr/Cg/Cb/C1exponent", substr($src, $seek ,4));
					//$tmp[$i]['exponent'] = chr($tmp[$i]['exponent']);
					$seek += 4;
				}
			break;

			case LUMP_TEXDATA_STRING_DATA:
				$tmp[LUMP_TEXDATA_STRING_DATA] =  substr($src, $seek ,$length);
				for($i=0;$i<($length/32);$i++)		    	{
				//	$tmp[$i] = unpack("a32ddd", substr($src, $seek ,32));
					//$tmp[$i]['exponent'] = chr($tmp[$i]['exponent']);
					$seek += 4;
				}
			break;
			case LUMP_TEXDATA_STRING_TABLE:
				$tmp[LUMP_TEXDATA_STRING_TABLE] = substr($src, $seek ,$length);
				for($i=0;$i<($length/16);$i++)		    	{
					$tmp[$i] = unpack("i4t", substr($src, $seek ,16));
					//$tmp[$i]['exponent'] = chr($tmp[$i]['exponent']);
					$seek += 16;
				}
			break;

			default:
		}

		return $tmp;	}
}

?>
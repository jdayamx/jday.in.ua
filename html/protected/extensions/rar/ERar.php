<?
class ERar extends CApplicationComponent {
	public function infosRar ($src, $data=true){		if(!function_exists('rar_open')) return false;
        if (($rar = @rar_open(realpath($src))))
        {        	/*$csize = $entry->getPackedSize();
			$rsize = $entry->getUnpackedSize();
			$name = $entry->getName();
			if ($rsize != 0 || $csize != 0)
				{
					$procfile= round(($csize*100)/$rsize,2);
					$files.="<tr><td class='row1'>$name</td><td width=60 class='row2'>".formatsize($rsize)."</td><td width=60 class='row2'>$procfile %</td></tr>";
				}*/
			$entries = @rar_list($rar);
			//print_r();
			foreach ($entries as $entry)
				{
					$csize = $entry->getPackedSize();
					$rsize = $entry->getUnpackedSize();
					$attr = $entry->getAttr();
					$name = $entry->getName();
					$isDirectory = (bool) ((($entry->getHostOs() == RAR_HOST_WIN32) && ($entry->getAttr() & 0x10)) || (($entry->getHostOs() == RAR_HOST_UNIX) && (($entry->getAttr() & 0xf000) == 0x4000)));
					//echo $attr.'<br>';
					if (!$isDirectory)
					$content[$name.($isDirectory?'/':'')] = array (
                       // 'Ratio' => zip_entry_filesize($rar_entry) ? round(100-zip_entry_compressedsize($rar_entry) / zip_entry_filesize($rar_entry)*100, 1) : false,
                        'Size' => $csize,
                        'NormalSize' =>  $rsize
                        );
				}
            /*while (($rar_entry = @rar_list($rar)))
            {
                //$path = zip_entry_name($rar_entry);
                  $path =  $rar_entry->getName();
//                if (zip_entry_open($rar, $rar_entry, "r"))
  //              {
                    $content[$path] = array (
                       // 'Ratio' => zip_entry_filesize($rar_entry) ? round(100-zip_entry_compressedsize($rar_entry) / zip_entry_filesize($rar_entry)*100, 1) : false,
                        'Size' => $rar_entry->getPackedSize(),
                        'NormalSize' =>  $rar_entry->getUnpackedSize()
                        );
                   // if ($data)
                     //   $content[$path]['Data'] = zip_entry_read($rar_entry, zip_entry_filesize($rar_entry));
                    //zip_entry_close($rar_entry);
    //            }
      //          else
        //            $content[$path] = false;
            }
            */
            @rar_close($rar);
            return $content;
        }
        return false;
    }

    public function extractRar ($src, $dest, $files = false)
    {    	$out = true;
		$rar_file = RarArchive::open($src);//rar_open($src);
    	if (is_array($files)) {
    			foreach($files as $file) {    				$ent =  rar_entry_get($rar_file, $file);
				    if($ent)
				    {
				    	$ent->extract($dest);
				    } else $out = false;
				}
    		} else {    		foreach($rar_file->getEntries() as $file) {
			    if($file)
			    {			    	$file->extract($dest);
			    } else $out = false;
			}
    	}

		rar_close($rar_file);
		return $out;
    }

    public function makeRar ($src, $dest)
    {

/*        $rar = new ZipArchive;
        $src = is_array($src) ? $src : array($src);
        if ($rar->open($dest, ZipArchive::CREATE) === true)
        {
            foreach ($src as $item)
                if (file_exists($item))
                    $this->addZipItem($rar, realpath(dirname($item)).'/', realpath($item).'/');
            $rar->close();
            return true;
        }
        return false;*/
    }

    private function addRarItem ($rar, $racine, $dir)
    {
/*        if (is_dir($dir))
        {
            $rar->addEmptyDir(str_replace($racine, '', $dir));
            $lst = scandir($dir);
                array_shift($lst);
                array_shift($lst);
            foreach ($lst as $item)
                $this->addZipItem($rar, $racine, $dir.$item.(is_dir($dir.$item)?'/':''));
        }
        elseif (is_file($dir))
            $rar->addFile($dir, str_replace($racine, '', $dir));*/
    }
}
?>
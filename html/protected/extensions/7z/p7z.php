<?
class p7z extends CApplicationComponent {

	public function infos7z($src){
		$ret = explode(PHP_EOL,shell_exec('7za l '.$src));
		foreach($ret as $r) {
				$out[$o[6]] = array(
					'date' => $o[1],
					'time' => $o[2],
					'size' => $o[4],
				);
			}
        return $out;
    }

    public function extract7z($src, $dest, $files = false)
    {
    	if($files) {
	    	foreach($files as $file) {
	    		//echo '7za e -o"'.$dest.'" '.$src.' "'.$file.'" -y';
    	} else {
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
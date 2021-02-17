<?php
/********************************************************************************
*																				*
*							WAD File Reader v.1.1								*
*																				*
********************************************************************************/

class hlwad extends CComponent
	{
		public 	$FileName,
				$FileHandle,
				$IsWAD3,
				$TexturesCount,
				$Lumps,
				$Textures_info,
				$Textures_palette,
				$mipmap,
				$showinfo;

		private $LumpsOffset;
		private $path;
		private $file;

		public function __construct($FilePath = array('path'=>'','file'=>''))   // зоздание класса с параметром (указываем путь к файлу)
		{			$this->FileName = $FilePath['path'].$FilePath['file'];
			$this->path = $FilePath['path'];
			$this->file = $FilePath['file'];
    		$this->IsWAD3 = false;
    		$this->Lumps = false;
    		$this->mipmap = 0;
    		$this->showinfo = false;
    		$this->TexturesCount = 0;
    		$this->LoadFromFile();		}
		public function LoadFromFile()                                          // читаем параметры текстур
  		{
  			$this->FileHandle = fopen($this->FileName, 'rb');
			$is_wad = fread($this->FileHandle,4);
			if ($is_wad=='WAD3') $this->IsWAD3 = true;
			if ($this->IsWAD3)
			{
				$this->TexturesCount = $this->readInt();
				$this->LumpsOffset = $this->readInt();
				fseek($this->FileHandle, $this->LumpsOffset);
				for($i=1;$i<=$this->TexturesCount;$i++)
				{
					$buffer = fread($this->FileHandle, 32);
					$this->Lumps[$i] = unpack('IOffset_texture/ICompressed/IFullSize/CTextureType/CCompressionType/SPadding/A16Name', $buffer);
				}
				for($i=1;$i<=$this->TexturesCount;$i++)
				{
					fseek($this->FileHandle, $this->Lumps[$i]['Offset_texture']);
					$buffer = fread($this->FileHandle,40);
					$this->Textures_info[$i] = unpack('A16Name/IWidth/IHeight/I4Offset', $buffer);

					fseek($this->FileHandle, $this->Lumps[$i]["Offset_texture"]-2+$this->Lumps[$i]["FullSize"]-256*3);
					// RGB Data
					for ($n=0; $n<=255; $n++)
						{
							$buffer = fread($this->FileHandle,3);
							$this->Textures_palette[$i][$n] = unpack('CR/CG/CB', $buffer);
						}
				}
			}
  		}

		public function getLumps()
		{
			return $this->Lumps;
		}

		public function TextureList($separator = '<br>')						// показываем список текстур
		{			foreach ($this->Lumps as $lump)
			{				echo $separator.$lump["Name"];			}
		}

		public function ShortData()												// формируем массив с данными
		{			$ret = array();			for($id=1;$id<=$this->TexturesCount;$id++) {
				if (!is_dir(realpath('uploads/Textures'))) mkdir(realpath('uploads/Textures'));
				if (!is_dir(realpath('uploads/Textures').DIRECTORY_SEPARATOR.$this->file)) mkdir(realpath('uploads/Textures').DIRECTORY_SEPARATOR.$this->file);
				$texture_file = realpath('uploads/Textures').DIRECTORY_SEPARATOR.$this->file.DIRECTORY_SEPARATOR.$this->file.'_'.md5($this->Lumps[$id]['Name']).'.png';
				if (!is_file($texture_file))
				{
					imagepng($this->Image($id), $texture_file);
				}
				$ret[$id]['img'] = '/uploads/Textures/'.$this->file.DIRECTORY_SEPARATOR.$this->file.'_'.md5($this->Lumps[$id]['Name']).'.png';
				$ret[$id]['name'] = $this->Lumps[$id]['Name'];
				$ret[$id]['height'] = $this->Textures_info[$id]['Height'];
				$ret[$id]['width'] = $this->Textures_info[$id]['Width'];			}
			return $ret;		}

		public function ShowImage($id, $to_string = false)						// показываем текстуры и одновременно сохраняем на диск
		{
			if ($id<1||$id>$this->TexturesCount) $id = 1;
			if (!is_dir(realpath('uploads/Textures'))) mkdir(realpath('uploads/Textures'));
			if (!is_dir(realpath('uploads/Textures').DIRECTORY_SEPARATOR.$this->file)) mkdir(realpath('uploads/Textures').DIRECTORY_SEPARATOR.$this->file);
			$texture_file = realpath('uploads/Textures').DIRECTORY_SEPARATOR.$this->file.DIRECTORY_SEPARATOR.$this->file.'_'.md5($this->Lumps[$id]['Name']).'.png';
			if (!is_file($texture_file))
			{				imagepng($this->Image($id), $texture_file);				ob_start();
				imagepng($this->Image($id));
				$imagedata = ob_get_contents();
				ob_end_clean();
				if ($to_string)
					return  '<img src="data:image/png;base64,'.base64_encode($imagedata).'" alt="'.trim($this->Lumps[$id]['Name'],"\x00..\x1F").'" title="'.trim($this->Lumps[$id]['Name'],"\x00..\x1F").'">';
				else
					echo '<img src="data:image/png;base64,'.base64_encode($imagedata).'" alt="'.trim($this->Lumps[$id]['Name'],"\x00..\x1F").'" title="'.trim($this->Lumps[$id]['Name'],"\x00..\x1F").'">';
				unset($imagedata);
			} else {				if ($to_string)					return '<img src="/uploads/Textures/'.$this->file.DIRECTORY_SEPARATOR.$this->file.'_'.md5($this->Lumps[$id]['Name']).'.png" title="'.trim($this->Lumps[$id]['Name'],"\x00..\x1F").'">';
				else
					echo '<img src="/uploads/Textures/'.$this->file.DIRECTORY_SEPARATOR.$this->file.'_'.md5($this->Lumps[$id]['Name']).'.png" title="'.trim($this->Lumps[$id]['Name'],"\x00..\x1F").'">';			}
		}

		public function ShowPalette($id) 										// читаем палитру RGB для текстуры
		{
			if ($id<1||$id>$this->TexturesCount) $id = 1;

			$out = "<fieldset style=\width:240px;\><legend><span title='ID of Image'>[$id]</span> Палитра <b>".trim($this->Lumps[$id]['Name'],"\x00..\x1F")."</b>:</legend><table width=100%>";
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

		public function Image($id)												// формируем текстуру
		{
			if ($id<1||$id>$this->TexturesCount) $id = 1;

			switch($this->mipmap)
				{
					case 1:
						$w = ($this->Textures_info[$id]['Width'] / 2);
						$h = ($this->Textures_info[$id]['Height'] / 2);
						fseek($this->FileHandle, $this->Textures_info[$id]['Offset2']);
					break;
					case 2:
						$w = ($this->Textures_info[$id]['Width'] / 4);
						$h = ($this->Textures_info[$id]['Height'] / 4);
						fseek($this->FileHandle, $this->Textures_info[$id]['Offset3']);
					break;
					case 3:
						$w = ($this->Textures_info[$id]['Width'] / 8);
						$h = ($this->Textures_info[$id]['Height'] / 8);
						fseek($this->FileHandle, $this->Textures_info[$id]['Offset4']);
					break;
					default:
						$w = $this->Textures_info[$id]['Width'];
						$h = $this->Textures_info[$id]['Height'];
						fseek($this->FileHandle, $this->Lumps[$id]["Offset_texture"]+40);
				}

			if ($h>8192||$w>8192) return false;

			$img = imagecreatetruecolor($w,$h);

			if(substr($this->Textures_info[$id]['Name'],0,1)=="{")
				{
					$transparent = imagecolorallocate($img, $this->Textures_palette[$id][255]["R"],$this->Textures_palette[$id][255]["G"],$this->Textures_palette[$id][255]["B"]);
					imagecolortransparent($img, $transparent);
				}

			$i = 0;
			//image data indexes
			$indexes = array();
			for ($y=0; $y<=($h-1); $y++)
				{
					for ($x=0; $x<=($w-1); $x++)
						{
							$indexes[$i+$y] = ord(fgetc($this->FileHandle));
							$i++;
						}
				}

			// Generate image
			$i = 0;
			for ($y=0; $y<=$h; $y++)
				{
					for ($x=0; $x<=$w; $x++)
						{
							imagesetpixel($img,$x,$y,imagecolorallocate($img,
									$this->Textures_palette[$id][isset($indexes[$i])?$indexes[$i]:0]["R"],
									$this->Textures_palette[$id][isset($indexes[$i])?$indexes[$i]:0]["G"],
									$this->Textures_palette[$id][isset($indexes[$i])?$indexes[$i]:0]["B"]
								));
							$i++;
						}
				}
			unset($indexes);
			return $img;
		}

		private function readInt()												// чтение целого числа (4 бита)
		{
			$b4 = @ord(fgetc($this->FileHandle));
			$b3 = @ord(fgetc($this->FileHandle));
			$b2 = @ord(fgetc($this->FileHandle));
			$b1 = @ord(fgetc($this->FileHandle));
			return ($b1<<24)|($b2<<16)|($b3<<8)|$b4;
		}

		public function __destruct()											// закрываем файл
		{
			fclose($this->FileHandle);
		}
	}

?>
<?php
// Script to open a .obj file, parse to arrays and return in format for Kevs3D HTML5 3D engine
// By James Reid
// Additions by Kevin Roast

// open this directory 
$myDirectory = opendir(".");

// get each entry
while($entryName = readdir($myDirectory))
{
	$dirArray[] = $entryName;
}

// close directory
closedir($myDirectory);

for($i=0;$i<count($dirArray);$i++)
{
	$type_obj = strpos($dirArray[$i],'.obj');
	if($type_obj !== FALSE)
	{
		$filename = substr($dirArray[$i],0,-4);
		print("$dirArray[$i]:\n");
		$file_contents = file_get_contents('./'.$dirArray[$i]);
		$file_array = explode("\n",$file_contents);
		
		$vertex = array();
		$faces = array();
		//$vertex_normals = array();
		//$vertex_texture = array();
		
		foreach($file_array as $key=>$line)
		{
			$linemode = substr($line,0,2);
			switch($linemode)
			{
				case 'v ':
					array_push($vertex,$line);
					break;
				
				case 'f ':
					array_push($faces,$line);
					break;
				
				//case 'vn':
				//	array_push($vertex_normals,$line);
				//	break;
				
				//case 'vt':
				//	array_push($vertex_texture,$line);
				//	break;
			}
		}
		
		$output_v = '[';
		foreach($vertex as $key => $v)
		{
		   $v = preg_split("/[ ]+/",rtrim($v));
			$output_v .= '{x:'.rtrim($v[1]).',y:'.rtrim($v[2]).',z:'.rtrim($v[3]).'}';
			//print("$output_v\n");
			if($key<(count($vertex)-1))
			{
				$output_v .= ',';
			}
		}
		print(" vertex count: ".count($vertex)."\n");
		$output_v .= ']';
		
		$output_f = '[';
		foreach($faces as $key => $f)
		{
		   //print("$f\n");
			$f = preg_split("/[ ]+/",rtrim($f));
			$output_f .= '{vertices:[';
			foreach($f as $key1 => $node)
			{
				if($key1 == 0)
				{
					continue;
				}
				$node_parts = explode('/',$node);
				$vertex_id = $node_parts[0];
				$output_f .= $vertex_id-1;
				if($key1 < (count($f)-1))
				{
					$output_f .=',';
				}
			}
			$output_f .= ']}';//,texture:1
			if($key < (count($faces) - 1))
			{
				$output_f .=',';
			}
		}
		print(" faces count: ".count($faces)."\n");
		$output_f .= ']';
		$output_combined = $output_v.",\n".'[]'.",\n".$output_f;
		
		if(file_put_contents('./'.$filename.'.kv3d',$output_combined) === FALSE)
		{
			print('ERROR');
		}
		else
		{
			print(" - ".$filename.".kv3d created\n");
		}
	}
}
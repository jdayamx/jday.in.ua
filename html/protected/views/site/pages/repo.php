<?php
	$this->layout = 'blank';
	header("Content-Type: text/xml");
	header("Expires: Thu, 19 Feb 1998 13:24:18 GMT");
	header("Last-Modified: ".gmdate("D, d M Y H:i:s")." GMT");
	header("Cache-Control: no-cache, must-revalidate");
	header("Cache-Control: post-check=0,pre-check=0");
	header("Cache-Control: max-age=0");
	header("Pragma: no-cache");

	echo "<?xml version=\"1.0\" encoding=\"UTF-8\" standalone=\"yes\"?>";
	echo " <response> ";
	echo "<header>";
	echo "<name>Репозиторий jday.in.ua</name>";
	echo "<version>1.0</version>";
	echo "</header>";
	echo "<items>";
	foreach(RepoItems::model()->cache(60)->findAll() as $item) {
    	echo "<item>";
		echo "<id>".$item->id."</id>";
		echo "<pid>".$item->pid."</pid>";
		echo "<name>".$item->name."</name>";
		echo "<tname>".$item->tname."</tname>";
		echo "<category>".$item->category_id."</category>";
		echo "<version>".$item->version."</version>";
		echo "<image>".$item->image."</image>";
		echo "<cover>".$item->cover."</cover>";
		echo "<cost>".$item->cost."</cost>";
		echo "<type>".$item->type."</type>";
		echo "<description>".htmlspecialchars($item->description)."</description>";
		echo "</item>";
    }
	echo "</items>";
	echo "<categories>";
    foreach(repoCategories::model()->cache(60)->findAll() as $cat) {    	echo "<category>";
		echo "<id>".$cat->id."</id>";
		echo "<pid>".$cat->pid."</pid>";
		echo "<name>".$cat->name."</name>";
		echo "</category>";    }
	echo "</categories>";

	echo "</response> ";

?>
<?php
class ItemFixclasnoCommand extends CConsoleCommand
{

	public function run() {

		foreach (Item::model()->findAll() as $item)
		{
			$fix = strip_tags($item->title);
			$item->title = $fix;
			echo 'Item['.$item->id.'] '."\t".$item->title.'->'.$fix.' FIXED'.PHP_EOL;
			$item->save(false);
		}

	}
}
?>
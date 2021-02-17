<?php
require_once(dirname(__FILE__).DIRECTORY_SEPARATOR.'excel_reader2.php');

class xls extends CComponent {	public $_Excel_Reader;

	public function init() {}

	public function Load($filename) {
		$this->_Excel_Reader = new Spreadsheet_Excel_Reader($filename);
	}

	public function dump($row_numbers=false,$col_letters=false,$sheet=0,$table_class='excel') {		return $this->_Excel_Reader->dump($row_numbers,$col_letters,$sheet,$table_class);	}}

?>
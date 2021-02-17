<?php

// This is the configuration for yiic console application.
// Any writable CConsoleApplication properties can be configured here.

$main = require(dirname(__FILE__).'/main.php'); // считываем основнйо конфиг

unset($main['defaultController']);  // без этого не заводится

return CMap::mergeArray(
    $main,
    array(
        'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
        'name'=>'JDay console',
    )
);

?>
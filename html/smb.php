<?
$SMBWEBCLIENT_CLASS = '123';
require_once('protected/extensions/smbwebclient-2.9.1.php');

$swc = new smbwebclient;
$swc->cfgAnonymous = true;
$swc->cfgDefaultLanguage = 'ru';
$swc->cfgDefaultServer = '192.168.1.46';
$swc->Run();


?>
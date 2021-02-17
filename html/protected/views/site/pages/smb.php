<?
require_once(Yii::getPathOfAlias('ext').'/smbwebclient-2.9.1.php');

/*$swc = new smbwebclient;
$swc->cfgAnonymous = true;
$swc->cfgDefaultServer = '192.168.1.5';
$swc->Run();*/

//include '/usr/share/samba/smbwebclient.php';
include '/etc/samba/smbwebclient.conf';
$swc = new smbwebclient_config;
$swc->Run();

?>
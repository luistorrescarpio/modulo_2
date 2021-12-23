<?php 
// Facilitador de Directorios
$view = $base_url."/view";
$controller = $base_url."/controller";
$public = $base_url."/public";
$lib = $base_url."/lib";
$sys_lib = $base_url."/system/lib";
//Others
$script = $base_url."/script";
$system_url = $base_url."/system";

// //////////////////////////////////////

$homeRootArr = explode("/", $base_url);
$homeRoot="";
foreach ($homeRootArr as $key => $val) {
	if($key>2)
		$homeRoot.="/".$val;
}
$root = $_SERVER['DOCUMENT_ROOT'].$homeRoot;

$system_path = $root."/system";
function sys_helper($name){
	// $root."/system"
	include($GLOBALS['root']."/system/helper/".$name.".php");
	return $he_security;
};
?>
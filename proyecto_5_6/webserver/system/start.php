<?php
	//Session On Proyect
	session_start(); 
	
	$protocol = protocolSet("http");
	//URL base del Proyecto
	$base_url = $protocol.$_SERVER['HTTP_HOST']."/github/micodigolibre/modulo_2/proyecto_5_6/webserver";
	
	// My Helpers
	$my_helper = ["test"];
	
	//Helpers System Globals
	// query_tool: AutoGenerate Query
	// url: url func Path
	$sys_helper = ["url","query_tool","sess"];


	//System Driver
	if(isset($add_syshelper))
		if(count($add_syshelper)>0){
			$sys_helper = array_merge($sys_helper, $add_syshelper);
		}
	if(isset($add_myhelper))
		if(count($add_myhelper)>0){
			$my_helper = array_merge($my_helper, $add_myhelper);
		}

	function protocolSet($type = false){
		$protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
		if($type=="https"){
			if($protocol!= "https://")
				header("Location: https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
		}elseif($type=="http"){
			if($protocol!= "http://")
				header("Location: http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
		}
		return $protocol;
	}

	require("core.php");
?>
<?php 
	require("route.php");
	// Cookie PHP Post
	if(isset($_POST['sess'])){
		foreach ($_POST["sess"] as $index => $val) {
			$_SESSION[$index] = $val;
		}
	}
	$sess = (object)$_SESSION;
	if(count($sys_helper)>0) //Add Helper Server
		foreach ($sys_helper as $i => $hp) {
			if($hp!="")
				require("{$root}/system/helper/{$hp}.php");
		}
	if(count($my_helper)>0) //Add Helper Client
		foreach ($my_helper as $i => $mhp) {
			if($mhp!="")
				require("{$root}/helper/{$mhp}.php");
		}

	if(isset($client)):
		include("script_client.php");
	else: // Get Data From Client
		// $obj = (object)$_REQUEST;
		// $obj = (object) array_merge($_POST, $_GET);
		// $obj = $_REQUEST;
		$obj = array_merge($_POST, $_GET);
		if(isset($sys)){
			if(@$sys["injectProtected"])
				$obj = injectProtected_obj($obj);
		}

		// if(count((array)$obj)>0)
		// 	foreach ($obj as $i => $val) 
		// 		if(gettype($obj->$i) == "array")
		// 			$obj->$i = (object)$obj->$i;

		// Func Response Server to Client
		function res($dt){
			if( gettype($dt) == "string" )
					echo $dt;
				else
					echo json_encode($dt);
				exit();
		}
		//Load Script DB
		//require("svsql.php");
		require("mysql.php");
		// require("pgsql.php");
		// require("couch.php");

		//Load Model
		$dirModel = "../model"; //Default

		if($dirModel){
			if(is_dir($dirModel)){
				foreach (scandir($dirModel) as $filename) {
					
					if($filename=="." || $filename==".." ) continue;

				    if (is_file($dirModel . '/' . $filename)) {
				        require $dirModel . '/' . $filename;
				        $modelName1 = explode(".php", $filename)[0];
				        eval("\$$modelName1 = new $modelName1();");
				    }
				}
			}
		}
	endif;
	$Model = [];
	function Models($models){
		$filename = "";
		foreach ($models as $i => $model) {
			$ruta = "";
			if(strrpos($models[$i], "/") != -1){
				$model = explode("/", $model);
				foreach ($model as $j => $val) {
					if($j>0) $ruta.="/";

					if($j == count($model)-1){
						$filename = $model[$j]."_model.php";
						$ruta.=$filename;
						continue;
					}
					$ruta.=$model[$j];
				}
				require $GLOBALS['root'].'/model/'.$ruta;
				$modelName1 = explode(".php", $filename)[0];
				$nameShort = getModelName($modelName1);
				eval("\$GLOBALS['Model']['$nameShort'] = new $modelName1();");		
			}
		}
	}
	function getModelName($fileName){
		$fileNames = explode("_", $fileName);
		$nameShort = "";
		foreach ($fileNames as $i => $namePart) {
			if($i == count($fileNames)-1) continue;
			if($i>0) $nameShort.="_";	
			$nameShort.=$namePart;
		}
		return $nameShort;
	}
	// Tools Core
	function injectProtected_obj($object){
	  foreach ($object as $item => $val) {    
	    //Funcción que permitira realizar un filtro de los caracteres que permitan la modificación de las consultas SQL (Filtrado de protección SQL)
	    $object[$item] = str_replace(
	        ["'","|","‘","’",'“','”']
	      , ['\"',"","&#8216;","&#8217;","&#8220;","&#8221;"]
	      , $val
	    );
	  }
	  return $object; //Object Filtrado
	}
 ?>
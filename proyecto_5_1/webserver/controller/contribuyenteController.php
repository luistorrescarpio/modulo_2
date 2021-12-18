<?php 
require "../system/start.php";

switch ($obj['action']) {
	case 'registrar_contribuyente':
		$obj['datetime'] = date("Y-m-d H:i:s");

		$r = query("INSERT INTO contribuyente (con_dni, con_fullname, con_latlng,con_password,con_datetime)VALUES('".$obj['dni']."','".$obj['fullname']."','".$obj['latLng']."','".$obj['password']."','".$obj['datetime']."')");
		if(!isset($r["error"])){
			res([
				"success"=>1,
				"message"=>"Registro Correcto"
			]);
		}else{
			res([
				"success"=>0,
				"message"=>"Error al registrar",
				"error"=>$r["error"]
			]);
		}
		break;
}


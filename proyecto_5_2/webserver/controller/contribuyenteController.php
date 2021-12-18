<?php 
require "../system/start.php";

switch ($obj['action']) {

	case 'validar_acceso':
		// $obj['dni'];
		// $obj['password']
		$r = query("SELECT id_contribuyente, con_dni, con_fullname, con_latlng, con_datetime FROM contribuyente WHERE con_dni='".$obj['dni']."' AND con_password='".$obj['password']."'");
		if(count($r)>0)
			res([
				"success"=>1,
				"message"=>"Bienvenido ".$r[0]['con_fullname'],
				"rdr"=>"registro_de_contribuyente.html",
				"sess_data"=>$r[0]
			]);
		else
			res([
				"success"=>0,
				"message"=>"login o password incorrecto"
			]);

		break;

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


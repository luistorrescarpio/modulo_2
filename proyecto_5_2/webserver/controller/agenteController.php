<?php 
require "../system/start.php";

switch ($obj['action']) {
	case 'validar_acceso':
		$r = query("SELECT id_agente, age_fullname, age_datetime FROM agente WHERE id_agente='".$obj['codigo']."' AND age_password='".$obj['password']."'");
		if(count($r)>0){
			
			$r[0]["token"] = md5($r[0]["id_agente"]); // Encriptar Identificador del Agente

			res([
				"success"=>1,
				"message"=>"Bienvenido ".$r[0]['age_fullname'],
				"rdr"=>"qr_token.html",
				"sess_data"=>$r[0]
			]);
		}else
			res([
				"success"=>0,
				"message"=>"login o password incorrecto"
			]);

		break;
}
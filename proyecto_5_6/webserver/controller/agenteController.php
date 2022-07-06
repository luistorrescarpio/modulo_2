<?php 
require "../system/start.php";

switch ($obj['action']) {

	case 'validar_acceso':
		$r = query("SELECT id_agente, age_fullname, age_datetime, age_tipo FROM agente WHERE id_agente='".$obj['codigo']."' AND age_password='".$obj['password']."'");
		if(count($r)>0){
			
			$r[0]["token"] = md5($r[0]["id_agente"]); // Encriptar Identificador del Agente

			

			switch($r[0]['age_tipo']){
				case 'recolector':
					$link = "qr_token.html";
					break;
				case 'supervisor':
					$link = "reporte_de_recoleccion.html";
					break;
			}

			res([
				"success"=>1,
				"message"=>"Bienvenido ".$r[0]['age_fullname'],
				"rdr"=>$link,
				"sess_data"=>$r[0]
			]);

		}else
			res([
				"success"=>0,
				"message"=>"login o password incorrecto"
			]);

		break;
}
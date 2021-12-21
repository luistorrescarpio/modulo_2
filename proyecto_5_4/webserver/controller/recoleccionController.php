<?php 
require "../system/start.php";

switch ($obj['action']) {
	case 'reporte':
		$r = query("SELECT con.id_contribuyente,con.con_fullname,con.con_cell, COUNT(con.id_contribuyente) AS 'cant' FROM recoleccion AS rec 
			INNER JOIN contribuyente AS con ON rec.id_contribuyente = con.id_contribuyente
			WHERE DATE('".$obj['fech_ini']."') <= DATE(rec.rec_datetime) && DATE(rec.rec_datetime) <= DATE('".$obj['fech_fin']."')
			GROUP BY con.id_contribuyente,con.con_fullname,con.con_cell ");
		res($r);
		break;
	case 'registrar': // Registro de Recolección entre agente y contribuyente
		$id = query("INSERT INTO recoleccion (rec_codigo_agente, id_contribuyente, rec_datetime)VALUES('".$obj['cod_agente']."','".$obj['id_contribuyente']."','".date("Y-m-d H:i:s")."') ");

		if(isset($id["error"])){
			res([
				"success"=>0,
				"message"=>"Error al registrar",
				"error"=>$id["error"]
			]);
		}else{
			res([
				"success"=>1,
				"message"=>"Registro Exitoso"
			]);
		}
		break;
}
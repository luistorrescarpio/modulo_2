<?php 
require "../system/start.php";

switch ($obj['action']) {
	case 'exp_contribuyente':
		$data_contribuyente = query("SELECT id_contribuyente, con_dni, con_fullname, con_latlng, con_datetime, con_cell FROM contribuyente WHERE id_contribuyente=".$obj['id_contribuyente']);

		$historial_contribuyente = query("SELECT rec.id_contribuyente, DATE(rec.rec_datetime) AS 'fecha',age.age_fullname AS 'agente', COUNT(rec.id_recoleccion) AS frecuencia FROM recoleccion AS rec
			INNER JOIN agente AS age ON rec.rec_codigo_agente = MD5(age.id_agente)
			WHERE rec.id_contribuyente=".$obj['id_contribuyente']."
			GROUP BY rec.id_contribuyente,DATE(rec.rec_datetime), age.age_fullname");

		res([
			"contribuyente"=>$data_contribuyente,
			"historial"=>$historial_contribuyente
		]);

		break;

	case 'exp_agente': //No esta considerado
		
		break;
}
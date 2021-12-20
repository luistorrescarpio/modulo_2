<?php 
/*
	Nombre: heasy_mysql
	Versión: 1.2
	Autor del Script: Luis Torres Carpio
	Correo: luis.torres.carpio1@gmail.com
	Descripción: 
		Script para facilitar las querys en Mysql desde PHP
		Pensado para el desarrollo agil.
*/
class conexion{	
	private $server;
	private $user;
	private $clave;
	private $db;
	
	public $conex;
	
	function __construct()
	{	
		$this->server="127.0.0.1";
		$this->user="root";
		$this->clave="";
		$this->db="mcl_proyecto_5";
	}
	public function conectar()
	{
		$this->conex=new mysqli($this->server,$this->user,$this->clave,$this->db);
		$this->conex->set_charset("utf8");//save accent db
	}
	public function cerrar()
	{
		$this->conex->close();
	}
}
$GLOBALS['mc']=new conexion();
function query_multiple($query){
	$mc=new conexion();
	$mc->conectar();
	$ok_affected = [];
	if( $rsta = $mc->conex->multi_query($consulta)  === TRUE ){
		do {
			$row=$mc->conex->affected_rows;
			array_push($ok_affected, $row);
	        if (!$mc->conex->more_results()) {
	        	break;
	        }
	    } while ($mc->conex->next_result());

	    $mc->cerrar();
	}else{
		echo "Error: " . $mc->conex->error;
	}
	return $ok_affected;
}
function query_exec($query){
	$mc = new conexion();
	$mc->conectar();
	// if(!$mc->conex->multi_query($query)) //Error mysql
		// return ["error"=>$mc->conex->error];
	$fecth_rows = 0;
	$mc->conex->multi_query($query);
	do {
		if ($result = $mc->conex->store_result()) {
            $fecth_rows =  $result->num_rows;
        }
    }while ($mc->conex->next_result()); // flush multi_queries
	$mc->cerrar();
	return $fecth_rows;
}
function query_start($query){
	$GLOBALS['mc']->conectar();
	return $GLOBALS['mc']->conex->query($query);
}
function query($query){
	$type = array(
		"CALL", 
		"INSERT INTO", 
		"INSERT", 
		"UPDATE",
		"SELECT * FROM",
		"SELECT",
		"DELETE FROM",
		"CREATE TABLE",
		);
	for($i=0;$i<count($type);$i++){

		if (strpos($query, $type[$i]) !== false){
			
			switch ($type[$i]) {
				case 'CALL':
					// if( !$results = query_start($query))
						// return ["error"=>$GLOBALS['mc']->conex->error];
					if(!$results = query_start($query))
						return ["error"=>$GLOBALS['mc']->conex->error];
					// return $results?['SI']:['NO'];
					if(strrpos($query, "select_")){
						return select($results);
					}else if(strrpos($query, "update_")){
						return 1;
					}else if(strrpos($query, "delete_")){
						return 1;
					}else if(strrpos($query, "insert_")){
						$id=$GLOBALS['mc']->conex->insert_id;
						return $id;
					}
					break;
				case 'INSERT INTO':
					if( !query_start($query))
						return ["error"=>$GLOBALS['mc']->conex->error];
					$id=$GLOBALS['mc']->conex->insert_id;
					return $id;
					break;
				
				case 'UPDATE':
					if( !query_start($query))
						return ["error"=>$GLOBALS['mc']->conex->error]; 
					else
						return 1;
					break;	

				case 'SELECT * FROM':
					if(!$results = query_start($query))
						return ["error"=>$GLOBALS['mc']->conex->error];
					return select($results);
					break;

				case 'SELECT':
					if(!$results = query_start($query))
						return ["error"=>$GLOBALS['mc']->conex->error];
					return select($results);
					break;
					
				case 'DELETE FROM':
					if( !query_start($query))
						return ["error"=>$GLOBALS['mc']->conex->error]; 
					else
						return 1;
					break;

			}
			$GLOBALS['mc']->cerrar();
		}
	}
}
function select($results){
	if(!$results) return [];
	if($results->num_rows>0){
		while( $rr = mysqli_fetch_assoc($results) ) $rows[] = $rr; //return array 
			return $rows;
	}else
		return [];
}


?>

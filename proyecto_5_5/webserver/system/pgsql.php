<?php 
	
	// require_once("utilities.php");
	class conexion{	
		private $server;
		private $user;
		private $clave;
		private $db;
		
		public $conex;
		
		function __construct()
		{	
			$this->server="127.0.0.1";
			$this->user="postgres";
			$this->clave="luitorc";
			$this->db="mpi_mapa_delito";
			$this->puerto= 5432;
		}
		public function conectar()
		{
			$this->conex = pg_connect("host=$this->server dbname=$this->db port=$this->puerto user=$this->user password=$this->clave");
		}
		public function cerrar()
		{
			$this->conex->close();
		}
	}
	
function query($consulta){
	// $type = "INSERT INTO";
	$type = array(
		"INSERT INTO", 
		"INSERT", 
		"UPDATE",
		"SELECT * FROM",
		"SELECT",
		"DELETE FROM",
		// "hello", 
		// "world"
		);
	// echo count($type);
	for($i=0;$i<count($type);$i++){

		if (strpos($consulta, $type[$i]) !== false){
			$mc=new conexion();
			$mc->conectar();
				// echo "jajaja";
				// exit();
			switch ($type[$i]) {
				case 'INSERT INTO':
					// $mc->conex->query($consulta);
					$results = pg_query($mc->conex, $consulta);
					while($rid= pg_fetch_array($results)){ 
				 		return $rid[0]; //id
				 	}
					return 0;
					break;
				
				case 'UPDATE':
					$results = pg_query($mc->conex, $consulta);
					return pg_affected_rows($results);
					break;

				case 'SELECT * FROM':
					// $results = $mc->conex->query($consulta);
					$results = pg_query($mc->conex, $consulta);
					if(pg_num_rows($results)>0){
						// while( $rr = pg_fetch_assoc($results) ) $rows[] = array_map("utf8_encode", $rr);
						while( $rr = pg_fetch_assoc($results) ) $rows[] = $rr;
					
						return $rows;
					}else
						return 0;
					break;
				case 'SELECT':
					// $results = $mc->conex->query($consulta);
					$results = pg_query($mc->conex, $consulta);
					if(pg_num_rows($results)>0){
						// while( $rr = pg_fetch_assoc($results) ) $rows[] = array_map("utf8_encode", $rr);
						while( $rr = pg_fetch_assoc($results) ) $rows[] = $rr;
					
						return $rows;
					}else
						return 0;
					break;
				case 'DELETE FROM':
					$results = pg_query($mc->conex, $consulta);
					return pg_affected_rows($results);
					// return 1;
					break;
			}
		$mc->cerrar();
		}
	}
}
?>
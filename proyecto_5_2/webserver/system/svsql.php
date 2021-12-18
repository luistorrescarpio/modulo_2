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
			$live = true;
			if($live){
				$this->server="";
				$this->user="";
				$this->clave="";
				$this->db="";				
			}else{
				$this->server=""; //test
				$this->user="";
				$this->clave="";
				$this->db="";
				$this->puerto= 5432;				
			}

		}
		public function conectar()
		{
			// $this->conex = pg_connect("host=$this->server dbname=$this->db port=$this->puerto user=$this->user password=$this->clave");
			$this->conex = sqlsrv_connect( $this->server, ["Database"=>$this->db, "UID"=>$this->user, "PWD"=>$this->clave, "CharacterSet" => "UTF-8"]);
		}
		public function cerrar()
		{
			$this->conex->close();
			// sqlsrv_free_stmt
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
					$results = sqlsrv_query( $mc->conex, $consulta );
					if( $results === false) {
					    die( print_r( sqlsrv_errors(), true) );
					}
					$rows = [];
					while( $row = sqlsrv_fetch_array( $results, SQLSRV_FETCH_ASSOC) )$rows[] = $row;
					      // echo $row['iTiposActividadesId'].", ".$row['cTiposActividadesDsc']."<br />";

					if(count($rows)>0)
						return $rows;
					else
						return [];
					break;
				case 'SELECT':

					$results = sqlsrv_query( $mc->conex, $consulta );
					if( $results === false) {
					    die( print_r( sqlsrv_errors(), true) );
					}
					$rows = [];
					while( $row = sqlsrv_fetch_array( $results, SQLSRV_FETCH_ASSOC) )
						$rows[] = $row;
					if(count($rows)>0)
						return $rows;
					else
						return [];
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
<?php 
if(!class_exists('table')){
	class table{
		private $tb;
		function __construct($tb){
			$this->tb = $tb;	
		}
		public function insert($attr){
			$queryStr = "INSERT INTO ".$this->tb;
			$queryStr.=" (";
			foreach ($attr as $key => $value) {
					$queryStr.=$key.",";
			}
			$queryStr = substr($queryStr, 0, -1);
			$queryStr.=") ";
			$queryStr.="VALUES";
			$queryStr.="(";
			foreach ($attr as $key => $value) {
					$queryStr.="'".$value."',";
			}
			$queryStr = substr($queryStr, 0, -1);
			$queryStr.=")";
			// Only Postgresql line: 23
			// $queryStr.=") RETURNING id_".$this->tb.";";
			$ltrs = query($queryStr);
			// return $ltrs;
			return $ltrs;
		}

		public function update($id, $attr){
			$queryStr = "UPDATE ".$this->tb;
			$queryStr.=" SET ";
			foreach ($attr as $key => $value) {
					$queryStr.=$key."='".$value."',";
			}
			$queryStr = substr($queryStr, 0, -1);
			$queryStr.= " WHERE ";
			if( (Int)$id ){
				//solo identificador
				$queryStr.="id_".$this->tb." = ".$id;
			}else{
				//Es texto personalizado
				$queryStr.= $id;
			}

			$ltrs = query($queryStr);
			return $ltrs;
		}
		public function delete($id){
			$queryStr = "DELETE FROM ".$this->tb;
			$queryStr.=" WHERE ";
			if( is_array($id) ){
				foreach ($id as $key => $value) {
					$queryStr.="id_".$this->tb." = ".$value;
					$queryStr.=" OR ";
				}
			$queryStr = substr($queryStr, 0, -4).";";
			}else{
				if( (Int)$id ){
					$queryStr.="id_".$this->tb." = ".$id.";";
				}else{
					$queryStr.=$id.";";
				}
			}

			$ltrs = query($queryStr);
			return $ltrs;
		}

		public function view($search = false,$campo = false,$order = false,$campoOrder = false){
			$queryStr ="";
			$queryStr.= "SELECT * FROM ".$this->tb." ";
			if( $campo ){
				if( is_array($campo) ){
					$queryStr = "SELECT ";
					foreach ($campo as $key => $value) {
						$queryStr.= $value.",";
					}
					$queryStr = substr($queryStr, 0, -1);
					$queryStr.= " FROM ".$this->tb." ";				
				}else
					$queryStr = "SELECT ".$campo." FROM ".$this->tb." ";
			}
			if( !is_array($search) ){
				if( $campo ){
					$queryStr.="WHERE ";	
					if( is_array($campo) ){
						foreach ($campo as $key => $value) {
							$queryStr.= $value;
							$queryStr.= "||' '||";
						}	
						$queryStr = substr($queryStr, 0, -7);
						$queryStr.=" ILIKE "."'%".$search."%' ";
					}
				}
			}else{
				if(is_array($search[0])){
					$queryStr.=" WHERE ";
					foreach ($search[0] as $key => $value) {
						$queryStr.= $value;
						$queryStr.= "||' '||";
					}	
					$queryStr = substr($queryStr, 0, -7);
					$queryStr.=" ILIKE "."'%".$search[2]."%' ";
				}else{
					$queryStr.="WHERE ".$search[0]." ".$search[1]." '".$search[2]."' ";
				}
			}
			if( $campoOrder ){
				if( $order ){
					if( $order == "<" )
						$queryStr.="ORDER BY ".$campoOrder." ASC";
					if( $order == ">" )
						$queryStr.="ORDER BY ".$campoOrder." DESC";
				}
			}else if( $order ){
				//ASC
				if( $order == "<" )
					$queryStr.="ORDER BY id_".$this->tb." ASC";
				if( $order == ">" )
					$queryStr.="ORDER BY id_".$this->tb." DESC";
			}
			$ltr = query($queryStr);
			return $ltr;
			// echo $queryStr;
		}
	}
}
// $table = new table('dtpersonal');
// 		$r = $table->view(array('nombres','edad'),'>','edad',array(array('nombres','edad'),'=','100'));
// $table = new table('dtpersonal');
// 		$r = $table->view(0,'>','id_dtpersonal',array('edad','=','100'));


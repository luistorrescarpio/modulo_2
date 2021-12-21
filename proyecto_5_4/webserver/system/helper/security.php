<?php 
if(!class_exists('he_security')){
	class he_security{
		function __construct(){	

		}
		public function injectProtected_text($text){
		  //Funcción que permitira realizar un filtro de los caracteres que permitan la modificación de las consultas SQL (Filtrado de protección SQL)
		  $textFiltrado = str_replace(
		     array("'","|","‘","’",'“','”')
		    ,array('\"',"","&#8216;","&#8217;","&#8220;","&#8221;")
		    ,$text
		  );
		  return $textFiltrado;
		}
	}
	$he_security = new he_security();
}

?>

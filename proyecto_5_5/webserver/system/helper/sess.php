<?php 
$id_sess = "unitek001";
function sess_destroy(){
	foreach ($_SESSION as $key => $value) {
		$var = explode("_",$key);
		if($var[count($var)-1] == $GLOBALS['id_sess']){
			// session_unset($key);
			unset( $_SESSION[$key] );
		}
	}
}
function sess($id=false, $val=false){
	if(!$id && !$val)
		return $_SESSION;
	$id=$id."_".$GLOBALS['id_sess'];
	if($val==false){
		if(isset($_SESSION[$id]))
			return $_SESSION[$id];
		else
			return 0;
	}
	if($val==true){
		$_SESSION[$id] = $val;
		return $_SESSION[$id];
	}
	if($val == -1){
		unset($id);
		return 1;
	}
	if($val != -1){
		$_SESSION[$id] = $val;
		return $_SESSION[$id];
	}	
}
 ?>
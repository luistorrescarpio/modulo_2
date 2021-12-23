<?php 
	$client = true;
	require("start.php");

	//Aditional
	// $theme = "{$base_url}/lib/startbootstrap-sb-admin-2-gh-pages";
	
	// Data init Client
	echo '<div style="height:100vh;width:100vw;background-color:rgba(0,0,0,0.5);position:fixed;z-index:150000;padding:30px;display:none;"
	 align="center" id="he_loading">
		<img src="'.$base_url.'/system/assets/img/loading.gif" width="150">
	  </div>';

	 // Thema admin
	// if(isset($_SESSION['user']['privilegio']))
		// require_once($root."/view/admin/theme/sb-admin.php");

 ?>
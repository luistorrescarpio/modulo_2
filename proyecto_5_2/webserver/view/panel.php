<?php require("../system/client.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title> Welcome</title>
  <script src="<?=$public?>/js/jquery-3.2.1.min.js"></script>
</head>
<body>
  <h1>  Bienvenido</h1>
  <div>Que tal</div>
  <a href="admin/welcome.php">Admin Ini</a>
  <button onclick="saludar()">saludar</button>
  <button onclick="userList()">getList User</button>
  <script>
  	function userList(){
	  	he.post("test@user_list",{

	  	},function(res){
	  		console.log(res)
	  	},"json");
	  }
  	function saludar(){
	  	he.post("test@saludo",{

	  	},function(res){
	  		console.log(res)
	  	},"json");
	  }
    window.location.href="login.php"
  </script>
</body>
</html>
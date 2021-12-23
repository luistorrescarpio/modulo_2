<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Generador QR</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css">
	<link rel="stylesheet" href="https://static.pingendo.com/bootstrap/bootstrap-4.3.1.css">
	<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous" style=""></script>

	<script src="../lib/jquery-qrcode/jquery.qrcode.min.js"></script>
	
</head>
<body>
	<div>Esto es una prueba</div>
	<div class="py-5" style="	background-image: url(../public/img/fondo-001.jpg);	background-position: top left;	background-size: 300%;	background-repeat: no-repeat;	height: 99.5vh;">
	    <div class="container">
	      <div class="row">
	        <div class="col-md-12">
	          <h2 class="text-center my-0 py-0"  style="font-weight:bold;color:#38A390;">QR de Identificación</h2>
	          <!-- <img class="img-fluid d-block mx-auto" src="../public/img/qr-test.png" style="" > -->
	          <br>
	          <div align="center">
	          	<div id="qrcode" style="padding: 10px;background: white;position: absolute;left:28%;"></div>
	          </div>
	          
	          <h5 class="text-center" style="font-weight:normal;color:black;margin-top:230px;">Agente Juan Perez</h5>
	        </div>
	      </div>
	    </div>
	  </div>

	
	<script type="text/javascript">
		$('#qrcode').qrcode({width: 200,height: 200,text: "12312size doesn't matter"});
	</script>
</body>
</html>
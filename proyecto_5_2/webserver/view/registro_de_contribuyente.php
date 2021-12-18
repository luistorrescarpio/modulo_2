<?include("../system/client.php")?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css">
  <link rel="stylesheet" href="https://static.pingendo.com/bootstrap/bootstrap-4.3.1.css">
  <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous" style=""></script>
</head>

<body>
  <div class="py-4">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h2 contenteditable="true" class="text-center">Registro de Contribuyente</h2>
        </div>
      </div>
      <div class="row mt-3">
        <div class="col-md-12">
          <form class="" id="form_de_registro">
            <div class="form-group"> <label>DNI</label> <input type="text" class="form-control" id="dni"> <small class="form-text text-muted">Ingrese el Nro de su documento de identidad</small> </div>
            <div class="form-group"> <label>Nombres Completos</label> <input type="text" class="form-control" id="fullname"> </div>
            <div class="form-group"> <label>Ubicación GPS</label> <input type="text" class="form-control" id="latLng"> </div>
            <div class="form-group"> <label>Clave Secreta</label> <input type="text" class="form-control" id="password"> </div>
            <center>
              <button type="submit" class="btn btn-primary">Registrar</button>
            </center>
          </form>
        </div>
      </div>
    </div>
  </div>
  <script type="text/javascript">
    $(window).ready(function(){
      $( "#form_de_registro" ).submit(function( event ) {
        event.preventDefault();

        registrar();
      });
    });
    function registrar(){
      he.post("Contribuyente@registrar_contribuyente",{
        dni: $("#dni").val(),
        fullname: $("#fullname").val(),
        latLng: $("#latLng").val(),
        password: $("#password").val()
      },function( res ){
        alert(res.message);
        
        if(!res.success){
          console.log(res.error);
          return;
        }
        
        window.location.reload();

      },"json");
    }
  </script>
</body>
</html>
<? require("system/client.php")?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<script src="<?=$public?>/js/jquery-3.2.1.min.js"></script>
	<link rel="stylesheet" href="//cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
	<script src="//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
</head>
<body>
	<table id="example"></table>
	<button onclick="saludar()">Saludar</button>
	<button onclick="cuadroXcarrera()">Cuadro</button>
	<script>
		// saludar();
		function cuadroXcarrera(){
			he.post("test@cuadroXcarrera",{

			},function(res){
				console.log(res);
			},"json");
		}
		function saludar(){
			he.post("test@usoAula",{

			},function(res){
				console.log(res);
				return;	
/*				var data = [
    {
        "name":       "Tiger Nixon",
        "position":   "System Architect",
        "salary":     "$3,120",
        "start_date": "2011/04/25",
        "office":     "Edinburgh",
        "extn":       "5421"
    },
    {
        "name":       "Garrett Winters",
        "position":   "Director",
        "salary":     "$5,300",
        "start_date": "2011/07/25",
        "office":     "Edinburgh",
        "extn":       "8422"
    }
]*/
				$('#example').DataTable( {
				    data: res,
				    columns: [
				        { data: 'cActividadesTitulo' },
				        { data: 'cCarrera' },
				        { data: 'cCurricCursoDsc' },
				        { data: 'cNombres' },
				        { data: 'cTiposActividadesDsc' },
				        // { data: 'dtActividadesFechaSis' }
				    ]
				} );
			},"json")
		}
	</script>
</body>
</html>
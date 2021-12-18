<?php 
	// Funciones php Aqui
class he_driver{
	public function con($linkStr){
		if( strrpos($linkStr,"@") == TRUE ){
			$link = explode("@", $linkStr);
			$act = $link[1];
			$name = $link[0];
			return "{$GLOBALS['controller']}/{$name}Controller.php?action={$act}";			
		}else
			return "{$GLOBALS['controller']}/{$linkStr}Controller.php";
	}
	public function post($nameC,$attr=array(),$type_res=false) {
		$nameC = explode("@", $nameC);
		$url = $GLOBALS['base_url'].'/controller/'.$nameC[0].'Controller.php';
		$dataObj = array();
		$dataObj["action"] =  $nameC[1]; //action controller
		foreach ($attr as $key => $val) {
			$dataObj[$key] = $val;
		}

		$method = 'post';

		$dataObj["sess"] = [];
		$dataObj["sess"] = $_SESSION; 

	    $ch = curl_init();
	    if ($method == 'post') {
	        curl_setopt($ch, CURLOPT_POST, 1);
	        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($dataObj, '', '&'));
	    }
	    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	    curl_setopt($ch, CURLOPT_URL, $url);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	    curl_setopt($ch, CURLOPT_COOKIESESSION, 1);

	    $buffer = curl_exec($ch);
	    curl_close($ch);
	    // return $buffer;
	    if($type_res == "json" ){
	    	if(is_object(json_decode($buffer))){
	    		$arr = (array)json_decode($buffer);
		    	foreach ($arr as $i => $el) {
		    		if(is_object($arr[$i])){
			    		$arr2 = (array)$arr[$i];
				    	foreach ($arr2 as $j => $el2) {
				    		$arr2[$j] = $el2;

				    	}
				    	$arr[$i] = $arr2;
		    		}else{
		    			 $arr2 = $arr[$i];
				    	foreach ($arr2 as $j => $el2) {
				    		$arr2[$j] = (array)$el2;

				    	}
				    	$arr[$i] = $arr2;
		    			// $arr[$i] = $el;
		    		}
		    	}
				return $arr;
	    	}else if(is_array(json_decode($buffer))){
	    		$arr = (array)json_decode($buffer);
		    	foreach ($arr as $i => $el) {
		    		$arr[$i] = (array)$el;

		    	}
				return $arr;
	    	}
		}else
			return $buffer;
	}
	public function post_yearold($nameC,$attr=array(),$type_res=false){ // refused for yearonly
		$nameC = explode("@", $nameC);
		$url = $GLOBALS['base_url'].'/controller/'.$nameC[0].'Controller.php';
		$dataObj = array();
		$dataObj["action"] =  $nameC[1]; //action controller

		foreach ($attr as $key => $val) {
			$dataObj[$key] = $val;
		}
		$options = array(
		    'http' => array(
		        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
		        'method'  => 'POST',
		        'content' => http_build_query($dataObj, '', '&')
		    )
		);
		$context  = stream_context_create($options);
		$result = file_get_contents($url, false, $context);
		$lt_estado = strrpos($result, "Notice");
		if( $lt_estado ){
			echo $result;
			exit();
		}
		if ($result === FALSE) { /* Handle error */ }

		if($type_res == "json" )
			return json_decode($result);
		else
			return $result;
	}
}
$he = new he_driver();
?>

<script>
	var he_driver = function(){
		this.base_url = "<?=$base_url?>";
		this.post3_ok = {};
		this.con = function(linkStr){
			var link = linkStr.split("@");
			var act = link[1];
			var name = link[0];
			return "<?=$controller?>/"+name+"Controller.php?action="+act;
		}
		this.uploadFile = function(){
			//Codigo extra
		}
		this.post = function(nameController, obj ,callback1, type,loading,timeout){
		loading = loading!=undefined?loading:true;
		timeout = timeout?timeout:10;

		console.log(he.post3_ok);

		type = type?"json":false;
		var thisAux = this;
		nameController = nameController.split('@');
		if(he.post3_ok[nameController[1]] == undefined ){
			he.post3_ok[nameController[1]] = true;
		}
		if(he.post3_ok[nameController[1]] == false){
			console.log("SOLICITUD DENEGADA POR ESPERA");
			return;
		}
		dataObj = {};
		dataObj.action =  nameController[1]; //action controller

		console.log(nameController);
		// console.log(he.post3_ok);

		for( i in obj ){
			dataObj[i] = obj[i];
		}
		//Ingresa y cancela solicitudes hasta finalizar
		he.post3_ok[dataObj.action] = false; 

		if(loading)
			jQuery("#he_loading").show();
		console.log("SEND DATA");
		// console.log(dataObj.action);
		
			var actionPost = dataObj.action;
			var jqxhr = $.ajax({
				// async: false,
				type: 'POST',
				url: thisAux.base_url+'/controller/'+nameController[0]+'Controller.php',
				dataType: type,
				data: dataObj,
				error: function(jqXHR, exception){
					he.post3_ok[actionPost] = true;
					if(loading)
						jQuery("#he_loading").hide();
			        if (jqXHR.status === 0) {
				        alert('Not connect.\n Verify Network.');
				    } else if (jqXHR.status == 404) {
				        alert('Requested page not found. [404]');
				    } else if (jqXHR.status == 500) {
				        alert('Internal Server Error [500].');
				    } else if (exception === 'parsererror') {
				        // alert('Requested JSON parse failed.');
				        alert(jqXHR.responseText);
				    } else if (exception === 'timeout') {
				        alert('Time out error.');
				    } else if (exception === 'abort') {
				        alert('Ajax request aborted.');
				    } else {
				        alert('Uncaught Error.\n' + jqXHR.responseText);
				    }
			    },success: function(res){

			        //do something
			        setTimeout(function(){
			    		he.post3_ok[actionPost] = true;
				    	if(loading)
				    		jQuery("#he_loading").hide();
			        	callback1(res);
					},timeout);
			    }
			    /*,complete:function(){
			    	console.log("COMPLETADO");
			    }*/
	 
			})

		}
	}
	he = new he_driver();
</script>
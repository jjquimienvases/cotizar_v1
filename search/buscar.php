<?php
$conn = new mysqli('ftp.jjquimienvases.com', 'jjquimienvases_jjadmin', 'LeinerM4ster', 'jjquimienvases_cotizar');


function formatear($num){
	setlocale(LC_MONETARY, 'en_US');
	return "$" . number_format($num, 2);
}

    $salida = "";
    $querys = "SELECT * FROM factura_orden ORDER By order_date DESC LIMIT 25";

     $boton_receiver_info = $_POST['info_buscador'];

   if ($boton_receiver_info != "" OR $boton_receiver_info != 0) {

		echo "<pre>";
		print_r($boton_receiver_info);
		echo "</pre>";
	}else{
		echo "<pre>";
		print_r("Busca una nueva cotizacion");
		echo "</pre>";

	}

    if (isset($boton_receiver_info)) {
    	$q = ($_POST['caja_busqueda']);
    	$opcion = $_POST['opcion_filtro'];
    	 if($opcion == "cotizacion"){
    	     $query = "SELECT * FROM factura_orden WHERE order_id LIKE '%$q%'";
    	 }else if($opcion == "cc"){
    	     $query = "SELECT * FROM factura_orden WHERE cedula LIKE '%$q%'";
    	 }else if($opcion == "comercial"){
    	     $query = "SELECT * FROM factura_orden WHERE order_receiver_address LIKE '%$q%'";
    	 }else if($opcion == "cliente"){
    	     $query = "SELECT * FROM factura_orden WHERE order_receiver_name LIKE '%$q%'";
    	 }else if($opcion == "fecha"){
    	     $query = "SELECT * FROM factura_orden WHERE order_date LIKE '%$q%'";
    	 }
        
    	
    // 	return;
    // 	$query = "SELECT * FROM factura_orden WHERE order_id LIKE '%$q%' OR DATE(order_date) LIKE '%$q%' OR order_receiver_name LIKE '%$q%' OR cedula = '%$q%'";
    }





// return;
 ?>   

 <!DOCTYPE html>
 <html lang="en" dir="ltr">
 	<head>
 		<meta charset="utf-8">
 		<title>Resultado</title>
 		<link rel="stylesheet" type="text/css" href="css/estilo.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">

 				<style>
				th,td {
						padding: 0.4rem !important;
				}
				body>div {
						box-shadow: 10px 10px 8px #888888;
						border: 2px solid black;
						border-radius: 10px;
						margin-top: 20px;
						height: auto;
				}
				a{
					decoration: none;
					color: white;
				}
				.container{
					height: auto;
				}
				tbody{
					height: 100%;

				}
				.contenedor_post{
				    margin-left:200px;
				}

		</style>
 	</head>
 	<body>
 	    <hr>
 	    <hr>
 	      <center>
        <span class="btn btn-primary"><a href="../create_invoice_.php">Crear una nueva cotizacion</a></span>
        <span class="btn btn-danger" ><a href="../action.php?action=logout">Cerrar Session</a></span>
        </center>
        <hr>
        <?php
        	$seleccion = " 
	 <select name='opcion_filtro' class='form-control'>
	     <option value='cotizacion'>Cotizacion</option>
	     <option value='cliente'>Nombre</option>
	     <option value='cc'>CC o NIT</option>
	     <option value='fecha'>Fecha</option>
	     <option value='comercial'>Comercial</option>
	 </select>
	 ";
 	 	 $label = "<label for='caja_busqueda' id='caja_busqueda' name='caja_busqueda'>";
 	     $input = "<input type='text' name='caja_busqueda' id='caja_busqueda' class='form-control'>";
 	     $botoncini = "<button class='btn btn-success' id='info_buscador' value='1' type='submit' name='info_buscador'>Buscar</button>";
 	     $new_search ="Hacer una nueva busqueda";
 	        $card = "
   <div class='card' style='width: 18rem;'>
  <div class='card-header'>
    $new_search
  </div>
  <ul class='list-group list-group-flush'>
    <li class='list-group-item'>$seleccion</li>
    <li class='list-group-item'>$label</li>
    <li class='list-group-item'>$input</li>
    <li class='list-group-item'>$botoncini</li>
  </ul>
</div>";
 	     ?>
 	     <form class="" action="" method="post">
 	       <div class="row">

 	       <div class="col-xs-6 col-md-4">
 	    <?php  
     if (isset($_POST['caja_busqueda'])){
    echo $card;
}
?>
           </div>
           </div>
           
 	     
 	       


</form>
 	      
		<hr>
		<div id="contenedor_post" class="container">
		    
		    
		     	<?php
 	
 	$resultado = $conn->query($query);
    $resultado_2 = $conn->query($querys);

    if ($resultado->num_rows>0) {
    	$salida.="<table class='table table-bordered'>
    			<thead>
    				<tr id='titulo'>
    			     	<td>Fecha</td>
    					<td>Remision</td>
    					<td>Comercial</td>
    					<td>Cliente</td>
    					<td>Cedula</td>
    					<td>Monto</td>
    					<td colspan='2'>Editar</td>
    					<td>imprimir</td>
    				
    				</tr>

    			</thead>
    			

    	<tbody>";

    	while ($fila = $resultado->fetch_assoc()) {
    	    $cotizacion = $fila['order_id'];
    	    $monto = $fila['order_total_after_tax'];
    	    
      $link = "<button class='btn btn-warning'> <a href='../print_invoice.php?invoice_id=".$cotizacion."' target='_blank'>PDF</a></button>";
    	$url ="<button class='btn btn-primary'> <a href='../edit_invoice.php?update_id=".$cotizacion."' target='_blank'>Editar</a></button>";
    	$url_ib ="<button class='btn btn-secundary'> <a href='../edit_ibague.php?update_id=".$cotizacion."' target='_blank'>E-Ibague</a></button>";
    	 
    		$salida.="<tr>
    					<td>".$fila['order_date']."</td>
    					<td>".$fila['order_id']."</td>
    					<td>".$fila['order_receiver_address']."</td>
    					<td>".$fila['order_receiver_name']."</td>
    					<td>".$fila['cedula']."</td>
    					<td>".formatear($monto)."</td>
    					<td>".$url."</td>
    					<td>".$url_ib."</td>
    					<td>".$link."</td>
    				</tr>";

    	}
    	$salida.="</tbody></table>";
    }else{
    	$salida.="<table class='table table-bordered'>
    			<thead>
    				<tr id='titulo'>
    					<td>Fecha</td>
    					<td>Remision</td>
    					<td>Comercial</td>
    					<td>Cliente</td>
    					<td>Cedula</td>
    					<td>Monto</td>
    					<td colspan='2'>Editar</td>
    					<td>imprimir</td>
    				</tr>

    			</thead>
    			

    	<tbody>";

    	while ($filas = $resultado_2->fetch_assoc()) {
    	    $cotizacion = $filas['order_id'];
    	    $monto = $filas['order_total_after_tax'];
    	    
      $link = "<button class='btn btn-warning'> <a href='../print_invoice.php?invoice_id=".$cotizacion."' target='_blank'>PDF</a></button>";
    	$url ="<button class='btn btn-primary'> <a href='../edit_invoice.php?update_id=".$cotizacion."' target='_blank'>Editar</a></button>";
    		$url_ib ="<button class='btn btn-secundary'> <a href='../edit_ibague.php?update_id=".$cotizacion."' target='_blank'>E-Ibague</a></button>";
    	 
    		$salida.="<tr>
    					<td>".$filas['order_date']."</td>
    					<td>".$filas['order_id']."</td>
    					<td>".$filas['order_receiver_address']."</td>
    					<td>".$filas['order_receiver_name']."</td>
    					<td>".$filas['cedula']."</td>
    					<td>".formatear($monto)."</td>
    					<td>".$url."</td>
    					<td>".$url_ib."</td>
    					<td>".$link."</td>
    				</tr>";

    	}
    	$salida.="</tbody></table>";
    }


    echo $salida;

    $conn->close();



?>
		    
		</div>
 	

 	</body>
 </html>
<?php
include '../conectar.php';
$conn = conectar();
function formatear($num){
	setlocale(LC_MONETARY, 'en_US');
	return "$" . number_format($num, 2);
}

    $salida = "";

    $querys = "SELECT * FROM factura_orden ORDER By order_date DESC LIMIT 25";

    if (isset($_POST['consulta'])) {
    	$q = $conn->real_escape_string($_POST['consulta']);
    	$query = "SELECT * FROM factura_orden WHERE order_id LIKE '%$q%' OR order_date LIKE '%$q%' OR order_receiver_name LIKE '%$q%'";
    }

    $resultado = $conn->query($query);
    $resultado_2 = $conn->query($querys);

    if ($resultado->num_rows>0) {
    	$salida.="<table border=1 class='tabla_datos'>
    			<thead>
    				<tr id='titulo'>
    					<td>Fecha</td>
    					<td>Cot</td>
    					<td>Cliente</td>
    					<td>Monto</td>

    					<td>imprimir</td>
    				
    				</tr>

    			</thead>
    			

    	<tbody>";

    	while ($fila = $resultado->fetch_assoc()) {
    	    $cotizacion = $fila['order_id'];
    	    $monto = $fila['order_total_after_tax'];
    	    
      $link = "<button> <a href='../imprimir.php?invoice_id=".$cotizacion."' target='_blank'>PDF</a></button>";

    	 
    		$salida.="<tr>
    					<td>".$fila['order_date']."</td>
    					<td>".$fila['order_id']."</td>
    					<td>".$fila['order_receiver_name']."</td>
       					<td>".formatear($monto)."</td>

    					<td>".$link."</td>
    					
    			
    				</tr>";

    	}
    	$salida.="</tbody></table>";
    }else{
    	$salida.="<table border=1 class='tabla_datos'>
    			<thead>
    				<tr id='titulo'>
    					<td>Fecha</td>
    					<td>Cot</td>
    					<td>Cliente</td>
    					<td>Monto</td>
    	
    					<td>imprimir</td>
    				
    				</tr>

    			</thead>
    			

    	<tbody>";

    	while ($filas = $resultado_2->fetch_assoc()) {
    	    $cotizacion = $filas['order_id'];
    	    $monto = $filas['order_total_after_tax'];
    	    
      $link = "<button> <a href='../imprimir.php?invoice_id=".$cotizacion."' target='_blank'>PDF</a></button>";

    	 
    		$salida.="<tr>
    					<td>".$filas['order_date']."</td>
    					<td>".$filas['order_id']."</td>
    					<td>".$filas['order_receiver_name']."</td>
    					<td>".formatear($monto)."</td>
    		
    					<td>".$link."<td>
    				</tr>";

    	}
    	$salida.="</tbody></table>";
    }


    echo $salida;

    $conn->close();



?>
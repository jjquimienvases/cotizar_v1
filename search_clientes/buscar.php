<?php
include '../conectar.php';
$conn = conectar();
function formatear($num){
	setlocale(LC_MONETARY, 'en_US');
	return "$" . number_format($num, 2);
}

    $salida = "";

    $querys = "SELECT * FROM clientes ORDER By id DESC LIMIT 25";

    if (isset($_POST['consulta'])) {
    	$q = $conn->real_escape_string($_POST['consulta']);
    	$query = "SELECT * FROM clientes WHERE cedula LIKE '%$q%' OR nombres LIKE '%$q%' OR telefono LIKE '%$q%'";
    }

    $resultado = $conn->query($query);
    $resultado_2 = $conn->query($querys);

    if ($resultado->num_rows>0) {
    	$salida.="<table border=1 class='tabla_datos'>
    			<thead>
    				<tr id='titulo'>
    					<td>Cedula</td>
    					<td>Nombre</td>
							<td>Email</td>
    					<td>Telefono</td>
    					<td>Direccion</td>
    					<td>Ciudad</td>

    				</tr>

    			</thead>


    	<tbody>";

    	while ($fila = $resultado->fetch_assoc()) {
    		$salida.="<tr>
    					<td>".$fila['cedula']."</td>
    					<td>".$fila['nombres']."</td>
							<td>".$fila['email']."</td>
    					<td>".$fila['telefono']."</td>
    					<td>".$fila['direccion']."</td>
    					<td>".$fila['ciudad']."</td>


    				</tr>";

    	}
    	$salida.="</tbody></table>";
    }else{
    	$salida.="<table border=1 class='tabla_datos'>
    			<thead>
					<tr id='titulo'>
						<td>Cedula</td>
						<td>Nombre</td>
						<td>Email</td>
						<td>Telefono</td>
						<td>Direccion</td>
						<td>Ciudad</td>
					</tr>

    			</thead>


    	<tbody>";

    	while ($filas = $resultado_2->fetch_assoc()) {
    		$salida.="<tr>
				<td>".$filas['cedula']."</td>
				<td>".$filas['nombres']."</td>
				<td>".$filas['email']."</td>
				<td>".$filas['telefono']."</td>
				<td>".$filas['direccion']."</td>
				<td>".$filas['ciudad']."</td>
    				</tr>";

    	}
    	$salida.="</tbody></table>";
    }


    echo $salida;

    $conn->close();



?>

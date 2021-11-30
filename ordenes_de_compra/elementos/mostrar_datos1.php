<?php
include '../conexion.php';
session_start();

$user_name = $_SESSION['user'];
$user_rol = $_SESSION['id_rol'];
$estado_solicitud = "solicitud";

$consulta = $conexion->query("SELECT * FROM solicitud_productos WHERE DATE(fecha_solicitud) > '2021-08-30' ");

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../traspasos/css/estilos.css">
    <title>Ver ordenes</title>
</head>

<body>
    <?php
echo "<table class='table'>
 <thead>
     <th>Fecha</th>
     <th>Codigo</th>
     <th>Producto</th>
     <th>Cantidad</th>
     <th>Cancelar</th>
 </thead>";

while ($registro = mysqli_fetch_array($consulta)) {
    echo "<tr>";
    echo "<td><center>" . $registro['fecha_solicitud'] . "</center></td>";
    echo "<td><center>" . $registro['item_id'] . "</center></td>";
    echo "<td><center>" . $registro['item_name'] . "</center></td>";
    echo "<td><center>" . $registro['item_quantity'] . "</center></td>";
    echo "<td> <button id='eliminar' data-id='" . $registro["id"] . "' class='btn btn-danger'>X</button></td>";

    echo "</tr>";

}
echo "</table>";
?>
</body>

</html>
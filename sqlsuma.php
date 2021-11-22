

<?php
// $mysqli2 = new mysqli ('localhost', 'root', '', 'cotpruebas');  //voy a hacer una prueba, miremos si funciona
include 'conectar.php';
$conexion = conectar();


 $consulta = $conexion -> query("SELECT * FROM modal_info WHERE user = '$usuario'");
$totalss = 0;
$tot = 0;
while($row = mysqli_fetch_array($consulta))
{
  $tot += $totalss + $row['total'];
}
?>

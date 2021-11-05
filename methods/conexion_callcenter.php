<?php
include "../conectar.php";
$conexion = conectar();
$resultado = new stdClass;
$fun = $_POST['key'];
switch ($fun) {
  case 'buscarproducto':
    if (isset($_POST['val'])) {
        $ids = $_POST['val'];
      $query = $conexion -> query ("SELECT id,contratipo as text FROM producto_av WHERE visibilidad = 1 AND id LIKE '%$ids%' OR contratipo LIKE '%$ids%'");
      while ($valores = $query->fetch_object()) {
        $resultado->results[] = $valores;
      }
    }
    break;
  case 'Q1':
    $id = $_POST['producto'];
    $sql = "SELECT * FROM producto_av
    WHERE visibilidad = 1 AND id=$id";
    $r = $conexion->query($sql);
    if ($o = $r->fetch_object()) {
      $resultado->resultado = $o;
    }
    break;
}
echo json_encode($resultado);
 ?>

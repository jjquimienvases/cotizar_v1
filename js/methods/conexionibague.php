<?php
include '../../conectar.php';
$conexion = conectar();
$resultado = new stdClass;
$fun = $_POST['key'];
switch ($fun) {
  case 'buscarproducto':
    if (isset($_POST['val'])) {
      $query = $conexion -> query ("SELECT id,contratipo as text FROM productos_ibague WHERE contratipo LIKE '%$_POST[val]%' OR id LIKE '%$_POST[val]%'");
      while ($valores = $query->fetch_object()) {
        $resultado->results[] = $valores;
      }
    }
    break;
  case 'Q1':
    $id = $_POST['producto'];
    $sql = "SELECT * FROM productos_ibague
    WHERE id='$id'  OR contratipo LIKE '%$id%' AND id LIKE '%$id%' ";
    $r = $conexion->query($sql);
    if ($o = $r->fetch_object()) {
      $resultado->resultado = $o;
    }
    break;
}
echo json_encode($resultado);
 ?>

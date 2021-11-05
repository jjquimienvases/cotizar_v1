<?php
include "../conectar.php";
$conexion = conectar();
$resultado = new stdClass;
$fun = $_POST['key'];
switch ($fun) {
  case 'proveedor_s':
    if (isset($_POST['val'])) {
      $query = $conexion -> query ("SELECT id,empresa as text FROM proveedor WHERE empresa LIKE '%$_POST[val]%' OR asesor LIKE '%$_POST[val]%'");
      while ($valores = $query->fetch_object()) {
        $resultado->results[] = $valores;
      }
    }
    break;
  case 'Q2':
    $id = $_POST['producto'];
    $sql = "SELECT * FROM proveedor
    WHERE empresa='$id'  OR asesor LIKE '%$id%'";
    $r = $conexion->query($sql);
    if ($o = $r->fetch_object()) {
      $resultado->resultado = $o;
    }
    break;
}
echo json_encode($resultado);
 ?>
 

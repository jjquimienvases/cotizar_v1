<?php

include "../globals.php";

$resultado = new stdClass;
$fun = $_POST['key'];
switch ($fun) {
  case 'buscarproducto':
    if (isset($_POST['val'])) {
      $query = $cnx->query("SELECT id,contratipo as text FROM producto WHERE contratipo LIKE '%$_POST[val]%' OR id LIKE '%$_POST[val]%'");
      while ($valores = $query->fetch_object()) {
        $resultado->results[] = $valores;
      }
    }
    break;
  case 'Q1':
    $id = $_POST['producto'];
    $sql = "SELECT * FROM producto
    WHERE id='$id'  OR contratipo LIKE '%$id%' AND id LIKE '%$id%' ";
    $r = $cnx->query($sql);
    if ($o = $r->fetch_object()) {
      $resultado->resultado = $o;
    }
    break;
}

echo json_encode($resultado);

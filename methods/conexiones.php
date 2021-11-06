

<?php
include "../globals.php";
header('Content-Type: application/json');
$response = new stdClass;
$fun = $_POST['key'];
switch ($fun) {
  case 'Q1':
    $id = $_POST['cliente'];
    $sql = "SELECT * FROM clientes
                WHERE nombres='$id'  OR cedula LIKE '%$id%'";
    $r = $cnx->query($sql);
    if ($o = $r->fetch_object()) {
      $resultado = $o;
    }
    $response->resultado = $resultado;
    break;
}
echo json_encode($response);
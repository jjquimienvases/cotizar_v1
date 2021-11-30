<?php
header('Content-type: application/json; charset=utf-8');
$json = new stdClass;
include 'conectar.php';
$con = conectar();
$json->items = array();

if (isset($_POST['id'])) {
  $id = $_POST['id'];

  $r = $con->query("DELETE FROM modal_info WHERE id='$id' LIMIT 1;");
  if ($r) {
    $r = $con->query("SELECT * FROM modal_info");
    while ($o = $r->fetch_object()) {
      $json->items[] = $o;
    }
  }
}



echo json_encode($json);
?>

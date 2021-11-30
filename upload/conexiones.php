
<?php
function conectar()
{
  $servidor = "173.230.154.140";
  $nombreBd = "cotizar";
  $usuario = "cotizar";
  $pass = "LeinerM4ster";
  $conexion = new mysqli($servidor, $usuario, $pass, $nombreBd);
  if ($conexion->connect_error) {
    die("Connection failed: " . $conexion->connect_error);
  }
  return $conexion;
}
header('Content-Type: application/json');
$response = new stdClass;
$conexion = conectar();
  $fun = $_POST['key'];
  switch ($fun) {
      case 'Q1':
         $id = $_POST['cliente'];
          $sql = "SELECT * FROM files
                WHERE order_id='$id'";
          $r = $conexion->query($sql);
          if ($o = $r->fetch_object()) {
           $resultado = $o;
          }
        $response->resultado = $resultado;
          break;
    }
    echo json_encode($response);
 ?>

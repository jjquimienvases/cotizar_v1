<?php
$conexion = new mysqli('ftp.jjquimienvases.com', 'jjquimienvases_jjadmin', 'LeinerM4ster', 'jjquimienvases_cotizar');
function conectar(){
  $servidor="ftp.jjquimienvases.com";
  $nombreBd="jjquimienvases_cotizar";
  $usuario="jjquimienvases_jjadmin";
  $pass="LeinerM4ster";
  $conexion = new mysqli($servidor,$usuario,$pass,$nombreBd);
  if ($conexion->connect_error) {
    die("Connection failed: " . $conexion->connect_error);
  }
  return $conexion;
}

$conexion = conectar();




$resultado = new stdClass;
$fun = $_POST['key'];
switch ($fun) {
  case 'buscarproducto':
    if (isset($_POST['val'])) {
      $query = $conexion -> query ("SELECT id,contratipo as text FROM producto WHERE contratipo LIKE '%$_POST[val]%' OR id LIKE '%$_POST[val]%'");
      while ($valores = $query->fetch_object()) {
        $resultado->results[] = $valores;
      }
    }
    break;
  case 'Q1':
    $id = $_POST['producto'];
    $sql = "SELECT * FROM producto
    WHERE id='$id'  OR contratipo LIKE '%$id%' AND id LIKE '%$id%' ";
    $r = $conexion->query($sql);
    if ($o = $r->fetch_object()) {
      $resultado->resultado = $o;
    }
    break;
}

echo json_encode($resultado);

 ?>

<?php
include "../conectar.php";
$conexion = conectar();
$resultado = new stdClass;
$fun = $_POST['key'];
switch ($fun) {
    case 'buscarproducto':
        if (isset($_POST['val'])) {
            $query = $conexion->query("SELECT id,contratipo as text FROM producto_av WHERE contratipo LIKE '%$_POST[val]%' OR id LIKE '%$_POST[val]%'");
            while ($valores = $query->fetch_object()) {
                $resultado->results[] = $valores;
            }
        }
        
        break;
    case 'buscarPerfume':
        if (isset($_POST['val'])) {
            $query = $conexion->query("SELECT id,contratipo as text FROM producto_av WHERE contratipo LIKE '%$_POST[val]%' OR id LIKE '%$_POST[val]%'");
            while ($valores = $query->fetch_object()) {
                $resultado->results[] = $valores;
            }
        }
        
        break;
    case 'Q1':
        $id = $_POST['producto'];
        $sql = "SELECT * FROM producto_av
    WHERE id='$id'  OR contratipo LIKE '%$id%' AND id LIKE '%$id%' ";
        $r = $conexion->query($sql);
        if ($o = $r->fetch_object()) {
            $resultado->resultado = $o;
        }
        break;
        
    case 'Q2':
        $id = $_POST['perfume'];
        $sql = "SELECT * FROM producto_av
            WHERE id='$id'  OR contratipo LIKE '%$id%' AND id LIKE '%$id%' ";
        $r = $conexion->query($sql);
        if ($o = $r->fetch_object()) {
            $resultado->resultado = $o;
        }
        
        break;
    case 'Q3':
        $id = $_POST['opcion'];
        $sql = "SELECT * FROM opciones_perfumeria
                WHERE idperfumeria='$id'  OR opciones LIKE '%$id%' AND idperfumeria LIKE '%$id%' ";
        $r = $conexion->query($sql);
        if ($o = $r->fetch_object()) {
            $resultado->resultado = $o;
        }
       
        break;
    case 'opciones':
        if (isset($_POST['val'])) {
            $query = $conexion->query("SELECT idperfumeria,opciones as text FROM opciones_perfumeria WHERE opciones LIKE '%$_POST[val]%' OR idperfumeria LIKE '%$_POST[val]%' ");
            while ($valores = $query->fetch_object()) {
                $resultado->results[] = $valores;
            }
        }
        
        break;
  case 'buscarEnvases':
       
        $query = $conexion->query("SELECT * FROM producto_av WHERE id_categoria=9");
        echo "<datalist id='buscarenva'>";
        echo "<opcion>seleciona</option>";
        while ($valores = mysqli_fetch_array($query)) {
            echo '<option value="' . $valores["id"] . '">' . $valores["contratipo"] . ',' . $valores["id"] . '</option>';
        }
        echo "</datalist>";
        echo " <input class='' list='buscarenva' name='Envase[]' id='envases' type='text' placeholder='Buscar' class='form-group'>";
        break;
    case 'Q3':

        $id = $_POST['cliente'];
        $sql = "SELECT * FROM producto_av WHERE contratipo='$id'  OR id LIKE '%$id%'";
        $r = $conexion->query($sql);
        if ($o = $r->fetch_object()) {
            $resultado = $o;
        }
        $response->resultado = $resultado;
        break;
}

echo json_encode($resultado);
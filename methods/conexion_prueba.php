<?php
include "../conectar.php";
$conexion = conectar();
$resultado = new stdClass;
$fun = $_POST['key'];
switch ($fun) {
    case 'buscarproducto':
        $tabla = $_POST['tabla'];
        if (isset($_POST['val'])) {
            $query = $conexion->query("SELECT id,contratipo as text FROM ".$tabla." WHERE contratipo LIKE '%$_POST[val]%' OR id LIKE '%$_POST[val]%'");
            while ($valores = $query->fetch_object()) {
                $resultado->results[] = $valores;
            }
        }

        break;
    case 'buscarPerfume':
        $tabla = $_POST['tabla'];
        if (isset($_POST['val'])) {
            $query = $conexion->query("SELECT id,contratipo as text FROM ".$tabla." WHERE contratipo LIKE '%$_POST[val]%' OR id LIKE '%$_POST[val]%'");
            while ($valores = $query->fetch_object()) {
                $resultado->results[] = $valores;
            }
        }

        break;
    case 'Q1':
        $id = $_POST['producto'];
        $tabla = $_POST['tabla'];
        $sql = "SELECT * FROM ".$tabla."
    WHERE id='$id'  OR contratipo LIKE '%$id%' AND id LIKE '%$id%' ";
        $r = $conexion->query($sql);
        if ($o = $r->fetch_object()) {
            $resultado->resultado = $o;
        }
        break;

    case 'Q2':
        $id = $_POST['perfume'];
        $tabla = $_POST['tabla'];
        $sql = "SELECT * FROM ".$tabla."
            WHERE id='$id'  OR contratipo LIKE '%$id%' AND id LIKE '%$id%' ";
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
        $tabla = $_POST['tabla'];
        $query = $conexion->query("SELECT * FROM ".$tabla." WHERE  id_categoria=9 ");
        echo "<datalist id='buscarenva'>";
        echo "<opcion>seleciona</option>";
        while ($valores = mysqli_fetch_array($query)) {
            echo '<option value="' . $valores["id"] . '">' . $valores["id"] . ',' . $valores["contratipo"] . '</option>';
        }
        echo "</datalist>";
        echo " <input class='' list='buscarenva' name='Envase[]' id='envases' type='text' placeholder='Buscar'>";
    
        break;
    case 'Q3':
        $tabla = $_POST['tabla'];
        $id = $_POST['cliente'];
        $sql = "SELECT * FROM ".$tabla." WHERE contratipo='$id'  OR id LIKE '%$id%'";
        $r = $conexion->query($sql);
        if ($o = $r->fetch_object()) {
            $resultado = $o;
        }
        $response->resultado = $resultado;
        break;
}

echo json_encode($resultado);

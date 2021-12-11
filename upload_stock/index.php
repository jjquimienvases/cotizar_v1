<?php
include 'conexion.php';
session_start();


$user = $_SESSION['user'];
$user_id = $_SESSION['userid'];
$user_rol = $_SESSION['id_rol'];

$bodega = "";
if ($user_rol == 3) {
    $bodega = "producto_d1";
} else if ($user_rol == 2) {
    $bodega = "producto";
} else if ($user_rol == 7) {
    $bodega = "productos_ibague";
} else {
    $bodega = "producto_av";
}

include 'includes/modal_information.php';
$href = "";

if($user_rol == 2){
    $href = "../panel_mostrador.php";
}else if($user_rol == 3){
    $href = "../panel_d1.php";
}else{
    $href = "../Panel_Comerciales.php";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="../jquery-3.5.1.min.js"></script>
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="js/funciones.js"></script>
    <title>Gestor Inventarios</title>
    <style> 
 a{
     text-decoration: none;
     color: #fff;
 }
</style>
</head>

<body>
    <div class="container">
        
  <!-- Modal Trigger -->
  
  <hr>
  <div class="text-center">
  
  <center> <h4> Bienvenido <?= $user ?> </h4>
      <h5>Gestion y actualizacion de inventarios</h5>
    </div>
    <div> 
        <button type="button" class="btn btn-primary red lighten-2"><a href="<?= $href?>">Regresar a tu panel.</a> </button>
    </center>
    </div>   
    <hr>
    <br>
    <a class="waves-effect waves-light btn modal-trigger" href="#modal1" id="open_modal_information">Ver Items Ingresados   </a>
    <br>
    <div class="form-group mt-2">
            <label>Buscar Productos</label>
            <div class="buscar_productos">
                <datalist id="search_items">
                    <option value="">Seleccione un cliente</option>
                    <?php
                    $query = $con->query("SELECT * FROM $bodega ORDER BY id ASC");
                    while ($valores = mysqli_fetch_array($query)) {
                        echo '<option value="' . $valores["id"] . '">' . $valores["id"] . ',' . $valores["contratipo"] . '</option>';
                    }
                    ?>
                </datalist>
                <input class="form-control buscador" list="search_items" name="item" id="buscar_productos" type="text" placeholder="Buscar Productos">
            </div>
        </div>

        <br>

        <div class="row" id="info_item">
            <form class="col s12" id="form_1">
                <div class="row">
                    <div class="input-field col s6">
                        <input placeholder="Codigo" name="id" id="first_name" readonly type="number" class="validate">
                        <label for="first_name">Codigo</label>
                    </div>
                    <div class="input-field col s6">
                        <input id="last_name" name="contratipo" type="text" readonly class="validate">
                        <input name="user_id" type="hidden" id="user_id" value="<?= $user_id ?>" class="validate">
                        <input name="user_name" id="user_name" type="hidden" value="<?= $user ?>" class="validate">
                        <input name="bodega" type="hidden" value="<?= $bodega ?>" class="validate">
                        <label for="last_name">Contratipo</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <input id="password" type="number" name="stock" readonly class="validate">
                        <label for="password">Stock Actual</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <input id="email" name="new_stock" type="number" class="validate">
                        <label for="email">Nuevo Stock</label>
                    </div>
                </div>

                <div class="row">
                    <button class="btn btn-primary blue lighten-2" type="button" id="send_info">Cargar Inventarios</button>
                </div>
            </form>
        </div>

    </div>
</body>

</html>
<?php
include '../conexion.php';
$conexion = conectar();
$date = date("Y-m-d");
session_start();
$user = $_SESSION["user"];
$user_rol = $_SESSION["id_rol"];
// if (!$user_rol) {
//     header("location: https://cotizar.jjquimienvases.com/");

//     return;
// } else {}

$date = date("Y-m-d");
$ref = "";
$ref_create = "";
$info_bodega = "";


if ($user_rol == 7) {
  $ref = "../../panel_ibague.php";
} else if ($user_rol == 2) {
  $ref = "../../panel_mostrador.php";
} else if ($user_rol == 3) {
  $ref = "../../panel_d1.php";
} else {
  $ref = "../../Panel_Comerciales.php";
}
if ($user_rol == 7) {
  $info_bodega = "productos_ibague";
} else if ($user_rol == 2) {
  $info_bodega = "producto";
} else if ($user_rol == 3) {
  $info_bodega = "producto_d1";
} else {
  $info_bodega = "producto_av";
}



?>
<!DOCTYPE html>
<html lang="en">

<head>
  <link href="../../Lib/bootstrap/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="../../Lib/bootstrap/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
  <link rel="stylesheet" href="../css/estilos.css">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <title>Crear Items</title>
</head>

<body>
  <div class="container" id="app">
    <!-- <form @submit.prevent="consultar_data"> -->
    <form id="form_1" method="post">
      <div class="panel panel-default">
        <div class="panel-heading">

          <div class="row ">
            <div class="col-md-12">
              <span class="help-block text-muted small-font">Busca y selecciona tu nombre</span>
              <div class="buscar_usuario">
                <datalist id="buscaruser">
                  <option value="">Seleccione un cliente</option>
                  <?php
                  $query = $conexion->query("SELECT * FROM factura_usuarios ORDER BY first_name ASC");
                  while ($valores = mysqli_fetch_array($query)) {
                    echo '<option value="' . $valores["first_name"] . ' ' . $valores["last_name"] . '">' . $valores["first_name"] . ' ' . $valores["last_name"] . '</option>';
                  }
                  ?>
                </datalist>
                <input class="form-control" v-model="user_creador" list="buscaruser" name="user_creador" id="buscar_usuario" type="text" placeholder="Buscar el nombre de quien va a ejecutar la accion">
              </div>
            </div>
          </div>
          <hr>
          <div class="row mt-1">
            <div class="col-md-3 col-sm-3 col-xs-3">
              <span class="help-block text-muted small-font">Seleccionar Materia Prima</span>
              
              <select name="materia" id="inputPassword4" v-model="materia" class="form-control">
                <option value="">Escoger Una Opcion</option>
                <?php 
             $sql = $conexion->query("SELECT * FROM producto_av WHERE contratipo LIKE '%Materia Prima%'");
             foreach ($sql as $data):
              echo '<option value="' . $data["id"] . '">' . $data["id"] . ' ' . $data["contratipo"] . '</option>';

             endforeach; 

              ?>
              </select>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-3">
              <span class="help-block text-muted small-font"> Seleccionar una presentacion</span>
              <select name="presentacion" id="presentacion" v-model="presentacion" class="form-control">
                <option value="">Escoge Una Opcion</option>
                <option value="cuarto">Cuarto</option>
                <option value="media">Media Libra</option>
                <option value="libra">Libra</option>
                <option value="litro">Litro / Kilo</option>
                <option value="galon">Galon</option>
                <option value="garrafa">Garrafa</option>
              </select>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-3">
              <span class="help-block text-muted small-font"> Seleccionar Un Envase</span>
              <div class="buscar_envase">
                <datalist id="buscarenvase">
                  <option value="">Seleccione un envase</option>
                  <?php
                  $query = $conexion->query("SELECT * FROM producto_av ORDER BY contratipo ASC");
                  while ($valores = mysqli_fetch_array($query)) {
                    echo '<option value="' . $valores["id"] . '">' . $valores["id"] . ', ' . $valores["contratipo"] . '</option>';
                  }
                  ?>
                </datalist>
                <input class="form-control" v-model="envase_presentacion" list="buscarenvase" name="envase_presentacion" id="buscar_envase" type="text" placeholder="Buscar Envase">
              </div>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-3">
              <span class="help-block text-muted small-font"> Seleccionar Una Tapa</span>
              <div class="buscar_tapa">
                <datalist id="buscartapa">
                  <option value="">Seleccione una tapa</option>
                  <?php
                  $query = $conexion->query("SELECT * FROM producto_av ORDER BY contratipo ASC");
                  while ($valores = mysqli_fetch_array($query)) {
                    echo '<option value="' . $valores["id"] . '">' . $valores["id"] . ', ' . $valores["contratipo"] . '</option>';
                  }
                  ?>
                </datalist>
                <input class="form-control" v-model="tapa_presentacion" list="buscartapa" name="tapa_presentacion" id="buscar_tapa" type="text" placeholder="Buscar Tapa">
              </div>
            </div>
          </div>
          <hr>
          <div class="row mt-2">
            <div class="col-md-12 pad-adjust">
              <label class="help-block text-muted small-font">Escribir la cantidad</label>
              <input type="number" v-model="cantidad" name="cantidad" class="form-control" placeholder="Escribir la cantidad" />
            </div>
<input type="hidden" name="bodega" value="<?= $info_bodega ?>">
          </div>

          <div class="row ">
            <div class="col-md-6 col-sm-6 col-xs-6 pad-adjust mt-2">
              <!-- <input type="button" class="btn btn-warning btn-block" @click="consultar_data()" id="send_info" :disabled="!(cantidad)" value="Crear Productos" /> -->
              <button type="button" class="btn btn-warning btn-block"  id="send_info" :disabled="!(cantidad)">ok</button>
            </div>
          </div>

        </div>
      </div>
    </form>
  </div>




  <!-- Scripts-->

  <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
  <script src="../../jquery-3.5.1.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.24/datatables.min.js"></script>
  <!-- Vue Currency Filter Dependency -->
  <script src="https://unpkg.com/vue-currency-filter@3.2.3/dist/vue-currency-filter.iife.js"></script>
  <!-- Change 3.2.3 with latest version -->
  <script src="../js/consulta.js"></script>
  <!-- <script src="../scripts/script.js"></script> -->
  <!-- <script src="../scripts/funciones_globales.js"></script> -->
</body>

</html>
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
  <?php include '../includes/head.php'; ?>
  <title>Crear Items</title>
</head>

<body>
  <div class="container" id="app">
    <!-- <form @submit.prevent="consultar_data"> -->
    <form id="form_1" method="post">
      <div class="panel panel-default">
        <div class="panel-heading">

          <div class="row mt-4">
            <div class="col-md-12">
              <h3 class="help-block text-muted medium-font text-danger">Bienvenido <?= $user ?></h3>

            </div>
          </div>
          <hr>
          <div class="row mt-1">
            <div class="col-md-3 col-sm-3 col-xs-3">
              <span class="help-block text-muted small-font">Seleccionar Materia Prima</span>

              <select name="materia" id="inputPassword4" v-model="materia" class="form-control">
                <option value="">Escoger Una Opcion</option>
                <?php
                $sql = $conexion->query("SELECT * FROM materia_prima");
                foreach ($sql as $data) :
                  echo '<option value="' . $data["id"] . '">' . $data["id"] . ' ' . $data["nombre"] . '</option>';

                endforeach;

                ?>
              </select>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-3">
              <span class="help-block text-muted small-font"> Seleccionar una presentacion</span>

              <div class="buscar_presentacion">
                <datalist id="presentacion">
                  <option value="">Busca y escoge un presentacion</option>
                  <?php
                  $query = $conexion->query("SELECT * FROM producto_av WHERE padre != 0 AND visibilidad = 1 ORDER BY contratipo ASC");
                  while ($valores = mysqli_fetch_array($query)) {
                    echo '<option value="' . $valores["id"] . '">' . $valores["id"] . ', ' . $valores["contratipo"] . '</option>';
                  }
                  ?>
                </datalist>
                <input class="form-control" v-model="presentacion" list="presentacion" name="presentacion" id="buscar_presentacion" type="text" placeholder="Buscar Presentacion">
              </div>
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
              <button type="button" class="btn btn-primary btn-block" id="send_info" :disabled="!(cantidad)">Cargar Presentacion</button>
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
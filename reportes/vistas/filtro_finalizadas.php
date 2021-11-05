<?php
include '../conexion.php';
$conexion = conectar();
$date = date("Y-m-d");
session_start();
$date = date("Y-m-d");
$user = $_SESSION["user"];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous"> -->
    <link href="../../Lib/bootstrap/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- CSS only -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.24/datatables.min.css" />
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.24/datatables.min.js"></script> -->
    <link rel="stylesheet" href="../frontend/css/estilos.css"> <!-- JavaScript Bundle with Popper -->
    <script src="../../Lib/bootstrap/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
  <title> Reporte JJ <?= $date?></title>
    <!-- <script>
        $(document).ready(function() {
            $('#tables').DataTable();
        });
    </script> -->


</head>

<body>
    <div class="container mt-4" id="app">
        <div class="container text-center">
            <h3>Bienvenido <?= $user ?> </h3>
            <img src="../img/JJ CIRCULO LOGO (fondo blanco).png" alt="Logo JJQUIMIENVASES">
            <center>
                <div class="report">
                    <span id="report"> REPORTES JJQUIMIENVASES SAS</span>
                </div>
            </center>
        </div>
        <br>
        <div class="text-center">
            <span class="btn btn-success"> <a href="cot_finalizadas.php" id="span_1">Regresar al reporte del <?= $date ?></a></span>
            <button class="btn btn-danger"> <a href="../../administrador/index.php" id="link">PANEL ADMINISTRADOR</a> </button>
            <button class="btn btn-warning"> <a href="../../administrador/call_r.php" id="link">Filtrar Ventas CC</a> </button>
        </div>
        <hr>

        <div class="text-left">
            <span class="text-danger" id="span_1">ESCOGE LA FECHA QUE DESEAS FILTRAR</span>
        </div>
        <br>
        <form @submit.prevent="consultar">

            <div class="container">
                <div class="row">
                    <div class="col-sm">
                        <label for="date_1">Fecha Inicial</label>
                        <input id="date_1" v-model="fecha_inicio" name="fecha_ini" type="date" class="form-control">
                    </div>
                    <div class="col-sm">
                        <label for="date_2">Fecha Final</label>
                        <input id="date_2" v-model="fecha_final" name="fecha_fin" type="date" class="form-control">
                    </div>
                    <div class="col-sm">
                        <br>
                        <button id="consultar" :disabled="!(fecha_inicio && fecha_final)" class="btn btn-success">Consultar</button>

                    </div>
                </div>
            </div>

        </form>
        <hr>
        <?php include '../includes/tabs.php'; ?>
        <div class="tab-content" id="myTabContent">
            <div :class="index === 0 ? 'tab-pane fade show active' : 'tab-pane fade show'" :id="item.punto" role="tabpanel" aria-labelledby="home-tab" v-for="item, index in info_total">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="home-tab" data-bs-toggle="tab" :data-bs-target="`#${item.punto}-efectivas`" type="button" role="tab" aria-controls="${item.punto}-efectivas" aria-selected="true">efectivas</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="profile-tab" data-bs-toggle="tab" :data-bs-target="`#${item.punto}-pendientes`" type="button" role="tab" aria-controls="${item.punto}-pendientes" aria-selected="false">pendiente</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="profile-tab" data-bs-toggle="tab" :data-bs-target="`#${item.punto}-descuento`" type="button" role="tab" aria-controls="${item.punto}-descuento" aria-selected="false">descuento</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="profile-tab" data-bs-toggle="tab" :data-bs-target="`#${item.punto}-anuladas`" type="button" role="tab" aria-controls="${item.punto}-anuladas" aria-selected="false">anulada</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="profile-tab" data-bs-toggle="tab" :data-bs-target="`#${item.punto}-metodos`" type="button" role="tab" aria-controls="${item.punto}-metodos" aria-selected="false">Metodos de pago</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="profile-tab" data-bs-toggle="tab" :data-bs-target="`#${item.punto}-novedades`" type="button" role="tab" aria-controls="${item.punto}-novedades" aria-selected="false">Gastos y Novedades</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="profile-tab" data-bs-toggle="tab" :data-bs-target="`#${item.punto}-finish`" type="button" role="tab" aria-controls="${item.punto}-finish" aria-selected="false">Cierre Caja</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="profile-tab" data-bs-toggle="tab" :data-bs-target="`#${item.punto}-abono`" type="button" role="tab" aria-controls="${item.punto}-abono" aria-selected="false">Abonos</button>
                    </li>

                </ul>
                <?php include '../includes/informacion_principal.php'; ?>
            </div>
            <?php include '../includes/informacion_call_m.php'; ?>
            <?php include '../includes/informacion_call_i.php'; ?>
            <?php include '../includes/informacion_call_i2.php'; ?>
            <?php include '../includes/formulario_comerciales.php'; ?>
            <?php include '../includes/informacion_abonos.php'; ?>
            <?php include '../includes/formulario_novedades.php'; ?>
            <?php include '../includes/formulario_multiples.php'; ?>

        </div>
    </div>

    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="../../jquery-3.5.1.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.24/datatables.min.js"></script>

    <!-- Vue Currency Filter Dependency -->
    <script src="https://unpkg.com/vue-currency-filter@3.2.3/dist/vue-currency-filter.iife.js"></script>
    <!-- Change 3.2.3 with latest version -->
    <script src="../js/consulta_filtro.js"></script>
    <script src="../scripts/script.js"></script>
    <script src="../scripts/funciones_globales.js"></script>

</body>

</html>
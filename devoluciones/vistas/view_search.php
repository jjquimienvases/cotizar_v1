<?php
include '../conexion.php';
$conexion = conectar();
$date = date("Y-m-d");
session_start();
$user = $_SESSION["user"];
$user_rol = $_SESSION["id_rol"];
if (!$user_rol) {
    header("location: https://cotizar.jjquimienvases.com/");

    return;
} else {
}

$date = date("Y-m-d");
$ref = "";
$ref_create = "";

if ($user_rol == 7) {
    $ref = "../../panel_ibague.php";
} else if ($user_rol == 2) {
    $ref = "../../panel_mostrador.php";
} else if ($user_rol == 3) {
    $ref = "../../panel_d1.php";
} else {
    $ref = "../../Panel_Comerciales.php";
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
    <title>Devoluciones</title>

</head>

<body>
    <div class="text-center">
        <img src="../../JJ CIRCULO LOGO (fondo blanco).png" alt="Logo JJQUIMIENVASES" width="280" height="200" class="mt-3">
        <hr>
        <h3>Bienvenido <?= $user;?> al panel de devolucion de mercancia.</h3>
        <button class="btn btn-danger"> <a href=<?= $ref; ?>>Regresar al panel principal</a> </button>
        <h6 class="text-danger"> Recuerda que para ejecutar la devolucion correctamente, debes buscar el numero de la cotizacion correspondiente y consultar.</h6>
    </div>
    <div class="container mt-4" id="app">
        <div class="container">

            <form @submit.prevent="consultar">

                <div class="container text-right">

                    <div class="row">
                        <div class="col-sm">
                            <label for="date_1" class="mb-2">Escribe el numero de la cotizacion</label>
                            <input id="date_1" v-model="cotizacion" name="cotizacion" type="number" class="form-control">
                            <br>
                            <div class="text-right">
                                <button id="consultar" :disabled="!(cotizacion)" class="btn btn-info">Consultar</button>
                            </div>
                        </div>
                    </div>
                </div>

            </form>
            <br>
            <div class="container text-right" v-for="data in info_cliente">

                <span class="text-danger">Creditos a favor del cliente seleccionado: <b class="text-primary">{{data.credito | currency}}</b> </span>
            </div>
            <hr>
            <?php include '../includes/information.php'; ?>
            <hr>
        </div>

    </div>
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
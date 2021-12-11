<?php
include '../conexion.php';
$conexion = conectar();
session_start();
$user = $_SESSION["user"];
$id_rol = $_SESSION["id_rol"];

if($id_rol != 8 || $id_rol != 1){

}else{
    header('Location: cotizar.jjquimienvases.com/');
}
$date = date("Y-m-d");

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous"> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- CSS only -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.24/datatables.min.css" />
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.24/datatables.min.js"></script>
    <link rel="stylesheet" href="../frontend/css/estilos.css">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
    <title> Inventario JJ <?= $date?></title>
</head>

<body>
    <!-- <div class="container">
        <button class="btn btn-warning" id="filter" onclick="show_new_methods()">Filtrar Reportes</button>
        <button class="btn btn-danger" id="filters" onclick="ocultar_new_methods()">Cerrar Filtro</button>
    </div> -->
    <hr>
    <div class="container mt-4" id="app">

        <div class="container text-center">
            <h3>Bienvenido <?= $user ?> </h3>
            <img src="../../JJ CIRCULO LOGO (fondo blanco).png" alt="Logo JJQUIMIENVASES" width="270" height="200">
            <center>
                <div class="report">
                    <span id="report"> INVENTARIOS JJQUIMIENVASES SAS</span>
                </div>
            </center>
        </div>
        <br>
        <div class="text-center">
            <button class="btn btn-danger"><a href="../../administrador/index.php" id="link">PANEL ADMINISTRADOR</a> </button>
        </div>
        <hr>

        <?php include '../includes/tabs.php'; ?>
        <div class="tab-content" id="myTabContent">
            <div :class="index === 0 ? 'tab-pane fade show active' : 'tab-pane fade show'" :id="item.punto" role="tabpanel" aria-labelledby="home-tab" v-for="item, index in info_total">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="home-tab" data-bs-toggle="tab" :data-bs-target="`#${item.punto}-todos`" type="button" role="tab" aria-controls="${item.punto}-todos" aria-selected="true">Todos</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="profile-tab" data-bs-toggle="tab" :data-bs-target="`#${item.punto}-positivo`" type="button" role="tab" aria-controls="${item.punto}-positivo" aria-selected="false">Positivo</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="profile-tab" data-bs-toggle="tab" :data-bs-target="`#${item.punto}-negativo`" type="button" role="tab" aria-controls="${item.punto}-negativo" aria-selected="false">Negativo</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="profile-tab" data-bs-toggle="tab" :data-bs-target="`#${item.punto}-items`" type="button" role="tab" aria-controls="${item.punto}-items" aria-selected="false">Items</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="profile-tab" data-bs-toggle="tab" :data-bs-target="`#${item.punto}-perfumeria`" type="button" role="tab" aria-controls="${item.punto}-perfumeria" aria-selected="false">Perfumeria</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="profile-tab" data-bs-toggle="tab" :data-bs-target="`#${item.punto}-perfumeria_ambiental`" type="button" role="tab" aria-controls="${item.punto}-perfumeria_ambiental" aria-selected="false">Perfumeria Ambiental</button>
                    </li>
                   
                </ul>
                <?php include '../includes/informacion_principal.php'; ?>
            </div>
            
          

        </div>
    </div>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/vue-paginate/3.2.1/vue-paginate.min.js"></script> -->
    <!-- Vue Currency Filter Dependency -->
    <script src="https://unpkg.com/vue-currency-filter@3.2.3/dist/vue-currency-filter.iife.js"></script>
    <!-- Change 3.2.3 with latest version -->
    <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="../../jquery-3.5.1.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.24/datatables.min.js"></script>

    <script type="module" src="../js/consulta.js"></script>
    <!-- <script src="../scripts/script.js"></script> -->
    <script src="../scripts/funciones_globales.js"></script>
</body>

</html>
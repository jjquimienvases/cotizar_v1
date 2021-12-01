<?php require_once '../conexion.php'; ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proveedores</title>
    <link rel="stylesheet" href="../Lib/bootstrap/css/bootstrap.css">
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
    <script src="../Lib/bootstrap/js/bootstrap.js"></script>
    <script src="../js/scripts.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <!--     <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> -->
    <?php include '../includes/header.php'; ?>
    
    <style>
        .modal-lg {
            max-width: 1800px;
        }

        .marc {
            width: 120px;
        }

        .tooltitle {
            width: 300%;
        }

        .aprobar:hover,
        .printer:hover {
            cursor: pointer;
        }
    </style>
</head>

<body>

    <?php include './navbar.php' ?>
    <div class="m-4">
        
        <body>
            <div class='cont'>
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#proveedores" type="button" role="tab" aria-controls="home" aria-selected="true">Proveedores</button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link" id="profile-tab" onclick="getOrderList()" data-bs-toggle="tab" data-bs-target="#ordenes" type="button" role="tab" aria-controls="profile" aria-selected="true">Ordenes de Compra</button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link" id="contact-tab" onclick="getFacturaList()" data-bs-toggle="tab" data-bs-target="#facturas" type="button" role="tab" aria-controls="profile" aria-selected="true">Facturas</button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#ingresos" type="button" role="tab" aria-controls="profile" aria-selected="true">Ingresos y Egresos</button>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="proveedores" role="tabpanel" aria-labelledby="home-tab">
                        <?php include  "./toolbar_prove.php"; ?>
                        <?php /* include  "./table.php"; */ ?>
                    </div>
                    <div class="tab-pane fade" id="ordenes" role="tabpanel" aria-labelledby="profile-tab">
                        <?php include  "./toolbar_oc.php"; ?>
                        <?php include "./modal_product.php"; ?>
                        <?php
                        /*  include "./table.php";  */
                        include './modal_update_merch.php';
                        include './modal_edit_item.php';
                        ?>
                        <div id="square_orders">
                            <?php
                            include './providers_in_orders.php';
                            include './orders_in_orders.php';
                            include './products_in_orders.php'; ?>
                        </div>
                        <?php
                        include './modal_enlazar_items.php';
                        include './modal_start_order_item.php';
                        include './modal_create_provider.php';
                        include '../includes/modal_create_order_provider.php';
                        ?>
                    </div>
                    <div class="tab-pane fade" id="facturas" role="tabpanel" aria-labelledby="contact-tab">
                        <?php include  "toolbar_fact.php"; ?>
                        <?php include  "table_facturas.php";
                        include  "modal_update_comprobante.php";
                        ?>
                    </div>
                    <div class="tab-pane fade" id="ingresos" role="tabpanel" aria-labelledby="contact-tab">
                        <?php include  "toolbar_income_egress.php"; ?>
                        <?php include "modal_income_egress.php"; ?>
                        <div class="mx-2">
                            <div class="row">
                                <div class="col text-center">
                                    <h4 class="text-success">Ingresos</h4>
                                    <?php include  "table_income.php"; ?>
                                </div>
                                <div class="col text-center">
                                    <h4 class="text-danger">Egresos</h4>
                                    <?php include  "table_egress.php"; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>

    
</html>
    <script src="../js/funciones.js"></script>
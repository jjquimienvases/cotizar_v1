<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

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
                <?php require_once('./toolbar_prove.php'); ?>
                <?php /* require_once  "./table.php"; */ ?>
            </div>
            <div class="tab-pane fade" id="ordenes" role="tabpanel" aria-labelledby="profile-tab">
                <?php require_once('./toolbar_oc.php'); ?>
                <?php require_once('./modal_product.php'); ?>
                <?php 
               /*  require_once "./table.php";  */
                      require_once('./modal_update_merch.php');
                      require_once('./modal_edit_item.php');
                      ?>
                      <div id="square_orders">
                          <?php
                      require_once('./providers_in_orders.php');
                      require_once('./orders_in_orders.php');
                      require_once('./products_in_orders.php');?>
                      </div>
                      <?php
                      require_once('./modal_enlazar_items.php');
                      require_once('./modal_start_order_item.php');
                      require_once('./modal_create_provider.php');
                      require_once('./modal_create_order_provider.php');
                      ?>
            </div>
            <div class="tab-pane fade" id="facturas" role="tabpanel" aria-labelledby="contact-tab">
                <?php require_once('./toolbar_fact.php'); ?>
                <?php  require_once('./table_facturas.php');
                 require_once('./modal_update_comprobante.php');
                ?>
            </div>
            <div class="tab-pane fade" id="ingresos" role="tabpanel" aria-labelledby="contact-tab">
                <?php require_once('./toolbar_income_egress.php'); ?>
                <?php require_once('./modal_income_egress.php'); ?>
                <div class="mx-2">
                    <div class="row">
                        <div class="col text-center">
                            <h4 class="text-success">Ingresos</h4>
                            <?php require_once('./table_income.php'); ?>
                        </div>
                        <div class="col text-center">
                        <h4 class="text-danger">Egresos</h4>
                            <?php require_once('./table_egress.php'); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</body>

</html>

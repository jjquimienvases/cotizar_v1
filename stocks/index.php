<?php
include 'conexion.php';
session_start();

$user = $_SESSION['user'];
$id_rol = $_SESSION['id_rol'];
$user_id = $_SESSION['userid'];

if ($id_rol == 4) {
    $ref = "../Panel_Comerciales.php";
} else if ($id_rol == 2) {
    $ref = "../panel_bodega.php";
} else if ($id_rol == 7) {
    $ref = "../panel_ibague.php";
} else if ($id_rol == 3) {
    $ref = "../panel_d1.php";
} else if ($id_rol == 6) {
    $ref = "../panel_bodega.php";
} else {
    $ref = "../Panel_Comerciales.php";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="../jquery-3.5.1.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/estilos.css">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <title>Inventarios</title>
</head>

<body>
    <div class="container mb-3">
        <hr>
        <div class="text-center mt-4">
            <h3>Bienvenido <?PHP echo $user; ?> En este apartado puedes consultar el stock</h3>
        </div>
        <hr>
        <div class="form-group">
            <div class="container">

                <button class="btn btn-success" id="mybtn"> <a href="<?= $ref ?>">Regresar a tu panel</a> </button>
                <button class="btn btn-warning" id="mybtn"> <a href="">Ir a Cotizar</a> </button>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Solicitar Mercancia</button>

            </div>
            <br>
            <!-- MODAL PARA SOLICITAR MERCANCIA  -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Solciitar Mercancia</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form methods="POST" id="form_1"> 

                                <div class="buscaritems">
                                    <label for="" class="text-success">Consultar Un Producto:</label>
                                    <datalist id="buscaritem">
                                        <option value="">Selecciona un producto</option>
                                        <?php
                                        // $query = $conexion->query("SELECT * FROM producto_av ORDER BY id ASC");
                                        if ($user_id == 27) {
                        $query = $conexion->query("SELECT * FROM productos_ibague2 ORDER BY id ASC");
                      } else if ($id_rol == 4) {
                        $query = $conexion->query("SELECT * FROM producto_av ORDER BY id ASC");
                      } else if ($id_rol == 2) {
                        $query = $conexion->query("SELECT * FROM producto ORDER BY id ASC");
                      } else if ($user_id == 26) {
                        $query = $conexion->query("SELECT * FROM productos_ibague ORDER BY id ASC");
                      } else {
                        $query = $conexion->query("SELECT * FROM producto_av ORDER BY id ASC");
                      }
                                        while ($valores = mysqli_fetch_array($query)) {
                                            echo '<option value="' . $valores["id"] . '">' . $valores["id"] . ',' . $valores["contratipo"] . '</option>';
                                        }
                                        ?>
                                    </datalist>
                                    <input list="buscaritem" type="text" name="cedulasres" id="buscaritems" class="form-control" placeholder="Buscar Item" aria-describedby="helpId">
                                    <small id="helpId" class="text-muted">Puedes buscar el item apartir de su codigo o nombre del mismo :D</small>

                                </div>

                                <div class="form-row">
                                    <div class="col mb-2">
                                        <input type="text" class="form-control" name="id" placeholder="ID">
                                    </div>
                                    <div class="col mb-2">
                                        <input type="text" class="form-control" name="item" placeholder="ITEM">
                                    </div>
                                    <div class="col mb-2">
                                        <input type="text" class="form-control" name="quantity" placeholder="Cantidad">
                                        <input type="hidden" class="form-control" name="categoria">
                                    </div>
                                    <div class="col mb-2">
                                        <label>Seleccionar Bodega De Despacho:</label>
                                        <select id="bodega_salida" name="bodega_salida" class="form-control">
                                            <option value="producto_av" selected>Bodega Principal</option>
                                            <option value="producto">Mostrador Principal</option>
                                            <option value="producto_d1">Mostrador D1</option>
                                            <option value="productos_ibague">Ibague 1</option>
                                            <option value="productos_ibague2">Ibague 2</option>
                                        </select>
                                    </div>
                                </div>

                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" id="send_info">Solicitar Traspaso</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Fin Modal-->

            <div class="buscarcliente">
                <label for="" class="text-success">Consultar Un Producto:</label>
                <datalist id="buscarclient">
                    <option value="">Selecciona un producto</option>
                    <?php
                                  if ($user_id == 27) {
                        $query = $conexion->query("SELECT * FROM productos_ibague2 ORDER BY id ASC");
                      } else if ($id_rol == 4) {
                        $query = $conexion->query("SELECT * FROM producto_av ORDER BY id ASC");
                      } else if ($id_rol == 2) {
                        $query = $conexion->query("SELECT * FROM producto ORDER BY id ASC");
                      } else if ($user_id == 26) {
                        $query = $conexion->query("SELECT * FROM productos_ibague ORDER BY id ASC");
                      } else {
                        $query = $conexion->query("SELECT * FROM producto_av ORDER BY id ASC");
                      }
                    while ($valores = mysqli_fetch_array($query)) {
                        echo '<option value="' . $valores["id"] . '">' . $valores["id"] . ',' . $valores["contratipo"] . '</option>';
                    }
                    ?>
                </datalist>
                <input list="buscarclient" type="text" name="cedulasres" id="buscarcliente" class="form-control" placeholder="Buscar Item" aria-describedby="helpId">
                <small id="helpId" class="text-muted">Puedes buscar el item apartir de su codigo o nombre del mismo :D</small>

            </div>
        </div>
        <div class="container">
            <div id="av">
                <hr>
                <div class="text-center">
                    <h3 class="btn btn-info">Bodega Principal</h3>
                </div>
                <div class="row">

                    <div class="col">
                        <label class="control-label"><b>CODIGO</b></label>
                        <input type="text" class="form-control" placeholder="SKU" name="sku_av" readonly>
                    </div>
                    <div class="col">
                        <label class="control-label"><b>PRODUCTO</b></label>
                        <input type="text" class="form-control" placeholder="ITEM NAME" name="item_av" readonly>
                    </div>
                    <div class="col">
                        <label class="control-label"><b>STOCKS</b></label>
                        <input type="text" class="form-control" placeholder="STOCKS" name="stock_av" readonly>
                    </div>
                </div>
            </div>
            <div id="mostrador">
                <hr>
                <div class="text-center">
                    <h3 class="btn btn-danger">Stock Mostrador Principal</h3>
                </div>
                <div class="row">

                    <div class="col">
                        <label class="control-label"><b>CODIGO</b></label>
                        <input type="text" class="form-control" placeholder="SKU" name="sku_mp" readonly>
                    </div>
                    <div class="col">
                        <label class="control-label"><b>PRODUCTO</b></label>
                        <input type="text" class="form-control" placeholder="ITEM NAME" name="item_mp" readonly>
                    </div>
                    <div class="col">
                        <label class="control-label"><b>STOCKS</b></label>
                        <input type="text" class="form-control" placeholder="STOCKS" name="stock_mp" readonly>
                    </div>
                </div>
            </div>
            <div id="d1">
                <hr>
                <div class="text-center">
                    <h3 class="btn btn-warning">Stock Mostrador D1</h3>
                </div>
                <div class="row">

                    <div class="col">
                        <label class="control-label"><b>CODIGO</b></label>
                        <input type="text" class="form-control" placeholder="SKU" name="sku_d1" readonly>
                    </div>
                    <div class="col">
                        <label class="control-label"><b>PRODUCTO</b></label>
                        <input type="text" class="form-control" placeholder="ITEM NAME" name="item_d1" readonly>
                    </div>
                    <div class="col">
                        <label class="control-label"><b>STOCKS</b></label>
                        <input type="text" class="form-control" placeholder="STOCKS" name="stock_d1" readonly>
                    </div>
                </div>
            </div>
            <div id="ib1">
                <hr>
                <div class="text-center">
                    <h3 class="btn btn-info">Stock Ibague 1</h3>
                </div>
                <div class="row">

                    <div class="col">
                        <label class="control-label"><b>CODIGO</b></label>
                        <input type="text" class="form-control" placeholder="SKU" name="sku_ib1" readonly>
                    </div>
                    <div class="col">
                        <label class="control-label"><b>PRODUCTO</b></label>
                        <input type="text" class="form-control" placeholder="ITEM NAME" name="item_ib1" readonly>
                    </div>
                    <div class="col">
                        <label class="control-label"><b>STOCKS</b></label>
                        <input type="text" class="form-control" placeholder="STOCKS" name="stock_ib1" readonly>
                    </div>
                </div>
            </div>
            <div id="ib2">
                <hr>
                <div class="text-center">
                    <h3 class="btn btn-success">Stock Mostrador Ibague 2</h3>
                </div>
                <div class="row">

                    <div class="col">
                        <label class="control-label"><b>CODIGO</b></label>
                        <input type="text" class="form-control" placeholder="SKU" name="sku_ib2" readonly>
                    </div>
                    <div class="col">
                        <label class="control-label"><b>PRODUCTO</b></label>
                        <input type="text" class="form-control" placeholder="ITEM NAME" name="item_ib2" readonly>
                    </div>
                    <div class="col">
                        <label class="control-label"><b>STOCKS</b></label>
                        <input type="text" class="form-control" placeholder="STOCKS" name="stock_ib2" readonly>
                    </div>
                </div>
            </div>


        </div>
    </div>
<hr>

<footer class = "text-center">Panel de inventarios consulta el productos que desees verificar</footer>
    <script src="funciones.js"></script>
</body>

</html>
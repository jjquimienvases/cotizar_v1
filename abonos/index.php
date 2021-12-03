<?php
include '../conectar.php';
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="../jquery-3.5.1.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/estilos.css">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <title>Document</title>
</head>

<body>
    <h3>ABONO JJ QUIMIENVASES</h3>
    <div class="container">
        <div class="card">
            <div class="text-center">
                <h5 class="card-header">Buscar y seleccionar la cotizacion que a la cual vas a hacer el abono</h5>
            </div>
            <div class="card-body">
                <h5 class="card-title text-center">BUSCAR POR COTIZACION O NOMBRE DEL CLIENTE</h5>
                <div class="buscarcliente">
                    <datalist id="buscarclient">
                        <option value="">Seleccione un cliente</option>
                        <?php
                        $query = $conexion->query("SELECT * FROM factura_orden ORDER BY order_date DESC");
                        while ($valores = mysqli_fetch_array($query)) {
                            echo '<option value="' . $valores["order_id"] . '">' . $valores["order_id"] . ',' . $valores["order_receiver_name"] . '</option>';
                        }
                        ?>
                    </datalist>
                    <input class="form-control" list="buscarclient" name="cedulasres" id="buscarcliente" type="text" placeholder="Buscar Cotizacion">
                </div>
                <hr>
                <div class="form-group">
                    <form method="post" enctype="multipart/form-data" id="form1">
                  
                        <h4 class="btn btn-primary text-center">INFORMACION DE VENTA </h4>
                            <input type="text" name="order" class="form-control mt-1 mb-1" readonly>  
                    <div class="row">
                        <div class="col">
                            <input type="text" class="form-control" name="cliente" placeholder="Cliente">
                        </div>
                        <div class="col">
                            <input type="text" class="form-control" name="comercial" placeholder="Comercial">
                        </div>
                        <div class="col">
                            <input type="text" class="form-control" name="fecha" placeholder="Fecha">
                        </div>
                        <div class="col">
                            <input type="text" class="form-control" name="monto" id="txt_campo_2" placeholder="Monto">
                        </div>
                    </div>
                    <br>
                    <h5 class="text-danger">Escribir El Monto Abonado por el cliente y adjuntar el comprobante de pago</h5>
                    <div class="row">
                        <div class="col">
                            <label>Escribir el monto cancelado por el cliente</label>
                            <input type="number" class="form-control" id="txt_campo_3" name="abono" onkeyup= placeholder="Escribir aqui el monto cancelado">
                        </div>
                        <div class="col">
                            <label>Adjuntar el comprobante de pago</label>
                            <select id="metodo_pago" name="metodo_pago" class="form-control">
                             <option value="bancolombia">Bancolombia</option>
                             <option value="davivienda">Davivienda</option>
                             <option value="datafono">Datafono</option>
                             <option value="efectivo">Efectivo</option>                             
                            </select>
                        </div>
                        <div class="col">
                            <label>Adjuntar el comprobante de pago</label>
                            <input type="file" class="form-control" name="imagen" placeholder="Adjuntar fotografia">
                        </div>

                    </div>
               <div class="text-left" id="resultado"></div>
                </div>
                <p class="card-text">Si completaste toda la informacion dar click en el siguiente boton.</p>
                <button type="button" class="btn btn-info" id="upload" onclick="onSubmitForm()">Subir Abono</button>
                </form>
            </div>
        </div>
    </div>

</body>

<script src="funciones.js"></script>

</html>
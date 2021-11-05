<?php
function formatear($num)
{
    setlocale(LC_MONETARY, 'en_US');
    return "$" . number_format($num, 2);
}

include_once 'conexion.php';
$order = $_GET['order'];
$sql_item = $con->query("SELECT * FROM `traspaso_producto_id` INNER JOIN traspaso_orden ON traspaso_producto_id.transfer_id = traspaso_orden.transfer_id WHERE traspaso_orden.transfer_id = $order");

foreach ($sql_item as $data) {
    $solicita = $data['solicitante'];
    $empaca = $data['empaca'];
    $recibe = $data['recibe'];
    $fecha = $data['order_date'];
    $estado = $data['estado'];
}

// metodo buscar

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Facturas Pendientes</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../catalogo_e/fontawesome/svg-with-js/js/fontawesome-all.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://fonts.googleapis.com/css2?family=Gentium+Basic&family=Julius+Sans+One&family=Open+Sans+Condensed:wght@300&display=swap" rel="stylesheet">
    <style>
        contenedor {
            width: 90%;
            height: 90%;
        }
    </style>
</head>

<body>

    <div class="container">

        <br>
            <center>
                <h3 class="border-bottom border-top"></h3>
            </center>
        <br>


        <div class="border border-dark rounded">
            <h4 class="border-bottom border-dark">> Información : </h4>
                
                <ul style="list-style-type: none;">
                    <li> <strong> Fecha : </strong>                     <?= $fecha ?>    </li>
                    <li> <strong> Solicitante : </strong>               <?= $solicita ?> </li>
                    <li> <strong> Traspaso: </strong>                   <?= $order ?>    </li>
                    <li> <strong> Estado: </strong>                     <?= $estado ?>   </li>
                </ul>
        
        </div>

        <table class="table  border table-bordered" id="tablas" style="margin-top: 15px;">
            <tr class="head-bordered">
                <td>Codigo</td>
                <td>Producto</td>
                <td>Cantidad</td>

            </tr>
                

                <form class="" id="form_1" method="post">
                <?php foreach ($sql_item as $fila) : ?>
                    <tr>
                        <td><input type="text" name="id[]" value="<?php echo $fila['item_code']; ?>" class="form-control" readonly></td>
                        <td><input type="text" name="item[]" value="<?php echo $fila['item_name']; ?>" class="form-control" readonly></td>
                        <td><input type="text" name="quantity[]" value="<?php echo $fila['item_quantity']; ?>" class="form-control"></td>
                        <input type="hidden" name="order" value="<?php echo $fila['transfer_id']; ?>">
                    </tr>
                <?php endforeach ?>

                
        </table>

        <button id="send_info" class="btn btn-success">Enviar Traspaso</button>
        </form>

    </div>
</body>

<script src="js/funciones.js"></script>

</html>
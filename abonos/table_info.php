<?php
include 'conexion.php';
session_start();
include 'scripts/consulta2.php';
include 'modal.php';

function formatear($num)
{
    setlocale(LC_MONETARY, 'en_US');
    return "$" . number_format($num, 2);
}



$id_rol = $_SESSION['id_rol'];
$ref = "";

if ($id_rol == 4) {
    $ref = "../Panel_Comerciales.php";
} else if ($id_rol == 2) {
    $ref = "../panel_mostrador.php";
} else if ($id_rol == 5) {
    $ref = "../asistente.php";
} else if ($id_rol == 7) {
    $ref = "../panel_ibague.php";
} else if ($id_rol == 3) {
    $ref = "../panel_d1.php";
} else if ($id_rol == 8) {
    $ref = "../administrador/index.php";
} else {
    $ref = "../administrador/index.php";
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="../jquery-3.5.1.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!--  Datatables JS-->
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.20/datatables.min.js"></script>   
    <!-- SUM()  Datatables-->
    <script src="https://cdn.datatables.net/plug-ins/1.10.20/api/sum().js"></script>
    <!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/estilos.css">
    <!--<link rel="stylesheet" href="//cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">-->
    <!--<script src="//cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>-->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <!-- <script src="js/elem.js"></script> -->
    <title>Cotizaciones a credito</title>

</head>

<body>
    <div class="contenedor mt-4">
        <div class="text-center">
            <button class="btn btn-success"><a href="<?php echo $href; ?>">Regresar Al Panel</a></button>
        </div>
        <div class="text-center">
            <table class="table table-sm" id="myTable">
                <thead class="thead-dark">
                    <tr>
                        <th>Fecha</th>
                        <th>Cotizacion</th>
                        <th>Cliente</th>
                        <th>Deuda</th>
                        <th>Abono</th>
                        <th>Restante</th>
                        <th>Estado</th>
                        <th>Ver Abono</th>
                        <th>PDF</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($sql as $data) :
                        $fecha = $data['order_date'];
                        $order_id = $data['order_id'];
                        $cliente = $data['order_receiver_name'];
                        $deuda = $data['deuda'];
                        $abono = $data['abono'];
                        $restante = $data['restante'];
                        $estado = $data['estado_abono'];


                    ?>
                        <tr>
                            <td class="table-dark"><?= $fecha; ?></td>
                            <td><?= $order_id; ?></td>
                            <td><?= $cliente; ?></td>
                            <td><?= formatear($deuda); ?></td>
                            <td><?= formatear($abono); ?></td>
                            <td><?= formatear($restante); ?></td>
                            <td><?= $estado; ?></td>

                            <td> <button class="btn btn-success" data-toggle="modal" onclick="abrir_data(<?php echo $order_id; ?>)" data-target="#exampleModal" id="info" value="<?php echo $order_id ?>">Ver Abono </button> </td>
                            <td> <button class="btn btn-danger"><a href="../print_invoice.php?invoice_id=<?php echo $order_id ?>" target='_blank'>PDF</a></button> </td>

                        </tr>
                    <?php endforeach; ?>

                </tbody>
                   <tfoot> 
                 <tr>
                     <td colspan="4"><h4>Deuda Total:</h4></td>
                     <td colspan="5"><input id="total_deuda" class="form-control"> </td>
                 </tr>
                 <tr>
                     <td colspan="4"><h4>Abono Total:</h4></td>
                     <td colspan="5"><input id="total_abono" class="form-control"> </td>
                 </tr>
               
                </tfoot>
            </table>
        </div>
    </div>
</body>

<script src="funciones.js"></script>

</html>
<?php
// include '../conexion.php';
// $conexion = conectar();

// $date = date('Y-m-d');
$date = "2021-03-09";

//aqui las consultas 
$puntos_de_venta = ["mostradorjj","mostradord1","mostrador_ibague_1","mostrador_ibague_2","bancolombia"];

foreach($puntos_de_venta as $punto):

$consulta_mostrador = $conexion->query("SELECT * FROM factura_orden WHERE order_date LIKE '%$date%' AND metodopago = '$punto' AND estado != 'solicitud anular' AND estado != 'anulado' AND estado != 'pendiente'");



?>

<div class="container">

<table class="table table-bordered">
    <thead>
    <tr><th colspan="6" class="text-center"> Cotizaciones Efectivas <?= $punto ?></th> </tr>
        <tr>
            <th>Fecha</th>
            <th>Remision</th>
            <th>Cliente</th>
            <th>Comercial</th>
            <th>Metodo de pago</th>
            <th>Monto</th>
        </tr>
    </thead>
    <tbody>
        <?php
        while($datos_mostrador = mysqli_fetch_array($consulta_mostrador)): 
            $fecha = $datos_mostrador["order_date"];
            $cotizacion = $datos_mostrador["order_id"];
            $cliente = $datos_mostrador["order_receiver_name"];
            $comercial = $datos_mostrador["order_receiver_address"];
            $metodo_de_pago = $datos_mostrador["metodo_de_pago"];
            $monto_x = 0;
          
            $total_tax = $datos_mostrador["order_total_after_tax"];
            $total_desc = $datos_mostrador["order_total_amount_due"];
            
            if($total_desc == "0" || $total_desc == ""){
                $monto_x = $total_tax;
            }else{
                $monto_x = $total_desc;
            }
        ?>
        <tr>
            <td><?= $fecha; ?></td>
            <td><?= $cotizacion; ?></td>
            <td><?= $cliente; ?></td>
            <td><?= $comercial; ?></td>
            <td><?= $metodo_de_pago; ?></td>
            <td><?= $monto_x; ?></td>
        </tr>
        <?php endwhile ?>
        
    </tbody>


</table>
</div>

<?php endforeach; ?>
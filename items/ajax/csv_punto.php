<?php

include '../conexion.php';

$date = "2021-11";

$sql = "SELECT * FROM order_abono WHERE DATE(order_date) LIKE '%$date%' AND order_receiver_name LIKE '%quimico%'";
$execute = $conexion->query($sql);

if ($execute) {
    foreach ($execute as $data) :

        $order_id = $data['order_id'];

        $sql_get_price = $conexion->query("SELECT * FROM factura_orden WHERE order_id = $order_id");

        if ($sql_get_price) {

            foreach ($sql_get_price as $data_p) {
                $price = $data_p['order_total_after_tax'];

                $update = $conexion->query("UPDATE order_abono SET deuda = $price, restante = $price WHERE order_id = $order_id");

                if ($update) {
                    echo "<pre>";
                    print_r("Esta cotizacion se actualizo correctamente: " . $order_id);
                    echo "</pre>";
                } else {
                    echo "<pre>";
                    print_r("Esta no se actualizo: " . $order_id);
                    echo "</pre>";
                }
            }
        } else {
            var_dump("No funcion la consulta para extraer el valor de la orden");
        }

    endforeach;
} else {
    var_dump("No funciona la consulta principal");
}

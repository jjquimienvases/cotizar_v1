<?php

class facturaModificadaControlador extends facturamodificadaModelo
{

    public function consultar_factura_Modificada_controller()
    {

        $hoy = $_POST['fecha_inicial'] . "&nbsp" . "07:10:55";
        $manana = $_POST['fecha_final'] . "&nbsp" . "07:15:55";

        $datos = [
            "total_venta" => facturamodificadaModelo::total_de_venta_fecha($hoy, $manana),
            "total_davivienda" => facturamodificadaModelo::total_de_venta_metodo_fecha("davivienda", $hoy, $manana),
            "total_efectivo" => facturamodificadaModelo::total_de_venta_metodo_fecha("efectivo", $hoy, $manana),
            "total_bancolombia" => facturamodificadaModelo::total_de_venta_metodo_fecha("bancolombia", $hoy, $manana),
            "total_contraentrega" => facturamodificadaModelo::total_de_venta_metodo_fecha("contraentrega", $hoy, $manana),
            "total_mercado" => facturamodificadaModelo::total_de_venta_metodo_fecha("mercado", $hoy, $manana),
            "total_credito" => facturamodificadaModelo::total_de_venta_metodo_fecha("credito", $hoy, $manana),
            "total_redes_sociales" => facturamodificadaModelo::total_de_venta_redes_fecha("redes sociales", $hoy, $manana),
            "total_contra" => facturamodificadaModelo::total_de_venta_contra_fecha("contra", $hoy, $manana),
            "monto_venta" => main::formatear(facturamodificadaModelo::monto_total_fecha($hoy, $manana)),
            "monto_davivienda" => main::formatear(facturamodificadaModelo::monto_total_metodo_fecha("davivienda", $hoy, $manana)),
            "monto_bancolombia" => main::formatear(facturamodificadaModelo::monto_total_metodo_fecha("bancolombia", $hoy, $manana)),
            "monto_mercado" => main::formatear(facturamodificadaModelo::monto_total_metodo_fecha("mercado", $hoy, $manana)),
            "monto_efectivo" => main::formatear(facturamodificadaModelo::monto_total_metodo_fecha("efectivo", $hoy, $manana)),
            "monto_credito" => main::formatear(facturamodificadaModelo::monto_total_metodo_fecha("credito", $hoy, $manana)),
            "monto_redes_sociales" => main::formatear(facturamodificadaModelo::monto_total_redes_fecha("redes sociales", $hoy, $manana)),
            "monto_contra" => main::formatear(facturamodificadaModelo::monto_total_contra_fecha("contra", $hoy, $manana)),
        ];

        echo json_encode($datos);
    }
    public function consultar_metodo_credito()
    {
        $de = $_POST['fecha_inicial'] . "&nbsp" . "07:10:55";
        $para = $_POST['fecha_final'] . "&nbsp" . "07:15:55";
        $today = date("Y-m-d");
        $if = $_POST['consulta'];
        if ($if == "si") {

            $consulta = "SELECT * FROM factura_modificada  WHERE metodopago='credito' AND order_date LIKE '%$today%' order by order_id desc";
        } else {
            $consulta = "SELECT * FROM factura_orden fo INNER JOIN factura_modificada fm ON fo.order_id = fm.order_id WHERE fm.metodopago='credito' AND DATE(fo.order_date) BETWEEN ' $de ' and ' $para ' AND (fm.estado LIKE '%pendiente%' OR fm.estado LIKE '%finalizado%' OR fm.estado LIKE '%alistamiento%')";
            // $consulta = "SELECT * FROM factura_modificada  WHERE metodopago='credito' and order_date BETWEEN '" . $de . "' and '" . $para . "' order by order_id desc";
        }
        $conexion = main::conectar();
        $datos = $conexion->query($consulta);
        $datos = $datos->fetchAll();
        $total = $conexion->query("SELECT  FOUND_ROWS()");
        $total = (int) $total->fetchColumn();
        echo "<table class='table'>
        <thead>
            <tr>
                <th scope='col'># Cotizacion</th>
                <th scope='col'>Orden</th>
                <th scope='col'>Total</th>
                <th scope='col'>Fecha</th>
                <th scope='col'>Imprimir</th>
            </tr>
        </thead>";
        if ($total >= 1) {
            $contador = 0;
            foreach ($datos as $registro) {
                echo "<tr>";
                echo "<td>" . $registro['order_id'] . "</td>";
                echo "<td>" . $registro['order_receiver_name'] . "</td>";
                echo "<td>" . main::formatear($registro['total']) . "</td>";
                echo "<td>" . $registro['order_date'] . "</td>";
                echo "<td><a class='btn btn-info' href='../print_invoice.php?invoice_id=" . $registro['order_id'] . "'>Imprimir</a></td>";
                echo "</tr>";
            }
        } else {
            echo '<tr><td colspan="0">No hay regristos en el sistema</td></tr>';
        }
        echo "</table>";
    }
}

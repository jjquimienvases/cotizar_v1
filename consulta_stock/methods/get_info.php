
<?php
include "../conexion.php";
header('Content-Type: application/json');
$response = new stdClass;
$fun = $_POST['key'];
switch ($fun) {
    case 'Q1':
        $puntos = ['producto_av', 'productos_ibague', 'productos_ibague2', 'producto_d1', 'producto'];
        $id = $_POST['item'];
        // foreach ($puntos as $punto) {


        $sql = "SELECT * FROM producto_av
                WHERE id=$id";
        $r = $con->query($sql);
        if ($o = $r->fetch_object()) {
            $resultado = $o;
        }
        $response->resultado = $resultado;
        echo json_encode($response);
        // }
        break;

    case 'Q2':
        $id = $_POST['item'];
        $inicial = $_POST['inicial'];
        $final = $_POST['final'];
        $sql = "SELECT * FROM factura_modificada fo INNER JOIN factura_orden_producto fp ON fo.order_id = fp.order_id 
        WHERE DATE(fo.order_date) BETWEEN '$inicial' AND '$final' AND fp.item_code = $id AND fo.estado != 'pendiente' AND fo.punto_pago = ''";
        // $sql = "SELECT * FROM producto_av
        //         WHERE id=$id";
        $r = $con->query($sql);
        $retornolosdatos = [];
        while ($o = $r->fetch_object()) {
            $retornolosdatos[] = $o;
        }
        $response->retornolosdatos = $retornolosdatos;
        echo json_encode($response);
        break;

    case 'Q3':
        $id = $_POST['item'];
        $inicial = $_POST['inicial'];
        $final = $_POST['final'];

        $sql = "SELECT fo.order_date,fo.cedula,fm.estado,fo.order_receiver_name, fp.item_code, fp.item_name, fo.order_receiver_address,fp.order_item_quantity FROM factura_orden fo 
         INNER JOIN factura_orden_producto fp ON fo.order_id = fp.order_id 
         INNER JOIN factura_modificada fm ON fo.order_id = fm.order_id
         WHERE DATE(fp.order_date) BETWEEN '$inicial' AND '$final' AND fp.item_code = $id ORDER BY fp.order_item_quantity DESC";

        $r = $con->query($sql);
        $retornolosdatos = [];
        while ($o = $r->fetch_object()) {
            $retornolosdatos[] = $o;
        }
        $response->retornolosdatos = $retornolosdatos;
        echo json_encode($response);
        break;


    case 'Q4':
        $id = $_POST['item'];
        $inicial = $_POST['inicial'];
        $final = $_POST['final'];
        $sql = "SELECT SUM(fp.order_item_quantity) AS Total_Ventas FROM factura_modificada fo INNER JOIN factura_orden_producto fp ON fo.order_id = fp.order_id 
            WHERE DATE(fo.order_date) BETWEEN '$inicial' AND '$final' AND fp.item_code = $id AND fo.estado != 'pendiente' AND fo.punto_pago = ''";
        $r = $con->query($sql);
        if ($o = $r->fetch_object()) {
            $resultado = $o;
        }
        $response->resultado = $resultado;
        echo json_encode($response);
        break;
    case 'Q5':
        $id = $_POST['item'];
        $inicial = $_POST['inicial'];
        $final = $_POST['final'];
        $sql = "SELECT SUM(cantidad) AS total_ingresos FROM ingresos 
            WHERE DATE(order_date) BETWEEN '$inicial' AND '$final' AND code = $id";
        $r = $con->query($sql);
        if ($o = $r->fetch_object()) {
            $resultado = $o;
        }
        $response->resultado = $resultado;
        echo json_encode($response);
        break;

    case 'Q6':
        $id = $_POST['item'];
        $inicial = $_POST['inicial'];
        $final = $_POST['final'];

        $sql = "SELECT fo.order_date,fo.cedula,fm.estado,fo.order_receiver_name, fp.item_code, fp.item_name, fo.order_receiver_address,fp.order_item_quantity FROM factura_orden fo 
             INNER JOIN factura_orden_producto fp ON fo.order_id = fp.order_id 
             INNER JOIN factura_modificada fm ON fo.order_id = fm.order_id
             WHERE DATE(fp.order_date) BETWEEN '$inicial' AND '$final' AND fp.item_code = $id AND fm.estado != 'pendiente'";

        $r = $con->query($sql);
        $retornolosdatos = [];
        while ($o = $r->fetch_object()) {
            $retornolosdatos[] = $o;
        }
        $response->retornolosdatos = $retornolosdatos;
        echo json_encode($response);
        break;

    case 'Q7': //imprimiendo el total de salidas traspasos panel anterior
        $id = $_POST['item'];
        $inicial = $_POST['inicial'];
        $final = $_POST['final'];
        //         $sql = "SELECT SUM(fp.order_item_quantity) AS Total_Ventas FROM factura_modificada fo INNER JOIN factura_orden_producto fp ON fo.order_id = fp.order_id 
        //     -- WHERE DATE(fo.order_date) BETWEEN '$inicial' AND '$final' AND fp.item_code = $id AND fo.estado != 'pendiente' AND fo.punto_pago = ''";

        $sql = "SELECT SUM(cantidad) as salidas_anterior FROM traspasos 
         WHERE DATE(order_date) BETWEEN '$inicial' AND '$final' AND bodega_salida = 'producto_av' AND codigo = $id AND estado LIKE '%finalizado%'";
        $r = $con->query($sql);
        if ($o = $r->fetch_object()) {
            $resultado = $o;
        }
        $response->resultado = $resultado;
        echo json_encode($response);
        break;
    case 'Q8': //imprimiendo el total de salidas traspasos panel actual
        $id = $_POST['item'];
        $inicial = $_POST['inicial'];
        $final = $_POST['final'];

        $sql = "SELECT SUM(item_quantity) as salidas_actual FROM traspaso_producto_id 
        WHERE DATE(order_date) BETWEEN '$inicial' AND '$final' AND bodega_salida = 'producto_av' AND item_code = $id AND item_status LIKE '%finalizado%'";



        $r = $con->query($sql);
        if ($o = $r->fetch_object()) {
            $resultado = $o;
        }
        $response->resultado = $resultado;
        echo json_encode($response);
        break;
    case 'Q9': //imprimiendo el total de entradas traspasos panel anterior
        $id = $_POST['item'];
        $inicial = $_POST['inicial'];
        $final = $_POST['final'];
        $sql = "SELECT SUM(cantidad) as entradas_Anterior FROM traspasos 
         WHERE DATE(order_date) BETWEEN '$inicial' AND '$final' AND bodega_entrada = 'producto_av' AND codigo = $id AND estado LIKE '%finalizado%'";
        $r = $con->query($sql);
        if ($o = $r->fetch_object()) {
            $resultado = $o;
        }
        $response->resultado = $resultado;
        echo json_encode($response);
        break;
    case 'Q10': //imprimiendo el total de entradas traspasos panel actual
        $id = $_POST['item'];
        $inicial = $_POST['inicial'];
        $final = $_POST['final'];
        $sql = "SELECT SUM(item_quantity) as entradas_Actual FROM traspaso_producto_id 
        WHERE DATE(order_date) BETWEEN '$inicial' AND '$final' AND bodega_entrada = 'producto_av' AND item_code = $id AND item_status LIKE '%finalizado%'";
        $r = $con->query($sql);
        if ($o = $r->fetch_object()) {
            $resultado = $o;
        }
        $response->resultado = $resultado;
        echo json_encode($response);
        break;
    case 'Q11': //imprimiendo el total de ventas mostrador
        $id = $_POST['item'];
        $inicial = $_POST['inicial'];
        $final = $_POST['final'];

        $sql = "SELECT SUM(fp.order_item_quantity) AS ventas_mostrador FROM factura_orden fo 
        INNER JOIN factura_orden_producto fp ON fo.order_id = fp.order_id 
        WHERE DATE(fo.order_date) BETWEEN '$inicial' AND '$final' AND fo.estado LIKE '%finalizado%' AND fp.item_code = $id AND fo.metodopago = 'mostradorjj'";

        $r = $con->query($sql);
        if ($o = $r->fetch_object()) {
            $resultado = $o;
        }
        $response->resultado = $resultado;
        echo json_encode($response);
        break;
    case 'Q12': //imprimiendo el total de ventas mostrador D1
        $id = $_POST['item'];
        $inicial = $_POST['inicial'];
        $final = $_POST['final'];

        $sql = "SELECT SUM(fp.order_item_quantity) AS ventas_mostrador_D1 FROM factura_orden fo 
        INNER JOIN factura_orden_producto fp ON fo.order_id = fp.order_id 
        WHERE DATE(fo.order_date) BETWEEN '$inicial' AND '$final' AND fo.estado LIKE '%finalizado%' AND fp.item_code = $id AND fo.metodopago = 'mostradord1'";

        $r = $con->query($sql);
        if ($o = $r->fetch_object()) {
            $resultado = $o;
        }
        $response->resultado = $resultado;
        echo json_encode($response);
        break;

    case 'Q13':
        $id = $_POST['item'];
        $inicial = $_POST['inicial'];
        $final = $_POST['final'];
        $sql = "SELECT * FROM ingresos WHERE DATE(order_date) BETWEEN '$inicial' AND '$final' AND code = $id";
        $r = $con->query($sql);
        $retornolosdatos = [];
        while ($o = $r->fetch_object()) {
            $retornolosdatos[] = $o;
        }
        $response->retornolosdatos = $retornolosdatos;
        echo json_encode($response);
        break;

    case 'Q14':
        $id = $_POST['item'];
        $inicial = $_POST['inicial'];
        $final = $_POST['final'];
        $sql = "SELECT * FROM traspasos WHERE DATE(order_date) BETWEEN '$inicial' AND '$final' AND bodega_salida = 'producto_av' AND codigo = $id AND estado LIKE '%finalizado%'";
        $r = $con->query($sql);
        $retornolosdatos = [];
        while ($o = $r->fetch_object()) {
            $retornolosdatos[] = $o;
        }
        $response->retornolosdatos = $retornolosdatos;
        echo json_encode($response);
        break;

    case 'Q15':
        $id = $_POST['item'];
        $inicial = $_POST['inicial'];
        $final = $_POST['final'];
        $sql = "SELECT * FROM traspaso_producto_id WHERE DATE(order_date) BETWEEN '$inicial' AND '$final' AND bodega_salida = 'producto_av' AND item_code = $id AND item_status LIKE '%finalizado%'";
        $r = $con->query($sql);
        $retornolosdatos = [];
        while ($o = $r->fetch_object()) {
            $retornolosdatos[] = $o;
        }
        $response->retornolosdatos = $retornolosdatos;
        echo json_encode($response);
        break;

    case 'Q16':
        $id = $_POST['item'];
        $inicial = $_POST['inicial'];
        $final = $_POST['final'];
        $sql = "SELECT * FROM traspasos WHERE DATE(order_date) BETWEEN '$inicial' AND '$final' AND bodega_entrada = 'producto_av' AND codigo = $id AND estado LIKE '%finalizado%'";
        $r = $con->query($sql);
        $retornolosdatos = [];
        while ($o = $r->fetch_object()) {
            $retornolosdatos[] = $o;
        }
        $response->retornolosdatos = $retornolosdatos;
        echo json_encode($response);
        break;

    case 'Q17':
        $id = $_POST['item'];
        $inicial = $_POST['inicial'];
        $final = $_POST['final'];
        $sql = "SELECT * FROM traspaso_producto_id WHERE DATE(order_date) BETWEEN '$inicial' AND '$final' AND bodega_entrada = 'producto_av' AND item_code = $id AND item_status LIKE '%finalizado%'";
        $r = $con->query($sql);
        $retornolosdatos = [];
        while ($o = $r->fetch_object()) {
            $retornolosdatos[] = $o;
        }
        $response->retornolosdatos = $retornolosdatos;
        echo json_encode($response);
        break;
}




?>


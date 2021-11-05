<?php

include '../conexion.php';

header('Content-Type: application/json');
$date = DATE("Y-m-d");
$response = new stdClass;
$fun = $_POST['key'];
switch ($fun) {
    case 'Q1':
        $date_inicial = $_POST['inicial'];
        $date_final = $_POST['final'];
        $sql = "SELECT * FROM factura_orden WHERE DATE(order_date) BETWEEN '$date_inicial' AND '$date_final' AND estado LIKE '%finalizado%' AND metodo_de_pago LIKE '%efectivo%' AND metodopago = 'mostrador_ibague_1'";
        $r = $con->query($sql);
        $retornolosdatos = [];
        while ($o = $r->fetch_object()) {
            $retornolosdatos[] = $o;
        }
        $response->retornolosdatos = $retornolosdatos;

        echo json_encode($response);
        break;
    case 'Q5':
        $date_inicial = $_POST['inicial'];
        $date_final = $_POST['final'];
        $sql = "SELECT * FROM factura_orden WHERE DATE(order_date) BETWEEN '$date_inicial' AND '$date_final' AND estado LIKE '%finalizado%' AND metodo_de_pago LIKE '%efectivo%' AND metodopago = 'mostrador_ibague_2'";
        $r = $con->query($sql);
        $retornolosdatos = [];
        while ($o = $r->fetch_object()) {
            $retornolosdatos[] = $o;
        }
        $response->retornolosdatos = $retornolosdatos;

        echo json_encode($response);
        break;


    case 'Q2':
        $date_inicial = $_POST['inicial'];
        $date_final = $_POST['final'];
        $sql = "SELECT * FROM novedades_gastos WHERE DATE(order_date) BETWEEN '$date_inicial' AND '$date_final' AND punto_venta LIKE '%mostrador_ibague%'";
        $r = $con->query($sql);
        $retornolosdatos = [];
        while ($o = $r->fetch_object()) {
            $retornolosdatos[] = $o;
        }
        $response->retornolosdatos = $retornolosdatos;

        echo json_encode($response);
        break;



    case 'Q3':
        $date_inicial = $_POST['inicial'];
        $date_final = $_POST['final'];
        $sql = "SELECT * FROM factura_modificada WHERE DATE(order_date) BETWEEN '$date_inicial' AND '$date_final' AND punto_pago LIKE '%ibague%'";
        $r = $con->query($sql);
        $retornolosdatos = [];
        while ($o = $r->fetch_object()) {
            $retornolosdatos[] = $o;
        }
        $response->retornolosdatos = $retornolosdatos;

        echo json_encode($response);
        break;
        
        
       case 'Q6':
        $date_inicial = $_POST['inicial'];
        $date_final = $_POST['final'];
        $sql = "SELECT * FROM finish_day WHERE DATE(order_date) BETWEEN '$date_inicial' AND '$date_final' AND punto_venta = 'mostrador_ibague_1'";
        $r = $con->query($sql);
        $retornolosdatos = [];
        while ($o = $r->fetch_object()) {
            $retornolosdatos[] = $o;
        }
        $response->retornolosdatos = $retornolosdatos;

        echo json_encode($response);
        break;    
        
        case 'Q7':
        $date_inicial = $_POST['inicial'];
        $date_final = $_POST['final'];
        $sql = "SELECT * FROM finish_day WHERE DATE(order_date) BETWEEN '$date_inicial' AND '$date_final' AND punto_venta = 'mostrador_ibague_2'";
        $r = $con->query($sql);
        $retornolosdatos = [];
        while ($o = $r->fetch_object()) {
            $retornolosdatos[] = $o;
        }
        $response->retornolosdatos = $retornolosdatos;

        echo json_encode($response);
        break;    
        
        
}

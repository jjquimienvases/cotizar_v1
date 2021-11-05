<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;


require_once "../Model/main.php";

require '../vendor/autoload.php';

$app = new \Slim\App;

/* ---------- Api para consultar factura_orden el dia de hoy  ----------*/
$app->get('/factura_orden/hoy/', function (Request $request, Response $response) {
    $fecha = date("Y-m-d");
    // $fecha = "2021-03-06";
    $sql = "SELECT * FROM factura_orden where estado!='pendiente' and estado!='solicitud anular' and estado!='anulado' and order_date like '%$fecha%'";
    try {
        $conexion = new main();
        $conexion = $conexion->conectar();
        $resultado = $conexion->query($sql);
        if ($resultado->rowCount() > 0) {
            $factura_orden = $resultado->fetchAll(PDO::FETCH_OBJ);
            echo json_encode($factura_orden);
        }
    } catch (PDOException $e) {
        echo '{"error" : {"text":' . $e->getMessage() . '}';
    }
});
/* ---------- Api para consultar factura_orden dependiendo la fecha ----------*/
$app->get('/factura_orden/hoy/{de}/{cuando}', function (Request $request, Response $response) {
    // $fecha = date("d-m-y H:i:s");
    $de = $request->getAttribute("de");
    $cuando = $request->getAttribute("cuando");
    $sql = "SELECT * FROM factura_orden where estado!='pendiente' and estado!='solicitud anular' and estado!='anulado' and order_date BETWEEN  '$de' and '$cuando'";
    try {
        $conexion = new main();
        $conexion = $conexion->conectar();
        $resultado = $conexion->query($sql);
        if ($resultado->rowCount() > 0) {
            $factura_orden = $resultado->fetchAll(PDO::FETCH_OBJ);
            echo json_encode($factura_orden);
        }
    } catch (PDOException $e) {
        echo '{"error" : {"text":' . $e->getMessage() . '}';
    }
});
/* ---------- Api para consultar factura_orden el dia de hoy con el punto con la fecha de hoy  ----------*/
$app->get('/factura_orden/hoy/{punto}', function (Request $request, Response $response) {
   $fecha = date("Y-m-d");
    $punto = $request->getAttribute("punto");
    // $fecha = "2021-03-06";
    $sql = "SELECT * FROM factura_orden where estado!='pendiente' and estado!='solicitud anular' and estado!='anulado' and order_date like '%$fecha%' and metodopago like '%$punto%'";
    try {
        $conexion = new main();
        $conexion = $conexion->conectar();
        $resultado = $conexion->query($sql);
        if ($resultado->rowCount() > 0) {
            $factura_orden = $resultado->fetchAll(PDO::FETCH_OBJ);
            echo json_encode($factura_orden);
        }
    } catch (PDOException $e) {
        echo '{"error" : {"text":' . $e->getMessage() . '}';
    }
});
/* ---------- Api para consultar factura_orden de los puntos con la fecha de hasta  ----------*/
$app->get('/factura_orden/hoy/{punto}/{de}/{cuando}', function (Request $request, Response $response) {
    // $fecha = date("Y-m-d");
    $punto = $request->getAttribute("punto");
    $de = $request->getAttribute("de");
    $cuando = $request->getAttribute("cuando");
    $sql = "SELECT * FROM factura_orden where estado!='pendiente' and estado!='solicitud anular' and estado!='anulado' and order_date BETWEEN  '$de' and '$cuando' and metodopago like '%$punto%' ";
    try {
        $conexion = new main();
        $conexion = $conexion->conectar();
        $resultado = $conexion->query($sql);
        if ($resultado->rowCount() > 0) {
            $factura_orden = $resultado->fetchAll(PDO::FETCH_OBJ);
            echo json_encode($factura_orden);
        }
    } catch (PDOException $e) {
        echo '{"error" : {"text":' . $e->getMessage() . '}';
    }
});
/* ---------- Api para consultar factura_orden el total de ventas del vendedor ----------*/
$app->get('/factura_orden/{vendedor}', function (Request $request, Response $response) {
    $vendedor = $request->getAttribute("vendedor");
    $sql = "SELECT sum(order_total_before_tax) as total_ventas FROM factura_orden where metodopago like '%$vendedor%' and estado !='pendiente' and estado!='solicitud anular' and estado!='anulado'";
    try {
        $conexion = new main();
        $conexion = $conexion->conectar();
        $resultado = $conexion->query($sql);
        if ($resultado->rowCount() > 0) {
            $factura_orden = $resultado->fetchAll(PDO::FETCH_OBJ);
            echo json_encode($factura_orden);
        }
    } catch (PDOException $e) {
        echo '{"error" : {"text":' . $e->getMessage() . '}';
    }
});
/* ---------- Api para consultar factura_orden el total de ventas del vendedor  con fecha de y fecha cuando----------*/
$app->get('/factura_orden/{vendedor}/{fecha-inicio}/{fecha-final}', function (Request $request, Response $response) {
    $vendedor = $request->getAttribute("vendedor");
    $fecha = $request->getAttribute("fecha-inicio");
    $fecha_final = $request->getAttribute("fecha-final");
    $sql = "SELECT sum(order_total_before_tax) as total_ventas FROM factura_orden where metodopago like '%$vendedor%' and estado !='pendiente' and estado!='solicitud anular' and estado!='anulado' and order_date BETWEEN  '$fecha' and '$fecha_final' ";

    try {
        $conexion = new main();
        $conexion = $conexion->conectar();
        $resultado = $conexion->query($sql);
        if ($resultado->rowCount() > 0) {
            $factura_orden = $resultado->fetchAll(PDO::FETCH_OBJ);
            echo json_encode($factura_orden);
        }
    } catch (PDOException $e) {
        echo '{"error" : {"text":' . $e->getMessage() . '}';
    }
});
/* ---------- Api para consultar factura_orden el total de ventas del vendedor si la fecha esta vacia muestra la fecha de hoy ----------*/
$app->get('/factura_orden/{vendedor}//', function (Request $request, Response $response) {
    $fecha = date("d-m-y H:i:s");
    // $fecha = "2021-03-06";
    $vendedor = $request->getAttribute("vendedor");
    $sql = "SELECT sum(order_total_before_tax) as total_ventas FROM factura_orden where metodopago like '%$vendedor%' and estado !='pendiente' and estado!='solicitud anular' and estado!='anulado' and order_date like'%$fecha%'";
    try {
        $conexion = new main();
        $conexion = $conexion->conectar();
        $resultado = $conexion->query($sql);
        if ($resultado->rowCount() > 0) {
            $factura_orden = $resultado->fetchAll(PDO::FETCH_OBJ);
            echo json_encode($factura_orden);
        }
    } catch (PDOException $e) {
        echo '{"error" : {"text":' . $e->getMessage() . '}';
    }
});
/* ---------- Api para consultar factura_orden el total de metodo de pago  ----------*/
$app->get('/factura_orden/metodo/{punto}/{metodo}/{de}/{para}', function (Request $request, Response $response) {
    // $fecha = date("d-m-y");
    $punto = $request->getAttribute("punto");
    $metodo = $request->getAttribute("metodo");
    $de = $request->getAttribute("de");
    $cuando = $request->getAttribute("para");
    $sql = "SELECT sum(order_total_before_tax) as total_$metodo FROM factura_orden where metodopago like '%$punto%' and metodo_de_pago like '%$metodo%' and estado !='pendiente' and estado!='solicitud anular' and estado!='anulado' and order_date  BETWEEN '$de' AND '$cuando'";
    try {
        $conexion = new main();
        $conexion = $conexion->conectar();
        $resultado = $conexion->query($sql);
        if ($resultado->rowCount() > 0) {
            $factura_orden = $resultado->fetchAll(PDO::FETCH_OBJ);
            echo json_encode($factura_orden);
        }
    } catch (PDOException $e) {
        echo '{"error" : {"text":' . $e->getMessage() . '}';
    }
});
$app->get('/factura_orden/metodo/{punto}/{metodo}/', function (Request $request, Response $response) {
   $fecha = date("Y-m-d");
    // $fecha = "2021-03-06";
    $metodo = $request->getAttribute("metodo");
    $punto = $request->getAttribute("punto");
    $sql = "SELECT sum(order_total_before_tax) as total_$metodo FROM factura_orden where metodopago like '%$punto%' and metodo_de_pago like '%$metodo%' and estado !='pendiente' and estado!='solicitud anular' and estado!='anulado' and order_date like '%$fecha%'";
    try {
        $conexion = new main();
        $conexion = $conexion->conectar();
        $resultado = $conexion->query($sql);
        if ($resultado->rowCount() > 0) {
            $factura_orden = $resultado->fetchAll(PDO::FETCH_OBJ);
            echo json_encode($factura_orden);
        }
    } catch (PDOException $e) {
        echo '{"error" : {"text":' . $e->getMessage() . '}';
    }
});
/* ---------- Api para consultar finish_day con fecha y punto  ----------*/
$app->get('/factura_orden/caja/{punto}/{de}/{cuando}', function (Request $request, Response $response) {
    $punto = $request->getAttribute("punto");
    $de = $request->getAttribute("de");
    $cuando = $request->getAttribute("cuando");
    $sql = "SELECT sum(monto) as total_$punto from finish_day WHERE order_date BETWEEN '$de' AND '$cuando' AND punto_venta LIKE '%mostradorjj%'";
    try {
        $conexion = new main();
        $conexion = $conexion->conectar();
        $resultado = $conexion->query($sql);
        if ($resultado->rowCount() > 0) {
            $factura_orden = $resultado->fetchAll(PDO::FETCH_OBJ);
            echo json_encode($factura_orden);
        }
    } catch (PDOException $e) {
        echo '{"error" : {"text":' . $e->getMessage() . '}';
    }
});
$app->get('/factura_orden/caja/{punto}//', function (Request $request, Response $response) {
  $fecha = date("Y-m-d");
    // $fecha = "2021-03-06";
    $punto = $request->getAttribute("punto");
    $sql = "SELECT sum(monto) as total_$punto from finish_day WHERE order_date like '%$fecha%' AND punto_venta LIKE '%$punto%'";
    try {
        $conexion = new main();
        $conexion = $conexion->conectar();
        $resultado = $conexion->query($sql);
        if ($resultado->rowCount() > 0) {
            $factura_orden = $resultado->fetchAll(PDO::FETCH_OBJ);
            echo json_encode($factura_orden);
        }
    } catch (PDOException $e) {
        echo '{"error" : {"text":' . $e->getMessage() . '}';
    }
});
/* ---------- Api para consultar finish day solo punto en el dia   ----------*/
$app->get('/factura_orden/call/{metodo}/{de}/{cuando}', function (Request $request, Response $response) {
$fecha = date("Y-m-d");
// $fecha = "2021-02-25";
    $metodo = $request->getAttribute("metodo");
    $de = $request->getAttribute("de");
    $cuando = $request->getAttribute("cuando");
    // $sql = "SELECT sum(factura_modificada.total) as total_$metodo from factura_modificada inner join factura_orden on factura_modificada.order_id=factura_orden.order_id where factura_orden.order_date between '$de' and '$cuando' and factura_modificada.metodopago like '%$metodo%'";
    $sql = "SELECT sum(total) as total_$metodo FROM factura_modificada WHERE order_date BETWEEN '$de' AND '$cuando'";
   
    try {
        $conexion = new main();
        $conexion = $conexion->conectar();
        $resultado = $conexion->query($sql);
        if ($resultado->rowCount() > 0) {
            $factura_orden = $resultado->fetchAll(PDO::FETCH_OBJ);
            echo json_encode($factura_orden);
        }
    } catch (PDOException $e) {
        echo '{"error" : {"text":' . $e->getMessage() . '}';
    }
});
/* ---------- Api para consultar finish day solo punto en el dia   ----------*/
$app->get('/factura_orden/call/{metodo}/', function (Request $request, Response $response) {
    $fecha = date("Y-m-d");
    // $fecha = "2021-03-06";
    $metodo = $request->getAttribute("metodo");

    // $sql = "SELECT sum(factura_modificada.total) as total_$metodo from factura_modificada inner join factura_orden on factura_modificada.order_id=factura_orden.order_id where factura_orden.order_date like '%$fecha%' and factura_modificada.metodopago like '%$metodo%'";
      $sql = "SELECT sum(total) as total_$metodo FROM factura_modificada WHERE order_date like '%$fecha%'";

    try {
        $conexion = new main();
        $conexion = $conexion->conectar();
        $resultado = $conexion->query($sql);
        if ($resultado->rowCount() > 0) {
            $factura_orden = $resultado->fetchAll(PDO::FETCH_OBJ);
            echo json_encode($factura_orden);
        }
    } catch (PDOException $e) {
        echo '{"error" : {"text":' . $e->getMessage() . '}';
    }
});
/* ---------- Api para consultar finish day solo punto en el dia   ----------*/
$app->get('/factura_orden/lugar_pago/call', function (Request $request, Response $response) {
    $fecha = date("Y-m-d");
    // $fecha = "2021-03-06";
    // $sql = "SELECT sum(factura_modificada.total) as lugar_total from factura_modificada inner join factura_orden on factura_modificada.order_id=factura_orden.order_id where factura_orden.order_date like '%$fecha%' and factura_modificada.punto_pago like '%mostradorjj%'";
    $sql = "SELECT sum(total) as total_$metodo FROM factura_modificada WHERE order_date like '%$fecha%' and punto_pago like '%mostradorjj%'";
    $sql2 = "SELECT * FROM factura_modificada WHERE order_date like '%$fecha%' and punto_pago like '%mostradorjj%'";
    // $sql2 = "SELECT * from factura_modificada inner join factura_orden on factura_modificada.order_id=factura_orden.order_id where factura_orden.order_date like '%$fecha%' and factura_modificada.punto_pago like '%mostradorjj%'";
    try {
        $conexion = new main();
        $conexion = $conexion->conectar();
        $resultado = $conexion->query($sql);
        $resultado2 = $conexion->query($sql2);

        if ($resultado->rowCount() > 0) {
            $factura_orden = $resultado->fetchAll(PDO::FETCH_OBJ);
            $factura_orden2 = $resultado2->fetchAll(PDO::FETCH_OBJ);
            $consulta =[
                "total" => $factura_orden[0],
                "informacion" => $factura_orden2

            ];
            echo json_encode($consulta);
         
        }
    } catch (PDOException $e) {
        echo '{"error" : {"text":' . $e->getMessage() . '}';
    }
});
/* ---------- Api para consultar finish day solo punto en el dia   ----------*/
$app->get('/factura_orden/lugar_pago/call/{de}/{cuando}', function (Request $request, Response $response) {
    $de = $request->getAttribute("de");
    $cuando = $request->getAttribute("cuando");
    $sql = "SELECT sum(factura_modificada.total) as lugar_total from factura_modificada inner join factura_orden on factura_modificada.order_id=factura_orden.order_id where factura_orden.order_date between '$de' and '$cuando' and factura_modificada.punto_pago like '%mostradorjj%'";
    $sql2 = "SELECT * from factura_modificada inner join factura_orden on factura_modificada.order_id=factura_orden.order_id where factura_orden.order_date between '$de' and '$cuando' and factura_modificada.punto_pago like '%mostradorjj%'";
    try {
        $conexion = new main();
        $conexion = $conexion->conectar();
        $resultado = $conexion->query($sql);
        $resultado2 = $conexion->query($sql2);

        if ($resultado->rowCount() > 0) {
            $factura_orden = $resultado->fetchAll(PDO::FETCH_OBJ);
            $factura_orden2 = $resultado2->fetchAll(PDO::FETCH_OBJ);
            $consulta = [
                "total" => $factura_orden[0],
                "informacion" => $factura_orden2

            ];
            echo json_encode($consulta);
        }
    } catch (PDOException $e) {
        echo '{"error" : {"text":' . $e->getMessage() . '}';
    }
});
/* ---------- Api para consultar finish day solo punto en el dia   ----------*/
$app->get('/factura_orden/factura/pendientes', function (Request $request, Response $response) {
    $fecha = date("Y-m-d");
    // $fecha = "2021-03-06";
    $sql = "SELECT * from factura_orden WHERE order_date like '%$fecha%' AND estado LIKE '%pendiente%'";
    try {
        $conexion = new main();
        $conexion = $conexion->conectar();
        $resultado = $conexion->query($sql);
        if ($resultado->rowCount() > 0) {
            $factura_orden = $resultado->fetchAll(PDO::FETCH_OBJ);
            echo json_encode($factura_orden);
        }
    } catch (PDOException $e) {
        echo '{"error" : {"text":' . $e->getMessage() . '}';
    }
});
/* ---------- Api para consultar finish day solo punto en el dia   ----------*/
$app->get('/factura_orden/factura/pendientes/{de}/{cuando}', function (Request $request, Response $response) {
    $de = $request->getAttribute("de");
    $cuando = $request->getAttribute("cuando");
    $sql = "SELECT * from factura_orden WHERE order_date between '$de' and '$cuando'  AND estado LIKE '%pendiente%'";
    try {
        $conexion = new main();
        $conexion = $conexion->conectar();
        $resultado = $conexion->query($sql);
        if ($resultado->rowCount() > 0) {
            $factura_orden = $resultado->fetchAll(PDO::FETCH_OBJ);
            echo json_encode($factura_orden);
        }
    } catch (PDOException $e) {
        echo '{"error" : {"text":' . $e->getMessage() . '}';
    }
});


$app->run();

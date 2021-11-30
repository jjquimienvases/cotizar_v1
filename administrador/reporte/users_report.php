<?php

function formatear($num)
{
  setlocale(LC_MONETARY, 'en_US');
  return "$" . number_format($num, 2);
}






// $tamara = 32;
// $nidia = 30;
// $andrea = 6;
// $maria = 8;
// $karen = 25;
// $leidy = 10;
// $sergio = 9;

$mostrador = "mostradorjj";
$mostrador_d1 = "mostradord1";
$ibague1 = "mostrador_ibague_1";
$ibague2 = "mostrador_ibague_2";
$monto_tamara = 0;
$valor_ventas_total = 0;
$anulado = "anulado";
$finalizado = "finalizado";
$total_tamara = 0;

$fecha_inicio = $_POST['inicio'] . "&nbsp;" . "08:01:00";
$fecha_final = $_POST['final'] . "&nbsp;" . "07:10:50";



$conexion = new mysqli('173.230.154.140', 'cotizar', 'LeinerM4ster', 'cotizar');
//consular los usuarios del sistema

$consulta_user = $conexion->query("SELECT * FROM factura_usuarios");
while ($usuarios = mysqli_fetch_array($consulta_user)) {
  $nombre[] = $usuarios["first_name"] . "&nbsp" . $usuarios["last_name"];
}

$maria_1 = "maria";
$tamara_1 = "Tamara";
$nidia_1 = "Nidia";
$sergio_1 = "Sergio";
$karen_1 = "Karen";
//--------- ibagueto 1 
$michel = "Michell";
$elizabet = "Elizabeth";
$linda = "Linda";
$diego = "Diego";

//-----------ibagueto 2
$leidy_j = "Leidy";
$angie = "angie";



//  $leiner = $nombre[0];
//  $tamara = $nombre[22];
//  $nidia = $nombre[20];
//  $maria = $nombre[6];
//  $karen = $nombre[13];
//  $leidy_call = $nombre[7];
//  $sergio = $nombre[8];


//  var_dump($tamara);
//  var_dump($nidia);
//  var_dump($maria);
//  var_dump($karen);
//  var_dump($sergio);

//estas son pruebas para dejar el nombre de tamara sin caracteres desconocidos 
$tamarita = "Tamara Â Franca";
$_tamaria_2 = mysqli_real_escape_string($conexion, $tamarita);
// $texto = "Hola!+Mi'Nombre €Es&Ju%an";
$_tamarita = preg_replace('([^A-Za-z0-9 ])', '', $tamarita);



//tamara - ventas y monto efectivo
$consulta_datos_tamara = $conexion->query("SELECT SUM(order_total_after_tax) as total_tamara FROM factura_orden WHERE order_date BETWEEN '$fecha_inicio' AND '$fecha_final' AND order_receiver_address LIKE '%$tamara_1%' AND metodopago ='$mostrador' AND estado LIKE '%$finalizado%'");
//  echo "<pre>";
//   print_r("SELECT SUM(order_total_after_tax) as total_tamara FROM factura_orden WHERE order_date BETWEEN '$fecha_inicio' AND '$fecha_final' AND order_receiver_address LIKE '%$tamara_1%' AND metodopago ='$mostrador' AND estado LIKE '%$finalizado%'");
//  echo "</pre>";
$datos_ventas_tamara = mysqli_fetch_assoc($consulta_datos_tamara);
$monto_tamara = $datos_ventas_tamara['total_tamara'];

$consulta_ventas_tamara = $conexion->query("SELECT count(user_id) as total_tamara_count FROM factura_orden WHERE order_date BETWEEN '$fecha_inicio' AND '$fecha_final' AND order_receiver_address LIKE '%$tamara_1%' AND metodopago ='$mostrador' AND estado LIKE '%$finalizado%'");

$data = mysqli_fetch_assoc($consulta_ventas_tamara);
$count_tamara = $data['total_tamara_count'];



//nidia - ventas y efectivo

$consulta_datos_nidia = $conexion->query("SELECT SUM(order_total_after_tax) as total_nidia FROM factura_orden WHERE order_date BETWEEN '$fecha_inicio' AND '$fecha_final' AND order_receiver_address LIKE '%$nidia_1%' AND metodopago ='$mostrador' AND estado LIKE '%$finalizado%'");


$datos_ventas_nidia = mysqli_fetch_assoc($consulta_datos_nidia);
$monto_nidia = $datos_ventas_nidia['total_nidia'];

$consulta_ventas_nidia = $conexion->query("SELECT count(user_id) as total_nidia_count FROM factura_orden WHERE order_date BETWEEN '$fecha_inicio' AND '$fecha_final' AND order_receiver_address LIKE '%$nidia_1%' AND metodopago ='$mostrador' AND estado LIKE '%$finalizado%'");

$data_nidia = mysqli_fetch_assoc($consulta_ventas_nidia);
$count_nidia = $data_nidia['total_nidia_count'];

//andrea - ventas y efectivo

$consulta_datos_sergio = $conexion->query("SELECT SUM(order_total_after_tax) as total_sergio FROM factura_orden WHERE order_date BETWEEN '$fecha_inicio' AND '$fecha_final' AND order_receiver_address LIKE '%$sergio_1%' AND metodopago ='$mostrador_d1' AND estado LIKE '%$finalizado%'");


$datos_ventas_sergio = mysqli_fetch_assoc($consulta_datos_sergio);
$monto_sergio = $datos_ventas_sergio['total_sergio'];

$consulta_ventas_sergio = $conexion->query("SELECT count(user_id) as total_sergio_count FROM factura_orden WHERE order_date BETWEEN '$fecha_inicio' AND '$fecha_final' AND order_receiver_address LIKE '%$sergio_1%' AND metodopago ='$mostrador_d1' AND estado LIKE '%$finalizado%'");

$data_sergio = mysqli_fetch_assoc($consulta_ventas_sergio);
$count_sergio = $data_sergio['total_sergio_count'];

//karen - ventas y efectivo

$consulta_datos_karen = $conexion->query("SELECT SUM(order_total_after_tax) as total_karen FROM factura_orden WHERE order_date BETWEEN '$fecha_inicio' AND '$fecha_final' AND order_receiver_address LIKE '%$karen_1%' AND metodopago ='$mostrador' AND estado LIKE '%$finalizado%'");


$datos_ventas_karen = mysqli_fetch_assoc($consulta_datos_karen);
$monto_karen = $datos_ventas_karen['total_karen'];

$consulta_ventas_karen = $conexion->query("SELECT count(user_id) as total_karen_count FROM factura_orden WHERE order_date BETWEEN '$fecha_inicio' AND '$fecha_final' AND order_receiver_address LIKE '%$karen_1%' AND metodopago ='$mostrador' AND estado LIKE '%$finalizado%'");

$data_karen = mysqli_fetch_assoc($consulta_ventas_karen);
$count_karen = $data_karen['total_karen_count'];

//maria - ventas y efectivo 

$consulta_datos_maria = $conexion->query("SELECT SUM(order_total_after_tax) as total_maria FROM factura_orden WHERE order_date BETWEEN '$fecha_inicio' AND '$fecha_final' AND order_receiver_address LIKE '%$maria_1%' AND metodopago ='$mostrador' AND estado LIKE '%$finalizado%'");


$datos_ventas_maria = mysqli_fetch_assoc($consulta_datos_maria);
$monto_maria = $datos_ventas_maria['total_maria'];

$consulta_ventas_maria = $conexion->query("SELECT count(user_id) as total_maria_count FROM factura_orden WHERE order_date BETWEEN '$fecha_inicio' AND '$fecha_final' AND order_receiver_address LIKE '%$maria_1%' AND metodopago ='$mostrador' AND estado LIKE '%$finalizado%'");

$data_maria = mysqli_fetch_assoc($consulta_ventas_maria);
$count_maria = $data_maria['total_maria_count'];

//leidy - ventas y efectivo

// $consulta_datos_leidy = $conexion ->query("SELECT SUM(total) as total_leidy FROM files INNER JOIN call_de_punto_venta ON files.order_id = call_punto_de_venta.order_id INNER JOIN factura_modificada ON files.order_id = factura_modificada.order_id WHERE order_date BETWEEN '$fecha_inicio' AND '$fecha_final'");
$consulta_datos_leidy = $conexion->query("SELECT SUM(total) as total_leidy FROM factura_modificada WHERE order_date BETWEEN '$fecha_inicio' AND '$fecha_final'");
$datos_ventas_leidy = mysqli_fetch_assoc($consulta_datos_leidy);
$monto_leidy = $datos_ventas_leidy['total_leidy'];




// $datos_ventas_leidy=mysqli_fetch_assoc($consulta_datos_leidy);
// $monto_leidy = $datos_ventas_leidy['total_leidy'];

$consulta_ventas_leidy = $conexion->query("SELECT count(order_id) as total_leidy_count FROM factura_modificada WHERE order_date BETWEEN '$fecha_inicio' AND '$fecha_final'");

$data_leidy = mysqli_fetch_assoc($consulta_ventas_leidy);
$count_leidy = $data_leidy['total_leidy_count'];

//informacion de leidy 
$consulta_datos_leidy_bc = $conexion->query("SELECT SUM(total) as total_leidy_bc FROM factura_modificada WHERE order_date BETWEEN '$fecha_inicio' AND '$fecha_final' AND metodopago LIKE '%bancolombia%'");


$datos_ventas_leidy_bc = mysqli_fetch_assoc($consulta_datos_leidy_bc);
$monto_leidy_bc = $datos_ventas_leidy_bc['total_leidy_bc'];

$consulta_ventas_leidy_bc = $conexion->query("SELECT count(order_id) as total_leidy_count_bc FROM factura_modificada WHERE order_date BETWEEN '$fecha_inicio' AND '$fecha_final' metodopago LIKE '%bancolombia%'");

$data_leidy_bc = mysqli_fetch_assoc($consulta_ventas_leidy_bc);
$count_leidy_bc = $data_leidy_bc['total_leidy_count_bc'];

//DAVIVIENDA  CALL
$consulta_datos_leidy_dv = $conexion->query("SELECT SUM(total) as total_leidy_dv FROM factura_modificada WHERE order_date BETWEEN '$fecha_inicio' AND '$fecha_final' AND metodopago LIKE '%davivienda%'");


$datos_ventas_leidy_dv = mysqli_fetch_assoc($consulta_datos_leidy_dv);
$monto_leidy_dv = $datos_ventas_leidy_dv['total_leidy_dv'];

$consulta_ventas_leidy_dv = $conexion->query("SELECT count(order_id) as total_leidy_count_dv FROM factura_modificada WHERE order_date BETWEEN '$fecha_inicio' AND '$fecha_final' metodopago LIKE '%davivienda%'");

$data_leidy_dv = mysqli_fetch_assoc($consulta_ventas_leidy_dv);
$count_leidy_dv = $data_leidy_dv['total_leidy_count_dv'];
//contra entrega call 
$consulta_datos_leidy_ce = $conexion->query("SELECT SUM(total) as total_leidy_ce FROM factura_modificada WHERE order_date BETWEEN '$fecha_inicio' AND '$fecha_final' AND metodopago LIKE '%contra%'");


$datos_ventas_leidy_ce = mysqli_fetch_assoc($consulta_datos_leidy_ce);
$monto_leidy_ce = $datos_ventas_leidy_ce['total_leidy_ce'];

$consulta_ventas_leidy_ce = $conexion->query("SELECT count(order_id) as total_leidy_count_ce FROM factura_modificada WHERE order_date BETWEEN '$fecha_inicio' AND '$fecha_final' metodopago LIKE '%contra%'");

$data_leidy_ce = mysqli_fetch_assoc($consulta_ventas_leidy_ce);
$count_leidy_ce = $data_leidy_ce['total_leidy_count_ce'];
//credito
$consulta_datos_leidy_cd = $conexion->query("SELECT SUM(total) as total_leidy_cd FROM factura_modificada WHERE order_date BETWEEN '$fecha_inicio' AND '$fecha_final' AND metodopago LIKE '%credito%'");


$datos_ventas_leidy_cd = mysqli_fetch_assoc($consulta_datos_leidy_cd);
$monto_leidy_cd = $datos_ventas_leidy_cd['total_leidy_cd'];

$consulta_ventas_leidy_cd = $conexion->query("SELECT count(order_id) as total_leidy_count_cd FROM factura_modificada WHERE order_date BETWEEN '$fecha_inicio' AND '$fecha_final' metodopago LIKE '%credito%'");

$data_leidy_cd = mysqli_fetch_assoc($consulta_ventas_leidy_cd);
$count_leidy_cd = $data_leidy_cd['total_leidy_count_cd'];

//efectivo
$consulta_datos_leidy_ef = $conexion->query("SELECT SUM(total) as total_leidy_ef FROM factura_modificada WHERE order_date BETWEEN '$fecha_inicio' AND '$fecha_final' AND metodopago LIKE '%efectivo%'");


$datos_ventas_leidy_ef = mysqli_fetch_assoc($consulta_datos_leidy_ef);
$monto_leidy_ef = $datos_ventas_leidy_ef['total_leidy_ef'];

$consulta_ventas_leidy_ef = $conexion->query("SELECT count(order_id) as total_leidy_count_ef FROM factura_modificada WHERE order_date BETWEEN '$fecha_inicio' AND '$fecha_final' metodopago LIKE '%efectivo%'");

$data_leidy_ef = mysqli_fetch_assoc($consulta_ventas_leidy_ef);
$count_leidy_ef = $data_leidy_ef['total_leidy_count_ef'];

//redes sociales
$consulta_datos_leidy_rd = $conexion->query("SELECT SUM(total) as total_leidy_rd FROM factura_modificada WHERE order_date BETWEEN '$fecha_inicio' AND '$fecha_final' AND canal LIKE '%redes%'");

$datos_ventas_leidy_rd = mysqli_fetch_assoc($consulta_datos_leidy_rd);
$monto_leidy_rd = $datos_ventas_leidy_rd['total_leidy_rd'];

$consulta_ventas_leidy_rd = $conexion->query("SELECT count(order_id) as total_leidy_count_rd FROM factura_modificada WHERE order_date BETWEEN '$fecha_inicio' AND '$fecha_final' canal LIKE '%redes%'");

$data_leidy_rd = mysqli_fetch_assoc($consulta_ventas_leidy_rd);
$count_leidy_rd = $data_leidy_rd['total_leidy_count_rd'];

//datafono 
$consulta_datos_leidy_data = $conexion->query("SELECT SUM(total) as total_leidy_data FROM factura_modificada WHERE order_date BETWEEN '$fecha_inicio' AND '$fecha_final' AND metodopago LIKE '%datafono%'");

$datos_ventas_leidy_data = mysqli_fetch_assoc($consulta_datos_leidy_data);
$monto_leidy_data = $datos_ventas_leidy_data['total_leidy_data'];

$consulta_ventas_leidy_data = $conexion->query("SELECT count(order_id) as total_leidy_count_data FROM factura_modificada WHERE order_date BETWEEN '$fecha_inicio' AND '$fecha_final' metodopago LIKE '%datafono%'");

$data_leidy_data = mysqli_fetch_assoc($consulta_ventas_leidy_data);
$count_leidy_data = $data_leidy_data['total_leidy_count_data'];
//mercado libre
$consulta_datos_leidy_ml = $conexion->query("SELECT SUM(total) as total_leidy_ml FROM factura_modificada WHERE order_date BETWEEN '$fecha_inicio' AND '$fecha_final' AND metodopago LIKE '%mercado%'");

$datos_ventas_leidy_ml = mysqli_fetch_assoc($consulta_datos_leidy_ml);
$monto_leidy_ml = $datos_ventas_leidy_ml['total_leidy_ml'];

$consulta_ventas_leidy_ml = $conexion->query("SELECT count(order_id) as total_leidy_count_ml FROM factura_modificada WHERE order_date BETWEEN '$fecha_inicio' AND '$fecha_final' metodopago LIKE '%mercado%'");

$data_leidy_ml = mysqli_fetch_assoc($consulta_ventas_leidy_ml);
$count_leidy_ml = $data_leidy_ml['total_leidy_count_ml'];

// ibague 1 - michel 

$consulta_datos_michel = $conexion->query("SELECT SUM(order_total_after_tax) as total_michel FROM factura_orden WHERE order_date BETWEEN '$fecha_inicio' AND '$fecha_final' AND order_receiver_address LIKE '%$michel%' AND metodopago ='$ibague1' AND estado LIKE '%$finalizado%'");


$datos_ventas_michel = mysqli_fetch_assoc($consulta_datos_michel);
$monto_michel = $datos_ventas_michel['total_michel'];

$consulta_ventas_michel = $conexion->query("SELECT count(user_id) as total_michel_count FROM factura_orden WHERE order_date BETWEEN '$fecha_inicio' AND '$fecha_final' AND order_receiver_address LIKE '%$michel%' AND metodopago ='$ibague1' AND estado LIKE '%$finalizado%'");

$data_michel = mysqli_fetch_assoc($consulta_ventas_michel);
$count_michel = $data_michel['total_michel_count'];

//ibague 1 -- elizabeth 
$consulta_datos_eli = $conexion->query("SELECT SUM(order_total_after_tax) as total_eli FROM factura_orden WHERE order_date BETWEEN '$fecha_inicio' AND '$fecha_final' AND order_receiver_address LIKE '%$elizabet%' AND metodopago ='$ibague1' AND estado LIKE '%$finalizado%'");


$datos_ventas_elizabeth = mysqli_fetch_assoc($consulta_datos_eli);
$monto_elizabeth = $datos_ventas_elizabeth['total_eli'];

$consulta_ventas_elizabeth = $conexion->query("SELECT count(user_id) as total_eli_count FROM factura_orden WHERE order_date BETWEEN '$fecha_inicio' AND '$fecha_final' AND order_receiver_address LIKE '%$elizabet%' AND metodopago ='$ibague1' AND estado LIKE '%$finalizado%'");

$data_elizabeth = mysqli_fetch_assoc($consulta_ventas_elizabeth);
$count_elizabeth = $data_elizabeth['total_eli_count'];

//ibague 1 -- diego 

$consulta_datos_diego = $conexion->query("SELECT SUM(order_total_after_tax) as total_diego FROM factura_orden WHERE order_date BETWEEN '$fecha_inicio' AND '$fecha_final' AND order_receiver_address LIKE '%$diego%' AND metodopago ='$ibague1' AND estado LIKE '%$finalizado%'");


$datos_ventas_diego = mysqli_fetch_assoc($consulta_datos_diego);
$monto_diego = $datos_ventas_diego['total_diego'];

$consulta_ventas_diego = $conexion->query("SELECT count(user_id) as total_diego_count FROM factura_orden WHERE order_date BETWEEN '$fecha_inicio' AND '$fecha_final' AND order_receiver_address LIKE '%$diego%' AND metodopago ='$ibague1' AND estado LIKE '%$finalizado%'");

$data_diego = mysqli_fetch_assoc($consulta_ventas_diego);
$count_diego = $data_diego['total_diego_count'];


//ibague 1 -- linda
$consulta_datos_linda = $conexion->query("SELECT SUM(order_total_after_tax) as total_linda FROM factura_orden WHERE order_date BETWEEN '$fecha_inicio' AND '$fecha_final' AND order_receiver_address LIKE '%$linda%' AND metodopago ='$ibague1' AND estado LIKE '%$finalizado%'");


$datos_ventas_linda = mysqli_fetch_assoc($consulta_datos_linda);
$monto_linda = $datos_ventas_linda['total_linda'];

$consulta_ventas_linda = $conexion->query("SELECT count(user_id) as total_linda_count FROM factura_orden WHERE order_date BETWEEN '$fecha_inicio' AND '$fecha_final' AND order_receiver_address LIKE '%$linda%' AND metodopago ='$ibague1' AND estado LIKE '%$finalizado%'");

$data_linda = mysqli_fetch_assoc($consulta_ventas_linda);
$count_linda = $data_linda['total_linda_count'];


//ibague 2 -- leidy jimenez 
$consulta_datos_leidyj = $conexion->query("SELECT SUM(order_total_after_tax) as total_leidyj FROM factura_orden WHERE order_date BETWEEN '$fecha_inicio' AND '$fecha_final' AND order_receiver_address LIKE '%$leidy_j%' AND metodopago ='$ibague2' AND estado LIKE '%$finalizado%'");


$datos_ventas_leidyj = mysqli_fetch_assoc($consulta_datos_leidyj);
$monto_leidyj = $datos_ventas_leidyj['total_leidyj'];

$consulta_ventas_leidyj = $conexion->query("SELECT count(user_id) as total_leidyj_count FROM factura_orden WHERE order_date BETWEEN '$fecha_inicio' AND '$fecha_final' AND order_receiver_address LIKE '%$leidy_j%' AND metodopago ='$ibague2' AND estado LIKE '%$finalizado%'");

$data_leidyj = mysqli_fetch_assoc($consulta_ventas_leidyj);
$count_leidyj = $data_leidyj['total_leidyj_count'];



//ibague 2 -- angie
$consulta_datos_angie = $conexion->query("SELECT SUM(order_total_after_tax) as total_angie FROM factura_orden WHERE order_date BETWEEN '$fecha_inicio' AND '$fecha_final' AND order_receiver_address LIKE '%$angie%' AND metodopago ='$ibague2' AND estado LIKE '%$finalizado%'");


$datos_ventas_angie = mysqli_fetch_assoc($consulta_datos_angie);
$monto_angie = $datos_ventas_angie['total_angie'];

$consulta_ventas_angie = $conexion->query("SELECT count(user_id) as total_angie_count FROM factura_orden WHERE order_date BETWEEN '$fecha_inicio' AND '$fecha_final' AND order_receiver_address LIKE '%$angie%' AND metodopago ='$ibague2' AND estado LIKE '%$finalizado%'");

$data_angie = mysqli_fetch_assoc($consulta_ventas_angie);
$count_angie = $data_angie['total_angie_count'];


?>


<!DOCTYPE html>

<html lang="en" dir="ltr">

<head>
  <meta charset="euc-jp">

  <title>Reporte por vendedores</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>

  <style>
    .container {
      width=90%;
    }
  </style>
</head>

<body>

  <div class="container">
    <hr>
    <h3>Reporte de ventas por empleados</h3>
    <br>
    <center>
      <h1>Reporte de ventas por empleados</h1>
    </center>
    <form action="" method="post" enctype="multipart/form-data">

      <label>Fecha inicial:</label>
      <input type="date" id="start" name="inicio" value="" min="2019-01-01" max="2023-12-31">
      <hr>
      <label>Fecha Final:</label>
      <input type="date" id="finished" name="final" value="" min="2019-01-01" max="2023-12-31">

      <button type="submit"> Consultar</button>
    </form>

    <hr>



    <table class="table table-bordered table-hover">
      <center>
        <tr colspan="2">
          <th bgcolor="#F4960E">
            <center>Tamara Franca</center>
          </th>
          <th bgcolor="#F4960E">
            <center>Promedio</center>
          </th>
        </tr>
        <tr>
          <td> <?php echo "Monto Efectivo: " . formatear($monto_tamara) ?>
            <br>
            <?php echo "Cantidad Ventas: " . $count_tamara ?>

          </td>
          <td><?php $promedio_tamara = $monto_tamara / $count_tamara ?>
            El promedio de venta por cliente fue de <?php echo formatear($promedio_tamara); ?>
          </td>
        </tr>
        <tr colspan="2">
          <th bgcolor="#F4500E">
            <center>Nidia Cantillo</center>
          </th>
          <th bgcolor="#F4500E">
            <center>Promedio</center>
          </th>
        </tr>
        <tr>
          <td> <?php echo "Monto Efectivo: " . formatear($monto_nidia) ?>
            <br>
            <?php echo "Cantidad Ventas: " . $count_nidia ?>
          </td>
          <td><?php $promedio_nidia = $monto_nidia / $count_nidia ?>
            El promedio de venta por cliente fue de <?php echo formatear($promedio_nidia); ?>
          </td>
        </tr>
        <tr colspan="2">
          <th bgcolor="#FD2507">
            <center>Sergio Martinez</center>
          </th>
          <th bgcolor="#FD2507">
            <center>Promedio</center>
          </th>
        </tr>
        <tr>
          <td> <?php echo "Monto Efectivo: " . formatear($monto_sergio) ?>
            <br>
            <?php echo "Cantidad Ventas: " . $count_sergio ?>
          </td>
          <td><?php $promedio_sergio = $monto_sergio / $count_sergio ?>
            El promedio de venta por cliente fue de <?php echo formatear($promedio_sergio); ?>
          </td>
        </tr>
        <tr colspan="2">
          <th bgcolor="#00ABD1">
            <center>Karen Rivera</center>
          </th>
          <th bgcolor="#00ABD1">
            <center>Promedio</center>
          </th>

        </tr>
        <tr>
          <td> <?php echo "Monto Efectivo: " . formatear($monto_karen) ?>
            <br>
            <?php echo "Cantidad Ventas: " . $count_karen ?>
          </td>
          <td><?php $promedio_karen = $monto_karen / $count_karen ?>
            El promedio de venta por cliente fue de <?php echo formatear($promedio_karen); ?>
          </td>
        </tr>
        <tr colspan="2">
          <th bgcolor="#5CCFE8">
            <center>Maria Omaña</center>
          </th>
          <th bgcolor="#5CCFE8">
            <center>Promedio</center>
          </th>

        </tr>
        <tr>
          <td> <?php echo "Monto Efectivo: " . formatear($monto_maria) ?>
            <br>
            <?php echo "Cantidad Ventas: " . $count_maria ?>
          </td>
          <td><?php $promedio_maria = $monto_maria / $count_maria ?>
            El promedio de venta por cliente fue de <?php echo formatear($promedio_maria); ?>
          </td>
        </tr>
        <!-- Segunda parte -->
        <tr colspan="2">
          <th bgcolor="#00D1FF">
            <center>Leidy Velasco</center>
          </th>
          <th bgcolor="#00D1FF">
            <center>Promedio</center>
          </th>
        </tr>

        <tr colspan="9">
          <td> <?php echo "Monto Efectivo: " . formatear($monto_leidy) ?>
            <br>
            <?php echo "Cantidad Ventas: " . $count_leidy ?>
          </td>
          <td><?php $promedio_leidy = $monto_leidy / $count_leidy ?>
            El promedio de venta por cliente fue de <?php echo formatear($promedio_leidy); ?>
          </td>
          <hr>
          <td>Monto total Ventas Bancolombia <?php echo formatear($monto_leidy_bc); ?> </td><br>
          <td>Monto total Ventas Davivienda <?php echo formatear($monto_leidy_dv); ?> </td><br>
          <td>Monto total Ventas Mercado Libre <?php echo formatear($monto_leidy_ml); ?> </td><br>
          <td>Monto total Ventas Efectivo <?php echo formatear($monto_leidy_ef); ?> </td><br>
          <td>Monto total Ventas Datafono <?php echo formatear($monto_leidy_data); ?> </td><br>
          <td>Monto total Ventas redes sociales <?php echo formatear($monto_leidy_rd); ?> </td><br>
          <td>Monto total Ventas Contra Entrega <?php echo formatear($monto_leidy_ce); ?> </td><br>
          <td>Monto total Ventas Credito <?php echo formatear($monto_leidy_cd); ?> </td>
        </tr>


        <!-- Tercera parte Ibague 1 -->

        <tr>
          <th>IBAGUE 1</th>
        </tr>
        <tr colspan="2">
          <th>Elizabeth Parra:</th>
          <th>Promedio</th>
        </tr>
        <tr>
          <td> <?php echo "Monto Efectivo: " . formatear($monto_elizabeth) ?>
            <br>
            <?php echo "Cantidad Ventas: " . $count_elizabeth ?>
          </td>
          <td><?php $promedio_elizabeth = $monto_elizabeth / $count_elizabeth ?>
            El promedio de venta por cliente fue de <?php echo formatear($promedio_elizabeth); ?>
          </td>
        </tr>

        <tr colspan="2">
          <th>Diego:</th>
          <th>Promedio</th>
        </tr>
        <tr>
          <td> <?php echo "Monto Efectivo: " . formatear($monto_diego) ?>
            <br>
            <?php echo "Cantidad Ventas: " . $count_diego ?>
          </td>
          <td><?php $promedio_diego = $monto_diego / $count_diego ?>
            El promedio de venta por cliente fue de <?php echo formatear($promedio_diego); ?>
          </td>
        </tr>

        <tr colspan="2">
          <th>Michell Parra:</th>
          <th>Promedio</th>
        </tr>
        <tr>
          <td> <?php echo "Monto Efectivo: " . formatear($monto_michel) ?>
            <br>
            <?php echo "Cantidad Ventas: " . $count_michel ?>
          </td>
          <td><?php $promedio_michel = $monto_michel / $count_michel ?>
            El promedio de venta por cliente fue de <?php echo formatear($promedio_michel); ?>
          </td>
        </tr>

        <tr colspan="2">
          <th>Linda Garcia:</th>
          <th>Promedio</th>
        </tr>
        <tr>
          <td> <?php echo "Monto Efectivo: " . formatear($monto_linda) ?>
            <br>
            <?php echo "Cantidad Ventas: " . $count_linda ?>
          </td>
          <td><?php $promedio_linda = $monto_linda / $count_linda ?>
            El promedio de venta por cliente fue de <?php echo formatear($promedio_linda); ?>
          </td>
        </tr>

        <!-- PARTE 4 IBAGUE 2-->
        <tr>
          <th>IBAGUE 2</th>
        </tr>
        <tr colspan="2">
          <th>Leidy Jimenez:</th>
          <th>Promedio</th>
        </tr>
        <tr>
          <td> <?php echo "Monto Efectivo: " . formatear($monto_leidyj) ?>
            <br>
            <?php echo "Cantidad Ventas: " . $count_leidyj ?>
          </td>
          <td><?php $promedio_leidyj = $monto_leidyj / $count_leidyj ?>
            El promedio de venta por cliente fue de <?php echo formatear($promedio_leidyj); ?>
          </td>

        </tr>

        <th colspan="2">Angie Barreto:</th>
        <th>Promedio</th>
        </tr>
        <tr>
          <td> <?php echo "Monto Efectivo: " . formatear($monto_angie) ?>
            <br>
            <?php echo "Cantidad Ventas: " . $count_angie ?>
          </td>
          <td><?php $promedio_angie = $monto_angie / $count_angie ?>
            El promedio de venta por cliente fue de <?php echo formatear($promedio_angie); ?>
          </td>
        </tr>

      </center>
      <?php
      $total_ventas = $count_tamara + $count_nidia  + $count_karen + $count_maria;
      $total_montos = $monto_tamara + $monto_nidia  + $monto_karen + $monto_maria;

      $total_ventas_ib1 = $count_michel + $count_linda + $count_diego + $count_elizabeth;
      $total_montos_ib1 = $monto_michel + $monto_linda + $monto_diego + $monto_elizabeth;

      $total_ventas_ib2 = $count_leidyj + $count_angie;
      $total_montos_ib2 = $monto_leidyj + $monto_angie;

      ?>
      <br>
      <tfoot>
        <tr>
          <th colspan="2" bgcolor="#FF0023">Total Ventas Mostrador</th>
        </tr>

        <tr>
          <td><?php echo "Total Ventas: " . $total_ventas ?> </td>
          <td><?php echo "Total Efectivo: " . formatear($total_montos) ?> </td>

        </tr>

        <tr>
          <th colspan="2" bgcolor="#33BEFF">Total Ventas ibague 1</th>
        </tr>

        <tr>
          <td><?php echo "Total Ventas: " . $total_ventas_ib1 ?> </td>
          <td><?php echo "Total Efectivo: " . formatear($total_montos_ib1) ?> </td>

        </tr>

        <tr>
          <th colspan="2" bgcolor="#FF5733">Total Ventas ibague 2</th>
        </tr>

        <tr>
          <td><?php echo "Total Ventas: " . $total_ventas_ib2 ?> </td>
          <td><?php echo "Total Efectivo: " . formatear($total_montos_ib2) ?> </td>

        </tr>

      </tfoot>

    </table>



  </div>




</body>

</html>
<?php

include "../globals.php";

function formatear($num)
{
  setlocale(LC_MONETARY, 'en_US');
  return "$" . number_format($num, 2);
}



$fecha_inicio = $_POST['inicio'];
$fecha_final = $_POST['final'];


//leidy - ventas y efectivo
$consulta_all_data = $cnx->query("SELECT * FROM factura_orden fo INNER JOIN factura_modificada fm ON fo.order_id = fm.order_id WHERE DATE(fo.order_date) BETWEEN '$fecha_inicio' AND '$fecha_final' AND (fm.estado LIKE '%solicitud%' OR fm.estado LIKE '%finalizado%' OR fm.estado LIKE '%alistamiento%')");
$count_leidy = mysqli_num_rows($consulta_all_data);

$consulta_datos_leidy = $cnx->query("SELECT SUM(total) as total_leidy FROM factura_orden fo INNER JOIN factura_modificada fm ON fo.order_id = fm.order_id WHERE DATE(fo.order_date) BETWEEN '$fecha_inicio' AND '$fecha_final' AND (fm.estado LIKE '%solicitud%' OR fm.estado LIKE '%finalizado%' OR fm.estado LIKE '%alistamiento%')");
$datos_ventas_leidy = mysqli_fetch_assoc($consulta_datos_leidy);
$monto_leidy = $datos_ventas_leidy['total_leidy'];

//metodos de pago
$consulta_datos_bc = $cnx->query("SELECT SUM(order_total_after_tax) as total_bc FROM factura_orden fo INNER JOIN factura_modificada fm ON fo.order_id = fm.order_id WHERE DATE(fo.order_date) BETWEEN '$fecha_inicio' AND '$fecha_final' AND (fm.estado LIKE '%solicitud%' OR fm.estado LIKE '%finalizado%' OR fm.estado LIKE '%alistamiento%') AND fm.metodopago LIKE '%bancolombia%'");
$consulta_data_bc = $cnx->query("SELECT * FROM factura_orden fo INNER JOIN factura_modificada fm ON fo.order_id = fm.order_id WHERE DATE(fo.order_date) BETWEEN '$fecha_inicio' AND '$fecha_final' AND (fm.estado LIKE '%solicitud%' OR fm.estado LIKE '%finalizado%' OR fm.estado LIKE '%alistamiento%') AND fm.metodopago LIKE '%bancolombia%'");
$datos_bc = mysqli_fetch_assoc($consulta_datos_bc);
$monto_bc = $datos_bc['total_bc'];
$count_bc = mysqli_num_rows($consulta_data_bc);

//davivienda
$consulta_datos_dv = $cnx->query("SELECT SUM(order_total_after_tax) as total_dv FROM factura_orden fo INNER JOIN factura_modificada fm ON fo.order_id = fm.order_id WHERE DATE(fo.order_date) BETWEEN '$fecha_inicio' AND '$fecha_final' AND (fm.estado LIKE '%solicitud%' OR fm.estado LIKE '%finalizado%' OR fm.estado LIKE '%alistamiento%') AND fm.metodopago LIKE '%davivienda%'");
$consulta_data_dv = $cnx->query("SELECT * FROM factura_orden fo INNER JOIN factura_modificada fm ON fo.order_id = fm.order_id WHERE DATE(fo.order_date) BETWEEN '$fecha_inicio' AND '$fecha_final' AND (fm.estado LIKE '%solicitud%' OR fm.estado LIKE '%finalizado%' OR fm.estado LIKE '%alistamiento%') AND fm.metodopago LIKE '%davivienda%'");
$datos_dv = mysqli_fetch_assoc($consulta_datos_dv);
$monto_dv = $datos_dv['total_dv'];
$count_dv = mysqli_num_rows($consulta_data_dv);

//contra entrega 
$consulta_datos_c = $cnx->query("SELECT SUM(order_total_after_tax) as total_c FROM factura_orden fo INNER JOIN factura_modificada fm ON fo.order_id = fm.order_id WHERE DATE(fo.order_date) BETWEEN '$fecha_inicio' AND '$fecha_final' AND (fm.estado LIKE '%solicitud%' OR fm.estado LIKE '%finalizado%' OR fm.estado LIKE '%alistamiento%') AND fm.metodopago LIKE '%contra%'");
$consulta_data_c = $cnx->query("SELECT * FROM factura_orden fo INNER JOIN factura_modificada fm ON fo.order_id = fm.order_id WHERE DATE(fo.order_date) BETWEEN '$fecha_inicio' AND '$fecha_final' AND (fm.estado LIKE '%solicitud%' OR fm.estado LIKE '%finalizado%' OR fm.estado LIKE '%alistamiento%') AND fm.metodopago LIKE '%contra%'");
$datos_c = mysqli_fetch_assoc($consulta_datos_c);
$monto_c = $datos_c['total_c'];
$count_c = mysqli_num_rows($consulta_data_c);

//datafono
$consulta_datos_dt = $cnx->query("SELECT SUM(order_total_after_tax) as total_dt FROM factura_orden fo INNER JOIN factura_modificada fm ON fo.order_id = fm.order_id WHERE DATE(fo.order_date) BETWEEN '$fecha_inicio' AND '$fecha_final' AND (fm.estado LIKE '%solicitud%' OR fm.estado LIKE '%finalizado%' OR fm.estado LIKE '%alistamiento%') AND fm.metodopago LIKE '%datafono%'");
$consulta_data_dt = $cnx->query("SELECT * FROM factura_orden fo INNER JOIN factura_modificada fm ON fo.order_id = fm.order_id WHERE DATE(fo.order_date) BETWEEN '$fecha_inicio' AND '$fecha_final' AND (fm.estado LIKE '%solicitud%' OR fm.estado LIKE '%finalizado%' OR fm.estado LIKE '%alistamiento%') AND fm.metodopago LIKE '%datafono%'");
$datos_dt = mysqli_fetch_assoc($consulta_datos_dt);
$monto_dt = $datos_dt['total_dt'];
$count_dt = mysqli_num_rows($consulta_data_dt);

//efectivo
$consulta_datos_ef = $cnx->query("SELECT SUM(order_total_after_tax) as total_ef FROM factura_orden fo INNER JOIN factura_modificada fm ON fo.order_id = fm.order_id WHERE DATE(fo.order_date) BETWEEN '$fecha_inicio' AND '$fecha_final' AND (fm.estado LIKE '%solicitud%' OR fm.estado LIKE '%finalizado%' OR fm.estado LIKE '%alistamiento%') AND fm.metodopago LIKE '%efectivo%'");
$consulta_data_ef = $cnx->query("SELECT * FROM factura_orden fo INNER JOIN factura_modificada fm ON fo.order_id = fm.order_id WHERE DATE(fo.order_date) BETWEEN '$fecha_inicio' AND '$fecha_final' AND (fm.estado LIKE '%solicitud%' OR fm.estado LIKE '%finalizado%' OR fm.estado LIKE '%alistamiento%') AND fm.metodopago LIKE '%efectivo%'");
$datos_ef = mysqli_fetch_assoc($consulta_datos_ef);
$monto_ef = $datos_ef['total_ef'];
$count_ef = mysqli_num_rows($consulta_data_ef);

//redes sociales 
$consulta_datos_rd = $cnx->query("SELECT SUM(order_total_after_tax) as total_rd FROM factura_orden fo INNER JOIN factura_modificada fm ON fo.order_id = fm.order_id WHERE DATE(fo.order_date) BETWEEN '$fecha_inicio' AND '$fecha_final' AND (fm.estado LIKE '%solicitud%' OR fm.estado LIKE '%finalizado%' OR fm.estado LIKE '%alistamiento%') AND fm.canal LIKE '%redes%'");
$consulta_data_rd = $cnx->query("SELECT * FROM factura_orden fo INNER JOIN factura_modificada fm ON fo.order_id = fm.order_id WHERE DATE(fo.order_date) BETWEEN '$fecha_inicio' AND '$fecha_final' AND (fm.estado LIKE '%solicitud%' OR fm.estado LIKE '%finalizado%' OR fm.estado LIKE '%alistamiento%') AND fm.canal LIKE '%redes%'");
$datos_rd = mysqli_fetch_assoc($consulta_datos_rd);
$monto_rd = $datos_rd['total_rd'];
$count_rd = mysqli_num_rows($consulta_data_rd);

//tienda virtual 
$consulta_datos_tv = $cnx->query("SELECT SUM(order_total_after_tax) as total_tv FROM factura_orden fo INNER JOIN factura_modificada fm ON fo.order_id = fm.order_id WHERE DATE(fo.order_date) BETWEEN '$fecha_inicio' AND '$fecha_final' AND (fm.estado LIKE '%solicitud%' OR fm.estado LIKE '%finalizado%' OR fm.estado LIKE '%alistamiento%') AND fm.canal LIKE '%tienda%'");
$consulta_data_tv = $cnx->query("SELECT * FROM factura_orden fo INNER JOIN factura_modificada fm ON fo.order_id = fm.order_id WHERE DATE(fo.order_date) BETWEEN '$fecha_inicio' AND '$fecha_final' AND (fm.estado LIKE '%solicitud%' OR fm.estado LIKE '%finalizado%' OR fm.estado LIKE '%alistamiento%') AND fm.canal LIKE '%tienda%'");
$datos_tv = mysqli_fetch_assoc($consulta_datos_tv);
$monto_tv = $datos_tv['total_tv'];
$count_tv = mysqli_num_rows($consulta_data_tv);

//call center 
$consulta_datos_cl = $cnx->query("SELECT SUM(order_total_after_tax) as total_cl FROM factura_orden fo INNER JOIN factura_modificada fm ON fo.order_id = fm.order_id WHERE DATE(fo.order_date) BETWEEN '$fecha_inicio' AND '$fecha_final' AND (fm.estado LIKE '%solicitud%' OR fm.estado LIKE '%finalizado%' OR fm.estado LIKE '%alistamiento%') AND fm.canal LIKE '%call%'");
$consulta_data_cl = $cnx->query("SELECT * FROM factura_orden fo INNER JOIN factura_modificada fm ON fo.order_id = fm.order_id WHERE DATE(fo.order_date) BETWEEN '$fecha_inicio' AND '$fecha_final' AND (fm.estado LIKE '%solicitud%' OR fm.estado LIKE '%finalizado%' OR fm.estado LIKE '%alistamiento%') AND fm.canal LIKE '%call%'");
$datos_cl = mysqli_fetch_assoc($consulta_datos_cl);
$monto_cl = $datos_cl['total_cl'];
$count_cl = mysqli_num_rows($consulta_data_cl);

//credito
$consulta_datos_cd = $cnx->query("SELECT SUM(order_total_after_tax) as total_cd FROM factura_orden fo INNER JOIN factura_modificada fm ON fo.order_id = fm.order_id WHERE DATE(fo.order_date) BETWEEN '$fecha_inicio' AND '$fecha_final' AND (fm.estado LIKE '%solicitud%' OR fm.estado LIKE '%finalizado%' OR fm.estado LIKE '%alistamiento%') AND fm.metodopago LIKE '%credito%'");
$consulta_data_cd = $cnx->query("SELECT * FROM factura_orden fo INNER JOIN factura_modificada fm ON fo.order_id = fm.order_id WHERE DATE(fo.order_date) BETWEEN '$fecha_inicio' AND '$fecha_final' AND (fm.estado LIKE '%solicitud%' OR fm.estado LIKE '%finalizado%' OR fm.estado LIKE '%alistamiento%') AND fm.metodopago LIKE '%credito%'");
$datos_cd = mysqli_fetch_assoc($consulta_datos_cd);
$monto_cd = $datos_cd['total_cd'];
$count_cd = mysqli_num_rows($consulta_data_cd);

$get_data_credito = $cnx->query("SELECT * FROM factura_orden fo INNER JOIN factura_modificada fm ON fo.order_id = fm.order_id WHERE DATE(fo.order_date) BETWEEN '$fecha_inicio' AND '$fecha_final' AND (fm.estado LIKE '%solicitud%' OR fm.estado LIKE '%finalizado%' OR fm.estado LIKE '%alistamiento%') AND fm.metodopago LIKE '%credito%'");

//descuento 
// $get_data_descuento = $cnx->query("SELECT SUM(order_total_after_tax) FROM factura_orden fo INNER JOIN factura_modificada fm ON fo.order_id = fm.order_id WHERE DATE(fo.order_date) BETWEEN '$fecha_inicio' AND '$fecha_final' AND (fm.estado LIKE '%solicitud%' OR fm.estado LIKE '%finalizado%' OR fm.estado LIKE '%alistamiento%') AND fo.order_tax_per != ''");

$consulta_datos_d = $cnx->query("SELECT SUM(order_total_amount_due) as total_d FROM factura_orden fo INNER JOIN factura_modificada fm ON fo.order_id = fm.order_id WHERE DATE(fo.order_date) BETWEEN '$fecha_inicio' AND '$fecha_final' AND (fm.estado LIKE '%solicitud%' OR fm.estado LIKE '%finalizado%' OR fm.estado LIKE '%alistamiento%') AND fo.order_tax_per > 1");
$consulta_data_d = $cnx->query("SELECT * FROM factura_orden fo INNER JOIN factura_modificada fm ON fo.order_id = fm.order_id WHERE DATE(fo.order_date) BETWEEN '$fecha_inicio' AND '$fecha_final' AND (fm.estado LIKE '%solicitud%' OR fm.estado LIKE '%finalizado%' OR fm.estado LIKE '%alistamiento%') AND fm.metodopago LIKE '%credito%'");
$datos_d = mysqli_fetch_assoc($consulta_datos_d);
$monto_d = $datos_d['total_d'];
$count_d = mysqli_num_rows($consulta_data_d);

//mercado libre 
$consulta_data_ml = $cnx->query("SELECT * FROM factura_orden fo INNER JOIN factura_modificada fm ON fo.order_id = fm.order_id WHERE DATE(fo.order_date) BETWEEN '$fecha_inicio' AND '$fecha_final' AND (fm.estado LIKE '%solicitud%' OR fm.estado LIKE '%finalizado%' OR fm.estado LIKE '%alistamiento%') AND fm.metodopago LIKE '%mercado%'");
$count_m = mysqli_num_rows($consulta_data_ml);
$totall = 0;
$total_bc = 0;
$total_dv = 0;
$total_ef = 0;
$total_datafono = 0;
$total_cd = 0;
$total_rd = 0;
$total_ml = 0;
$total_c = 0;
$total_mercado = 0;

$monto = 0;
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
    .information {
      width: 50%;
    }

    a {
      color: white;
    }
  </style>
</head>

<body>

  <div class="container">
    <br>

    <button class="btn btn-info"> <a href="administrador/index.php">Regresar al panel </a> </button>

    <center>
      <h1>Reporte de venta Call Center</h1>
    </center>
    <form action="" method="post" enctype="multipart/form-data">
      <div class="information">
        <label>Fecha inicial:</label>
        <input type="date" id="start" name="inicio" value="" class="form-control">
        <hr>
        <label>Fecha Final:</label>
        <input type="date" id="finished" name="final" value="" class="form-control">
        <br>
        <button type="submit" class="btn btn-primary"> Consultar</button>
      </div>
    </form>

    <hr>
    <div class="container">
      <table class="table table-striped table-bordered">
        <thead>
          <tr>
            <th colspan="2">EFECTIVAS</th>
            <th colspan="2">Bancolombia</th>
            <th colspan="2">Davivienda</th>
            <th colspan="2">Contra Entrega</th>
            <th colspan="2">Datafono</th>
            <th colspan="2">Efectivo</th>
          </tr>
          <tr>
            <?php foreach ($consulta_all_data as $data) :

              $monto_x = 0;
              $descuento = $data['order_total_amount_due'];
              $sin_descuento = $data['order_total_after_tax'];

              if ($descuento == 0) {
                $monto_x = $sin_descuento;
              } else {
                $monto_x = $descuento;
              }
              $montos = 0;
              $montos = $monto_x;
              $totall += $montos;

            endforeach;


            foreach ($consulta_data_bc as $datas) :

              $monto_bc = 0;
              $descuento_bc = $datas['order_total_amount_due'];
              $sin_descuento_bc = $datas['order_total_after_tax'];

              if ($descuento_bc == 0) {
                $monto_bc = $sin_descuento_bc;
              } else {
                $monto_bc = $descuento_bc;
              }
              $montob = 0;
              $montob = $monto_bc;
              $total_bc += $montob;
            endforeach;

            foreach ($consulta_data_dv as $datass) :

              $monto_dv = 0;
              $descuento_dv = $datass['order_total_amount_due'];
              $sin_descuento_dv = $datass['order_total_after_tax'];

              if ($descuento_dv == 0) {
                $monto_dv = $sin_descuento_dv;
              } else {
                $monto_dv = $descuento_dv;
              }

              $montod = $monto_dv;
              $total_dv += $montod;
            endforeach;

            foreach ($consulta_data_c as $datass2) :

              $monto_c = 0;
              $descuento_c = $datass2['order_total_amount_due'];
              $sin_descuento_c = $datass2['order_total_after_tax'];

              if ($descuento_c == 0) {
                $monto_c = $sin_descuento_c;
              } else {
                $monto_c = $descuento_c;
              }

              $montoc = $monto_c;
              $total_c += $montoc;
            endforeach;

            foreach ($consulta_data_ml as $datas_mercado) :

              $monto_ml = 0;
              $descuento_ml = $datas_mercado['order_total_amount_due'];
              $sin_descuento_ml = $datas_mercado['order_total_after_tax'];

              if ($descuento_ml == 0) {
                $monto_ml = $sin_descuento_ml;
              } else {
                $monto_ml = $descuento_ml;
              }

              $montoml = $monto_ml;
              $total_mercado += $montoml;
            endforeach;
            foreach ($consulta_data_dt as $data_datafono) :

              $monto_dt = 0;
              $descuento_dt = $data_datafono['order_total_amount_due'];
              $sin_descuento_dt = $data_datafono['order_total_after_tax'];

              if ($descuento_dt == 0) {
                $monto_dt = $sin_descuento_dt;
              } else {
                $monto_dt = $descuento_dt;
              }

              $montodt = $monto_dt;
              $total_datafono += $montodt;
            endforeach;
            foreach ($consulta_data_ef as $data_efectivo) :

              $monto_ef = 0;
              $descuento_ef = $data_efectivo['order_total_amount_due'];
              $sin_descuento_ef = $data_efectivo['order_total_after_tax'];

              if ($descuento_ef == 0) {
                $monto_ef = $sin_descuento_ef;
              } else {
                $monto_ef = $descuento_ef;
              }

              $montoef = $monto_ef;
              $total_ef += $montoef;
            endforeach;


            ?>

            <td><?= formatear($totall); ?> </td>

            <td><?= $count_leidy; ?> </td>
            <td><?= formatear($total_bc); ?> </td>
            <td><?= $count_bc; ?> </td>
            <td><?= formatear($total_dv); ?> </td>
            <td><?= $count_dv; ?> </td>
            <td><?= formatear($total_c); ?> </td>
            <td><?= $count_c; ?> </td>
            <td><?= formatear($total_datafono); ?> </td>
            <td><?= $count_dt; ?> </td>
            <td><?= formatear($total_ef); ?> </td>
            <td><?= $count_ef; ?> </td>
          </tr>

          <hr>
          <tr>
            <th colspan="12 text-center">CANALES</th>
          </tr>
          <tr>
            <th colspan="2">Redes Sociales</th>
            <th colspan="2">Tienda Virtual</th>
            <th colspan="2">Call Center</th>
            <th colspan="2">Mercado Libre</th>
          </tr>
          <td colspan="1"><?= formatear($monto_rd); ?> </td>
          <td colspan="1"> <?= $count_rd; ?> </td>
          <td colspan="1"><?= formatear($monto_tv); ?> </td>
          <td colspan="1"> <?= $count_tv; ?> </td>
          <td colspan="1"><?= formatear($monto_cl); ?> </td>
          <td colspan="1"> <?= $count_cl; ?> </td>
          <td colspan="1"><?= formatear($total_mercado); ?> </td>
          <td colspan="1"> <?= $count_m; ?> </td>
          <hr>
          <tr>
            <th colspan="12 text-center">CREDITO</th>
          </tr>
          <tr>
            <th colspan="6">MONTO</th>
            <th colspan="6">Cotizaciones</th>
          </tr>
          <tr>
            <td colspan="6"><?= formatear($monto_cd); ?></td>
            <td colspan="6"><?= $count_cd; ?></td>
          </tr>

          <div class="credito" id="credito">
            <tr>
              <th colspan="3">Fecha </th>
              <th>Cotizacion </th>
              <th colspan="3">Cliente </th>
              <th colspan="3">Monto </th>
              <th>PDF </th>
            </tr>
            <?php foreach ($get_data_credito as $fila) : ?>
              <tr>

                <?php $cotizacion = $fila['order_id'];
                $pdf = "<button class='btn btn-warning'> <a href='../print_invoice.php?invoice_id=" . $cotizacion . "' target='_blank'>PDF</a></button>"; ?>
                <td colspan="3"><?= $fila["order_date"] ?></td>
                <td><?= $fila["order_date"] ?></td>
                <td colspan="3"><?= $fila["order_receiver_name"] ?></td>
                <td colspan="3"><?= formatear($fila["order_total_after_tax"]) ?></td>
                <td><?= $pdf; ?></td>
              </tr>


            <?php endforeach; ?>
          </div>

        </thead>
      </table>
    </div>




  </div>




</body>

</html>
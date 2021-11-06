<script type="text/javascript">
  function stopDefAction(evt) {
    evt.preventDefault();
  }
</script>


<?php

include "../globals.php";

function formatear($num)
{
  setlocale(LC_MONETARY, 'en_US');
  return "$" . number_format($num, 2);
}
// metodo buscar
$fecha_inicial = $_POST['fecha_inicial'] . " " . "07:50:50";
$fecha_final = $_POST['fecha_final'] . " " . "19:50:50";
$mostrador_jj = "mostradorjj";
$mostrador_d1 = "mostradord1";
$mostrador_ib1 = "mostrador_ibague_1";
$mostrador_ib2 = "mostrador_ibague_2";
$user = 10; //esto es call center
$estado = "finalizado";
$ibague = "productos_ibague";

// echo "<pre>";
//    print_r($fecha_final);
//    print_r($fecha_inicial);
// echo "</pre>";

if (empty($_POST['fecha_inicial'])) {
  echo "<script>
         alert('Recuerda seleccionar la fecha que quieres filtrar');
		</script>";
} else {

  if (isset($_POST['btn_buscar'])) {
    $buscar_text = $_POST['buscar'];


    echo "<pre>";
    print_r($buscar_text);

    echo "</pre>";

    // $consulta_datos = $cnx -> query("SELECT SUM(order_item_quantity) as total_mostrador FROM factura_orden_producto INNER JOIN factura_orden ON factura_orden.order_id = factura_orden_producto.order_id WHERE order_date BETWEEN '$fecha_inicial' AND '$fecha_final' AND factura_orden_producto.item_code LIKE $buscar_text AND factura_orden.metodopago = '$mostrador_jj' AND factura_orden.estado = '$estado'");
    $consultando_datos = $cnx->query("SELECT SUM(order_item_quantity) AS total_mostrador FROM factura_orden_producto INNER JOIN factura_orden ON factura_orden.order_id = factura_orden_producto.order_id WHERE factura_orden_producto.order_date BETWEEN '$fecha_inicial' AND '$fecha_final' AND factura_orden.metodopago = '$mostrador_jj' AND factura_orden.estado LIKE '%$estado%' AND factura_orden_producto.item_code = $buscar_text");
    //mostrador principal
    $data = mysqli_fetch_assoc($consultando_datos);
    $cuentas_mostrador = $data['total_mostrador'];
    //mostrador_d1
    $consultando_datos_d1 = $cnx->query("SELECT SUM(order_item_quantity) AS total_d1 FROM factura_orden_producto INNER JOIN factura_orden ON factura_orden.order_id = factura_orden_producto.order_id WHERE factura_orden.order_date BETWEEN '$fecha_inicial' AND '$fecha_final' AND factura_orden.metodopago = '$mostrador_d1' AND factura_orden.estado LIKE '%$estado%' AND factura_orden_producto.item_code = $buscar_text");
    $data_d1 = mysqli_fetch_assoc($consultando_datos_d1);
    $cuentas_mostrador_d1 = $data_d1['total_d1'];
    //Call_Center
    $consultando_datos_call = $cnx->query("SELECT SUM(order_item_quantity) AS total_call FROM factura_orden_producto INNER JOIN factura_orden ON factura_orden.order_id = factura_orden_producto.order_id WHERE factura_orden_producto.order_date BETWEEN '$fecha_inicial' AND '$fecha_final' AND user_id = $user AND factura_orden.estado LIKE '%$estado%' AND factura_orden_producto.item_code = $buscar_text");
    $data_call = mysqli_fetch_assoc($consultando_datos_call);
    $cuentas_mostrador_call = $data_call['total_call'];

    //ENVIOS A IBAGUE     
    $consultando_datos_send_ibague = $cnx->query("SELECT SUM(cantidad) AS total_envio_ibague FROM traspasos WHERE order_date BETWEEN '$fecha_inicial' AND '$fecha_final' AND bodega_entrada = '$ibague' AND estado LIKE '%$estado%' AND codigo = $buscar_text");
    $data_envio_ibague = mysqli_fetch_assoc($consultando_datos_send_ibague);
    $cuentas_envio_ibague = $data_envio_ibague['total_envio_ibague'];

    //CONSTAL DE  LAS COTIZACIONES 
    $consultando_nombre_producto = $cnx->query("SELECT contratipo FROM producto_av WHERE id = $buscar_text");

    while ($name = mysqli_fetch_array($consultando_nombre_producto)) {
      $nombre = $name["contratipo"];
    }
  } else {
    echo "<pre>";
    print_r("BUSCAR UN PRODUCTO, POR MEDIO DEL CODIGO");

    echo "</pre>";
  }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="gb18030">

  <title>Mercancia Vendida</title>
  <script src="../jquery-3.1.1.min.js"></script>
  <link rel="stylesheet" href="../css/styledom.css">
  <link href="https://fonts.googleapis.com/css2?family=Gentium+Basic&family=Julius+Sans+One&family=Open+Sans+Condensed:wght@300&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

  <style>
    #contenedor_informacion {
      border: solid 1px black;
    }

    #contenedor {}

    #fechas {}

    #retornar {
      decoration: none;
      color: white;
    }

    a {
      color: white;
      text-decoration: none;
    }
  </style>
</head>

<body>

  <div class="contenedor">
    <button class="btn btn-success"><a href="index.php" id="retornar">Regresar al panel de administrador</a></button>

    <hr>
    <center>
      <h3>SALIDA DE MERCANCIA</h3>
    </center>

    <center>
      <span style="color:red;">
        Recuerda que para filtrar la cantidad de productos que han vendido todas las sedes de JJ QUIMIENVASES s.a.s debes seleccionar la fecha de inicio y final.
      </span>

    </center>
    <hr>
    <span style="color:green;">
      Seleccionar la fecha que deseas filtrar
    </span>

    <form action="" class="formulario" method="post">

      <br>
      <div id="fechas">
        <label> Fecha Inicio:</label>
        <input type="date" name="fecha_inicial" value="" class="date">
        <hr>
        <label> Fecha Final:</label>
        <input type="date" name="fecha_final" value="" class="date">
      </div>
      <div class="barra__buscador">
        <div class="buscarcliente">
          <datalist id="buscarproducto">
            <option value="">Busca y selecciona un producto</option>
            <?php
            $query = $cnx->query("SELECT * FROM producto_av");
            while ($valores = mysqli_fetch_array($query)) {
              echo '<option value="' . $valores["id"] . '">' . $valores["contratipo"] . ',' . $valores["id"] . '</option>';
            }
            ?>
          </datalist>
          <input class="form-control" list="buscarproducto" name="buscar" id="buscarcliente" type="text" placeholder="Buscar y seleccionar un producto">
          <p></p>
          <input type="submit" class="btn btn-success" name="btn_buscar" value="Buscar">
        </div>
    </form>
  </div>


  <ul class="list-group">
    <li class="list-group-item">La cantidad de <?php echo "$nombre";  ?> Que se vendió en la fecha seleccionada fue:</li>

    <li class="list-group-item list-group-item-primary">Mostrador Principal: <?php echo $cuentas_mostrador; ?> </li>
    <div id="mi_primer_resultado">
      <?php
      //consultando la informacion de ventas por cotizacion 
      $consulta_cot_mostrador = $cnx->query("SELECT * FROM factura_orden_producto INNER JOIN factura_orden ON factura_orden.order_id = factura_orden_producto.order_id WHERE factura_orden_producto.order_date BETWEEN '$fecha_inicial' AND '$fecha_final' AND factura_orden.metodopago = '$mostrador_jj' AND factura_orden.estado LIKE '%$estado%' AND factura_orden_producto.item_code = $buscar_text");
      $consulta_cot_callcenter = $cnx->query("SELECT * FROM factura_orden_producto INNER JOIN factura_orden ON factura_orden.order_id = factura_orden_producto.order_id WHERE factura_orden.order_date BETWEEN '$fecha_inicial' AND '$fecha_final' AND factura_orden.user_id = '$user' AND factura_orden.estado LIKE '%$estado%' AND factura_orden_producto.item_code = $buscar_text");
      $consulta_cot_d1 = $cnx->query("SELECT * FROM factura_orden_producto INNER JOIN factura_orden ON factura_orden.order_id = factura_orden_producto.order_id WHERE factura_orden_producto.order_date BETWEEN '$fecha_inicial' AND '$fecha_final' AND factura_orden.metodopago = '$mostrador_d1' AND factura_orden.estado LIKE '%$estado%' AND factura_orden_producto.item_code = $buscar_text");
      //  $consulta_cot_traspasos_ibague = $cnx -> query("SELECT * FROM factura_orden_producto INNER JOIN factura_orden ON factura_orden.order_id = factura_orden_producto.order_id WHERE factura_orden_producto.order_date BETWEEN '$fecha_inicial' AND '$fecha_final' AND factura_orden.metodopago = '$mostrador_jj' AND factura_orden.estado LIKE '%$estado%' AND factura_orden_producto.item_code = $buscar_text");

      //while mostrador
      while ($info = mysqli_fetch_array($consulta_cot_mostrador)) {
        $cliente = $info["order_receiver_name"];
        $cotizacion = $info["order_id"];
        $producto = $info["item_name"];
        $cantidad = $info["order_item_quantity"];
        $fecha = $info["order_date"];
        $boton = "<button class='btn btn-success'> <a href='../print_invoice.php?invoice_id=" . $cotizacion . "' target='_blank' title='Imprimir Factura'><div><span class='glyphicon glyphicon-print'>Ver Cotizacion</span></div></a></button>";


        $datos_mostrador = "<table>
       <tbody>
          <tr>
          <td style='width:15%'>$fecha </td>
          <td style='width:10%'>$cotizacion </td>
          <td style='width:25%'>$cliente </td>
          <td style='width:20%'>$cantidad </td>
          <td style='width:10%'>$boton </td>
          </tr>
         </tbody> 
      </table>";
        echo $datos_mostrador;
      }


      ?>

    </div>
    <li class="list-group-item list-group-item-secondary">Mostrador D1: <?php echo $cuentas_mostrador_d1; ?></li>
    <?php
    while ($info_d1 = mysqli_fetch_array($consulta_cot_d1)) {
      $cliente = $info_d1["order_receiver_name"];
      $cotizacion = $info_d1["order_id"];
      $producto = $info_d1["item_name"];
      $cantidad = $info_d1["order_item_quantity"];
      $fecha = $info_d1["order_date"];
      $comercial = $info_d1["order_receiver_addre"];
      $boton = "<button class='btn btn-success'> <a href='../print_invoice.php?invoice_id=" . $cotizacion . "' target='_blank' title='Imprimir Factura'><div><span class='glyphicon glyphicon-print'>Ver Cotizacion</span></div></a></button>";


      $datos_d1 = "<table>
      <tbody>
          <tr>
          <td style='width:15%'>$fecha </td>
          <td style='width:10%'>$cotizacion </td>
          <td style='width:25%'>$cliente </td>
          <td style='width:20%'>$cantidad </td>
          <td style='width:10%'>$boton</td>
          </tr>
      </tbody>      
      </table>";
      echo $datos_d1;
    }
    ?>

    <li class="list-group-item list-group-item-success">Ventas Call Center: <?php echo $cuentas_mostrador_call; ?></li>
    <?php
    while ($info_call = mysqli_fetch_array($consulta_cot_callcenter)) {
      $cliente = $info_call["order_receiver_name"];
      $cotizacion = $info_call["order_id"];
      $producto = $info_call["item_name"];
      $cantidad = $info_call["order_item_quantity"];
      $fecha = $info_call["order_date"];

      $boton = "<button class='btn btn-success'> <a href='../print_invoice.php?invoice_id=" . $cotizacion . "' target='_blank' title='Imprimir Factura'><div><span class='glyphicon glyphicon-print'>Ver Cotizacion</span></div></a></button>";

      $datos_call = "<table>
         <tbody>
          <tr>
          <td style='width:15%'>$fecha </td>
          <td style='width:10%'>$cotizacion </td>
          <td style='width:25%'>$cliente </td>
          <td style='width:20%'>$cantidad </td>
          <td style='width:10%'>$boton </td>
          </tr>
         </tbody> 
      </table>";
      echo $datos_call;
    }
    ?>
    <li class="list-group-item list-group-item-danger">Cantidad enviada a ibague: <?php echo $cuentas_envio_ibague; ?></li>
    <!--<li class="list-group-item list-group-item-warning">This is a warning list group item</li>-->
    <!--<li class="list-group-item list-group-item-info">This is a info list group item</li>-->
    <!--<li class="list-group-item list-group-item-light">This is a light list group item</li>-->
    <!--<li class="list-group-item list-group-item-dark">This is a dark list group item</li>-->
  </ul>

  </div>
</body>

</html>
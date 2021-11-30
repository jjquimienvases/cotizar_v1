<?php
  include 'conectar.php';

  $conexion = conectar();

  session_start();
  $user_rol = $_SESSION['id_rol'];
  $usuario = $_SESSION['user'];
  $userID = $_SESSION['userid'];


 $consulta_1 = $conexion ->query("SELECT * FROM order_abono WHERE estado = 'pendiente'");
  if ($conexion){
    echo "okok aqui vmaos";
  }else{
    echo "nonono";
  }
?>

<!DOCTYPE html>
<html lang="es" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Abonos JJ</title>
    <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
<script src="jquery-3.1.1.min.js"></script>
<style media="screen">
  .first_div{
    width: 90%;

  }
</style>
  </head>
  <body>
     <br>
     <center>
     <h3>BIENVENIDO <?php echo $usuario ?> En este apartado puedes ver todos los abonos de tu sede.</h3>
     </center>
     <hr>
     <center>
     <div class="first_div">
    <table class="table">
      <tr>
        <th>Fecha</th>
        <th>Cotizacion</th>
        <th>Cliente</th>
        <th>Comercial</th>
        <th>Total</th>
        <th>Abono</th>
        <th>Restante</th>
        <th>Metodo de pago</th>
        <th>Nuevo Abono</th>
        <th>Accion</th>
      </tr>
      <tr>
        <form class="" action="send_ajax_abono.php" method="post">
        <?php
                 while ($data = mysqli_fetch_array($consulta_1)) {
                   $fecha = $data['order_date'];
                   $cotizacion = $data['order_id'];
                   $cliente = $data['order_receiver_name'];
                   $comercial = $data['comercial'];
                   $total = $data['deuda'];
                   $abono = $data['abono'];
                   $restante = $data['restante'];
                   $restante_f = $total - $abono;
                   $metodo_de_pago = $data['metodo_de_pago'];
                   $rol = $data['id_rol'];

                   $input = "<input class='form-control' placeholder='abono' name='nuevo_abono' id='nuevo_abono' type='number'>";
                   $accion = "<button class='btn btn-success' name='aprobar'  id='aprobar' value='$cotizacion'>Aprobar Abono</button>";
                   $select = "<select class='form-control' name='metodo'>
                               <option value='efectivo'>Efectivo</option>
                               <option value='bancolombia'>Bancolombia</option>
                               <option value='davivienda'>Davivienda</option>
                               <option value='datafono'>Datafono</option>
                             </select>";
                   echo "<td>$fecha</td>
                         <td>$cotizacion</td>
                         <td>$cliente</td>
                         <td>$comercial</td>
                         <td><input type='number' class='form-control' readonly name='total_due' id='total_due' value='$total'></td>
                         <td>$abono</td>
                         <td><input type='number' class='form-control' readonly name='restante' id='restante' value='$restante'></td>
                         <td>$select</td>
                         <td>$input</td>
                         <td>$accion</td>
                   ";
                 }
        ?>
      </tr>
        </form>
    </table>
  </div>
</center>
  </body>
</html>

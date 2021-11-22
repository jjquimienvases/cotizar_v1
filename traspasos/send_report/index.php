<?php
function formatear($num){
  setlocale(LC_MONETARY, 'en_US');
  return "$" . number_format($num, 2);
}


$message = '';

$connect = new PDO("mysql:host=ftp.jjquimienvases.com;dbname=jjquimienvases_cotizar", "jjquimienvases_jjadmin", "LeinerM4ster");

function fetch_customer_data($connect)
{
  $total_mostrador = '';
  $total_call = '';
  $total_d1 = '';
  $total_ib1 = '';
  $total_ib2 = '';
$myconexion = new mysqli ('ftp.jjquimienvases.com', 'jjquimienvases_jjadmin', 'LeinerM4ster', 'jjquimienvases_cotizar');

$status = $_POST['estado'];


  $hoy = '';
  $tomorrow = '';

//   $ahora = time();
//   $unDiaEnSegundos = 24 * 60 * 60;
//   $manana = $ahora + $unDiaEnSegundos;
//   $mananaLegible = date("Y-m-d", $manana);
//   # ahoraLegible ���nicamente es para demostrar
//   $ahoraLegible = date("Y-m-d", $ahora);
  
  
  $hoy = $_POST['fecha_inicio']."&nbsp"."07:10:55";
  $tomorrow = $_POST['fecha_final']."&nbsp"."07:15:55";
  $bodega_salida = $_POST['origen'];
  $bodega_entrada = $_POST['destino'];
  
 // $fecha_inicial = "2020-10-01 07:28:20";
 // $fecha_terminal = "2020-11-01 07:28:20";




 //primer query sera mostrador principal
 $query = "SELECT * FROM traspasos WHERE DATE(order_date) BETWEEN '$hoy' AND '$tomorrow' AND bodega_entrada = '$bodega_entrada' AND bodega_salida = '$bodega_salida' AND estado ='$status'";
 $statement = $connect->prepare($query);
 $statement->execute();
 $result = $statement->fetchAll();
 
 
//  echo "<pre>";
//   print_r($result);
//  echo "</pre>";
//  return;
 


 $output = '
 <div class="table-responsive">
  <table class="table table-striped table-bordered">
   <tr>
    <th BGCOLOR="#f97428">Fecha</th>
    <th BGCOLOR="#f97428">Codigo</th>
    <th BGCOLOR="#f97428">Producto</th>
    <th BGCOLOR="#f97428">Cantidad</th>
    <th BGCOLOR="#f97428">Destino</th>
    <th BGCOLOR="#f97428">Estado</th>
 
   </tr>
 ';

 foreach($result as $row) //mostrador principal
 {

  $output .= '
   <tr>
    <td BGCOLOR="#479485">'.$row["order_date"].'</td>
    <td BGCOLOR="#479485">'.$row["codigo"].'</td>
    <td BGCOLOR="#479485">'.$row["producto"].'</td>
    <td BGCOLOR="#479485">'.$row["cantidad"].'</td>
    <td BGCOLOR="#479485">'.$row["bodega_entrada"].'</td>
    <td BGCOLOR="#479485">'.$row["estado"].'</td>

   </tr>
  ';
 }
 
 $output .= '
  </table>
 </div>
 ';



//_________________________ aqui va a retornar la informacion que le acabo de dar al output
 return $output;
}

if(isset($_POST["action"]))
{
 include('pdf.php');
 $file_name = md5(rand()) . '.pdf';
 $html_code = '<link rel="stylesheet" href="bootstrap.min.css">';
 $html_code .= fetch_customer_data($connect);
 $pdf = new Pdf();
 $pdf->load_html($html_code);
 $pdf->render();
 $file = $pdf->output();
 file_put_contents($file_name, $file);
$ahora = time();
$ahoraLegible = date("Y-m-d", $ahora);
 require 'class/class.phpmailer.php';
 $mail = new PHPMailer;
 $mail->IsSMTP();        //Sets Mailer to send message using SMTP
 $mail->Host = 'mi3-lr13.supercp.com';   //Sets the SMTP hosts of your Email hosting, this for Godaddy
 $mail->Port = 465;        //Sets the default SMTP server port
 $mail->SMTPAuth = true;       //Sets SMTP authentication. Utilizes the Username and Password variables
 $mail->Username = 'leiner@profruver.com';     //Sets SMTP username
 $mail->Password = 'fliamr201729';     //Sets SMTP password
 $mail->SMTPSecure = 'ssl';       //Sets connection prefix. Options are "", "ssl" or "tls"
 $mail->From = 'desarrollo@envasesyperfumeria.com';   //Sets the From email address for the message
 $mail->FromName = 'Area de desarrollo';   //Sets the From name of the message
 $mail->AddAddress('comercial1@envasesyperfumeria.com');  //Adds a "To" address (aqui va el correo destino)
 $mail->WordWrap = 50;       //Sets word wrapping on the body of the message to a given number of characters
 $mail->IsHTML(true);       //Sets message type to HTML
 $mail->AddAttachment($file_name);         //Adds an attachment from a path on the filesystem
 $mail->Subject = 'Reporte de ventas '.$ahoraLegible;   //Sets the Subject of the message
 $mail->Body = 'Reportes de venta JJ QUIMIENVASES.';    //An HTML or plain text message body
 if($mail->Send())        //Send an Email. Return true on success or false on error
 {
  $message = '<label class="text-success">El envio de los reportes se ejecuto correctamente</label>';
 }
 unlink($file_name);
}

?>
<!DOCTYPE html>
<html>
 <head><meta charset="euc-jp">
  <title>Solicitud de traspaso</title>
  <script src="jquery.min.js"></script>
  <link rel="stylesheet" href="bootstrap.min.css" />
  <script src="bootstrap.min.js"></script>
 </head>
 <body>
  <br />
  <div class="container">
   <h3 align="center">Solicitudes de traspaso</h3>
   <br />


   
   <form method="post" action="">
  <div class="form-row">
      <button class="btn btn-primary"> <a href="../new_demo.php">Volver a traspasos</a> </button>
    <div class="form-group col-md-6">

      <label for="fecha_inicio">Seleccionar una fecha inicial:</label>
        <input type="date" name="fecha_inicio" class="form-control" id="fecha_inicio">
    </div>
    <div class="form-group col-md-6">
      <label for="fecha_final">Seleccionar una fecha Final:</label>
       <input type="date" name="fecha_final" class="form-control" id="fecha_final">
    </div>
  </div>
  <div class="form-group">
    <label for="origen">Seleccionar Bodega Origen</label>
        <select name="origen" class="form-control" id="origen">
         <option value="producto_av">Bodega principal</option>
         <option value="producto">Mostrador Principal</option>
         <option value="producto_d1">Mostrador D1</option>
         <option value="productos_ibague">Ibague</option>
         <option value="productos_ibague2">Ibague 2</option>
    </select>
  </div>
  <div class="form-group">
    <label for="destino">Seleccionar Bodega Desino</label>
 <select name="destino" class="form-control" id="destino">
         <option value="producto_av">Bodega principal</option>
         <option value="producto">Mostrador Principal</option>
         <option value="producto_d1">Mostrador D1</option>
         <option value="productos_ibague">Ibague</option>
         <option value="productos_ibague2">Ibague 2</option>
</select>
 
  </div>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="estado">Escoger el estado del traspaso que quieres consultar</label>
     <select name="estado" class="form-control" id="estado">
         <option value="Solicitud Finalizada" selected>solicitud</option>
         <option value="Solicitud Pendiente">solicitudes pendientes</option>
         <option value="transito">Transito</option>
         <option value="Finalizado">Finalizado</option>
    </select>
    </div>

  </div>
  <hr>

  <button type="submit" value="buscador" name="buscador" class="btn btn-primary"> Consultar Traslado De Mercancia</button>
</form>
   
   <hr>
   
   
   <br />

   <?php
   echo fetch_customer_data($connect);
    
   ?>
  </div>
  <br />
  <br />
 </body>
</html>

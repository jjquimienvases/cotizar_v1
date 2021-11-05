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

$callcenter = "bancolombia";
$davivienda = "davivienda";
$credito = "credito";
$contraentrega="contra entrega";
$mercado_libre = "mercado libre";
$nequi = "Nequi";
$daviplata = "daviplata";
$redes = "redes sociales";
$datafono = "datafono";

$abonos = "este tiene que ser un array";
$gastos = "esto lo voy a sacar de una tabla de mi base de datos";




$ibague1 = "mostrador_ibague_1"; //deberia de ser mostrador_ibague_1
$ibague2 = "mostrador_ibague_2"; //deberia de ser mostrador_ibague_2
$mostrador_d1 = "mostradord1";
$mostrador = "mostradorjj";
$anulado = "anulado";
$status = "finalizado";
$status_2 = "pendiente";
$efectico = "efectivo";
$anular = "solicitud anular";


  $hoy = '';
  $ma���ana = '';

  $ahora = time();
  $unDiaEnSegundos = 24 * 60 * 60;
  $manana = $ahora + $unDiaEnSegundos;
  $mananaLegible = date("Y-m-d", $manana);
  # ahoraLegible ���nicamente es para demostrar
  $ahoraLegible = date("Y-m-d", $ahora);
  $hoy = $_POST['fecha_inicial']."&nbsp"."07:10:55";
  $ma���ana = $_POST['fecha_final']."&nbsp"."07:15:55";
  
  
  
    $today = $_POST['fecha_inicial'];
    $tomo  = $_POST['fecha_final'];
 // $fecha_inicial = "2020-10-01 07:28:20";
 // $fecha_terminal = "2020-11-01 07:28:20";
 

//consultando solicitudes de anulacion 
// SELECT tablaB.id, tablaA.nombre as Nombre1 
// FROM tablaB
// INNER JOIN tablaA on tablaA.id = tablaB.id_Primer_pers
$solicitud_anular = $myconexion -> query("SELECT * FROM solicitud_anular INNER JOIN factura_orden ON factura_orden.order_id = solicitud_anular.order_id WHERE order_date BETWEEN '$today' AND '$tomo'"); 

//consultando con cuanto dinero comenzo el dia cada punto de venta
$dinero_inicial = $myconexion -> query("SELECT * FROM start_day WHERE order_date BETWEEN '$today' AND '$tomo'");  

//consultando gastos y novedades 
$gastos_novedades = $myconexion ->query("SELECT * FROM novedades_gastos WHERE order_date BETWEEN '$today' AND '$tomo'");


 

//consultando la cantidad de Cotizaciones mostrador
$resultado_count = $myconexion -> query ("SELECT count(*) as total from factura_orden WHERE order_date BETWEEN '$hoy' AND '$ma���ana' AND metodopago = '$mostrador' AND estado !='$anular'");
$data=mysqli_fetch_assoc($resultado_count);
$cuenta_mostrador = $data['total'];
//calculando la cantidad de cotizaciones callcenter
$resultado_count_call = $myconexion -> query ("SELECT count(*) as total_call from factura_modificada WHERE order_date BETWEEN '$hoy' AND '$ma���ana' AND punto_pago != '$mostrador' ");
$data_call=mysqli_fetch_assoc($resultado_count_call);
$cuenta_call = $data_call['total_call'];
//calculando la cantidad de cotizaciones d1
$resultado_count_d1 = $myconexion -> query ("SELECT count(*) as total_d1 from factura_orden WHERE order_date BETWEEN '$hoy' AND '$ma���ana' AND metodopago = '$mostrador_d1' AND estado ='$status'");
$data_d1=mysqli_fetch_assoc($resultado_count_d1);
$cuenta_d1 = $data_d1['total_d1'];
//calculando la cantidad de ibague 1
$resultado_count_ib1 = $myconexion -> query ("SELECT count(*) as total_ib1 from factura_orden WHERE order_date BETWEEN '$hoy' AND '$ma���ana' AND metodopago = '$ibague1' AND estado ='$status'");
$data_ib1=mysqli_fetch_assoc($resultado_count_ib1);
$cuenta_ib1 = $data_ib1['total_ib1'];
//calculando la cantidad de ibague 2
$resultado_count_ib2 = $myconexion -> query ("SELECT count(*) as total_ib2 from factura_orden WHERE order_date BETWEEN '$hoy' AND '$ma���ana' AND metodopago = '$ibague2' AND estado ='$status'");
$data_ib2=mysqli_fetch_assoc($resultado_count_ib2);
$cuenta_ib2 = $data_ib2['total_ib2'];


//consulta para ventas callcenter en mostrador 
 $query_mcall = "SELECT * FROM factura_modificada WHERE order_date BETWEEN '$hoy' AND '$ma���ana' AND punto_pago = '$mostrador' AND estado ='$status'";
 $statement = $connect->prepare($query_mcall);
 $statement->execute();
 $resultante = $statement->fetchAll();


 //primer query sera mostrador principal
 $query = "SELECT * FROM factura_orden WHERE order_date BETWEEN '$hoy' AND '$ma���ana' AND metodopago = '$mostrador' AND estado !='$anular'";
 $statement = $connect->prepare($query);
 $statement->execute();
 $result = $statement->fetchAll();
 //fin consulta y ejecucion de mostrador principal
 $query_d1 = "SELECT * FROM factura_orden WHERE order_date BETWEEN '$hoy' AND '$ma���ana' AND metodopago = '$mostrador_d1' AND estado !='$anular' ";
 $statement = $connect->prepare($query_d1);
 $statement->execute();
 $resultado_d1 = $statement->fetchAll();
 //fin consulta y ejecucion mostrador d1
 $query_ibague_1 = "SELECT * FROM factura_orden WHERE order_date BETWEEN '$hoy' AND '$ma���ana' AND metodopago = '$ibague1' AND estado !='$anular' ";
 $statement = $connect->prepare($query_ibague_1);
 $statement->execute();
 $resultado_ibague1 = $statement->fetchAll();
 //fin consulta de ibague 1
 $query_ibague_2 = "SELECT * FROM factura_orden WHERE order_date BETWEEN '$hoy' AND '$ma���ana' AND metodopago = '$ibague2' AND estado !='$anular' ";
 $statement = $connect->prepare($query_ibague_2);
 $statement->execute();
 $resultado_ibague2 = $statement->fetchAll();
 //fin consulta ibague 2
 //inicio call center
 $query_cc = "SELECT * FROM factura_modificada WHERE order_date BETWEEN '$hoy' AND '$ma���ana' AND punto_pago != '$mostrador' ";
 $statement = $connect->prepare($query_cc);
 $statement->execute();
 $resultado_call = $statement->fetchAll();



//---------------------------------------------------------------------------------------------------------




//consulta para saber el monto  de ventas hechas en call 

$query_cc_bancolombia = $myconexion -> query ("SELECT sum(total) as total_call_bancolombia from factura_modificada WHERE order_date BETWEEN '$hoy' AND '$ma���ana' AND metodopago LIKE '%$callcenter%' AND punto_pago != '$mostrador'"); // bancolombia
$data_bc_call=mysqli_fetch_assoc($query_cc_bancolombia);
$cuenta_call_bancolombia = $data_bc_call['total_call_bancolombia'];

$query_cc_davivienda = $myconexion -> query ("SELECT sum(total) as total_call_davivienda from factura_modificada WHERE order_date BETWEEN '$hoy' AND '$ma���ana' AND metodopago LIKE '%$davivienda%' AND punto_pago != '$mostrador'"); // davivienda
$data_dv_call=mysqli_fetch_assoc($query_cc_davivienda);
$cuenta_call_davivienda = $data_dv_call['total_call_davivienda'];

$query_cc_credito = $myconexion -> query ("SELECT sum(total) as total_call_credito from factura_modificada WHERE order_date BETWEEN '$hoy' AND '$ma���ana' AND metodopago LIKE '%$credito%' AND punto_pago != '$mostrador'"); //credito
$data_cd_call=mysqli_fetch_assoc($query_cc_credito);
$cuenta_call_credito = $data_cd_call['total_call_credito'];

$query_cc_contra = $myconexion -> query ("SELECT sum(total) as total_call_contra from factura_modificada WHERE order_date BETWEEN '$hoy' AND '$ma���ana' AND metodopago LIKE '%$contraentrega%' AND punto_pago != '$mostrador'"); // contra entrega
$data_ct_call=mysqli_fetch_assoc($query_cc_contra);
$cuenta_call_contra = $data_ct_call['total_call_contra'];

$query_cc_mercado = $myconexion -> query ("SELECT sum(total) as total_call_mercado from factura_modificada WHERE order_date BETWEEN '$hoy' AND '$ma���ana' AND metodopago LIKE '%$mercado_libre%' AND punto_pago != '$mostrador'"); // mercado libre
$data_md_call=mysqli_fetch_assoc($query_cc_mercado);
$cuenta_call_mercado = $data_md_call['total_call_mercado'];


$query_cc_redes = $myconexion -> query ("SELECT sum(total) as total_call_redes from factura_modificada WHERE order_date BETWEEN '$hoy' AND '$ma���ana' AND canal LIKE '%$redes%' AND punto_pago != '$mostrador'"); // redes sociales
$data_rd_call=mysqli_fetch_assoc($query_cc_redes);
$cuenta_call_redes = $data_rd_call['total_call_redes'];

$query_cc_datafono = $myconexion -> query ("SELECT sum(total) as total_call_datafono from factura_modificada WHERE order_date BETWEEN '$hoy' AND '$ma���ana' AND metodopago LIKE '%$datafono%' AND punto_pago != '$mostrador'"); // datafono (ventas mostrador)
$data_rd_datafono=mysqli_fetch_assoc($query_cc_datafono);
$cuenta_call_datafono = $data_rd_datafono['total_call_datafono'];

//efectivo
$query_cc_mostrador_efectivo = $myconexion -> query ("SELECT sum(total) as total_call_efectivo_mostrador from factura_modificada WHERE order_date BETWEEN '$hoy' AND '$ma���ana' AND metodopago LIKE '%$efectico%' AND punto_pago = '$mostrador'"); // efectivo (ventas mostrador)
$data_cc_efectivo_mostrador=mysqli_fetch_assoc($query_cc_mostrador_efectivo);
$cuenta_call_efectivo_mostrador = $data_cc_efectivo_mostrador['total_call_efectivo_mostrador'];

//---------------- Consulta ára determinar metodos de pago mostrador principal

$query_mostrador_bancolombia = $myconexion -> query ("SELECT sum(order_total_after_tax) as total_mostrador_bancolombia from factura_orden WHERE order_date BETWEEN '$hoy' AND '$ma���ana' AND metodopago LIKE '%$mostrador%' AND metodo_de_pago LIKE '%$callcenter%' AND estado !='$anular'"); // bancolombia
$data_cb_mostrador=mysqli_fetch_assoc($query_mostrador_bancolombia);
$cuenta_mostrador_bancolombia = $data_cb_mostrador['total_mostrador_bancolombia'];

$query_mostrador_davivienda = $myconexion -> query ("SELECT sum(order_total_after_tax) as total_mostrador_davivienda from factura_orden WHERE order_date BETWEEN '$hoy' AND '$ma���ana' AND metodopago LIKE '%$mostrador%' AND metodo_de_pago LIKE '%$davivienda%' AND estado !='$anular'"); // davivienda
$data_dv_mostrador=mysqli_fetch_assoc($query_mostrador_davivienda);
$cuenta_mostrador_davivienda = $data_dv_mostrador['total_mostrador_davivienda'];

$query_mostrador_efectivo = $myconexion -> query ("SELECT sum(order_total_after_tax) as total_mostrador_efectivo from factura_orden WHERE order_date BETWEEN '$hoy' AND '$ma���ana' AND metodopago LIKE '%$mostrador%' AND metodo_de_pago LIKE '%$efectico%' AND estado !='$anular'"); //efectivo 
$data_cd_mostrador=mysqli_fetch_assoc($query_mostrador_efectivo);
$cuenta_mostrador_efectivo = $data_cd_mostrador['total_mostrador_efectivo'];

$query_mostrador_datafono = $myconexion -> query ("SELECT sum(order_total_after_tax) as total_mostrador_datafono from factura_orden WHERE order_date BETWEEN '$hoy' AND '$ma���ana' AND metodopago LIKE '%$mostrador%' AND metodo_de_pago LIKE '%$datafono%' AND estado !='$anular'"); // datafono 
$data_ct_mostrador=mysqli_fetch_assoc($query_mostrador_datafono);
$cuenta_mostrador_datafono = $data_ct_mostrador['total_mostrador_datafono'];


//___________________ mConsulta para determinar metodo de pago mostrador d1 

$query_mostradord1_bancolombia = $myconexion -> query ("SELECT sum(order_total_after_tax) as total_mostradord1_bancolombia from factura_orden WHERE order_date BETWEEN '$hoy' AND '$ma���ana' AND metodopago LIKE '%$mostrador_d1%' AND metodo_de_pago LIKE '%$callcenter%' AND estado !='$anular'"); // bancolombia
$data_cb_mostradord1=mysqli_fetch_assoc($query_mostradord1_bancolombia);
$cuenta_mostradord1_bancolombia = $data_cb_mostradord1['total_mostradord1_bancolombia'];

$query_mostradord1_davivienda = $myconexion -> query ("SELECT sum(order_total_after_tax) as total_mostradord1_davivienda from factura_orden WHERE order_date BETWEEN '$hoy' AND '$ma���ana' AND metodopago LIKE '%$mostrador_d1%' AND metodo_de_pago LIKE '%$davivienda%' AND estado !='$anular'"); // davivienda
$data_dv_mostradord1=mysqli_fetch_assoc($query_mostradord1_davivienda);
$cuenta_mostradord1_davivienda = $data_dv_mostradord1['total_mostradord1_davivienda'];

$query_mostradord1_efectivo = $myconexion -> query ("SELECT sum(order_total_after_tax) as total_mostradord1_efectivo from factura_orden WHERE order_date BETWEEN '$hoy' AND '$ma���ana' AND metodopago LIKE '%$mostrador_d1%' AND metodo_de_pago LIKE '%$efectico%' AND estado !='$anular'"); //efectivo 
$data_cd_mostradord1=mysqli_fetch_assoc($query_mostradord1_efectivo);
$cuenta_mostradord1_efectivo = $data_cd_mostradord1['total_mostradord1_efectivo'];

$query_mostradord1_datafono = $myconexion -> query ("SELECT sum(order_total_after_tax) as total_mostradord1_datafono from factura_orden WHERE order_date BETWEEN '$hoy' AND '$ma���ana' AND metodopago LIKE '%$mostrador_d1%' AND metodo_de_pago LIKE '%$datafono%' AND estado !='$anular'"); // datafono 
$data_ct_mostradord1=mysqli_fetch_assoc($query_mostradord1_datafono);
$cuenta_mostradord1_datafono = $data_ct_mostradord1['total_mostradord1_datafono'];


//___________________________CONSULTA PARA DETERMINAR EL METODO DE PAGO MOSTRADOR IBAGUE 1

$query_ibague_bancolombia = $myconexion -> query ("SELECT sum(order_total_after_tax) as total_ibague_bancolombia from factura_orden WHERE order_date BETWEEN '$hoy' AND '$ma���ana' AND metodopago LIKE '%$ibague1%' AND metodo_de_pago LIKE '%$callcenter%' AND estado !='$anular'"); // bancolombia
$data_cb_ibague=mysqli_fetch_assoc($query_ibague_bancolombia);
$cuenta_ibague_bancolombia = $data_cb_ibague['total_ibague_bancolombia'];

$query_ibague_davivienda = $myconexion -> query ("SELECT sum(order_total_after_tax) as total_ibague_davivienda from factura_orden WHERE order_date BETWEEN '$hoy' AND '$ma���ana' AND metodopago LIKE '%$ibague1%' AND metodo_de_pago LIKE '%$davivienda%' AND estado !='$anular'"); // davivienda
$data_dv_ibague=mysqli_fetch_assoc($query_ibague_davivienda);
$cuenta_ibague_davivienda = $data_dv_ibague['total_ibague_davivienda'];

$query_ibague_efectivo = $myconexion -> query ("SELECT sum(order_total_after_tax) as total_ibague_efectivo from factura_orden WHERE order_date BETWEEN '$hoy' AND '$ma���ana' AND metodopago LIKE '%$ibague1%' AND metodo_de_pago LIKE '%$efectico%' AND estado !='$anular'"); //efectivo 
$data_cd_ibague=mysqli_fetch_assoc($query_ibague_efectivo);
$cuenta_ibague_efectivo = $data_cd_ibague['total_ibague_efectivo'];

$query_ibague_datafono = $myconexion -> query ("SELECT sum(order_total_after_tax) as total_ibague_datafono from factura_orden WHERE order_date BETWEEN '$hoy' AND '$ma���ana' AND metodopago LIKE '%$ibague1%' AND metodo_de_pago LIKE '%$datafono%' AND estado !='$anular'"); // datafono 
$data_ct_ibague=mysqli_fetch_assoc($query_ibague_datafono);
$cuenta_ibague_datafono = $data_ct_ibague['total_ibague_datafono'];

//___________________________CONSULTA PARA DETERMINAR EL METODO DE PAGO MOSTRADOR IBAGUE 2

$query_ibague2_bancolombia = $myconexion -> query ("SELECT sum(order_total_after_tax) as total_ibague2_bancolombia from factura_orden WHERE order_date BETWEEN '$hoy' AND '$ma���ana' AND metodopago LIKE '%$ibague2%' AND metodo_de_pago LIKE '%$callcenter%' AND estado !='$anular'"); // bancolombia
$data_cb_ibague2=mysqli_fetch_assoc($query_ibague2_bancolombia);
$cuenta_ibague2_bancolombia = $data_cb_ibague2['total_ibague2_bancolombia'];

$query_ibague2_davivienda = $myconexion -> query ("SELECT sum(order_total_after_tax) as total_ibague2_davivienda from factura_orden WHERE order_date BETWEEN '$hoy' AND '$ma���ana' AND metodopago LIKE '%$ibague2%' AND metodo_de_pago LIKE '%$davivienda%' AND estado !='$anular'"); // davivienda
$data_dv_ibague2=mysqli_fetch_assoc($query_ibague2_davivienda);
$cuenta_ibague2_davivienda = $data_dv_ibague2['total_ibague2_davivienda'];

$query_ibague2_efectivo = $myconexion -> query ("SELECT sum(order_total_after_tax) as total_ibague2_efectivo from factura_orden WHERE order_date BETWEEN '$hoy' AND '$ma���ana' AND metodopago LIKE '%$ibague2%' AND metodo_de_pago LIKE '%$efectico%' AND estado !='$anular'"); //efectivo 
$data_cd_ibague2=mysqli_fetch_assoc($query_ibague2_efectivo);
$cuenta_ibague2_efectivo = $data_cd_ibague2['total_ibague2_efectivo'];

$query_ibague2_datafono = $myconexion -> query ("SELECT sum(order_total_after_tax) as total_ibague2_datafono from factura_orden WHERE order_date BETWEEN '$hoy' AND '$ma���ana' AND metodopago LIKE '%$ibague2%' AND metodo_de_pago LIKE '%$datafono%' AND estado !='$anular'"); // datafono 
$data_ct_ibague2=mysqli_fetch_assoc($query_ibague2_datafono);
$cuenta_ibague2_datafono = $data_ct_ibague2['total_ibague2_datafono'];

//--------------------------- MONTO AL finalizar dia 
$query_mostrador_F_E = $myconexion -> query ("SELECT sum(monto) as total_mostrador_F_E from finish_day WHERE order_date BETWEEN '$today' AND '$tomo' AND punto_venta LIKE '%$mostrador%'"); // SUMA DEL MONTO MOSTRADOR PRINCIPAL
$mostrador_F_E=mysqli_fetch_assoc($query_mostrador_F_E);
$suma_mostrador_F_E = $mostrador_F_E['total_mostrador_F_E'];

$query_ibague1_F_E = $myconexion -> query ("SELECT sum(monto) as total_ibague1_F_E from finish_day WHERE order_date BETWEEN '$today' AND '$tomo' AND punto_venta LIKE '%$ibague1%'"); // SUMA DEL MONTO MOSTRADOR IBAGUE
$mostrador_ibague1_F_E=mysqli_fetch_assoc($query_ibague1_F_E);
$suma_ibague1_F_E = $mostrador_ibague1_F_E['total_ibague1_F_E'];

$query_ibague2_F_E = $myconexion -> query ("SELECT sum(monto) as total_ibague2_F_E from finish_day WHERE order_date BETWEEN '$today' AND '$tomo' AND punto_venta LIKE '%$ibague2%'"); // SUMA DEL MONTO MOSTRADOR IBAGUE 2
$mostrador_ibague2_F_E=mysqli_fetch_assoc($query_ibague2_F_E);
$suma_ibague2_F_E = $mostrador_ibague2_F_E['total_ibague2_F_E'];

$query_d1_F_E = $myconexion -> query ("SELECT sum(monto) as total_d1_F_E from finish_day WHERE order_date BETWEEN '$today' AND '$tomo' AND punto_venta LIKE '%$mostrador_d1%'"); // SUMA DEL MONTO MOSTRADOR IBAGUE 2
$mostrador_d1_F_E=mysqli_fetch_assoc($query_d1_F_E);
$suma_d1_F_E = $mostrador_d1_F_E['total_d1_F_E'];

//-------------------------NOVEDADES 
 $query_novedades_mostrador = "SELECT * FROM novedades_gastos WHERE order_date LIKE '%$hoy%' AND punto_venta LIKE '%Mostrador%'";
 $statement = $connect->prepare($query_novedades_mostrador);
 $statement->execute();
 $resultado_novedades_mostrador = $statement->fetchAll(); // (Mostrador principal)
 
 $query_novedades_ibague1 = "SELECT * FROM novedades_gastos WHERE order_date LIKE '%$hoy%' AND user_id = 26";
 $statement = $connect->prepare($query_novedades_ibague1);
 $statement->execute();
 $resultado_novedades_ibague1 = $statement->fetchAll(); //(IBAGUE 1)

 $query_novedades_ibague2 = "SELECT * FROM novedades_gastos WHERE order_date LIKE '%$hoy%' AND punto_venta LIKE '%ibague 2%'";
 $statement = $connect->prepare($query_novedades_ibague2);
 $statement->execute();
 $resultado_novedades_ibague2 = $statement->fetchAll(); //(IBAGUE 2)
 
 $query_novedades_d1 = "SELECT * FROM novedades_gastos WHERE order_date LIKE '%$hoy%' AND user_id = 9";
 $statement = $connect->prepare($query_novedades_d1);
 $statement->execute();
 $resultado_novedades_d1 = $statement->fetchAll(); //(MOstrador D1)

//-----------------------CONSULTANDO LAS COTIZACIONES QUE TIENEN ABONOS Y / O DESCUENTOS 
//-................ PRIMERO LOS DECUENTOS 


 $query_descuentos_mostrador = "SELECT * FROM factura_orden WHERE order_date BETWEEN '$hoy' AND '$ma���ana' AND metodopago = '$mostrador' AND estado !='$anular' AND order_tax_per != '' AND order_tax_per != 0";
 $statement = $connect->prepare($query_descuentos_mostrador);
 $statement->execute();
 $resultado_descuento_mostrador = $statement->fetchAll();  //(MOSTRADOR PRINCIPAL) 
 
 $query_descuentos_mostrador_D1 = "SELECT * FROM factura_orden WHERE order_date BETWEEN '$hoy' AND '$ma���ana' AND metodopago = '$mostrador_d1' AND estado !='$anular' AND order_tax_per != '' AND order_tax_per != 0";
 $statement = $connect->prepare($query_descuentos_mostrador_D1);
 $statement->execute();
 $resultado_descuento_mostrador_D1 = $statement->fetchAll();  //(MOSTRADOR D1) 
 
//  $query_descuentos_call = "SELECT * FROM factura_orden WHERE order_date BETWEEN '$hoy' AND '$ma���ana' AND metodopago = '$mostrador' AND estado =='$status' AND order_tax_per != '' AND order_tax_per != 0";
//  $statement = $connect->prepare($query_descuentos_mostrador);
//  $statement->execute();
//  $resultado_descuento_mostrador = $statement->fetchAll();  //(MOSTRADOR CALL) (ESTE TIENE QUE SER UN INNER JOIN CON LA TABLA FACTURA_MODIFICADA)
 
 $query_descuentos_ibague1 = "SELECT * FROM factura_orden WHERE order_date BETWEEN '$hoy' AND '$ma���ana' AND metodopago = '$ibague1' AND estado !='$anular' AND order_tax_per != '' AND order_tax_per != 0";
 $statement = $connect->prepare($query_descuentos_ibague1);
 $statement->execute();
 $resultado_descuento_ibague1 = $statement->fetchAll();  //(MOSTRADOR IB1) 
 
 $query_descuentos_ibague2 = "SELECT * FROM factura_orden WHERE order_date BETWEEN '$hoy' AND '$ma���ana' AND metodopago = '$ibague2' AND estado !='$anular' AND order_tax_per != '' AND order_tax_per != 0";
 $statement = $connect->prepare($query_descuentos_ibague2);
 $statement->execute();
 $resultado_descuento_ibague2 = $statement->fetchAll();  //(MOSTRADOR IB2) 


//__________________ABONOS DE MERCANCIA__________________________________________________________________

//______________________________________________ VAMOS A INICIAR CON IBAGUE 2____________________________




//---------------------------------------------------------------------------------------------------------

 $output = '
 <div class="table-responsive">
  <table class="table table-striped table-bordered">
   <tr>
    <th BGCOLOR="#FAC9BB">Fecha</th>
    <th BGCOLOR="#FAC9BB">Cotizacion</th>
    <th BGCOLOR="#FAC9BB">Cliente</th>
    <th BGCOLOR="#FAC9BB">Comercial</th>
    <th BGCOLOR="#FAC9BB">Metodo de pago</th>
    <th BGCOLOR="#FAC9BB">Monto</th>
   </tr>
 ';
 $output .= '
   <tr>
    <th colspan="6">MOSTRADOR PRINCIPAL</th>

   </tr>
 ';
 foreach($result as $row) //mostrador principal
 {

$monto_mostrador_p = 0;
$valor_mostrador = empty($row['order_total_after_tax']) ? 0 : $row['order_total_after_tax'];
$monto_mostrador_p = $valor_mostrador;

  $total_mostrador += $monto_mostrador_p;
  $monto_x = "";
  $total_tax = $row["order_total_after_tax"];
  $total_desc = $row["order_total_amount_due"];
  
  if($total_desc == "0" || $total_desc == ""){
      $monto_x = $row["order_total_after_tax"];
  }else{
      $monto_x = $row["order_total_amount_due"];
  }


  $output .= '
   <tr>
    <td BGCOLOR="#FAEBE7">'.$row["order_date"].'</td>
    <td BGCOLOR="#FAEBE7">'.$row["order_id"].'</td>
    <td BGCOLOR="#FAEBE7">'.$row["order_receiver_name"].'</td>
    <td BGCOLOR="#FAEBE7">'.$row["order_receiver_address"].'</td>
    <td BGCOLOR="#FAEBE7">'.$row["metodo_de_pago"].'</td>
    <td BGCOLOR="#FAEBE7">'.formatear($monto_x).'</td>
   </tr>
  ';
 }
 
  $output .= '
   <tr>
    <th colspan="6">Ventas Call Center Pago Mostrador</th>
   </tr>
 ';
 
 foreach($resultante as $row_cm) //ventas call center canceladas en mostrador
 {

//cuenta mostrador call center 

$monto_mostrador_cl = 0;
$valor_mostrador_cl = empty($row_cm['total']) ? 0 : $row_cm['total'];
$monto_mostrador_cl = $valor_mostrador_cl;
$total_mostrador_cl += $monto_mostrador_cl;


  $output .= '
   <tr>
    <td BGCOLOR="#FAEBE7">'.$row_cm["order_date"].'</td>
    <td BGCOLOR="#FAEBE7">'.$row_cm["order_id"].'</td>
    <td BGCOLOR="#FAEBE7">'.$row_cm["order_receiver_name"].'</td>
    <td BGCOLOR="#FAEBE7">'.$row_cm["comercial"].'</td>
    <td BGCOLOR="#FAEBE7">'.$row_cm["metodopago"].'</td>
    <td BGCOLOR="#FAEBE7">'.formatear($row_cm["total"]).'</td>
   </tr>
  ';
 }
 
 //COTIZACIONES CON DESCUENTO
 
 
    $output .= '
   <tr>
    <th colspan="6">COTIZACIONES CON DESCUENTO</th>
   </tr>
 ';   
 
 $output .= '
   <tr>
    <th>FECHA</th>
    <th>COTIZACION</th>
    <th>CLIENTE</th>
    <th>COMERCIAL</th>
    <th>MONTO TOTAL</th>
    <th>PORCENTAJE</th>
    <th>Total con DESCUENTO</th>
   </tr>
 ';
  foreach($resultado_descuento_mostrador as $row_descuento_mp) //ventas call center canceladas en mostrador
 {

//cuenta mostrador call center 

// $monto_mostrador_cl = 0;
// $valor_mostrador_cl = empty($row_descuento_mp['total']) ? 0 : $row_descuento_mp['total'];
// $monto_mostrador_cl = $valor_mostrador_cl;
// $total_mostrador_cl += $monto_mostrador_cl;


  $output .= '
   <tr>
    <td BGCOLOR="#FAEBE7">'.$row_descuento_mp["order_date"].'</td>
    <td BGCOLOR="#FAEBE7">'.$row_descuento_mp["order_id"].'</td>
    <td BGCOLOR="#FAEBE7">'.$row_descuento_mp["order_receiver_name"].'</td>
    <td BGCOLOR="#FAEBE7">'.$row_descuento_mp["order_receiver_address"].'</td>
    <td BGCOLOR="#FAEBE7">'.$row_descuento_mp["order_total_after_tax"].'</td>
    <td BGCOLOR="#FAEBE7">'.$row_descuento_mp["order_tax_per"].'</td>
    <td BGCOLOR="#FAEBE7">'.formatear($row_descuento_mp["order_total_amount_due"]).'</td>
   </tr>
  ';
 }
 
 //FIN DESCUENTOS
  //GASTOS Y NOVEDADES
  
 
    $output .= '
   <tr>
    <th colspan="5">Gastos y Novedades</th>
   </tr>
 ';   
 
   $output .= '
   <tr>
    <th>FECHA</th>
    <th>LUGAR</th>
    <th>USUARIO</th>
    <th>NOVEDAD</th>
    <th>MONTO TOTAL</th>
   </tr>
 ';
 
  foreach($resultado_novedad_mostrador as $row_novedad_mp) // Novedades Mostrador
 {

//cuenta mostrador call center 

$monto_mostrador_nm = 0;
$valor_mostrador_nm = empty($row_novedad_mp['monto']) ? 0 : $row_novedad_mp['monto'];
$monto_mostrador_nm = $valor_mostrador_nm;
$total_mostrador_nm += $monto_mostrador_nm;


  $output .= '
   <tr>
    <td BGCOLOR="#FAEBE7">'.$row_novedad_mp["order_date"].'</td>
    <td BGCOLOR="#FAEBE7">'.$row_novedad_mp["punto_venta"].'</td>
    <td BGCOLOR="#FAEBE7">'.$row_novedad_mp["usuario"].'</td>
    <td BGCOLOR="#FAEBE7">'.$row_novedad_mp["novedad"].'</td>
    <td BGCOLOR="#FAEBE7">'.formatear($row_novedad_mp["monto"]).'</td>
   </tr>
  ';
 }



 //INICIO DE COTIZACIONES QUE CONTIENEN ABONOS 
 
 
 //METODOS DE PAGO MOSTRADOR
 
   $output .= '
   <tr>
    <th colspan="6">METODOS DE PAGO</th>
   </tr>
 ';
 
   $output .= '
   <tr>
    <th colspan="3">COTIZAR</th>
    <th colspan="3">CAJA</th>
   </tr>
 ';
  
    $output .= '
   <tr>
     <th colspan="3">
     Bancolombia:'.formatear($cuenta_mostrador_bancolombia).'<hr />
     Davivienda:'.formatear($cuenta_mostrador_davivienda).'<hr />
     Efectivo:'.formatear($cuenta_mostrador_efectivo).'<hr />
     Datafono:'.formatear($cuenta_mostrador_datafono + $cuenta_mostradord1_datafono + $cuenta_call_datafono).'<hr />
     Call Center:'.formatear($total_mostrador_cl).'<hr />
     TOTAL MOSTRADOR:'.formatear($total_mostrador).'<hr />
     TOTAL MOSTRADOR + CALL:'.formatear($cuenta_call_efectivo_mostrador + $total_mostrador).'
     </th>
     
  <th colspan="3">
     Bancolombia:'.formatear($cuenta_mostrador_bancolombia).'<hr />
     Davivienda:'.formatear($cuenta_mostrador_davivienda).'<hr />
     Efectivo Caja:'.formatear($suma_mostrador_F_E).'<hr />
     Datafono:'.formatear($cuenta_mostrador_datafono + $cuenta_mostradord1_datafono + $cuenta_call_datafono).'<hr />
     Call Center:'.formatear($total_mostrador_cl).'<hr />
     TOTAL MOSTRADOR SEGUN CAJA:'.formatear($cuenta_mostrador_bancolombia + $cuenta_mostrador_davivienda + $suma_mostrador_F_E + $cuenta_mostrador_datafono + $cuenta_mostradord1_datafono + $cuenta_call_datafono + $cuenta_call_efectivo_mostrador ).'

     </th>
    
   </tr>
 ';
  $caja = $cuenta_mostrador_bancolombia + $cuenta_mostrador_davivienda + $suma_mostrador_F_E + $cuenta_mostrador_datafono + $cuenta_mostradord1_datafono + $cuenta_call_datafono + $total_mostrador_cl;
  $cotizar = $total_mostrador + $total_mostrador_cl;
  
   $output .= '
   <tr>
    <th colspan="3">DIFERENCIA ENTRE TOTAL CAJA Y TOTAL COTIZAR:</th>
    <th colspan="3"> '.formatear($cotizar - $caja).' </th>
   </tr>
 ';
 //intentando incertar la otra columna


 
 
  $output .= '
   <tr>
    <th>Ventas Totales: </th>
    <th>'.$cuenta_mostrador.'</th>
    <th>Monto Total:'.formatear($total_mostrador).' </th>
    <th>Monto Call:'.formatear($total_mostrador_cl).'  </th>
    <th colspan="2">TOTAL MOSTRADOR:'.formatear($total_mostrador_cl + $total_mostrador).'  </th>
    
   </tr>
 ';
 


 $output .= '
  </table>
 </div>
 ';
 $output .= '
 <div class="table-responsive">
  <table class="table table-striped table-bordered">
   <tr>
    <th BGCOLOR="#A2DBFF">Fecha</th>
    <th BGCOLOR="#A2DBFF">Cotizacion</th>
    <th BGCOLOR="#A2DBFF">Cliente</th>
    <th BGCOLOR="#A2DBFF">Comercial</th>
    <th BGCOLOR="#A2DBFF">Metodo de pago</th>
    <th BGCOLOR="#A2DBFF">Monto</th>
   </tr>
 ';
 $output .= '
   <tr>
    <th colspan="5">Call Center</th>
   </tr>
 ';
 //callcenter
 foreach($resultado_call as $row_call)
 {
   $monto_calls = 0;
   $valor_call = $row_call["total"];
   $monto_call = $valor_call;
   $total_call += $monto_call;
   $output .= '
    <tr>
     <td BGCOLOR="#D8F0FF">'.$row_call["order_date"].'</td>
     <td BGCOLOR="#D8F0FF">'.$row_call["order_id"].'</td>
     <td BGCOLOR="#D8F0FF">'.$row_call["order_receiver_name"].'</td>
     <td BGCOLOR="#D8F0FF">'.$row_call["comercial"].'</td>
     <td BGCOLOR="#D8F0FF">'.$row_call["metodopago"].'</td>
     <td BGCOLOR="#D8F0FF">'.formatear($row_call["total"]).'</td>
    </tr>
   ';
 }
 
  $output .= '
   <tr>
    <th colspan="6">METODOS DE PAGO</th>
   </tr>
 ';
 
 
 //METODOS DE PAGO CALL CENTER 
   $output .= '
   <tr>
    <th>Bancolombia</th>
    <th>Davivienda</th>
    <th>Mercado Libre</th>
    <th>Credito</th>
    <th>Contra Entrega</th>
    <th>Redes Sociales</th>
   </tr>
 ';
 
    $output .= '
   <tr>
    <th>'.formatear($cuenta_call_bancolombia).'</th>
    <th>'.formatear($cuenta_call_davivienda).'</th>
    <th>'.formatear($cuenta_call_mercado).'</th>
    <th>'.formatear($cuenta_call_credito).'</th>
    <th>'.formatear($cuenta_call_contra).'</th>
    <th>'.formatear($cuenta_call_redes).'</th>
   </tr>
 ';
 
   $output .= '
   <tr>
    <th>Ventas Totales: </th>
    <th colspan="2">'.$cuenta_call.'</th>
    <th colspan="2">Monto Total Call Center: </th>
    <th>'.formatear($total_call).'</th>


   </tr>
 ';
 
 
 $output .= '
  </table>
 </div>
 ';

 // d1
 $output .= '
 <div class="table-responsive">
  <table class="table table-striped table-bordered">
   <tr>
    <th BGCOLOR="#AFF7DD">Fecha</th>
    <th BGCOLOR="#AFF7DD">Cotizacion</th>
    <th BGCOLOR="#AFF7DD">Cliente</th>
    <th BGCOLOR="#AFF7DD">Comercial</th>
    <th BGCOLOR="#AFF7DD">Metodo de pago</th>
    <th BGCOLOR="#AFF7DD">Monto</th>
   </tr>
 ';
 $output .= '
   <tr>
    <th colspan="5">Mostrador D1</th>
   </tr>
 ';
 //mostrador d1
 foreach($resultado_d1 as $row_d1)
 {
   $monto_d1 = 0;
   $valor_d1 = $row_d1["order_total_after_tax"];
   $monto_d1 = $valor_d1;
   $total_d1 += $monto_d1;
  $monto_x = "";
  $total_tax = $row_d1["order_total_after_tax"];
  $total_desc = $row_d1["order_total_amount_due"];
  
  if($total_desc == "0" || $total_desc == ""){
      $monto_x = $row_d1["order_total_after_tax"];
  }else{
      $monto_x = $row_d1["order_total_amount_due"];
  }
   
   $output .= '
    <tr>
     <td BGCOLOR="#D8FFEB">'.$row_d1["order_date"].'</td>
     <td BGCOLOR="#D8FFEB">'.$row_d1["order_id"].'</td>
     <td BGCOLOR="#D8FFEB">'.$row_d1["order_receiver_name"].'</td>
     <td BGCOLOR="#D8FFEB">'.$row_d1["order_receiver_address"].'</td>
     <td BGCOLOR="#D8FFEB">'.$row_d1["metodo_de_pago"].'</td>
     <td BGCOLOR="#D8FFEB">'.formatear($monto_x).'</td>
    </tr>
   ';
 }
 
  //COTIZACIONES CON DESCUENTO
 
 
    $output .= '
   <tr>
    <th colspan="6">COTIZACIONES CON DESCUENTO</th>
   </tr>
 ';   
 
 $output .= '
   <tr>
    <th>FECHA</th>
    <th>COTIZACION</th>
    <th>CLIENTE</th>
    <th>COMERCIAL</th>
    <th>MONTO TOTAL</th>
    <th>PORCENTAJE</th>
    <th>Total con DESCUENTO</th>
   </tr>
 ';
  foreach($resultado_descuento_mostrador_D1 as $row_descuento_md1) //ventas call center canceladas en mostrador
 {

//cuenta mostrador call center 

// $monto_mostrador_cl = 0;
// $valor_mostrador_cl = empty($row_descuento_mp['total']) ? 0 : $row_descuento_mp['total'];
// $monto_mostrador_cl = $valor_mostrador_cl;
// $total_mostrador_cl += $monto_mostrador_cl;


  $output .= '
   <tr>
    <td BGCOLOR="#FAEBE7">'.$row_descuento_md1["order_date"].'</td>
    <td BGCOLOR="#FAEBE7">'.$row_descuento_md1["order_id"].'</td>
    <td BGCOLOR="#FAEBE7">'.$row_descuento_md1["order_receiver_name"].'</td>
    <td BGCOLOR="#FAEBE7">'.$row_descuento_md1["order_receiver_address"].'</td>
    <td BGCOLOR="#FAEBE7">'.$row_descuento_md1["order_total_after_tax"].'</td>
    <td BGCOLOR="#FAEBE7">'.$row_descuento_md1["order_tax_per"].'</td>
    <td BGCOLOR="#FAEBE7">'.formatear($row_descuento_md1["order_total_amount_due"]).'</td>
   </tr>
  ';
 }
 
 //FIN DESCUENTOS
 
 
  //METODOS DE PAGO MOSTRADOR d1
 
   $output .= '
   <tr>
    <th colspan="6">METODOS DE PAGO</th>
   </tr>
 ';
 
    $output .= '
   <tr>
    <th colspan="3">COTIZAR</th>
    <th colspan="3">CAJA</th>
   </tr>
 ';
  
    $output .= '
   <tr>
     <th colspan="3">
     Bancolombia:'.formatear($cuenta_mostradord1_bancolombia).'<hr />
     Davivienda:'.formatear($cuenta_mostradord1_davivienda).'<hr />
     Efectivo:'.formatear($cuenta_mostradord1_efectivo).'<hr />
     Datafono:'.formatear($cuenta_mostradord1_datafono).'<hr />
     TOTAL MOSTRADOR D1:'.formatear($total_d1).'
     </th>
     
  <th colspan="3">
     Bancolombia:'.formatear($cuenta_mostradord1_bancolombia).'<hr />
     Davivienda:'.formatear($cuenta_mostradord1_davivienda).'<hr />
     Efectivo Caja:'.formatear($suma_d1_F_E).'<hr />
     Datafono:'.formatear($cuenta_mostradord1_datafono).'<hr />
     TOTAL MOSTRADOR SEGUN CAJA:'.formatear($cuenta_mostradord1_bancolombia + $cuenta_mostradord1_davivienda + $cuenta_mostradord1_datafono ).'

     </th>
    
   </tr>
 ';
 
 
   $output .= '
   <tr>
    <th>Bancolombia</th>
    <th>Davivienda</th>
    <th colspan="2">Efectivo</th>
    <th colspan="2">Datafono</th>
   </tr>
 ';
 
    $output .= '
   <tr>
    <th>'.formatear($cuenta_mostradord1_bancolombia).'</th>
    <th>'.formatear($cuenta_mostradord1_davivienda).'</th>
    <th colspan="2">'.formatear($cuenta_mostradord1_efectivo).'</th>
    <th colspan="2">'.formatear($cuenta_mostradord1_datafono).'</th>
   </tr>
 ';

 $output .= '
   <tr>
    <th>Ventas Totales: </th>
    <th>'.$cuenta_d1.'</th>
    <th colspan="3">Monto Total: </th>
    <th>'.formatear($total_d1).'</th>

   </tr>
 ';


 $output .= '
  </table>
 </div>
 ';
//$ibague1
$output .= '
<div class="table-responsive">
 <table class="table table-striped table-bordered">
  <tr>
   <th BGCOLOR="#FEB5BF">Fecha</th>
   <th BGCOLOR="#FEB5BF">Cotizacion</th>
   <th BGCOLOR="#FEB5BF">Cliente</th>
   <th BGCOLOR="#FEB5BF">Comercial</th>
   <th BGCOLOR="#FEB5BF">Metodo de pago</th>
   <th BGCOLOR="#FEB5BF">Monto</th>
  </tr>
';
$output .= '
  <tr>
   <th colspan="5">Mostrador Ibague 1</th>
  </tr>
';

//ibague 1
foreach($resultado_ibague1 as $row_i1)
{
  $monto_i1 = 0;
  $valor_i1 = $row_i1["order_total_after_tax"];
  $monto_i1 = $valor_i1;
  $total_ib1 += $monto_i1;
    $monto_x = "";
  $total_tax = $row_i1["order_total_after_tax"];
  $total_desc = $row_i1["order_total_amount_due"];
  
  if($total_desc == "0" || $total_desc == ""){
      $monto_x = $row_i1["order_total_after_tax"];
  }else{
      $monto_x = $row_i1["order_total_amount_due"];
  }
  

  $output .= '
   <tr>
    <td BGCOLOR="#FAF0F1">'.$row_i1["order_date"].'</td>
    <td BGCOLOR="#FAF0F1">'.$row_i1["order_id"].'</td>
    <td BGCOLOR="#FAF0F1">'.$row_i1["order_receiver_name"].'</td>
    <td BGCOLOR="#FAF0F1">'.$row_i1["order_receiver_address"].'</td>
    <td BGCOLOR="#FAF0F1">'.$row_i1["metodo_de_pago"].'</td>
    <td BGCOLOR="#FAF0F1">'.formatear($monto_x).'</td>
   </tr>
  ';
}

 
  //COTIZACIONES CON DESCUENTO
 
 
    $output .= '
   <tr>
    <th colspan="6">COTIZACIONES CON DESCUENTO</th>
   </tr>
 ';   
 
 $output .= '
   <tr>
    <th>FECHA</th>
    <th>COTIZACION</th>
    <th>CLIENTE</th>
    <th>COMERCIAL</th>
    <th>MONTO TOTAL</th>
    <th>PORCENTAJE</th>
    <th>Total con DESCUENTO</th>
   </tr>
 ';
  foreach($resultado_descuento_ibague1 as $row_descuento_ibague1) //ventas call center canceladas en mostrador
 {

//cuenta mostrador call center 

// $monto_mostrador_cl = 0;
// $valor_mostrador_cl = empty($row_descuento_mp['total']) ? 0 : $row_descuento_mp['total'];
// $monto_mostrador_cl = $valor_mostrador_cl;
// $total_mostrador_cl += $monto_mostrador_cl;


  $output .= '
   <tr>
    <td BGCOLOR="#FAEBE7">'.$row_descuento_ibague1["order_date"].'</td>
    <td BGCOLOR="#FAEBE7">'.$row_descuento_ibague1["order_id"].'</td>
    <td BGCOLOR="#FAEBE7">'.$row_descuento_ibague1["order_receiver_name"].'</td>
    <td BGCOLOR="#FAEBE7">'.$row_descuento_ibague1["order_receiver_address"].'</td>
    <td BGCOLOR="#FAEBE7">'.$row_descuento_ibague1["order_total_after_tax"].'</td>
    <td BGCOLOR="#FAEBE7">'.$row_descuento_ibague1["order_tax_per"].'</td>
    <td BGCOLOR="#FAEBE7">'.formatear($row_descuento_ibague1["order_total_amount_due"]).'</td>
   </tr>
  ';
 }
 
 //FIN DESCUENTOS
 

//METODOS DE PAGO MOSTRADOR ibague 1
 
   $output .= '
   <tr>
    <th colspan="6">METODOS DE PAGO</th>
   </tr>
 ';
    $output .= '
   <tr>
    <th colspan="3">COTIZAR</th>
    <th colspan="3">CAJA</th>
   </tr>
 ';
  
    $output .= '
   <tr>
     <th colspan="3">
     Bancolombia:'.formatear($cuenta_ibague_bancolombia).'<hr />
     Davivienda:'.formatear($cuenta_ibague_davivienda).'<hr />
     Efectivo:'.formatear($cuenta_ibague_efectivo).'<hr />
     Datafono:'.formatear($cuenta_ibague_datafono).'<hr />
     TOTAL MOSTRADOR IBAGUE 1:'.formatear($total_ib1).'
     </th>
     
  <th colspan="3">
     Bancolombia:'.formatear($cuenta_ibague_bancolombia).'<hr />
     Davivienda:'.formatear($cuenta_ibague_davivienda).'<hr />
     Efectivo Caja:'.formatear($suma_ibague1_F_E).'<hr />
     Datafono:'.formatear($cuenta_ibague_datafono).'<hr />
     TOTAL MOSTRADOR SEGUN CAJA:'.formatear($cuenta_ibague_bancolombia + $cuenta_ibague_davivienda + $suma_ibague1_F_E + $cuenta_ibague_datafono ).'

     </th>
    
   </tr>
 ';
 
   $caja_ib1 = $cuenta_ibague_bancolombia + $cuenta_ibague_davivienda + $suma_ibague1_F_E + $cuenta_ibague_datafono;
  $cotizar_ib1 = $total_ib1;
  
   $output .= '
   <tr>
    <th colspan="3">DIFERENCIA ENTRE TOTAL CAJA Y TOTAL COTIZAR:</th>
    <th colspan="3"> '.formatear($cotizar_ib1 - $caja_ib1).' </th>
   </tr>
 ';
 
   $output .= '
   <tr>
    <th>Bancolombia</th>
    <th>Davivienda</th>
    <th colspan="2">Efectivo</th>
    <th colspan="2">Datafono</th>
   </tr>
 ';
 
    $output .= '
   <tr>
    <th>'.formatear($cuenta_ibague_bancolombia).'</th>
    <th>'.formatear($cuenta_ibague_davivienda).'</th>
    <th colspan="2">'.formatear($cuenta_ibague_efectivo).'</th>
    <th colspan="2">'.formatear($cuenta_ibague_datafono).'</th>
   </tr>
 ';



 $output .= '
   <tr>
    <th>Ventas Totales: </th>
    <th>'.$cuenta_ib1.'</th>
    <th colspan="2">Monto Total: </th>
    <th colspan="2">'.formatear($total_ib1).'</th>

   </tr>
 ';


$output .= '
 </table>
</div>
';


//ibague2
$output .= '
<div class="table-responsive">
 <table class="table table-striped table-bordered">
  <tr>
   <th BGCOLOR="#FCD7A1">Fecha</th>
   <th BGCOLOR="#FCD7A1">Cotizacion</th>
   <th BGCOLOR="#FCD7A1">Cliente</th>
   <th BGCOLOR="#FCD7A1">Comercial</th>
   <th BGCOLOR="#FCD7A1">Metodo de pago</th>
   <th BGCOLOR="#FCD7A1">Monto</th>
  </tr>
';
$output .= '
  <tr>
   <th colspan="5">Mostrador Ibague 2</th>
  </tr>
';
//ibague 2
foreach($resultado_ibague2 as $row_i2)
{
  $monto_i2 = 0;
  $valor_i2 = $row_i2["order_total_after_tax"];
  $monto_i2 = $valor_i2;
  $total_ib2 += $monto_i2;
    $monto_x = "";
  $total_tax = $row_i2["order_total_after_tax"];
  $total_desc = $row_i2["order_total_amount_due"];
  
  if($total_desc == "0" || $total_desc == ""){
      $monto_x = $row_i2["order_total_after_tax"];
  }else{
      $monto_x = $row_i2["order_total_amount_due"];
  }
  
  
  $output .= '
   <tr>
    <td BGCOLOR="#FCF0DE">'.$row_i2["order_date"].'</td>
    <td BGCOLOR="#FCF0DE">'.$row_i2["order_id"].'</td>
    <td BGCOLOR="#FCF0DE">'.$row_i2["order_receiver_name"].'</td>
    <td BGCOLOR="#FCF0DE">'.$row_i2["order_receiver_address"].'</td>
    <td BGCOLOR="#FCF0DE">'.$row_i2["metodo_de_pago"].'</td>
    <td BGCOLOR="#FCF0DE">'.formatear($monto_x).'</td>
   </tr>
  ';
}

  //COTIZACIONES CON DESCUENTO
 
 
    $output .= '
   <tr>
    <th colspan="6">COTIZACIONES CON DESCUENTO</th>
   </tr>
 ';   
 
 $output .= '
   <tr>
    <th>FECHA</th>
    <th>COTIZACION</th>
    <th>CLIENTE</th>
    <th>COMERCIAL</th>
    <th>MONTO TOTAL</th>
    <th>PORCENTAJE</th>
    <th>Total con DESCUENTO</th>
   </tr>
 ';
  foreach($resultado_descuento_ibague2 as $row_descuento_ibague2) //ventas call center canceladas en mostrador
 {

//cuenta mostrador call center 

// $monto_mostrador_cl = 0;
// $valor_mostrador_cl = empty($row_descuento_mp['total']) ? 0 : $row_descuento_mp['total'];
// $monto_mostrador_cl = $valor_mostrador_cl;
// $total_mostrador_cl += $monto_mostrador_cl;


  $output .= '
   <tr>
    <td BGCOLOR="#FAEBE7">'.$row_descuento_ibague2["order_date"].'</td>
    <td BGCOLOR="#FAEBE7">'.$row_descuento_ibague2["order_id"].'</td>
    <td BGCOLOR="#FAEBE7">'.$row_descuento_ibague2["order_receiver_name"].'</td>
    <td BGCOLOR="#FAEBE7">'.$row_descuento_ibague2["order_receiver_address"].'</td>
    <td BGCOLOR="#FAEBE7">'.$row_descuento_ibague2["order_total_after_tax"].'</td>
    <td BGCOLOR="#FAEBE7">'.$row_descuento_ibague2["order_tax_per"].'</td>
    <td BGCOLOR="#FAEBE7">'.formatear($row_descuento_ibague2["order_total_amount_due"]).'</td>
   </tr>
  ';
 }
 
 //FIN DESCUENTOS




//METODOS DE PAGO IBAGUE 2
   $output .= '
   <tr>
    <th colspan="6">METODOS DE PAGO</th>
   </tr>
 ';
    $output .= '
   <tr>
    <th colspan="3">COTIZAR</th>
    <th colspan="3">CAJA</th>
   </tr>
 ';
  
    $output .= '
   <tr>
     <th colspan="3">
     Bancolombia:'.formatear($cuenta_ibague2_bancolombia).'<hr />
     Davivienda:'.formatear($cuenta_ibague2_davivienda).'<hr />
     Efectivo:'.formatear($cuenta_ibague2_efectivo).'<hr />
     Datafono:'.formatear($cuenta_ibague2_datafono).'<hr />

     TOTAL IBAGUE 2:'.formatear($total_ib2).'
     </th>
     
  <th colspan="3">
     Bancolombia:'.formatear($cuenta_ibague2_bancolombia).'<hr />
     Davivienda:'.formatear($cuenta_ibague2_davivienda).'<hr />
     Efectivo Caja:'.formatear($suma_ibague2_F_E).'<hr />
     Datafono:'.formatear($cuenta_ibague2_datafono).'<hr />
     TOTAL MOSTRADOR SEGUN CAJA:'.formatear($cuenta_ibague2_bancolombia + $cuenta_ibague2_davivienda + $suma_ibague2_F_E + $cuenta_ibague2_datafono ).'

     </th>
    
   </tr>
 ';
 
    $caja_ib2 = $cuenta_ibague2_bancolombia + $cuenta_ibague2_davivienda + $suma_ibague2_F_E + $cuenta_ibague2_datafono;
  $cotizar_ib2 = $total_ib2;
  
   $output .= '
   <tr>
    <th colspan="3">DIFERENCIA ENTRE TOTAL CAJA Y TOTAL COTIZAR:</th>
    <th colspan="3"> '.formatear($cotizar_ib2 - $caja_ib2).' </th>
   </tr>
 ';
 
 
 
   $output .= '
   <tr>
    <th>Bancolombia</th>
    <th>Davivienda</th>
    <th colspan="2">Efectivo</th>
    <th colspan="2">Datafono</th>
   </tr>
 ';
 
    $output .= '
   <tr>
    <th>'.formatear($cuenta_ibague2_bancolombia).'</th>
    <th>'.formatear($cuenta_ibague2_davivienda).'</th>
    <th colspan="2">'.formatear($cuenta_ibague2_efectivo).'</th>
    <th colspan="2">'.formatear($cuenta_ibague2_datafono).'</th>
   </tr>
 ';

 $output .= '
   <tr>
    <th>Ventas Totales: </th>
    <th>'.$cuenta_ib2.'</th>
    <th colspan="3">Monto Total: </th>
    <th>'.formatear($total_ib2).'</th>

   </tr>
 ';



$output .= '
 </table>
</div>
';

// pruebas de impresion de informacion adicional

 
$output .= '
<div class="table-responsive">
 <table class="table table-striped table-bordered">
  <tr>
   <th BGCOLOR="#FF6E62">Fecha</th>
   <th BGCOLOR="#FF6E62">Cotizacion</th>
   <th BGCOLOR="#FF6E62">Cliente</th>
   <th BGCOLOR="#FF6E62">Comercial</th>
   <th BGCOLOR="#FF6E62">Razon</th>
   <th BGCOLOR="#FF6E62">Monto</th>
  </tr>
';
$output .= '
  <tr>
   <th colspan="5">Solicitudes de anulacion</th>
  </tr>
';
foreach($solicitud_anular as $rw_anulacion)

//ibague 2each($solicitud_anular as $rw_anulacion);
{
  $monto_anulado = 0;
  $valor_anulado = $rw_anulacion["order_total_after_tax"];
  $monto_anulado = $valor_anulado;
  $total_anulado += $monto_anulado;
  $output .= '
   <tr>
    <td BGCOLOR="#CACACA">'.$rw_anulacion["order_date"].'</td>
    <td BGCOLOR="#CACACA">'.$rw_anulacion["order_id"].'</td>
    <td BGCOLOR="#CACACA">'.$rw_anulacion["order_receiver_name"].'</td>
    <td BGCOLOR="#CACACA">'.$rw_anulacion["comercial"].'</td>
    <td BGCOLOR="#CACACA">'.$rw_anulacion["razon"].'</td>
    <td BGCOLOR="#CACACA">'.formatear($rw_anulacion["order_total_after_tax"]).'</td>
   </tr>
  ';
}


 $output .= '
   <tr>
    <th>Ventas Totales: </th>
    <th>count</th>
    <th colspan="3">Monto Total: </th>
    <th>'.formatear($total_anulado).'</th>

   </tr>
 ';



$output .= '
 </table>
</div>
';






// primera tabla para saber cantidad que vendio cada punto
$output .= '
<div class="table-responsive">
 <table class="table table-striped table-bordered">
  <tr>
   <th colspan="3" BGCOLOR="#48945A">Mostrador</th>
   <th colspan="2" BGCOLOR="#48945A">Mostrador D1</th>
  </tr>
';

$output .= '
 <tr>
  <td>'."Ventas: ".$cuenta_mostrador.'</td>
  <td>'."Monto Mostrador: ".formatear($total_mostrador).'</td> 
  <td>'."Monto Callcenter: ".formatear($total_mostrador_cl).'</td>


  <td>'."Ventas: ".$cuenta_d1.'</td>
  <td>'."Monto: ".formatear($total_d1).'</td>

 </tr>
';


$output .= '
 </table>
</div>
';

//segunda tabla
$output .= '
<div class="table-responsive">
 <table class="table table-striped table-bordered">
  <tr>
   <th colspan="2" BGCOLOR="#48945A">Call Center</th>
   <th colspan="2" BGCOLOR="#E05A66">Ibague 1</th>
   <th colspan="2" BGCOLOR="#E05A66">Ibague 2</th>
  </tr>
';

$output .= '
 <tr>
  <td>'."Ventas: ".$cuenta_call.'</td>
  <td>'."Monto: ".formatear($total_call).'</td>
  <td>'."Ventas: ".$cuenta_ib1.'</td>
  <td>'."Monto: ".formatear($total_ib1).'</td>
  <td>'."Ventas: ".$cuenta_ib2.'</td>
  <td>'."Monto: ".formatear($total_ib2).'</td>
 </tr>
';



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
  <title>Reportes JJ</title>
  <script src="jquery.min.js"></script>
  <link rel="stylesheet" href="bootstrap.min.css" />
  <script src="bootstrap.min.js"></script>
  <style>
       a{
           decotarion:none;
           color:white;
       }
      
  </style>
  
  
 </head>
 <body>
  <br />
  <div class="container">
   <h3 align="center">VER REPORTES JJ QUIMIENVASES</h3>
   <br />
   <button class="btn btn-success"><a href="../index.php">Regresar al panel de administrador</a>  </button>
   <!--<form method="post">-->
   <!-- <input type="submit" name="action" class="btn btn-danger" value="PDF Send" /><?php echo $message; ?>-->
   <!--</form>-->
   <hr>
   <form method="post" action="">
         <div class="form-group">
        <center>
              <label>Seleccionar fecha inicial: </label>
            <input type="date" name="fecha_inicial" value="" class="form-control">
            <hr>
              <label>Seleccionar fecha final:</label>
            <input type="date" name="fecha_final" value="" class="form-control">
      </center>
         </div>

				<input type="submit" class="btn btn-primary" name="btn_buscar" value="Generar Reporte De Ventas">
  </form>
   <br />
   <?php
   echo fetch_customer_data($connect);

   ?>
  </div>
  <br />
  <br />
 </body>
</html>

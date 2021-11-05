<?php
include 'conexion.php';

setlocale(LC_ALL,"es_ES@euro","es_ES","esp");

$cedula = $_GET['id'];
$sql = $con->query("SELECT * FROM users_information WHERE cedula = $cedula");
foreach($sql as $data){
    $cargo = strtoUpper($data['cargo']);
    $nombre = strtoUpper($data['nombres']);
    $telefono = $data['telefono'];
    $direccion = strtoUpper($data['direccion']);
    $ciudad = strtoUpper($data['ciudad']);
    $email = strtoUpper($data['email']);
    $afp = strtoUpper($data['afp']);
    $eps = strtoUpper($data['eps']);
    $fecha_inicio = $data['prestacion_inicio'];
    $fecha_final = $data['prestacion_final'];
    $fecha_1 = strftime("%d de %B de %Y", strtotime($fecha_inicio));
     $fecha_2 = strftime("%d de %B de %Y", strtotime($fecha_final));
}

$output = '';

$output .='
<link href="css/style_dom.css" rel="stylesheet" type="text/css"   media="screen" />
<img src="head.jpg">
<center><b>CONTRATO DE PRESTACIÓN DE SERVICIOS</b></center>
<br>
<p>
Entre los suscritos a saber: <b>JORGE EDUARDO AVILA</b> mayor de edad, identificado con la con la cédula de ciudadanía Nº 79487270 de Bogotá, domiciliado y residente en Bogotá , actuando en representación de la compañía <b>JJ QUIMIENVASES SAS</b> con Nit <b>901.291.848-4</b> y 
quien en adelante se denominará el <b>CONTRATANTE</b>, y  <b>'.$nombre.'</b>  mayor de edad, identificado(a) con la cédula de ciudadanía y/o pasaporte  o PEP No <b>'.$cedula.' </b>, domiciliado y residente en '.$ciudad.', actuando en nombre y representación de él mismo
y quien para los efectos del presente documento se denominará el <b>CONTRATISTA</b>, acuerdan celebrar el presente contrato de prestación de servicios al cargo de <b>'.$cargo.' </b>el cual se regirá por las normas que regulan la materia y especialmente por las siguientes
cláusulas:<b> PRIMERA. Objeto—El CONTRATISTA</b> prestara el servicio de  en el establecimiento <b>JJ QUIMIENVASES SAS</b>, y se obliga para con el <b>CONTRATANTE</b> a ejecutar los trabajos y demás actividades propias del servicio contratado el cual debe realizar de conformidad con las
condiciones y cláusulas adicionales del presente documento. <b>SEGUNDA. Plazo.</b> —El plazo para la ejecución del presente contrato será de dos meses (del '.$fecha_1.' al '.$fecha_2.') contado desde la firma de este documento, el cual podrá prorrogarse por acuerdo entre las partes con
antelación a la fecha de su expiración mediante la celebración de un otrosí al contrato, el cual deberá constar por escrito. <b>TERCERA. Valor y forma de pago.</b> —El valor de este contrato es la suma de un millón catorce mil pesos ML ($1.014.000) moneda corriente, valor que corresponde al servicio
mensual durante el mes y el cual se cancelará así: del 1 al 15 el pago se hará el día 20 y entre el 16 al 30 pago se hará el día 5 del mes siguiente, previa presentación de la cuenta de cobro que el <b>CONTRATISTA</b> hará al <b>CONTRATANTE</b> a la fecha de vencimiento de cada pago. <b>CUARTA. Obligaciones del 
contratante. —El CONTRATANTE</b> se obliga a facilitar el acceso a la información que sea necesaria, de manera oportuna, para la debida ejecución del objeto del contrato, y, estará obligado a cumplir con lo estipulado en las demás cláusulas y condiciones previstas en este documento. <b>QUINTA. Obligaciones
del contratista. —EL CONTRATISTA</b> se obliga a cumplir en forma eficiente y oportuna los trabajos encomendados y aquellas obligaciones que se generen de acuerdo con la naturaleza del servicio, a traer los soportes mensuales de pago a la seguridad social y en general con las cláusulas de este contrato.
<b>SEXTA. Vigilancia del contrato. —El CONTRATANTE</b> o su representante supervisará la ejecución del servicio encomendado, y podrá formular las observaciones del caso con el fin de ser analizadas conjuntamente con <b>El CONTRATISTA</b> y efectuar por parte de éste las modificaciones o correcciones a que hubiere lugar. 
<b>SÉPTIMA. Cláusula penal. —</b>En caso de incumplimiento por alguna de las partes de cualquiera de las obligaciones previstas en este contrato dará derecho al <b>CONTRATANTE</b> o al <b>CONTRATISTA</b> según el caso, a pagar una suma de cien Mil Pesos Mcte. ($100.000) moneda corriente. <b>OCTAVA. Forma de terminación.</b>
—El presente contrato podrá darse por terminado por mutuo acuerdo entre las partes, o en forma unilateral por el incumplimiento de las obligaciones derivadas del contrato, por cualquiera de ellas. <b>NOVENA. Exclusión de la relación laboral. —Queda claramente entendido que no existirá relación laboral 
alguna entre el CONTRATANTE y el CONTRATISTA, o el personal que éste utilice en la ejecución del objeto del presente contrato. DÉCIMA Cesión del contrato. —</b> Queda prohibido <b>Al CONTRATISTA</b> ceder parcial o totalmente la ejecución del presente contrato a un tercero salvo previa autorización expresa y
escrita del <b>CONTRATANTE. DÉCIMO PRIMERA. Domicilio contractual.</b> —Para todos los efectos legales, el domicilio contractual será la ciudad de Bogotá las notificaciones serán recibidas por las partes en las siguientes direcciones: Por <b>El CONTRATANTE</b> en: Calle 65 #21-33 Por <b>El CONTRATISTA </b>
en: '.$direccion.' Teléfono: '.$telefono.'  <b>DÉCIMO SEGUNDA. Cláusula compromisoria. —</b>Toda controversia o diferencia que pueda surgir con ocasión de este contrato, su ejecución y liquidación, se resolverá por un tribunal de arbitramento, de acuerdo con el Decreto 2279 de 1989, Ley 446 de 1998 y 
Decreto 1818 de 1998, para lo cual se establecen la siguiente regla; El tipo de arbitraje que se adoptará es independiente, por tanto, el procedimiento establecido para este caso es derecho, en conciencia o en principios técnicos.  En señal de asentimiento las partes suscriben el presente documento en dos ejemplares del mismo tenor, en Bogotá el '.$fecha_1.'.
</p>
<br>
<div id="izquierda_prestacion">
<b>El Contratista<b>
<br><br><br><br>
<b>____________________________</b><br>
<b>'.$nombre.'</b><br>
<b>CC: '.$cedula.'</b>
</div>
<div id="derecha_prestacion">
<b>El Contratante<b>
<br><br><br><br>
<b>____________________________</b><br>
<b>JJ QUIMIENVASES SAS</b><br>
<b>NIT: 901.291.848-4</b>
</div>

<div id="huella_presentacion">

</div>
';





// create pdf of invoice

$invoiceFileName = 'Prestacion de servicios-'.$cedula.'.pdf';

require_once '../dompdf/src/Autoloader.php';

Dompdf\Autoloader::register();

use Dompdf\Dompdf;

$dompdf = new Dompdf();
$dompdf->loadHtml(html_entity_decode($output));
$dompdf->setPaper('letter', 'portrait');
$dompdf->render();
$dompdf->stream($invoiceFileName, array("Attachment" => false));
/* $dompdf->page_text(1,1, "{PAGE_NUM} of {PAGE_COUNT}", $font, 10, array(0,0,0));*/
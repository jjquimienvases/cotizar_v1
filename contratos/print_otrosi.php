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
    $fecha_inicio = $data['fecha_inicio'];
    $fecha_final = $data['fecha_final'];
    $fecha = strftime("%d de %B de %Y", strtotime($fecha_inicio));
}

$output = '';
$output .= '
<link href="css/style_dom.css" rel="stylesheet" type="text/css"   media="screen" />
<img src="head.jpg">
<center><b>OTROSÍ AL CONTRATO INDIVIDUAL DE TRABAJO A TÉRMINO FIJO</b></center>
<p>
Entre <b>LAS PARTES</b> firmantes del Contrato Individual de Trabajo a Término Fijo se ha decidido adicionar la Cláusula Vigésima Sexta del mismo teniendo en cuenta las siguientes:
</p>
<center><b>CONSIDERACIONES:</b></center>
<p> 
<b>PRIMERA:</b> Que, la Ley define el contrato de trabajo a término fijo como aquel que, desde el momento en que se firma las partes acuerdan la fecha en que terminará, pero, no obstante, si no se desea renovar el contrato, la ley exige notificar previamente a la otra parte esa decisión.
</p>
<p>
<b>SEGUNDA:</b> Que, el Preaviso se entiende como una confirmación de la terminación del contrato, pues si bien se conoce previamente la fecha en que se termina, la ley exige que se confirme la decisión de no renovarlo y se notifique a la otra parte.
</p>
<p>
<b>TERCERA:</b> Que, la Ley presume la renovación automática del contrato de trabajo, de suerte que si una de las partes no quiere renovarlo tendrá que notificarlo a la otra 30 días antes de la expiración del plazo o duración del contrato.
<br>
Teniendo en cuenta lo anterior, se adicionará la Cláusula Vigésima Sexta del Contrato así:
</p>
<p> 
<b>PARÁGRAFO SEGUNDO: LAS PARTES</b> pactan que en caso tal que se quiera dar por terminado el Contrato de Trabajo por parte de <b>EL TRABAJADOR</b> antes de la fecha de terminación del mismo, estará en obligación de informar de tal decisión a <b>EL EMPLEADOR</b> con una antelación no menor a 30 días. 
</p>
<p>
<b>PARÁGRAFO TERCERO: LAS PARTES</b> convienen que en caso tal que <b>EL TRABAJADOR</b> incumpla con la obligación pactada en el parágrafo anterior, <b>EL EMPLEADOR</b> podrá no aceptar dicha decisión y condicionar la terminación a la entrega del cargo a satisfacción de <b>EL EMPLEADOR</b> por parte de <b>EL TRABAJADOR.</b>
</p>
<br>
<div id="izquierda_otro">
<b>EL EMPLEADOR: </b>
<br><br><br><br>
<p>________________________<br>
<b>JORGE EDUARDO AVILA.</b><br>
<b>REPRESENTANTE LEGAL.</b><br>
<b>JJ QUIMIENVASES S.A.S.</b>
</p>
</div>

<div id="derecha_otro">
<b>EL TRABAJADOR: </b>
<br><br><br><br>
<p> 
___________________________<br>
<b>'.$nombre.'</b><br>
<b>C.C. No. '.$cedula.' </b><br>
<b>'.$cargo.'</b>
</p>
</div>
<div id="huella_otro">

</div>
';

// create pdf of invoice

$invoiceFileName = 'OtroSi - '.$nombre.'.pdf';

require_once '../dompdf/src/Autoloader.php';

Dompdf\Autoloader::register();

use Dompdf\Dompdf;

$dompdf = new Dompdf();
$dompdf->loadHtml(html_entity_decode($output));
$dompdf->setPaper('letter', 'portrait');
$dompdf->render();
$dompdf->stream($invoiceFileName, array("Attachment" => false));
/* $dompdf->page_text(1,1, "{PAGE_NUM} of {PAGE_COUNT}", $font, 10, array(0,0,0));*/

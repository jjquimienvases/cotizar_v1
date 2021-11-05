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
 <center><b>ACUERDO DE CONFIDENCIALIDAD Y NO DIVULGACIÓN
<br>
 JJ QUIMIENVASES S.A.S. 
 </b></center>
<br>
EL PRESENTE ACUERDO DE CONFIDENCIALIDAD Y NO DIVULGACIÓN (el
“Acuerdo”) está fechado y es efectivo desde '.$fecha.', realizado y suscrito entre:
<p>
<b>• JJ QUIMIENVASES S.A.S. ,</b>sociedad legalmente constituida bajo las leyes de
la república de Colombia, identificada con NIT 901.291.848-4 y con domicilio
principal en la ciudad de Bogotá, en adelante <b>EL EMPLEADOR</b>, representada
legalmente por el señor <b>JORGE EDUARDO AVILA SARMIENTO</b>, identificado
con Cédula de Ciudadanía No. 79.487.270 de Bogotá,
</p>

<p>
• Y, por otra parte, el señor <b>'.$nombre.'</b> identificado con Cédula de Ciudadanía No. '.$cedula.', y, quien en adelante se denominará: <b>EL TRABAJADOR.</b>
</p>
<p>Conjuntamente denominados: <b>LAS PARTES.</b></p>
<p>
El presente acuerdo tiene como finalidad establecer los términos que rigen el uso y la protección de la información, imagen y negocios de EL EMPLEADOR, JJ QUIMIENVASES S.A.S. previas las siguientes:
</p>
<center><b>CONSIDERACIONES</b></center>
<br>
<p> 
• Que, EL EMPLEADOR contrató a EL TRABAJADOR para el desarrollo de la labor de '.$cargo.' en la compañía.
</p>
<p>
• Que, en desarrollo del objeto contratado y en el marco del curso actual del negocio que actualmente adelanta EL EMPLEADOR, EL TRABAJADOR podrá tener acceso a datos de naturaleza confidencial (“Información Confidencial”), según se define más adelante; y 
</p>
<p>
• Que, JJ QUIMIENVASES S.A.S. desea establecer y determinar las obligaciones individuales con respecto a proteger su Información Confidencial. 
</p>
<p>
• Que, tanto EL TRABAJADOR, como EL EMPLEADOR, desean establecer y determinar las obligaciones individuales con respecto a proteger la mencionada Información Confidencial.
</p>
<p>
EN CONSECUENCIA, considerando lo anterior, LAS PARTES convienen el siguiente:
</p>
<center><p>
<b>ACUERDO</b>
</p></center>
<p>
<b>CLÁUSULA PRIMERA: DIVULGACIÓN DE INFORMACIÓN CONFIDENCIAL.</b>Se entenderá por “Información Confidencial”, toda la información de EL EMPLEADOR que sea susceptible de divulgarse a EL TRABAJADOR por cualquier medio, que se referencia en los considerandos de este acuerdo, y que sea considerada como tal por EL EMPLEADOR.
</p>
<p>
<b>CLÁUSULA SEGUNDA: CONFIDENCIALIDAD.</b> En el marco del presente acuerdo, EL TRABAJADOR se compromete a:
• No Usar la Información Confidencial de <b>EL EMPLEADOR EN NINGÚN CASO</b> 
</p>
<p>
• No divulgar la Información Confidencial de EL EMPLEADOR, sin el consentimiento expreso y por escrito de esta. 
</p>
<p>
• Sí, en desarrollo de las actividades propias del contrato EL TRABAJADOR conoce Información Confidencial alguna, deberá mantener dicha Información Confidencial en reserva y no divulgarla a otros o permitir que otros la usen para su beneficio o en detrimento de EL EMPLEADOR.
</p>
<p>
• Tomar todas las medidas necesarias para mantener la confidencialidad de la Información que no serán menores a las medidas que use para su información confidencial de tipo similar.
</p>
<p>
<b>PARÁGRAFO PRIMERO:</b> EL TRABAJADOR dará aviso inmediato a EL EMPLEADOR cuando se entere de cualquier pérdida, uso no autorizado o divulgación de la Información Confidencial de EL EMPLEADOR. Asimismo, conviene en tomar todas las medidas necesarias para cooperar con EL EMPLEADOR en rectificar dicho uso no autorizado o divulgación de la Información Confidencial. 
</p>
<p>
<b>PARÁGRAFO SEGUNDO:</b> Esta obligación de confidencialidad no aplicará si EL TRABAJADOR puede demostrar que: 
</p>
<p>
• La Información Confidencial de EL EMPLEADOR era parte del dominio público al momento de divulgación, o llegó a ser parte del dominio público mediante publicación u otro, que no sea mediante acciones que constituyan incumplimiento de las disposiciones de este Acuerdo;<br>
• La Información Confidencial de EL EMPLEADOR requiera divulgarse por agencia gubernamental para favorecer los objetivos de este Acuerdo, o por un tribunal apropiado de jurisdicción competente; siempre que ­­­­­­­­­­­­­­­ EL TRABAJADOR cumpla con los requisitos estipulados en la Cláusula Sexta.<br>
</p>
<p>
<b>CLÁUSULA TERCERA: IMAGEN.</b> Todos los logos, imágenes, eslóganes, vídeos, documentos y demás material publicitario que en desarrollo de su objeto EL EMPLEADOR usa, y toda representación tangible de la imagen de esta será de propiedad de EL EMPLEADOR y estará terminantemente prohibido a EL TRABAJADOR usarla para cualquier fin so pena de dar por terminado el contrato que lo vincula con EL EMPLEADOR.
</p>
<p>
­­­­­­­­­­­­­­EL TRABAJADOR devolverá a EL EMPLEADOR todo documento que contenga información y/o imágenes que de cualquier modo lleguen a su poder y que sean propiedad de esta de manera inmediata sin necesidad de solicitud por escrito de EL EMPLEADOR.
</p>
<p>
<b>CLÁUSULA CUARTA: NO LICENCIA.</b> Este Acuerdo no le otorga a EL TRABAJADOR licencia alguna para el uso de la Información Confidencial de EL EMPLEADOR.
</p>
<p>
<b>CLÁUSULA QUINTA: DURACIÓN.</b> El presente Acuerdo se mantendrá vigente desde la Fecha Efectiva por el término en el que se encuentre vigente el Contrato de Trabajo y por dos (2) años más, a menos que EL EMPLEADOR lo termine anticipadamente.  
</p>
<p>
<b>CLÁUSULA SEXTA: RESPUESTA A PROCESO LEGAL.</b> En el caso que EL TRABAJADOR (o alguna parte a quien le transfiera la Información Confidencial bien sea en cumplimiento de este Acuerdo o no) sea requerido mediante citación u otro proceso legal, para la Divulgación de cualquier Información Confidencial, dará aviso dentro de los  dos (2) días siguientes a la notificación, siempre y cuando el plazo concedido para atender el requerimiento lo permita, a EL EMPLEADOR con el fin de que esta pueda buscar una orden de protección u otro recurso apropiado y/o renunciar al cumplimiento de las estipulaciones de este Acuerdo. En el caso en que dicha orden protectiva u otro recurso no se obtenga, o que EL EMPLEADOR renuncie al cumplimiento de las estipulaciones de este Acuerdo, EL TRABAJADOR ­­ coordinará con EL EMPLEADOR en un esfuerzo para limitar la naturaleza y alcance de dicha divulgación requerida. 
</p>
<p>
<b>CLÁUSULA SÉPTIMA: RENUNCIA DE EXACTITUD DE LA INFORMACIÓN CONFIDENCIAL.</b> Si bien EL EMPLEADOR ha hecho su mejor esfuerzo para incluir como confidencial la información de su conocimiento que considera relevante para los fines del presente Acuerdo, ­­­­­­­­­­­­­­­ EL TRABAJADOR entiende que EL EMPLEADOR ni ninguno de sus representantes o agentes ha realizado o por el presente hace declaración o garantía alguna en cuanto a la exactitud o totalidad de la Información Confidencial.
</p>
<p>
<b>CLÁUSULA OCTAVA: CLÁUSULA PENAL.</b> El incumplimiento comprobado de las obligaciones establecidas o derivadas del presente acuerdo por parte de ­­­­­­­­­­­­EL TRABAJADOR, facultará a EL EMPLEADOR para cobrar a título de pena una suma igual a Diez Millones de Pesos ($10.000.000) COP, sin menoscabo del cobro de los perjuicios que pudieren ocasionarse como consecuencia del incumplimiento, previo a la verificación del mismo a través del procedimiento que se indica en el parágrafo siguiente. El pago de la cláusula penal no excluye el pago de los perjuicios derivados de incumplimiento de las obligaciones contenidas en el presente Acuerdo. El presente Acuerdo de Confidencialidad presta mérito ejecutivo.
</p>
<p>
<b>PARÁGRAFO PRIMERO:</b> Las partes definen atender el siguiente procedimiento como mecanismo previo para la comprobación del incumplimiento por parte de­­­­­­­­­­­­­ EL TRABAJADOR, el cual será obligatorio agotarlo para acudir a ejecutar las acciones legales respectivas: 
</p>
<p>
1. EL EMPLEADOR deberá notificar por escrito a la dirección de notificación física de­­­­­­­­ EL TRABAJADOR, la causa del presunto incumplimiento por parte de este, a fin de que en el término de cinco (5) días hábiles proceda a rendir los descargos y pruebas que considere pertinentes.
</p>
<p>
2. EL EMPLEADOR dentro de los cinco (5) días siguientes al plazo antes indicado deberá hacer la evaluación de los descargos y pruebas aportadas a fin de emitir su pronunciamiento por escrito y debidamente soportado de la comprobación del hecho imputado como incumplimiento o la aceptación de los descargos presentados.
</p>
<p>
3. En el caso de encontrarse por parte de EL EMPLEADOR, comprobado el incumplimiento podrá exigir el pago de la suma señalada como pena, para lo cual ­­­­­­­­­­­­­­ EL TRABAJADOR se reserva el derecho de excepcionar el cumplimiento de sus obligaciones con las pruebas que tenga a su favor.
</p>
<br>
<p>
<b>CLÁUSULA NOVENA: COMPROMISO:</b> Si surgiere alguna diferencia, disputa o controversia entre las Partes por razón o con ocasión del presente acuerdo, las Partes buscarán de buena fe un arreglo directo antes de acudir al trámite jurisdiccional aquí previsto. En consecuencia, si surgiere alguna diferencia, cualquiera de las Partes notificará a la otra la existencia de dicha diferencia y una etapa de arreglo directo surgirá desde el día siguiente a la respectiva notificación. Esta etapa de arreglo directo culminará a los diez (10) días siguientes a la fecha de su comienzo.
</p>
<p>
Si no hubiere arreglo entre las Partes dentro de la etapa antedicha, cualquiera de ellas podrá dar inicio al proceso jurisdiccional. En consecuencia, la diferencia, disputa o controversia correspondiente será sometida a la decisión definitiva y vinculante de un Juez de la República. 
</p>
<br>
<b>CLÁUSULA DÉCIMA. DISPOSICIONES GENERALES:</b>
<p>
• El presente Acuerdo sólo podrá modificarse o adicionarse por escrito debidamente firmado por ambas partes.<br>
• Ningún término o estipulación del presente será considerado como renuncia de alguna de las Partes, y no se excusará incumplimiento por ninguna de las partes, a menos que dicha renuncia o consentimiento sea por escrito firmado de la parte contra la cual la renuncia se aprueba. El no consentimiento de alguna de las Partes, o renuncia a incumplimiento por alguna de las Partes, sea expreso o implícito, se constituirá en consentimiento, renuncia o excusa de algún otro incumplimiento diferente o subsiguiente de alguna de las partes.<br>
• Si alguna parte de este Acuerdo es considerada inválida o no exigible, esa parte se modificará para llegar al mismo efecto lo más cercano posible de la estipulación original y el resto de este Acuerdo permanecerá en pleno vigor. <br>
</p>
<p>
• Este Acuerdo constituye el acuerdo total entre las partes relativo a este asunto y reemplaza todas las declaraciones, discusiones, negociaciones, y acuerdos anteriores o simultáneos sean escritos u orales.<br>
• El presente Acuerdo podrá perfeccionarse en uno o más ejemplares, cada uno de los cuales se considerará un original, pero en su totalidad constituirán el mismo acuerdo. <br>
EN CONSTANCIA DE LO ANTERIOR, LAS PARTES firman este Acuerdo en la Fecha Efectiva.
<p>
<br>
<br>
<br>
<b>EL EMPLEADOR: </b>
<br><br><br><br>
<p>___________________________________<br>
<b>JORGE EDUARDO AVILA.</b><br>
<b>REPRESENTANTE LEGAL.</b><br>
<b>JJ QUIMIENVASES S.A.S.</b>
</p>
<br><br><br>
<div id="izquierda_confidencial">
<b>EL TRABAJADOR: </b>
<br><br><br><br>
<p> 
______________________________________<br>
<b>'.$nombre.'</b><br>
<b>C.C. No. '.$cedula.' </b><br>
<b>'.$cargo.'</b>
</p>
</div>
<div id="derecha_confidencial">


</div>


';

// create pdf of invoice

$invoiceFileName = 'Acuerdo de confidencialidad - '.$nombre.'.pdf';

require_once '../dompdf/src/Autoloader.php';

Dompdf\Autoloader::register();

use Dompdf\Dompdf;

$dompdf = new Dompdf();
$dompdf->loadHtml(html_entity_decode($output));
$dompdf->setPaper('letter', 'portrait');
$dompdf->render();
$dompdf->stream($invoiceFileName, array("Attachment" => false));
$domPdfOptions = new Options();
$domPdfOptions->set("isPhpEnabled", true);

  if ( isset($dompdf) ) { 
    $dompdf->page_script('
        if ($PAGE_COUNT > 1) {
            $font = Font_Metrics::get_font("Arial, Helvetica, sans-serif", "normal");
            $size = 12;
            $pageText = $PAGE_NUM . "/" . $PAGE_COUNT;
            $y = $pdf->get_height() - 24;
            $x = $pdf->get_width() - 15 - Font_Metrics::get_text_width($pageText, $font, $size);
            $pdf->text($x, $y, $pageText, $font, $size);
        } 
    ');
}

/* $dompdf->page_text(1,1, "{PAGE_NUM} of {PAGE_COUNT}", $font, 10, array(0,0,0));*/

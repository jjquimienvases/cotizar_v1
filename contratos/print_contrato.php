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
    
    if($cargo == "ASESOR CALL CENTER"){
        $cargo = "ASESOR CALL CENTER";
    }else{
        $cargo = $cargo;
    }
}



if($cargo == "AUXILIAR DE BODEGA"){
$funciones = "<p> 
•Alistar y despachar la mercancía. Esto teniendo en cuenta (Factura, Cotización, Y Pago).
</p>
<p> 
•Revisar notas de las cotizaciones.
</p>
<p> 
•Si no existe la nota en la cotización y hay lugar a duda comunicarse con el asesor comercial.  
</p>
<p> 
•Verificar factura, cotización, y pago.  
</p>
<p> 
•Si Falta algún producto en la cotización, deberá avisar de inmediato a la asistente.
</p>
<p> 
•Alistamiento de la mercancía únicamente en el área designada. 
</p>
<p> 
•Revisión detallada de la mercancía que se envía y recibe. 
</p>
<p> 
•Solicitar la mercancía con anticipación de 48 a 72 horas.
</p>
<p> 
•Toda la mercancía que sale de la empresa debe llevar el rotulo de JJ QUIMI ENVASES describiendo producto y cantidad.
</p>
<p> 
•Quitar toda la información comercial de los proveedores que contenga la mercancía.
</p>
<p> 
•Antes de almacenar la mercancía en estante, debe tener el rotulo con la descripción del producto y cantidad.
</p>
<p> 
•Paquetear toda la mercancía de a 12 unidades.
</p>
<p> 
•Solo se autoriza a mantener 1 paquete abierto por producto.
</p>
<p> 
•Mantener el área limpia y ordenada.
</p>
<p> 
•Toda instrucción debe ir firmada y autorizada por su jefe inmediato.
</p>
<p> 
•Los montacargas se contratan por 1 hora, por lo anterior, es importante que el producto quede instalado en el área correcta en ese trascurso del tiempo.
</p>
<p> 
•Dejar el registro de los paquetes y el contenido despachado para cada pedido.
</p>
<p> 
•Realizar arqueo de inventario según instrucciones.
</p>
<p> 
•En el momento de recibir la mercancía reportar las unidades defectuosas o faltantes antes de 72 horas. 
</p>
<p> 
•Para toda mercancía nueva que llegue, se tendrá que informar de esto y posteriormente, trasladarla a los puntos de venta (Ibagué y Bogotá).
</p>
<p> 
•El uso de la dotación y de los elementos de protección entregados por parte de EL EMPLEADOR es obligatorio.
</p>";
}else if($cargo == "VENTAS MOSTRADOR"){
  $funciones = "<p> 
•Tener amabilidad en la atención con los clientes.
</p>
<p> 
•Ser ágil en la atención al cliente.
</p>
<p> 
•Llamar a los clientes por su nombre.
</p>
<p> 
•Estar atento a las solicitudes de los clientes y a sus pedidos.  
</p>
<p> 
•Respetar los procesos de empaque establecidos por la compañía. 
</p>
<p> 
•Tener en cuenta que los vendedores no están autorizados a entregar a la mercancía al cliente. 
</p>
<p> 
•La mercancía solo la entrega el área de bodega ventas mostrador.
</p>
<p> 
•Los vendedores no están autorizados a recibir dinero de los clientes. 
</p>
<p> 
•Deberá dar solución a los imprevistos y a las informalidades para con los clientes. 
</p>
<p> 
•Deberá Manejar el portafolio de JJ QUIMIENVASES S.A.S.
</p>
<p> 
•Cuando el cliente llegue con un precio menor al ofrecido por la compañía, deberá comunicarlo inmediatamente con la suplente representante legal.
</p>
<p> 
•No está autorizado a dar descuento sin autorización de la asistente o de la representante legal suplente.
</p>
<p> 
•Está obligado a mejorar la cotización del cliente para igualarla o mejorarle el precio que el cliente trae.
</p>
<p> 
•Deberá informar a la asistente cuando los productos solicitados no se encuentren en JJ QUIMI ENVASES SAS
</p>
<p> 
•Deberá avisar al cliente que la mercancía que no esté en el establecimiento se tardará en llegar de 10 a 15 minutos desde la bodega principal 
</p>
<p> 
•Pasar el tiquete que ya recibieron el dinero a los bodegueros para que ellos entreguen la mercancía.
</p>
<p> 
•Ofrecer la perfumería a todo cliente que entre sin importar lo que hayan comprado. Darle una tirilla marcada untada de perfume.
</p>
<p> 
•Conocer la descripción olfativa de los perfumes y ofrecerla a los clientes de acuerdo a su edad y personalidad.
</p>
<p> 
•Hacer una mirada de las personas que estén haciendo fila para ingresar al almacén saludarlos y decirles que nos esperen un momento mientras los atendemos.
</p>
<p> 
•Llenar todos los campos de la plataforma COTIZAR.
</p>
<p> 
•Ofrecer servicio de empacar los regalos tanto en temporada como fuera de ella.
</p>
<p> 
•En las vitrinas de exhibición debe colocar la mercancía nueva que esté llegando. 
</p>
<p> 
•Toda fragancia debe llevar el nombre del probador.
</p>
<p> 
•Deberá revisar el aforo del almacén y solicitar al cliente que espere cuando haya realizado y pagado el pedido mientras el personal de bodega le entrega la mercancía.
</p>
<p> 
•Inmediatamente hacer ingresar la siguiente persona.
</p>
<p> 
•El uso de la dotación y de los elementos de protección entregados por parte de EL EMPLEADOR es obligatorio.
</p>
";
}else if($cargo == "CAJERA"){
  $funciones = "<p> 
  •Administrar de manera adecuada los recursos dejados a su disposición.
  </p>
  <p> 
  •Manejar el sistema para entradas, salidas y cierres de caja mostrando un correcto funcionamiento del flujo de efectivo.
  </p>
  <p> 
  •Dar atención al cliente interno y externo de manera rápida y eficaz. 
  </p>
  <p> 
  •Revisar y entregar las planillas de asistencia del personal que labora diariamente en los establecimientos.  
  </p>
  <p> 
  •Tener amabilidad en la atención con los clientes. 
  </p>
  <p> 
  •Ser ágil en la atención al cliente.
  </p>
  <p> 
  •Llamar a los clientes por su nombre.
  </p>
  <p> 
  •Estar atento a las solicitudes de los clientes y a sus pedidos. 
  </p>
  <p> 
  •Respetar los procesos de empaque establecidos por la compañía. 
  </p>
  <p> 
  •Tener en cuenta que los vendedores no están autorizados a entregar a la mercancía al cliente.
  </p>
  <p> 
  •La mercancía solo la entrega el área de bodega ventas mostrador.
  </p>
  <p> 
  •Los vendedores no están autorizados a recibir dinero de los clientes. 
  </p>
  <p> 
  •Deberá dar solución a los imprevistos y a las informalidades para con los clientes.
  </p>
  <p> 
  •Deberá Manejar el portafolio de JJ QUIMIENVASES S.A.S. 
  </p>
  <p> 
  •Cuando el cliente llegue con un precio menor al ofrecido por la compañía, deberá comunicarlo inmediatamente con la suplente representante legal.
  </p>
  <p> 
  •No está autorizado a dar descuento sin autorización de la asistente o de la representante legal suplente.
  </p>
  <p> 
  •Está obligado a mejorar la cotización del cliente para igualarla o mejorarle el precio que el cliente trae
  </p>
  <p> 
  •Consultar el apartado de caja en la plataforma COTIZAR frecuentemente.
  </p>
  <p> 
  •Finzalizar las ventas de manera correcta, teniendo en cuenta abonos, devoluciones y pagos multiples.
  </p>
  <p> 
  •Cerrar Caja Correctamente en la plataforma COTIZAR y enviar informacion via whatsapp al numero autorizado.
  </p>
  <p> 
  •Guardar los comprobantes de pagos por datafono.
  </p>
  <p> 
  •Enviar comprobantes de pago electronico via whatsapp al numero autorizado para su verificacion. 
  </p>
  "; 
}else if($cargo == "AUXILIAR DE BODEGA - PERFUMERIA"){
    $funciones = "<p> 
•Alistar y despachar la mercancía. Esto teniendo en cuenta (Factura, Cotización, Y Pago).
</p>
<p> 
•Revisar notas de las cotizaciones.
</p>
<p> 
•Si no existe la nota en la cotización y hay lugar a duda comunicarse con el asesor comercial.  
</p>
<p> 
•Verificar factura, cotización, y pago.  
</p>
<p> 
•Si Falta algún producto en la cotización, deberá avisar de inmediato a la asistente.
</p>
<p> 
•Alistamiento de la mercancía únicamente en el área designada. 
</p>
<p> 
•Revisión detallada de la mercancía que se envía y recibe. 
</p>
<p> 
•Solicitar la mercancía con anticipación de 48 a 72 horas.
</p>
<p> 
•Toda la mercancía que sale de la empresa debe llevar el rotulo de JJ QUIMI ENVASES describiendo producto y cantidad.
</p>
<p> 
•Quitar toda la información comercial de los proveedores que contenga la mercancía.
</p>
<p> 
•Antes de almacenar la mercancía en estante, debe tener el rotulo con la descripción del producto y cantidad.
</p>
<p> 
•Paquetear toda la mercancía de a 12 unidades.
</p>
<p> 
•Solo se autoriza a mantener 1 paquete abierto por producto.
</p>
<p> 
•Mantener el área limpia y ordenada.
</p>
<p> 
•Toda instrucción debe ir firmada y autorizada por su jefe inmediato.
</p>
<p> 
•Los montacargas se contratan por 1 hora, por lo anterior, es importante que el producto quede instalado en el área correcta en ese trascurso del tiempo.
</p>
<p> 
•Dejar el registro de los paquetes y el contenido despachado para cada pedido.
</p>
<p> 
•Realizar arqueo de inventario según instrucciones.
</p>
<p> 
•En el momento de recibir la mercancía reportar las unidades defectuosas o faltantes antes de 72 horas. 
</p>
<p> 
•Para toda mercancía nueva que llegue, se tendrá que informar de esto y posteriormente, trasladarla a los puntos de venta (Ibagué y Bogotá).
</p>
<p> 
•El uso de la dotación y de los elementos de protección entregados por parte de EL EMPLEADOR es obligatorio.
</p>
<p> 
•Empacar esencias ambientales y de perfumeria fina velando por la preservacion y no desperdicio de la materia prima.
</p>
<p> 
•Mantener el espacio de trabajo totalmente cerrado siempre y cuando no se encuentre en el area.
</p>
<p> 
•No esta permitido sacar mercancia de la bodega sin algun soporte que sustente ese movimiento de mercancia.
</p>
<p> 
•Todo producto que salga de la bodega de esencias debe estar totalmente empacado y sellado en los empaques de seguridad proporcionados por la empresa, con su correspondiente comprobante.
</p>
";
}else if($cargo == "ASESOR CALL CENTER"){
  $funciones = "<p> 
•Cotizar los productos que comercializa EL EMPLEADOR a los clientes de la compañía disminuyendo los tiempos de respuesta.
</p>
<p> 
•Llamar y atender las solicitudes de los clientes.
</p>
<p> 
•Hacer seguimiento a las cotizaciones realizadas.  
</p>
<p> 
•Realizar un constante seguimiento a la plataforma de ventas de la compañía en la página web MERCADO LIBRE, realizando ventas y respondiendo preguntas de estas ventas.  
</p>
<p> 
•Deberá cotizar y adjuntar el respectivo soporte de pago remitido por los clientes al apartado predeterminado en la plataforma COTIZAR para poder facturar.
</p>
<p> 
•Responder las preguntas formuladas por los clientes en la plataforma de ventas de la compañía en la página web MERCADO LIBRE, sin publicar datos de la compañía (dirección teléfono redes sociales) para evitar sanciones por parte de la plataforma. 
</p>
<p> 
•Mantener la reputación en verde en la plataforma de ventas de la compañía en la página web MERCADO LIBRE. 
</p>
<p> 
•Responder las solicitudes de las redes sociales Facebook, Instagram, WhatsApp.
</p>
<p> 
•Realizar excelente asesoría del portafolio de JJ QUIMIENVASES generando necesidades y expectativas a los clientes.
</p>
<p> 
•Realizar servicio posventa (hacer seguimiento de los envíos y verificar las condiciones en las cuales los clientes recibieron la mercancía).
</p>
<p> 
•Solicitar la constante calificación de los clientes a través de google my bussiness.
</p>
<p> 
•Consultar sus dudas, inquietudes y/o las novedades de los pedidos a las personas encargadas (Asesores Comerciales y Asistente Administrativo).
</p>
<p> 
•Atender la solicitud del cliente incluso cuando solicitan en ventas mostrador.
</p>
<p> 
•No comunicar los clientes a los funcionarios de bodega.
</p>
<p> 
•Consultar inventarios de mercancia en la plataforma interna de produccion COTIZAR.
</p>
";    
}



  $info = "<p>Todo colaborador se compromete a reportar a la asistente administrativa los daños y errores que se den para con la mercancía en su día cotidiano en caso de que la comunicación no funcione dar aviso a la representante legal suplente. 
  <br><br>Por todo lo anterior, se le solicita dar estricto cumplimiento en la ejecución de sus labores para con la empresa, de hacer caso omiso podrá dar lugar a la imposición de sanciones establecidas en el reglamento interno de trabajo desde un llamado de atención hasta la cancelación del contrato de trabajo. </p>";

$output = '';

$output .= '

<link href="css/style_dom.css" rel="stylesheet" type="text/css"   media="screen" />
<img src="head.jpg">

<center> 
<br>
<b>CONTRATO INDIVIDUAL DE TRABAJO A TÉRMINO FIJO</b>
<br>
<b>'.$cargo.'</b>
</center>
<br>
<br>
<b>DOCUMENTO DE GENERALIDADES.</b>
<br>
<p>En el presente instrumento se plasman las condiciones generales del contrato que las partes rubrican, 
hace parte del mismo, y se desarrolla para que tanto la empresa como el colaborador tengan un soporte y 
un resumen general del acuerdo que procederán a suscribir. </p>
<br>
<table class="table">
 <tr> 
<td>EMPLEADOR</td>
<td>JJ QUIMIENVASES SAS.</td>
</tr>
<tr> 
<td>NIT</td>
 <td>901.291.848-4</td>
  </tr>
  <tr> 
<td>DIRECCIÓN NOTIFICACIONES:</td>
 <td>CARRERA 25 #66 - 82</td>
  </tr>
  <tr> 
<td>REPRESENTANTE LEGAL:</td>
 <td>JORGE EDUARDO AVILA</td>
  </tr>
  <tr> 
  <td>NOMBRE DEL EMPLEADO(A):</td>
   <td>'.$nombre.'</td>
    </tr>
    <tr> 
  <td>CÉDULA DE CIUDADANÍA No.:</td>
   <td>'.$cedula.'</td>
    </tr> 
    <tr> 
  <td>CELULAR:</td>
   <td>'.$telefono.'</td>
    </tr> 
    <tr> 
  <td>DIRECCIÓN RESIDENCIA:</td>
   <td>'.$direccion.'</td>
    </tr> 
    <tr> 
    <td>CORREO ELECTRÓNICO:</td>
     <td>'.$email.'</td>
      </tr> 
      <tr> 
    <td>CARGO A DESEMPEÑAR:</td>
     <td>'.$cargo.'</td>
      </tr> 
      <tr> 
    <td>SALARIO:</td>
     <td>$908.526</td>
      </tr>  
      <tr>
      <td>PAGADEROS:</td>
      <td>QUINCENAL</td>
       </tr>  
       <tr>
       <td>CIUDAD DE LABOR:</td>
       <td>'.$ciudad.'</td>
        </tr>  
        <tr>
        <td>AFP – EPS:</td>
        <td>'.$afp.'-'.$eps.'</td>
         </tr>     
         <tr>
         <td>INICIO CONTRATO:</td>
         <td>'.$fecha_inicio.'</td>
          </tr>     
          <tr>
          <td>TERMINACIÓN CONTRATO:</td>
          <td>'.$fecha_final.'</td>
           </tr>        
</table>
';

$output .= '
<br>
<br>
<span> Las Partes convienen que el presente documento de generalidades es parte integral del contrato que suscriben y confirman la aceptación de su contenido.</span>
<br>
<br>
<br>

<center><b>CONTRATO INDIVIDUAL DE TRABAJO A TÉRMINO FIJO<b></center>
<br>
<p>Entre los suscritos:</p>
<p>
• Por una parte, <b>JJ QUIMIENVASES S.A.S.</b>, sociedad comercial, legalmente constituida, la cual se identificada con el Nit. 901.291.848-4, 
y está representada legalmente por el señor <b>JORGE EDUARDO AVILA </b> identificado con 
Cédula de Ciudadanía No. 79.487.270 de Bogotá, y, quien en adelante se denominará: <b>EL EMPLEADOR.</b> 
</p>

<p>
• Y, por otra parte, el señor <b>'.$nombre.'</b> identificado con Cédula de Ciudadanía No.'.$cedula.', y, quien en adelante se denominará: <b>EL TRABAJADOR</b>.
</p>

<p> Y quienes conjuntamente se denominarán: <b>LAS PARTES.</b> </p>
<p> 
Han decidido, en pleno uso de sus facultades legales y mentales para ser sujetos de obligaciones, y no encontrándose inmersos en causal alguna 
de vicio del consentimiento, suscribir el presente <b>CONTRATO DE TRABAJO A TÉRMINO FIJO</b>, el cual se regulará por las siguientes cláusulas.
</p>

<p> 
<b>LAS PARTES</b>, de común acuerdo suscriben el presente Contrato de Trabajo Escrito a Término Fijo con una duración
inicial de (6) Seis Meses, iniciando y finalizando su relación laboral, en las fechas descritas en el documento de generalidades anexo al presente contrato.
</p>
<p>
<b>SEGUNDA. LUGAR DE TRABAJO.</b> El TRABAJADOR desarrollará sus funciones en las dependencias de la compañía y/o en el lugar que EL EMPLEADOR determine. 
Cualquier modificación del lugar de trabajo, que signifique cambio de ciudad, se hará conforme al Código Sustantivo de Trabajo.
</p>
<p>
<b>TERCERA. PERIODO DE PRUEBA:</b> El TRABAJADOR estará en periodo de prueba por un término equivalente a la quinta parte del término inicial del contrato,
siendo para el presente caso un periodo de dieciocho días (18), contados a partir de la fecha de inicio de labores.
</p>
<p>
<b>CUARTA. FUNCIONES:</b> EL TRABAJADOR en función del cargo de '.$cargo.' para el cual fue contratado, se compromete a desempeñar y a cumplir las siguientes funciones, siendo causal de terminación del presente Contrato De Trabajo, 
el incumplimiento de cualquier de ellas, de acuerdo a los términos y procedimientos estipulados en el Reglamento Interno de Trabajo de EL EMPLEADOR:
</p>
'.$funciones.'
'.$info.'
<p> 
<b>QUINTA. JEFE INMEDIATO:</b> El TRABAJADOR se compromete a responder frente a sus funciones, presentar informes, documentos de cumplimiento y cualquier otra 
actuación a su Jefe Inmediato quien será el Administrador del Establecimiento, esto, sin perjuicio de las funciones de control, seguimiento y sanción que cualquier otro empleado y/o directivo de la compañía de mayor jerarquía, directa o indirecta, pueda ejercer sobre el mismo.
</p>
<p>
<b>SEXTA. ELEMENTOS DE TRABAJO:</b> Corresponde, y es obligación de EL EMPLEADOR suministrar a EL TRABAJADOR los elementos necesarios para el normal desempeño de las funciones del cargo contratado. Cabe resaltar que, todos los elementos suministrados al trabajador deben ser para uso exclusivo de sus labores. En caso de pérdida, robo y/o deterioro por mal uso, esté deberá asumir los costos que se generen. 
De los elementos de trabajo que sean entregados a EL TRABAJADOR se dejará constancia en acta firmada por LAS PARTES y que deberá ser anexada a la carpeta laboral de EL TRABAJADOR, en dicha Acta se hará la descripción de los elemento y valor comercial del bien entregado.
</p>
<p>
<b>SÉPTIMA. VIGILANCIA DE LOS EQUIPOS:</b> EL TRABAJADOR autoriza a EL EMPLEADOR a vigilar, supervisar y recolectar datos de los equipos propiedad del EMPLEADOR y que sean usados por el TRABAJADOR. Esto en consonancia con lo dispuesto en la Cláusula Vigésima Segunda de este acuerdo.
</p>
<p>
<b>OCTAVA. VIGILANCIA Y CONTROL DE CONTENIDOS:</b> EL TRABAJADOR se compromete a no usar los equipos propiedad de EL EMPLEADOR para acceder a las páginas de redes sociales, a sitios web con contenidos pornográficos, y a cualquier otro portal ajeno a las funciones de su cargo. 
El incumplimiento de lo dispuesto en esta cláusula será causal de despido.
</p>
<p>
<b>NOVENA. USO DE TECNOLOGÍAS DE COMUNICACIÓN.</b> EL TRABAJADOR se compromete a abstenerse de usar cualquier medio tecnológico de comunicación como celulares, tabletas, dispositivos de audio o video y/o cualquier otro ya sea de su propiedad o de propiedad de la empresa.
<br>El uso de los mencionados dispositivos en los horarios laborales acarreará las sanciones propias del caso.
</p>
<p>
<b>PARÁGRAFO:</b> Se exceptúa de la mencionada obligación el caso en el cual, EL TRABAJADOR deba hacer uso de los equipos mencionados en la cláusula anterior para el desarrollo de una labor ordenada por su superior.
</p>
<p>
<b>DÉCIMA. INFORMACIÓN PERSONAL:</b> EL TRABAJADOR autoriza a EL EMPLEADOR el uso de la información personal y/o de localización que se encuentre registrada en las bases de datos de la compañía y/ o en la respectiva hoja de vida, para el envío de información de carácter laboral tales como:
    <br>• Comprobantes de Pago <br>
    • Notificaciones <br>
    • Invitaciones <br>
    • Requerimientos <br>
    Y demás asuntos que hagan parte integral de la relación contractual y de la necesidad de comunicación entre LAS PARTES.
    <br>
    En virtud de esta autorización EL EMPLEADOR podrá hacer uso de los diferentes medios electrónicos y físicos de comunicación, incluyendo mensajes de texto, para el envío de información a EL TRABAJADOR.
    </p>

    <p> 
    <b>PARÁGRAFO PRIMERO:</b> EL TRABAJADOR adicionalmente autoriza con la firma del presente contrato a EL EMPLEADOR para que este verifique, con las instituciones o entidades correspondientes, la información suministrada durante el proceso de selección y vinculación o, en cualquier momento durante la vigencia de la relación laboral; de igual forma EL TRABAJADOR acepta que la información suministrada a EL EMPLEADOR también sea usada para el control y prevención de lavados de activos y financiación del terrorismo y fraudes.
    </p>
    <p>
    <b>PARÁGRAFO SEGUNDO:</b> EL EMPLEADOR se compromete con la firma del presente documento, a tratar los datos de acuerdo con lo establecido en la Ley, y de acuerdo a la normatividad vigente, para el Tratamiento de datos personales y su régimen de protección.
    </p>
    <p>
   <b> DÉCIMA PRIMERA. EXCLUSIVIDAD:</b> El TRABAJADOR se compromete con la firma de este contrato a no vincularse con ninguna otra compañía para ejecutar servicios ni directa ni indirectamente, tampoco podrá trabajar por cuenta propia en el mismo oficio, esto durante la vigencia de este contrato.
    </p>
    <p>
  <b>DÉCIMA SEGUNDA. JUSTAS CAUSAS PARA DESPEDIR:</b> Son justas causas para dar por terminado unilateralmente el presente contrato por cualquiera de las partes, el incumplimiento a las obligaciones y prohibiciones que se expresan en los artículos 57 y siguientes del Código Sustantivo del Trabajo. Además del incumplimiento o violación a las normas establecidas en el Reglamento Interno de Trabajo, Higiene y de Seguridad y las previamente establecidas por el empleador o sus representantes.
    </p>
    <p>
<b>DÉCIMA TERCERA. SALARIO:</b> El EMPLEADOR cancelará a EL TRABAJADOR un salario mensual que asciende a la suma de NOVECIENTOS CINCO MIL QUINIENTOS VEINTISÉIS PESO MCTE ($ 905.526), pagaderos en dos quincenas el lugar de trabajo, el día veinte (20) y cinco (05) de cada mes. Dentro de este pago se encuentra incluida la remuneración de los descansos dominicales y festivos de que tratan los capítulos I y II del título VII del Código Sustantivo del Trabajo.
    </p>
    <p>
   <b> DÉCIMA CUARTA. TRABAJO EXTRA, EN DOMINICALES Y FESTIVOS:</b> El trabajo suplementario o en horas extras, así como el trabajo en domingo o festivo que correspondan a descanso, al igual que los nocturnos, será remunerado conforme al Código Sustantivo del Trabajo.
   <br>
   Es de advertir que dicho trabajo debe ser autorizado u ordenado por el empleador para efectos de su reconocimiento. Cuando se presenten situaciones urgentes o inesperadas que requieran la necesidad de este trabajo suplementario, se deberá ejecutar y se dará cuenta de ello por escrito, dentro de las 48 horas siguientes de la prestación del servicio no autorizado al jefe inmediato, de lo contrario, las horas
   laboradas de manera suplementaria que no se autorizó o no se notificó no será reconocido.
    </p>
    <p>
   <b> DÉCIMA QUINTA. HORARIO DE TRABAJO:</b> EL TRABAJADOR se obliga a laborar la jornada ordinaria en los turnos y dentro de las horas señaladas por EL EMPLEADOR, pudiendo hacer éste ajustes o cambios de horario cuando lo estime conveniente. Por el acuerdo expreso o tácito de las partes, podrán repartirse las horas jornada ordinaria de la forma prevista en el artículo 164 del Código Sustantivo del Trabajo, modificado por el artículo 23 de la Ley 50 de 1990, teniendo en cuenta que los tiempos de descanso entre las secciones de la jornada no se computan dentro de la misma, según el artículo 167 ibídem. 
    </p>
    <p>
    <b>DÉCIMA SEXTA. AFILIACIÓN Y PAGO A SEGURIDAD SOCIAL:</b> Es obligación de EL EMPLEADOR afiliar a EL TRABAJADOR a la seguridad social a los sistemas de salud y pensión, así como también a caja de compensación y a riesgos laborales, para dicha afiliación EL TRABAJADOR deberá autorizar el descuento en su salario de los valores que le corresponda aportar, esto en la proporción establecida por la ley.
    </p>
    <p>
    <b>PARÁGRAFO:</b> Para proceder a afiliar a los beneficiarios de EL TRABAJADOR, este deberá aportar los documentos exigidos por las diferentes entidades y acreditar el parentesco si dicha condición es requerida.  
    </p>
    <p>
    <b>DÉCIMA SÉPTIMA: CONFIDENCIALIDAD.</b> EL TRABAJADOR se abstendrá de divulgar, publicar o comunicar a terceros, información, documentos o fotografías relacionadas con el desarrollo del presente contrato, que conozcan por virtud de la ejecución del contrato o por cualquier otra causa. Para estos efectos, las partes convienen que toda información que reciba EL TRABAJADOR por parte de EL EMPLEADOR se considera importante y confidencial y divulgarla o transmitirla se constituirá en causal suficiente para dar por terminado el presente contrato unilateralmente. Esta obligación se regirá de acuerdo a lo estipulado en el Capítulo XX referente a Propiedad Intelectual y Confidencialidad del Reglamento Interno de Trabajo.
    </p>
    <p>
    <b>PARÁGRAFO PRIMERO:</b> LAS PARTES convienen en que entre ellas se firmará un Acuerdo de Confidencialidad y No Divulgación en el cual se detalla y precisa todo lo concerniente a las obligaciones de confidencialidad en desarrollo de la relación laboral que aquí se pacta. 
    </p>
    <p>
    <b>PARÁGRAFO SEGUNDO:</b> EL TRABAJADOR será responsable ante EL EMPLEADOR, por los perjuicios que sean ocasionados por el incumplimiento de las obligaciones derivadas del acuerdo de confidencialidad y de las establecidas en el presente documento.
    </p>
   <p>
   <b>DÉCIMA OCTAVA: MODIFICACIONES.</b>  Cualquier modificación al presente contrato debe efectuarse por escrito y anexarse a este documento.
   </p>
   <p>
   <b>DÉCIMA NOVENA. VERIFICACIÓN REGLAMENTO INTERNO DE TRABAJO (RIT):</b> EL TRABAJADOR deja constancia que previamente a la firma del presente Contrato de Trabajo, le fue entregada una copia del Reglamento Interno de Trabajo, y le fueron absueltas las inquietudes que se presentaron respecto a dicho documento.
   </p>
   <p>
   <b>VIGÉSIMA. VERIFICACIÓN DE LOS PROCEDIMIENTOS OPERATIVOS ESTANDARIZADOS DE SANEAMIENTO (POES):</b> El TRABAJADOR deja constancia que previamente a la firma del presente Contrato de Trabajo, le fue entregada copia de los POES de su área, y le fueron absueltas las inquietudes que se presentaron al respecto.
   </p>
   <p>
   <b>VIGÉSIMA PRIMERA. VERACIDAD DE LA DOCUMENTACIÓN:</b> EL TRABAJADOR, manifiesta bajo la gravedad de juramento, que cada uno de los documentos presentados dentro del proceso de vinculación con la compañía son veraces y que no se encuentra incurso en causal alguna que imposibilite su contratación con el cumplimiento de la totalidad de los requisitos legales
   </p>
   <p>
   <b>VIGÉSIMA SEGUNDA. AUTORIZACIÓN PARA EL TRATAMIENTO DE DATOS - HABEAS DATA.</b> El TRABAJADOR autoriza al EMPLEADOR a para tratar los datos personales que se suministren en desarrollo de la presente relación laboral, durante todo el tiempo de permanencia en la compañía y después de terminada la relación, esto, siempre y cuando exista un deber de conservación legal o contractual por parte de EL EMPLEADOR. La autorización de tratamiento de datos personales se otorga por parte del trabajador dentro de lo descrito en la Política de Protección de Datos Personales y se ajusta a lo prescrito en la Ley 1581 de 2012. De igual forma, EL TRABAJADOR deja constancia que previamente a la firma del presente contrato de trabajo, fue entregada copia de la Política de Tratamiento de Datos de la compañía, y fueron absueltas las inquietudes que se presentaron al respecto.
   </p>
   <p>
   <b>VIGÉSIMA TERCERA. INTERPRETACIÓN Y VACÍOS.</b> En caso tal que se presente algún vacío, vicio o contradicción al momento de interpretar las obligaciones laborales de las partes en el presente contrato, será usada como herramienta supletoria lo reglado en el Código Sustantivo de Trabajo y las demás normas concordantes.
   </p>
   <p>
  <b> VIGÉSIMA CUARTA. DIFERENCIA ENTRE LAS PARTES:</b> Toda diferencia que surja entre LAS PARTES con relación a la ejecución, interpretación, terminación y liquidación del presente contrato, se resolverá de la siguiente manera:
     <br>• En primera instancia se intentará resolver mediante conciliación privada y directa entre las partes por un término de quince (15) días hábiles. <br>
     •De no lograrse ningún acuerdo se podrán someter a solicitud de cualquiera de las partes, a conciliación ante un centro de conciliación que funcione en la ciudad de Bogotá debidamente reconocido y autorizado por el Ministerio de Justicia. <br>
     •En el evento que las partes no llegaren a ningún acuerdo, cada una queda en libertad de acudir a la Justicia Ordinaria.

    </p>
<p>
<b>VIGÉSIMA QUINTA. MÉRITO EJECUTIVO:</b> El presente contrato prestará mérito ejecutivo para hacer exigible el cumplimiento o pago de cualquier obligación o suma de dinero que se cause en virtud de él, sin necesidad de requerimiento judicial o extrajudicial alguno.
</p>
<p>
<b>VIGÉSIMA SEXTA. TERMINACIÓN:</b> El presente contrato podrá darse por terminado por las siguientes causas:
<br>• Por mutuo acuerdo con la obligación por parte de EL EMPLEADOR de efectuar el pago de los salarios causados hasta el momento de la terminación. <br>
• Por incumplimiento probado de cualquiera de LAS PARTES de las obligaciones pactadas, situación que faculta a la otra parte para dar por terminado el presente contrato. <br>
•Por decisión unilateral de EL EMPLEADOR quedando obligado a cancelar a la terminación efectiva del contrato cualquier monto adeudado a EL TRABAJADOR.
</p>
<p>
<b>PARÁGRAFO:</b> También dará lugar a la terminación del contrato de manera automática, el que EL TRABAJADOR se encuentre reportado en el sistema de administración de riesgos de lavado de activos y financiación del terrorismo – SARLAFT- o que se vea involucrado directa o indirectamente en actividades de lavado de activos y financiación del terrorismo, independiente del momento en el que se realice dicho reporte, es decir, sea anterior o posterior al inicio de la relación contractual entre LAS PARTES.
</p>
<p>
<b>VIGÉSIMA SÉPTIMA. DOMICILIO CONTRACTUAL Y LEY APLICABLE:</b> El presente Contrato se regirá e interpretará de conformidad con las leyes de la República de Colombia. Para todos los efectos legales derivados del presente Contrato, los comparecientes fijan su domicilio convencional en la ciudad Bogotá.
<br>
Para efecto de notificaciones, las partes recibirán correspondencia en las siguientes direcciones:
</p>
<br><br>
<p>
<b>EL TRABAJADOR: </b>
<br>
'.$nombre.'<br>
<b>DIRECCIÓN:</b> '.$direccion.'<br>
<b>CELULAR:</b> '.$telefono.'<br>
<b>CORREO ELECTRÓNICO:</b> '.$email.'<br>
<b>EL EMPLEADOR:</b><br>
JJ QUIMIENVASES S.A.S.<br>
<b>DIRECCIÓN:</b>  Carrera 25 N° 66-82 Barrio Siete de Agosto.  <br>
<b>PBX:</b> 3504931355-6095089<br>
<b><a>www.jjquimienvases.com</a></b>
</p>


<p> 
<b>VIGÉSIMA OCTAVA. EFECTOS:</b> El presente contrato reemplaza y deja sin efecto cualquier otro contrato verbal o escrito, que se hubiera celebrado entre las partes con anterioridad.
<br>
Una vez leída y aprobada por las partes se firma el presente contrato de trabajo en dos (2) ejemplares. Se firma el día '.$fecha_inicio.' en la ciudad de Bogotá D.C.
</p>
<br>
<br>
<br>
<br>

<p>
<b>EL EMPLEADOR: </b>
<br>
<br>
<br>
<br>
_________________________________
<br>
<b>JORGE EDUARDO AVILA.</b><br>
<b>REPRESENTANTE LEGAL.</b><br>
<b>JJ QUIMIENVASES S.A.S.</b><br>
</p>
<br>
<div id="izquierda_contrato">
<p>
<b>EL TRABAJADOR: </b><br>
<br>
<br>
<br>
<br>
<br>
_______________________________
<br>
<b>'.$nombre.'</b><br>
<b>c.c. No. '.$cedula.'</b><br>
<b>'.$cargo.'</b><br>
</p>
</div>
<div id="derecha_contrato">
 
</div>
<br>
<br>
<br>
<br>
<br>
<div id="other_white"> </div>
<p>
Bogotá D.C._______________DE______________DE__________________
</p>
<br>
<p> Señor(a)</p>
<br>
<p><b>'.$nombre.'</b></p>
<p><b>'.$cargo.'</b></p>
<p>Asunto:Preaviso NO Prorroga de Contrato de Trabajo </p>
<p>Reciba un Cordial saludo</p>
<p> 
Nos permitimos informarle que su contrato de trabajo, el cual vence el día ______ del mes _________ del ________, no será prorrogado dando cumplimiento a la obligación estipulada en el artículo 46 del Código Sustantivo del Trabajo.
 <br>
Agradecemos la colaboración prestada a nuestra compañía, y le recordamos que estamos prestos a referenciar su desempeño y apoyo en las labores realizadas.
</p>
<br>
<p>Sin otro particular.</p>
<p>
<b> JJ QUIMIENVASES S.A.S.</b><br>
<b> NIT 901.291.848-4 </b><br>
<b> JORGE EDUARDO AVILA</b>
</p>
<table>
<tr>
<td><br>
<p>Firma:________________________ </p><br>
<p>Nombre:_______________________</p><br>
<p>Cédula:________________________</p>
</td>
</tr>
</table>
';

// create pdf of invoice

$invoiceFileName = 'Contrato-'.$nombre.'.pdf';

require_once '../dompdf/src/Autoloader.php';

Dompdf\Autoloader::register();

use Dompdf\Dompdf;

$dompdf = new Dompdf();
$dompdf->loadHtml(html_entity_decode($output));
$dompdf->setPaper('letter', 'portrait');
$dompdf->render();
$dompdf->stream($invoiceFileName, array("Attachment" => false));
/* $dompdf->page_text(1,1, "{PAGE_NUM} of {PAGE_COUNT}", $font, 10, array(0,0,0));*/

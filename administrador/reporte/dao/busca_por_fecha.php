<?php
error_reporting(E_ALL ^ E_NOTICE);
require_once '../dao/adminDAO.php';

$impr = new adminDAO();


//EJECUTAMOS LA CONSULTA DE BUSQUEDA
if($_POST['desde']==false || $_POST['hasta']==false){
	include('../includes/imprimir_bitacora.php');
}else{
	$desde = $_POST['desde']."&nbsp;"."08:01:00" ;
	$hasta = $_POST['hasta']."&nbsp;"."19:59:59";

	// var_dump($desde);
	// var_dump($hasta);
	//
	// return;

	//EJECUTAMOS LA CONSULTA DE BUSQUEDA



	$datos = $impr->buscarAllBitacoraFecha($desde,$hasta);


?>
<?php
	if(count($datos)>0){
	for($x=0; $x<count($datos); $x++){
?>
<tr>
	<td><?php  $x; $l = $x+1; echo $l; ?></xtd>
	<td><?php echo $datos[$x]['order_date']; ?></td>
	<td><?php echo $datos[$x]['order_id']; ?></td>
	<td><?php echo $datos[$x]['order_receiver_name']; ?></td>
	<td><input type="text" name="" id="totales" value="<?php echo $datos[$x]['order_total_after_tax']; ?>">  </td>
</tr>

<?php
	}
	}else{
?>
	<tr class="odd"><td valign="top" colspan="8" class="dataTables_empty">No hay datos disponibles en la tabla</td></tr>
<?php
	}
}
?>

<?php
session_start();
include('header.php');
include 'orden_invoice.php';
	$invoiceItems = 0;
$invoice = new Invoice();
$invoice->checkLoggedIn();
if(!empty($_POST['companyName']) && $_POST['companyName'] && !empty($_POST['invoiceId']) && $_POST['invoiceId']) {

	 // echo "<pre>";
   //    print_r($_POST);
	 // echo "</pre>";
	 //
	 // return;


 $invoice->updateInvoice($_POST);

	echo '<script language="javascript">alert("SE ACTUALIZO CORRECTAMENE");</script>';
	header("location:orden_lista.php");
}if(!empty($_GET['update_id']) && $_GET['update_id']) {
	$invoiceValues = $invoice->getInvoice($_GET['update_id']);
	$invoiceItems = $invoice->getInvoiceItems($_GET['update_id']);
}

$mysqli2 = new mysqli ('localhost', 'root', '', 'cotpruebas');

?>
<title>Editar Orden de compra </title>
<link rel="stylesheet" type="text/css" href="css/select2.css">
<script src="jquery-3.1.1.min.js"></script>
<script src="js/select2.js"></script>
<script src="js/orden.js"></script>
<link href="css/style.css" rel="stylesheet">
<?php include('container.php');?>
<div class="container content-invoice">
    	<form action="" id="invoice-form" method="post" class="invoice-form" role="form" novalidate>
	    	<div class="load-animate animated fadeInUp">
		    	<div class="row">
		    		<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
		    			<h1 class="title">Editar Orden</h1>
						<?php include('menu.php');?>
		    		</div>
		    	</div>
		      	<input id="currency" type="hidden" value="$">
		    	<div class="row">
		      		<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
		      			<h3>De,</h3>
						<?php echo $_SESSION['user']; ?><br>
						<?php echo $_SESSION['address']; ?><br>
						<?php echo $_SESSION['mobile']; ?><br>
						<?php echo $_SESSION['email']; ?><br>
		      		</div>
		      		<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 pull-right">
		      			<h3>Para,</h3>
		      					<div class="form-group">
							<input value="<?php echo $invoiceValues['order_receiver_name']; ?>" type="text" class="form-control" name="companyName" id="companyName" placeholder="Nombre del cliente" autocomplete="off">
						</div>
				    <div class="form-group">
					<input value="<?php echo $invoiceValues['direccion']; ?>" type="text" class="form-control" name="direccion" id="direccion" placeholder="Direccion" autocomplete="off">
				   </div>
				   <div class="form-group">
			<input value="<?php echo $invoiceValues['ciudad']; ?>" type="text" class="form-control" name="ciudad" id="ciudad" placeholder="Ciudad" autocomplete="off">
		            </div>
		        </div>
		      	</div>
		      	<div class="row">
		      		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
<table class="table table-bordered table-hover" id="invoiceItem">
<tr>
<th width="2%"><input id="checkAll" class="formcontrol" type="checkbox"></th>
<th width="5%">Buscar aqui</th>
<th width ="2%">Cat</th>
<th width="8%">SKU</th>
<th width="15%">Producto</th>
<th width="15%">Stock</th>
<th width="15%">Empaque</th>
<th width="15%">Q - Cajas</th>
<th width="15%">Cantidad</th>
<th width="15%">Costo</th>
<th width="15%">Total</th>

</tr>

<?php
$count = 0;
foreach($invoiceItems as $invoiceItem){
    $count++;
?>
<tr>
    <td><input class="itemRow" type="checkbox"></td>
		<td>
			<div style="text-align: center;">
					 <select id="mibuscador" style="width: 310px">
						 <option value="0">Seleccione:</option>
								<?php
									$query = $mysqli2 -> query ("SELECT * FROM producto");
									while ($valores = mysqli_fetch_array($query)) {
										echo '<option value="'.$valores[id].'">'.$valores[contratipo].','.$valores[id].'</option>';
									}
								?>
					 </select>
			 </div></td>
<!-- Prod. No -->
<td><input type="number" value="<?php echo $invoiceItem["item_code"]; ?>" name="productCode[]" id="productCode_<?php echo $count; ?>" class="form-control" autocomplete="off"></td>
<td><input type="number" value="<?php echo $invoiceItem["id_categoria"]; ?>" name="productCat[]" id="productCat_<?php echo $count; ?>" class="form-control" autocomplete="off"></td>
<!-- Contratipo -->
<td><input type="text" value="<?php echo $invoiceItem["item_name"]; ?>" name="productName[]" id="productName_<?php echo $count; ?>" class="form-control quantity" autocomplete="off"></td>
<!-- Cantidad cajas -->
<td><input type="text" value="<?php echo $invoiceItem["order_item_quantity"]; ?>" name="cantidad[]" id="quantity_<?php echo $count; ?>" class="form-control price" autocomplete="off" ></td>
<!--Cantidad numeros -->
<td id="id_calcular"><input type="number" value="<?php echo $invoiceItem["cantidad_numero"]; ?>" name="quantity[]" id="quantityN_<?php echo $count; ?>" class="form-control price" autocomplete="off" onkeyup="return run_calcular(event, 1)"></td>
<!-- costo -->
<td><input type="number" value="<?php echo $invoiceItem["item_price"]; ?>" name="price" id="precio_<?php echo $count; ?>" class="form-control price" autocomplete="off" ></td>
<!-- total -->
<td><input type="number" value="<?php echo $invoiceItem["result"]; ?>" name="result[]" id="result_<?php echo $count; ?>" class="form-control price" autocomplete="off" ></td>

</tr>
 <?php } ?>
</table>
		      		</div>
		      	</div>
		      	<div class="row">
		      		<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
		      			<button class="btn btn-danger delete" id="removeRows" type="button">- Eliminar</button>
		      			<button class="btn btn-success" id="addRows" type="button">+ Aè´–adir</button>
		      		</div>
		      	</div>
						<br>
									 <div class="form-group">
										 <label for=""> Hacer click en este boton si no se suman los totales</label><br>
											<button type="button" class="btn btn-warning" name="button" onclick="return run_calcular(event, 1)">Calcular Total</button>
									 </div>

		      	<div class="row">
		      		<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">

								<hr>
		      			<h3>Notas: </h3>
		      			<div class="form-group">
							<textarea class="form-control txt" rows="5" name="notes" id="notes" placeholder="Your Notes"><?php echo $invoiceValues['note']; ?></textarea>
						</div>
						<br>
						<div class="form-group">
							<input type="hidden" value="<?php echo $_SESSION['userid']; ?>" class="form-control" name="userId">
							<input type="hidden" value="<?php echo $invoiceValues['order_id']; ?>" class="form-control" name="invoiceId" id="invoiceId">
			      			<input data-loading-text="Actualizando Cotizacion" type="submit" name="invoice_btn" value="Guardar Cotizacion" class="btn btn-success submit_btn invoice-save-btm">
			      		</div>

		      		</div>
							<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
									<span class="form-inline">
											<div class="form-group">
													<label>Subtotal: &nbsp;</label>
													<div class="input-group">
															<div class="input-group-addon currency">$</div>

														 <input value="" type="number" class="form-control" name="subTotal" id="subTotal" placeholder="Subtotal">
													</div>
											</div>
											<div class="form-group">
													<label>Total: &nbsp;</label>
													<div class="input-group">
															<div class="input-group-addon currency">$</div>
															<input value="" type="number" class="form-control" name="totalAftertax" id="totalAftertax" placeholder="Total">
													</div>
											</div>
									</span>
							</div>

		      	</div>
		      	<div class="clearfix"></div>
	      	</div>
		</form>
    </div>
    </div>
<script>
function ver_datos(id, e){
var dato = document.getElementById('producto'+id);
e.preventDefault();
}


$("#mibuscador").on('change',function(){
	$.ajax({
		url:'methods/conexion.php',
		type:'POST',
		dataType:'json',
		data:{key:'Q1',producto:$(this).val()}
	}).done(function(d){

		let padre = $("#mibuscador").parent().parent().parent();
		padre.find("[name^=idCategoria]").val(d.resultado.id_categoria)
		padre.find("[name^=productCode]").val(d.resultado.id)
		padre.find("[name^=productName]").val(d.resultado.contratipo)
		padre.find("[name^=price]").val(d.resultado.gramo)
	}).fail(function(e){console.log("ERROR:",e);});
})

function run_calcular(e, id){
	 calculateTotal(id);
}


$(document).ready(function(){
			$('#mibuscador').select2();
	});


</script>
<script type="text/javascript">
function confirmSave()
{
 var respuesta = confirm("è¢ƒEstas seguro que quieres editar esta cotizacion?");
 if (respuesta == true){
	 return true;
 }
 else {
	 return false;
 }}
</script>

<?php include('footer.php');?>

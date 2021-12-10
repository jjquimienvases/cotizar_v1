<?php
include 'conectar.php';
$con = conectar();

session_start();


$cot = $_GET['update_id'];
$invoiceValue = $con->query("SELECT * FROM factura_orden WHERE order_id = $cot");
$invoiceItems = $con->query("SELECT * FROM factura_orden_producto WHERE order_id = $cot");

?>
<title>Editar Cotizaciones</title>
<link rel="stylesheet" type="text/css" href="css/select2.css">
<script src="jquery-3.1.1.min.js"></script>
<script src="js/select2.js"></script>
<script src="js/invoice_ibague.js"></script>
<link href="css/style.css" rel="stylesheet">
<?php include('container.php');?>
<div class="container content-invoice">
    	<form action="" id="invoice-form" method="post" class="invoice-form" role="form" novalidate>
	    	<div class="load-animate animated fadeInUp">
		    	<div class="row">
		    		<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
		    			<h1 class="title">Editar cotizacion ibague</h1>
						<?php include('menu6.php');?>
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
							<input value="<?php echo $invoiceValues['cedula']; ?>" type="text" class="form-control" name="cedula" id="cedula" placeholder="Ingresar la Cedula o nit" autocomplete="off">
						</div>
						<div class="form-group">
					<input value="<?php echo $invoiceValues['tel_client']; ?>" type="text" class="form-control" name="tele" id="tele" placeholder="Telefono" autocomplete="off">
			    	</div>
				    <div class="form-group">
					<input value="<?php echo $invoiceValues['direccion']; ?>" type="text" class="form-control" name="direccion" id="direccion" placeholder="Direccion" autocomplete="off">
				   </div>
				   <div class="form-group">
			<input value="<?php echo $invoiceValues['ciudad']; ?>" type="text" class="form-control" name="ciudad" id="ciudad" placeholder="Ciudad" autocomplete="off">
		            </div>
						<div class="form-group">
              <input value="<?php echo $invoiceValues['order_receiver_address']; ?>" type="text" class="form-control" name="ciudad" id="ciudad" placeholder="Ciudad" autocomplete="off">
						</div>

						<div>
<div class="form-group">
<p>Elegir un metodo de pago</p>
<select name="metodopago" class="pagoselection">
 <option value="bancolombia"selected>Bancolombia</option>
 <option value="davivienda">Davivienda</option>
 <option value="daviplata">Daviplata</option>
 <option value="nequi">Nequi</option>
</select>
 	 </div>
		        </div>
		      	</div>
		      	<div class="row">
		      		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
<table class="table table-bordered table-hover" id="invoiceItem">
  <tr>
  		<th width="2%"><input id="checkAll" class="formcontrol" type="checkbox"></th>
   			<th width="5%">Buscar aqui</th>
   			<th width ="2%">Categoria</th>
   			<th width="8%">Prod. No</th>
   			<th width="15%">Contratipo</th>
              <th width="8%">Stock</th>
  			<th width="8%">U. Empaque</th>
   			<th width="5%">Cantidad</th>
   			<th width="8%">P.Unitario</th>
   			<th width="5%">Precio</th>
   			<th width="20%">Total</th>
  </tr>

<?php
$count = 0;
foreach($invoiceItems as $invoiceItem){
    $count++;
?>
<tr>
    <td><input class="itemRow" type="checkbox"></td>
		 <td><center id="mibuscador">
		 </center> </td>
<!--categoria del producto -->
    <td><input type="text" value="<?php echo $invoiceItem["item_categoria"]; ?>" name="idCategoria[]" id="idCategoria_<?php echo $count; ?>" class="form-control" autocomplete="off"></td>
<!-- Prod. No -->
	 <td><input type="number" value="<?php echo $invoiceItem["item_code"]; ?>" name="productCode[]" id="productCode_<?php echo $count; ?>" class="form-control" autocomplete="off"></td>
<!-- Contratipo -->
    <td><input type="text" value="<?php echo $invoiceItem["item_name"]; ?>" name="productName[]" id="productName_<?php echo $count; ?>" class="form-control quantity" autocomplete="off"></td>
<!-- STOCK -->
    <td><input type="text" value="<?php echo $invoiceItem["stock"]; ?>" name="productStock[]" id="productStock_<?php echo $count; ?>" class="form-control quantity" autocomplete="off"></td>
<!-- CANTIDAD X CAJA -->
    <td><input type="text" value="<?php echo $invoiceItem["unidad"]; ?>" name="productUnidad[]" id="productUnidad_<?php echo $count; ?>" class="form-control quantity" autocomplete="off"></td>
<!-- Cantidad -->
    <td id="id_calcular"><input type="number" value="<?php echo $invoiceItem["order_item_quantity"]; ?>" name="quantity[]" id="quantity_<?php echo $count; ?>" class="form-control price" autocomplete="off" onkeyup="calculateTotal(<?=$count?>)"></td>
<!-- unitario -->
    <td><input type="number" value="<?php echo $invoiceItem["order_item_unitario"]; ?>" name="unitario[]" class="prints" id="unitario_<?php echo $count; ?>" class="from-control total" autocomplete="off"></td>
<!-- Precio -->
    <td><input type="number" value="<?php echo $invoiceItem["order_item_price"]; ?>" name="total[]" class="prints" id="total_<?php echo $count; ?>" class="form-control total" autocomplete="off"></td>
<!--Total-->
    <td><input type="number" class="form-control Total"  placeholder="Total" name="result[]" id="result_<?php echo $count; ?>" value="<?php echo $invoiceItem['order_item_final_amount']; ?>" ></td>
	<!-- Prod. No -->
</tr>
 <?php } ?>
</table>
		      		</div>
		      	</div>
		      	<div class="row">
		      		<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
		      			<button class="btn btn-danger delete" id="removeRows" type="button">- Eliminar</button>
		      			<button class="btn btn-success" id="addRows" type="button">+ Añadir</button>
		      		</div>
		      	</div>

		      	<div class="row">
		      		<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
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
									<input value="<?php echo $invoiceValues['order_total_before_tax']; ?>" type="number" class="form-control" name="subTotal" id="subTotal" placeholder="Subtotal">
								</div>
							</div>
							<div class="form-group">
								<label>Total: &nbsp;</label>
								<div class="input-group">
									<div class="input-group-addon currency">$</div>
									<input value="<?php echo $invoiceValues['order_total_after_tax']; ?>" type="number" class="form-control" name="totalAftertax" id="totalAftertax" placeholder="Total">
								</div>
							</div>
        <div class="form-group">
					 <label>Porcentaje: &nbsp;</label>
					 <div class="input-group">
							 <input value="" type="number" class="form-control" value="0" min="0" name="taxRate" id="taxRate" placeholder="Porcentaje descuento">
							 <div class="input-group-addon">%</div>
					 </div>
			         </div>
			 <div class="form-group">
					 <label>Descuento: &nbsp;</label>
					 <div class="input-group">
							 <div class="input-group-addon currency">$</div>
							 <input value="" type="number" class="form-control" name="taxAmount" id="taxAmount" placeholder="Monto del descuento">
					 </div>
			         </div>
							<div class="form-group">
								<label>Cantidad pagada &nbsp;</label>
								<div class="input-group">
									<div class="input-group-addon currency">$</div>
									<input value="<?php echo $invoiceValues['order_amount_paid']; ?>" type="number" class="form-control" name="amountPaid" id="amountPaid" placeholder="Amount Paid">
								</div>
							</div>
							<div class="form-group">
								<label>Cantidad a cobrar &nbsp;</label>
								<div class="input-group">
									<div class="input-group-addon currency">$</div>
									<input value="<?php echo $invoiceValues['order_total_amount_due']; ?>" type="number" class="form-control" name="amountDue" id="amountDue" placeholder="Amount Due">
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
 var respuesta = confirm("¿Estas seguro que quieres editar esta cotizacion?");
 if (respuesta == true){
	 return true;
 }
 else {
	 return false;
 }}
</script>

<?php include('footer.php');?>

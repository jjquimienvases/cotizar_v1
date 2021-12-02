<?php
include 'conectar.php';
$con = conectar();

session_start();

if($con){
echo "okok";
}else{
echo "asa";
}

return;

$cot = $_GET['invoice_id'];
$invoiceValues = $con->query("SELECT * FROM factura_orden WHERE order_id = $cot");
$invoiceItem = $con->query("SELECT * FROM factura_orden_producto WHERE order_id = $cot");
?>
<title>Editar Cotizaciones</title>
<script src="jquery-3.5.1.min.js"></script>

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous">
</script>
<script src="alertifyjs/alertify.min.js"></script>
<link href="//cdn.jsdelivr.net/npm/@sweetalert2/theme-minimal@4/minimal.css" rel="stylesheet">
<script src="//cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.js"></script>
<script src="js/edit.js"></script>
<style>
	.table_contenedor {
		width: 120%;
		border: 1px solid #000;
		text-align: center;
	}

	th,
	td {
		text-align: center;
		vertical-align: top;
		border: 0.5px solid #000;
	}

	#ocult {
		display: none;
	}

	#left {

		float: left;
	}

	#buttonh {
		display: none;
	}

	a {
		color: white;
	}
</style>

<hr>
<br>
<div class="container-fluid content-invoice">
	<form id="invoice-form" method="post" class="invoice-form" role="form">
		<div class="load-animate animated fadeInUp">
			<div class="row">
				<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
					<h1 class="title">Editar Cotizaciones</h1>
					<button class="btn btn-info"> <a href="Panel_Comerciales.php">Regresar al panel de comerciales </a> </button>
				</div>
			</div>
			<input id="currency" type="hidden" value="$">
			<div class="row">
				<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 ml-5">
					<h3>De,</h3>
					<?php echo $_SESSION['user']; ?><br>
					<?php echo $_SESSION['address']; ?><br>
					<?php echo $_SESSION['mobile']; ?><br>
					<?php echo $_SESSION['email']; ?><br>
				</div>
				<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 pull-right">
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
						<input value="<?php echo $invoiceValues['email']; ?>" type="text" class="form-control" name="email" id="email" placeholder="Correo electronico" autocomplete="off">
					</div>
					<div class="form-group">
						<input class="form-control" rows="3" name="address" id="address" placeholder="Cotizante" value="<?php echo $invoiceValues['order_receiver_address']; ?>" readonly>
					</div>
					<button type="button" class="btn btn-success" onclick="showInfo()" id="buttons">Mostrar Opciones de venta</button>
					<button type="button" class="btn btn-danger" onclick="hiddenInfo()" id="buttonh">Cerrar Opciones de venta</button>
					<div id="ocult">
						<div class="form-group">
							<label for=""> Clientes Especiales Perfumeria</label>
							<td><input class="cEspeciales" type="checkbox" id="cEspeciales" name="cEspeciales"></td>
						</div>
						<div class="form-group">
							<label for=""> PUNTO QUIMICO</label>
							<td><input class="itemRous" type="checkbox" id="quimico" name="quimico"></td>
						</div>
						<div class="form-group">
							<label for=""> Jhon Jairo R</label>
							<td><input class="itemjohn" type="checkbox" id="john" name="john"></td>
						</div>
						<div class="form-group">
							<label for=""> ALGRANEL</label>
							<td><input class="itemRus" type="checkbox" id="granel" name="granel"></td>
						</div>
						<div class="form-group">
							<label for=""> Mercado libre</label>
							<td><input class="itemsmercado" type="checkbox" id="mercado" name="mercado"></td>
						</div>
						<div class="form-group">
							<label for=""> Promocion Pets</label>
							<td><input class="p_especial" type="checkbox" id="p_especial" name="p_especial"></td>
						</div>
						     <div class="form-group">
                        <label>Perfumeria P-C</label>
                        <td> <input class="p_perfumeria" type="checkbox" id="p_perfumeria" name='p_perfumeria'> </td> 
                     </div>
					</div>
					<br>
					<div class="form-group pt-3">

						<label for="metodo">Escoger un metodo de pago:</label>
						<select name="metodopago" class="form-control" id="metodo">
							<option value="bancolombia" selected>Bancolombia</option>
							<option value="davivienda">Davivienda</option>
							<option value="daviplata">Daviplata</option>
							<option value="nequi">Nequi</option>
						</select>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
					<table class="table table-bordered" id="invoiceItem">
						<tr>
							<th><input id="checkAll" class="formcontrol" type="checkbox"></th>
							<th>Buscar aqui</th>
							<th>C</th>
							<th>SKU</th>
							<th>Contratipo</th>
							<th>Stock</th>
							<th>U. Empaque</th>
							<th>Cantidad</th>
							<th>P.Unitario</th>

							<th width="20%">Total</th>
						</tr>

						<?php
						$count = 0;
						foreach ($invoiceItems as $invoiceItem) {
							$count++;
						?>
							<tr class="text-center">
								<td><input class="itemRow" type="checkbox"></td>
								<td>
									<select name="" id="" class="form-control"></select>
								</td>
								<!--categoria del producto -->
								<td><input type="text" value="<?php echo $invoiceItem["item_categoria"]; ?>" name="idCategoria[]" id="idCategoria_<?php echo $count; ?>" class="form-control" autocomplete="off"></td>
								<!-- Prod. No -->
								<td><input type="number" value="<?php echo $invoiceItem["item_code"]; ?>" name="productCode[]" id="productCode_<?php echo $count; ?>" class="form-control" autocomplete="off"></td>
								<!-- Contratipo -->
								<td><input type="text" value="<?php echo $invoiceItem["item_name"]; ?>" name="productName[]" id="productName_<?php echo $count; ?>" class="form-control quantity" autocomplete="off"></td>
								<!-- STOCK -->
								<td><input type="text" class="form-control" readonly></td>
								<!-- CANTIDAD X CAJA -->
								<td><input type="text" class="form-control" readonly></td>
								<!-- Cantidad -->
								<td id="id_calcular"><input type="number" value="<?php echo $invoiceItem["order_item_quantity"]; ?>" name="quantity[]" id="quantity_<?php echo $count; ?>" class="form-control price" autocomplete="off" onkeyup="calculateTotal(<?= $count ?>)"></td>
								<!-- unitario -->
								<td><input type="number" value="<?php echo $invoiceItem["order_item_unitario"]; ?>" name="unitario[]" class="form-control" id="unitario_<?php echo $count; ?>" class="from-control total" autocomplete="off"></td>
								<td><input type="number" class="form-control Total" placeholder="Total" name="result[]" id="result_<?php echo $count; ?>" value="<?php echo $invoiceItem['order_item_final_amount']; ?>"></td>
								<!-- Precio -->
								<!--Total-->
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
						<input data-loading-text="Actualizando Cotizacion" id="guardar" name="invoice_btn" value="Guardar Cotizacion" class="btn btn-success submit_btn invoice-save-btm">
					</div>

				</div>
				<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">

					<div class="card" style="width: 18rem;">
						<ul class="list-group list-group-flush">
							<li class="list-group-item">
								<div class="form-group">
									<label>Subtotal: &nbsp;</label>
									<div class="input-group">
										<div class="input-group-addon currency">$</div>
										<input value="<?php echo $invoiceValues['order_total_before_tax']; ?>" type="number" class="form-control" name="subTotal" id="subTotal" placeholder="Subtotal">
									</div>
								</div>
							</li>
							<li class="list-group-item">
								<div class="form-group" id="left">
									<label>Total: &nbsp;</label>
									<div class="input-group">
										<div class="input-group-addon currency">$</div>
										<input value="<?php echo $invoiceValues['order_total_after_tax']; ?>" type="number" class="form-control" name="totalAftertax" id="totalAftertax" placeholder="Total">
									</div>
								</div>
							</li>
							<li class="list-group-item">
								<div class="form-group">
									<label>Porcentaje: &nbsp;</label>
									<div class="input-group">
										<input value="" type="number" class="form-control" value="0" min="0" name="taxRate" id="taxRate" placeholder="Porcentaje descuento">
										<div class="input-group-addon">%</div>
									</div>
								</div>
							</li>
							<li class="list-group-item">
								<div class="form-group" id="left">
									<label>Descuento: &nbsp;</label>
									<div class="input-group">
										<div class="input-group-addon currency">$</div>
										<input value="" type="number" class="form-control" name="taxAmount" id="taxAmount" placeholder="Monto del descuento">
									</div>
								</div>
							</li>
							<li class="list-group-item">
								<div class="form-group">
									<label>Abono &nbsp;</label>
									<div class="input-group">
										<div class="input-group-addon currency">$</div>
										<input value="<?php echo $invoiceValues['order_amount_paid']; ?>" type="number" class="form-control" name="amountPaid" id="amountPaid" placeholder="Amount Paid">
									</div>
								</div>
								<div class="form-group" id="left">
									<label>Cantidad a cobrar &nbsp;</label>
									<div class="input-group">
										<div class="input-group-addon currency">$</div>
										<input value="<?php echo $invoiceValues['order_total_amount_due']; ?>" type="number" class="form-control" name="amountDue" id="amountDue" placeholder="Amount Due">
									</div>
								</div>
							</li>

						</ul>
					</div>




				</div>
			</div>
			<div class="clearfix"></div>
		</div>
	</form>
</div>
</div>
<script>
	function ver_datos(id, e) {
		var dato = document.getElementById('producto' + id);
		e.preventDefault();
	}


	$("#mibuscador").on('change', function() {
		$.ajax({
			url: 'methods/conexion_callcenter.php',
			type: 'POST',
			dataType: 'json',
			data: {
				key: 'Q1',
				producto: $(this).val()
			}
		}).done(function(d) {

			let padre = $("#mibuscador").parent().parent().parent();
			padre.find("[name^=idCategoria]").val(d.resultado.id_categoria)
			padre.find("[name^=productCode]").val(d.resultado.id)
			padre.find("[name^=productName]").val(d.resultado.contratipo)
			padre.find("[name^=price]").val(d.resultado.gramo)
			padre.find("[name^=productStock]").val(d.resultado.stock)
			padre.find("[name^=productUnidad]").val(d.resultado.unidad)
		}).fail(function(e) {
			console.log("ERROR:", e);
		});
	})

	function run_calcular(e, id) {
		calculateTotal(id);
	}


	$(document).ready(function() {
		$('#mibuscador').select2();
	});
</script>
<script type="text/javascript">

</script>


<script type="text/javascript">
	$(document).ready(function() {

		$('#guardar').click(function() {
			var datos = $('#invoice-form').serialize();
			$.ajax({
				type: "POST",
				url: "send_ajax_edit.php",
				data: datos,
				success: function(r) {
					console.log(r);
					if (r != 0 && !isNaN(r)) { //SI ES DISTINTO A 0 Y ES UN NUMERO

						Swal.fire(
							'Perfecto!!',
							'Editaste esta cotizacion correctamente',
							'success'
						)

						let redirect = window.location = "search/index.php";
						setTimeout(redirect, 4000);
						console.log(datos);
					} else { //ES 0(NO SE EJECUTO LA CONSULTA) O EXISTE UN ERROR EXPLICATIVO(STRING)
						alert("no funciona");
						console.log(datos);
					}
				}
			});
			return false;
		});



	});
</script>

<?php include('footer.php'); ?>

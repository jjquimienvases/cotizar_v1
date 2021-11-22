<?php

session_start([
    'cookie_lifetime' => 86400,
    'gc_maxlifetime' => 86400,
]);

include('header.php');
include 'orden_invoice.php';
$invoice = new Invoice();
$invoice->checkLoggedIn();
	if(empty($_POST['companyName']) && empty($_POST['direccion'])) {
		echo "<script>
         alert('Completar todos los campos');
		</script>";
	}else{
		$invoice->saveOrden($_POST);
		header("location:orden_lista.php");
	}
?>
<?php

$query = $mysqli -> query ("SELECT * FROM factura_orden");

 ?>

<title>Generar Orden de compra</title>
<link rel="stylesheet" type="text/css" href="css/select2.css">
<script src="jquery-3.1.1.min.js"></script>
<script src="js/select2.js"></script>
<script src="js/orden.js"></script>
<link href="css/styleOrden.css" rel="stylesheet">
 <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous"> -->
 <?php include('container.php');?>

<div class="container content-invoice">
 <form action="" id="invoice-form" method="post" class="invoice-form" role="form" novalidate>
<div class="load-animate animated fadeInUp">
<div class="row">
<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
    <h2 class="title">Generar Orden De Compra</h2>
    <?php include('menu5.php');?>
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
      <input type="text" class="form-control" name="companyName" id="companyName" placeholder="Nombre de Empresa o cliente" autocomplete="off" required>
		</div>
		<div class="form-group">
				<input type="text" class="form-control" name="direccion" id="direccion" placeholder="Direccion" autocomplete="off" required>
		</div>
		<div class="form-group">
				<input type="text" class="form-control" name="ciudad" id="ciudad" placeholder="Ciudad" autocomplete="off" required>
		</div>
    <div class="form-group">
        <textarea class="form-control" rows="3" name="address" id="address" placeholder="Cotizante" required></textarea>
    </div>
		<hr>
</div>

</div>
</div>
 <br>
<div class="row">

<div class="contenedor">
    <table class="table table-bordered table-hover" id="invoiceItem"  >
        <tr>
			<th width="2%"><input id="checkAll" class="formcontrol" type="checkbox"></th>
			<th width="5%">Buscar aqui</th>
			<th width="8%">Prod. No</th>
			<th width="15%">Contratipo</th>
			<th width="15%">Cantidad</th>
        </tr>



    </table>
</div>
</div>
<div class="row">
<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
    <button class="btn btn-danger delete" id="removeRows" type="button">- Borrar</button>
    <button class="btn btn-success" id="addRows" type="button">+ Agregar Más</button>
</div>

</div>
<div class="row">
<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
    <h3>Notas: </h3>
    <div class="form-group">
        <textarea class="form-control txt" rows="5" name="notes" id="notes" placeholder="Notas"></textarea>
    </div>
    <br>
    <div class="form-group">
        <input type="hidden" value="<?php echo $_SESSION['userid']; ?>" class="form-control" name="userId">
				<input data-loading-text="Guardando factura..." type="submit" name="invoice_btn" value="Guardar Factura" onclick="return confirmSave()" class="btn btn-success submit_btn invoice-save-btm">
    </div>

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
		padre.find("[name^=productCode]").val(d.resultado.id)
		padre.find("[name^=productName]").val(d.resultado.contratipo)
	}).fail(function(e){console.log("ERROR:",e);});
})

function run_calcular(e, id){
	 calculateTotal(id);
}


$(document).ready(function(){
			$('#mibuscador').select2();
			$("#addRows").trigger("click");
			console.log("agregue una fila");
	});


</script>


<script type="text/javascript">
function confirmSave()
{
 var respuesta = confirm("¿Estas seguro de guardar esta orden de compra?");
 if (respuesta == true){
	return true;
 }
 else {
	return false;
 }}
</script>


<?php include('footer.php');?>


<?php

include 'conectar.php';
$conexion = conectar();


session_start([
    'cookie_lifetime' => 86400,
    'gc_maxlifetime' => 86400,
]);

include('header.php');
include 'Invoice.php';

$invoice = new Invoice();
$invoice->checkLoggedIn();


?>


<title>Orden de compra</title>
<script src="https://cdnjs.cloudflare.com/ajax/libs/blueimp-md5/2.18.0/js/md5.js" integrity="sha512-NpfrQEgzOExS1Ax8fjITKrgBFK87lZbBmvWdZk4suiCC4tsHPrTCsulgIA7Z/+CeWhDpEP/f36mNWgZXDKtTAA==" crossorigin="anonymous"></script>
<script src="jquery-3.1.1.min.js"></script>
<link rel="stylesheet" type="text/css" href="css/select2.css">
<script src="js/select2.js"></script>
<script src="js/orden.js"></script>
<script src="myquery.js"></script>
<link href="css/style.css" rel="stylesheet">
<link href="css/sketch.css" rel="stylesheet">
<style>
 	table{
		width: 80%;
	}
	#invoiceItem{
		width: 90%;
	}
	#buscador{
		width: 10%;
	}
	#cod{
		width: 5%;
	}
	#tot{
		width: 10%;
	}
	#prod{
		width: 15%;
	}
	#cat{
		width: 3%;
	}
	#productCode{
		width: 3%;
	}
	td,th{
	    margin-left:2px;

	}
</style>

<?php include('container_asistente.php');?>


<div class="container content-invoice">
 <form action="" id="invoice-form" method="post" class="invoice-form" role="form" novalidate>
<div class="load-animate animated fadeInUp">
<div class="row">
<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
    <h2 class="title">Orden de compra</h2>
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
      <input type="text" class="form-control" name="cedula" id="cedula" placeholder="Nit o Cedula" autocomplete="off" required>
		</div>
		<div class="form-group">
				<input type="text" class="form-control" name="direccion" id="direccion" placeholder="Direccion" autocomplete="off" required>
		</div>
		<div class="form-group">
				<input type="text" class="form-control" name="ciudad" id="ciudad" placeholder="Ciudad" autocomplete="off" required>
		</div>
    <div class="form-group">
        <input class="form-control" rows="3" name="telefono" id="telefono" placeholder="telefono">
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

<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
     <table class="table table-bordered table-hover" id="invoiceItem"  >
         <tr>
 			<th width="2%"><input id="checkAll" class="formcontrol" type="checkbox"></th>
 			<th id="buscador"><center>Buscar aqui</center></th>
 			<th id="cat"> <center>Cat</center> </th>
 			<th id="cod"> <center>SKU</center></th>
 			<th id="prod"> <center>Producto</center></th>
            <th width="8%"><center>Stock</center></th>
			<th width="8%"><center>Empaque</center> </th>
			<th width="8%"><center>Q - Cajas</center> </th>
 			<th width="5%"> <center>Cantidad</center> </th>
 			<th width="5%"> <center>Costo</center> </th>
 			<th id="tot"><center>Total</center></th>

         </tr>

         

     </table>
 </div>
 </div>
 <div class="row">
 <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
     <button class="btn btn-danger delete" id="removeRows" type="button">- Borrar</button>
     <button class="btn btn-success" id="addRows" type="button" accesskey="a">+ Agregar Más</button>
     	<br>
        <hr>



 </div>

 </div>
<div class="form-group">
  <label for=""> Hacer click en este boton si no se suman los totales</label><br>
   <button type="button" class="btn btn-warning" name="button" onclick="return run_calcular(event, 1)">Calcular Total</button>
</div>
  <br>

 <div class="row">
 <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
     <h3>Notas: </h3>
     <div class="form-group">
         <textarea class="form-control txt" rows="5" name="notes" id="notes" placeholder="Notas"></textarea>
     </div>
     <br>
     	<hr>

     <div class="form-group">
         <input type="hidden" value="<?php echo $_SESSION['userid']; ?>" class="form-control" name="userId">
										<input id="guardando" data-loading-text="Guardando factura..." type="submit" name="invoice_btn" value="Guardar Orden" doiclicksito class="btn btn-success submit_btn invoice-save-btm" accesskey="g">

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

 <script type="text/javascript">
function run_calcular(e, id){
	calculateTotal(id);
}
</script>



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
 		padre.find("[name^=productStock]").val(d.resultado.stock)
 		padre.find("[name^=productUnidad]").val(d.resultado.unidad)
 		padre.find("[name^=price]").val(d.resultado.gramo)
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

$("[doiclicksito]").click(function(evt){
evt.preventDefault();

});

</script>

 <?php include('footer.php');?>

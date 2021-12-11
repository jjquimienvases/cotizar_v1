<?php
session_start();
include('header.php');
include 'Invoice.php';
$invoice = new Invoice();
$invoice->checkLoggedIn();
if(!empty($_POST['companyName']) && $_POST['companyName']) {
	$invoice->saveInvoice($_POST);
	header("Location:invoice_list.php");
}
?>
<?php

include "./conexion.php";


//$datos = new stdClass;
$resultado = "";


if (isset($_POST['buscar_producto'])) {
 $conexion = conectar();
 $id = $_POST['producto'];



 $sql = "SELECT * FROM producto WHERE id='$id'  OR contratipo LIKE '%$id%' ";
 $r = $conexion->query($sql);
 if ($o = $r->fetch_object()) {
	 $resultado = $o;
 }
}
 ?>

<title>Crear facturas</title>
<script src="js/invoice.js"></script>
<link href="css/style.css" rel="stylesheet">
 <?php include('container.php');?>

<div class="container content-invoice">
	<!--que hace éste form?-->
<form action="" id="invoice-form" method="post" class="invoice-form" role="form" novalidate>
<div class="load-animate animated fadeInUp">
<div class="row">
<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
    <h2 class="title">Crear una nueva factura</h2>
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
        <input type="text" class="form-control" name="companyName" id="companyName" placeholder="Nombre de Empresa o cliente" autocomplete="off">
    </div>
    <div class="form-group">
        <textarea class="form-control" rows="3" name="address" id="address" placeholder="dirección"></textarea>
    </div>


</div>
</div>
<!-- <center>	<div class="contenedor">
					<form class="" action="" method="post">
						<div class="input-contenedor">

							<input type="text"  placeholder="Producto" name="producto" size="30" id="producto" required>
							<input type="hidden" name="buscar_producto" size="30" value="<?=isset($resultado->contratipo)?$resultado->contratipo:''?>">
						</div>
					</form>
				</div> </center> -->
 <br> <center>     <div class="container">
          <div class="row">
            <div class="col-xs-12 col-md-3">
              <div class="form-group two-fields">
                <label for="">GENERO / CODIGO PRODUCTO</label>
                <div class="input-group">
                  <input name="genero" id="genero" type="text" required class="form-control" placeholder="Genero" value="<?=isset($resultado->genero)?$resultado->genero:''?>">
                  <input name="codigo" id="id_producto" type="text" required class="form-control" placeholder="ID Producto" value="<?=isset($resultado->id)?$resultado->id:''?>">
                </div>
              </div>
            </div>
          </div>
        </div>
 </center>

<div class="row">

<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
    <table class="table table-bordered table-hover" id="invoiceItem"  >
        <tr>
            <th width="2%"><input id="checkAll" class="formcontrol" type="checkbox"></th>
            <th width="12%">Buscar aqui</th>
						<th width="8%">No. Prod</th>
						<th width="15%">Contratipo</th>
            <th width="15%">Cantidad</th>
            <th width="15%">Precio</th>
            <th width="20%">Total</th>
        </tr>

        <tr>

            <td><input class="itemRow" type="checkbox"></td>

							<td><center id="primer_form">
						 	 </center>
						 </td>
							 <td><input type="text"  placeholder="ID producto" name="productCode[]" size="15" id="productCode_1" value="">

							 </td>
	 						 <td><input type="text"  placeholder="Producto" name="productName[]" size="15" id="productName_1" value=""></td>
	             <td  id="id_calcular"><input type="number" name="quantity[]" id="quantity_1" class="form-control quantity" autocomplete="off" onkeypress="return run_calcular(event, 1)"></td>
	             <td><input type="number"  placeholder="valor kilo" name="price[]" id="price_1" value="" ></td>
	             <td ><input type="number" class="form-control Total"  placeholder="Total" name="result[]" id="result_1" value="" ></td>
            <!--<td><input type="text"  placeholder="ID producto" name="productCode[]" size="15" id="productCode_1" value="<?=isset($resultado->id)?$resultado->id:''?>"></td>
						<td><input type="text"  placeholder="Producto" name="productName[]" size="15" id="productName_1" value="<?=isset($resultado->contratipo)?$resultado->contratipo:''?>"></td>
            <td><input type="number" name="quantity[]" id="quantity_1" class="form-control quantity" autocomplete="off"></td>
            <td><input type="number"  placeholder="valor kilo" name="price[]" id="price_1" value="<?=isset($resultado->gramo)?$resultado->gramo:''?>" ></td>
            <td><input type="number" name="total[]" id="total_1" class="form-control total" autocomplete="off"></td>
        --></tr>

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
        <input data-loading-text="Guardando factura..." type="submit" name="invoice_btn" value="Guardar Factura" class="btn btn-success submit_btn invoice-save-btm">
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
            <label>Tasa Impuesto: &nbsp;</label>
            <div class="input-group">
                <input value="" type="number" class="form-control" name="taxRate" id="taxRate" placeholder="Tasa de Impuestos">
                <div class="input-group-addon">%</div>
            </div>
        </div>
        <div class="form-group">
            <label>Monto Impuesto: &nbsp;</label>
            <div class="input-group">
                <div class="input-group-addon currency">$</div>
                <input value="" type="number" class="form-control" name="taxAmount" id="taxAmount" placeholder="Monto de Impuesto">
            </div>

        <div class="form-group">
            <label>Total: &nbsp;</label>
            <div class="input-group">
                <div class="input-group-addon currency">$</div>
                <input value="" type="number" class="form-control" name="totalAftertax" id="totalAftertax" placeholder="Total">
            </div>
        </div>
        <div class="form-group">
            <label>Cantidad pagada: &nbsp;</label>
            <div class="input-group">
                <div class="input-group-addon currency">$</div>
                <input value="" type="number" class="form-control" name="amountPaid" id="amountPaid" placeholder="Cantidad pagada">
            </div>
        </div>
        <div class="form-group">
            <label>Cantidad debida: &nbsp;</label>
            <div class="input-group">
                <div class="input-group-addon currency">$</div>
                <input value="" type="number" class="form-control" name="amountDue" id="amountDue" placeholder="Cantidad debida">
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
	e.preventDefault();
	var dato = document.getElementById('producto'+id);
	var formData = new FormData();
	formData.append("key", "Q1");
	formData.append("producto", dato.value);
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
          var fjson = JSON.parse(this.responseText);
					//console.log('fjson',fjson); //esta variable contiene los datos consultados
					document.getElementById('productCode_'+id).value = fjson.id;
					document.getElementById('productName_'+id).value = fjson.contratipo;
					document.getElementById('price_'+id).value = fjson.gramo;

			}
  };
  xhttp.open("post", 'methods/conexion.php', true);
  xhttp.send(formData);
}

function run_calcular(e, id){
	 if (e.keyCode == 13) {
		 e.preventDefault();
		 calculateTotal(id);
	 }
}



htmlRows = '<form class="finder" action="" method="post" onsubmit="ver_datos(1, event)">'+
	'<div class="input-contenedor">'+
		'<input type="text"  placeholder="Producto" name="producto" size="30" id="producto1" required>'+
		'<input type="hidden" name="buscar_producto" size="15">'+
		'<label style="float:left;">Elegir categoria: </label>'+
		'<select class="" name="" style="float:right;">'+
		 '<option value="">Perfumes</option>'+
		 '<option value="">Farmaceuticos</option>'+
		 '<option value="">Alimentos</option>'+
		 '<option value="">Hoja lata</option>'+
		 '<option value="">Utilitarios</option>'+
		 '<option value="">Cristaleria</option>'+
		'</select>'+
	'</div>'+
'</form>';
$('#primer_form').append(htmlRows);


</script>
<?php include('footer.php');?>

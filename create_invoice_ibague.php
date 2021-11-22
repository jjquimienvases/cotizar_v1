<?php

session_start([
    'cookie_lifetime' => 86400,
    'gc_maxlifetime' => 86400,
]);


$user = $_SESSION['userid'];

include('header.php');
include 'Invoice.php';
$invoice = new Invoice();
$invoice->checkLoggedIn();
	if(empty($_POST['companyName']) && empty($_POST['direccion'])) {
		echo "<script>
         alert('Completar todos los campos');
		</script>";
	}else{
		$invoice->saveInvoice($_POST);
		header("location:ibague_list.php");
	}
?>
<?php
$mysqli = new mysqli('ftp.profruver.com', 'profru_jjquimi', 'LeinerM4ster', 'profru_cotpruebas');
$mysqli2 = new mysqli ('ftp.profruver.com', 'profru_jjquimi', 'LeinerM4ster', 'profru_cotpruebas');  
$query = $mysqli -> query ("SELECT * FROM factura_orden");

 ?>

 <title>Crear cotizaciones</title>
 <link rel="stylesheet" type="text/css" href="css/select2.css">
 <script src="jquery-3.1.1.min.js"></script>
 <script src="js/select2.js"></script>
 <script src="js/invoice_ibague.js"></script>
 <link href="css/style.css" rel="stylesheet">
<style>
.table_contenedor{
   width: 120%;
   border: 1px solid #000;
   text-align: center;
}
th, td {
   text-align: center;
   vertical-align: top;
   border: 0.5px solid #000;
}   
</style>
  <?php include('container_ibague.php');?>

 <div class="container content-invoice">
  <form action="" id="invoice-form" method="post" class="invoice-form" role="form" novalidate>
 <div class="load-animate animated fadeInUp">
 <div class="row">
 <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
     <h2 class="title">Crear una nueva cotizacion ibague</h2>
     <?php include('menu3.php');?>
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
                    <div class="form-group">
 <button id="myBtn">Crear Cliente</button>
 <button id="myBtnes">Editar Cliente</button>
           
       </div>
 		<div style="text-align: center;">
							<select id="buscarcliente" style="width: 100%">
								<option value="0">Buscar cliente:</option>
								<?php
								$query = $mysqli2 -> query ("SELECT * FROM clientes ORDER BY nombres ASC");
								while ($valores = mysqli_fetch_array($query)) {
									echo '<option value="'.$valores["cedula"].'">'.$valores["cedula"].','.$valores["nombres"].'</option>';
								}

								?>
							</select>
		</div>
     </div>
       <div class="form-group">
       <input type="text" class="form-control" name="companyName" id="companyName" placeholder="Nombre de Empresa o cliente" autocomplete="off" required>
 		</div>
 		    <div class="form-group">
       <input type="text" class="form-control" name="cedula" id="cedula" placeholder="cedula o nit" autocomplete="off" required>
       		 <div class="form-group">
    <input type="text" class="form-control" name="email" id="email" placeholder="Correo electronico" autocomplete="off" required>
  </div>
 		</div>
 		<div class="form-group">
 				<input type="text" class="form-control" name="tele" id="tele" placeholder="Telefono" autocomplete="off" required>
 		</div>
 		<div class="form-group">
 				<input type="text" class="form-control" name="direccion" id="direccion" placeholder="Direccion" autocomplete="off" required>
 		</div>
 		<div class="form-group">
 				<input type="text" class="form-control" name="ciudad" id="ciudad" placeholder="Ciudad" autocomplete="off" required>
 		</div>
    <div class="form-group">
  			<div style="text-align: center;">
  				 <select id="buscarcomercial" style="width: 100%" name="address">
  						 <option value="0">Busca tu nombre:</option>
  					 	<?php
  								$query = $mysqli2 -> query ("SELECT * FROM factura_usuarios order by first_name");
  								while ($valores = mysqli_fetch_array($query)) {
  									echo '<option value="'.$valores[first_name].'&nbsp;'.$valores[last_name].'">'.$valores[first_name].'&nbsp;'.$valores[last_name].'</option>';
  								}

  							?>
  				 </select>
  		 </div>
  		 </div>
 		<hr>
 		
		

 <hr>
     <div class="form-group">
     <p>Elegir un metodo de pago</p>
 <select name="metodopago" class="pagoselection">
  <option value="mostrador_ibague_1"selected>Mostrador ibague 1</option>
  <option value="mostrador_ibague_2">Mostrador ibague 2</option>
  <option value="bancolombia">Bancolombia</option>
  <option value="davivienda">Davivienda</option>
  <option value="daviplata">Daviplata</option>
  <option value="nequi">Nequi</option>

  <option value="contraentrega">contraentrega</option>
 </select>
  	</div>
 </div>

 </div>
 </div>
  <br>
 <div class="row">

 <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
     <table class="table table-bordered table-hover" id="invoiceItem"  >
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
 			<th width="1%"></th>
  
 			<th width="20%">Total</th>
         </tr>

         <tr>

             <td><input class="itemRow" type="checkbox"></td>

 	             <td>
 								 <div style="text-align: center;">
  										<select id="mibuscador" style="width: 310px">
  											<option value="0">Seleccione:</option>
  								         <?php
  								           $query = $mysqli -> query ("SELECT * FROM productos_ibague");
  								           while ($valores = mysqli_fetch_array($query)) {
  								             echo '<option value="'.$valores[id].'">'.$valores[contratipo].','.$valores[id].'</option>';
  								           }

  								         ?>
  										</select>
  								</div></td>
 						   <td><input type="text"  placeholder="Categoria" name="idCategoria[]" size="2" id="idCategoria_1" value="" style="text-align: center; width: 100%;"></td>
 							 <td><input type="text"  placeholder="ID producto" name="productCode[]" size="8" id="productCode_1" value="" style="text-align: center; width: 100%;"></td>
 	 						 <td><input type="text"  placeholder="Producto" name="productName[]" size="15" id="productName_1" value="" style="text-align: center; width: 100%;"> </td>
 	 						 <td><input type="text"  placeholder="Stock" name="productStock[]" size="15" id="productStock_1" value="" style="text-align: center; width: 100%;"></td>
 	 						 <td><input type="text"  placeholder="Und x caja" name="productUnidad[]" size="15" id="productUnidad_1" value="" style="text-align: center; width: 100%;"></td>
 	             <td  id="id_calcular"><input type="number" name="quantity[]" size="15" id="quantity_1" class="form-control quantity" autocomplete="off" onkeyup="return run_calcular(event, 1)" style="text-align: center; width: 100%;" accesskey="c"></td>
 	            
               <td><input type="text"  placeholder="valor unitario" name="unitario[]" class="prints" size="8" id="unitario_1" value="" style="text-align: center; width: 100%;"></td>
  <td><input type="number" name="price[]" size="1" id="price_1"  autocomplete="off" style="text-align: center; width: 1%;"></td>
 	             <td><input type="text" class="form-control Total"  placeholder="Total" name="result[]" size="35" id="result_1" value="" style="text-align: center; width: 100%;"></td>

         </tr>

     </table>
 </div>
 </div>
 <div class="row">
 <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
     <button class="btn btn-danger delete" id="removeRows" type="button">- Borrar</button>
     <button class="btn btn-success" id="addRows" type="button" accesskey="a">+ Agregar Más</button>
     
     	<h4>Formulario Perfumeria Especial</h4>
     	<br>
	<a id="modal-btn" class="btn btn-warning">Perfumeria especial</a>
        <hr>
         <div class="" id="responses"> </div>
          <br>
 <div class="">
 	<table border='1px' heigh='65%'>
 		<tr>
			<td colspan="6">MONTO TOTAL PERFUMERIA ESPECIAL:</td>
 			<td> <input type="text" name="" id="okok" value=""> </td>
 		</tr>
 	</table>
 </div>
 <hr>
 <button aling="left" type="button" name="actualizar" id="actualizar" class="btn btn-success" onclick="return run_calcular(event, 1)">Actualizar Datos</button>

 </div>

 </div>
 <div class="row">
 <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
     <h3>Notas: </h3>
     <div class="form-group">
         <textarea class="form-control txt" rows="5" name="notes" id="notes" placeholder="Notas"></textarea>
     </div>
     <br>
     	<hr>
     <label> ELEGIR SI SOLICITAR FACTURA</label> 
     	<select class="" name="opciones">
			<option value="1" selected>No Solicitar factura</option>
			<option value="0">Solicitar Factura</option>
	   </select>
	   
	   
	     <div class="form-control">
     <label> datos naturales</label>
     <select class="" name="normaldt">
                 <option value="0">no existen datos naturales</option>
                 <option value="1" selected>existen datos naturales</option>
    </select>
   </div>	    
   
   <div class="form-control" >
     <label> datos especiales</label>
     <select class="" name="ejecutar">
                 <option value="0" selected>no hay datos especiales</option>
                 <option value="1">existen datos especiales</option>
    </select>
   </div>
<hr>
     <div class="form-group">
         <input type="hidden" value="<?php echo $_SESSION['userid']; ?>" class="form-control" name="userId">
		 <input id="guardando" data-loading-text="Guardando factura..." type="submit" name="invoice_btn" value="Finalizar" doiclicksito class="btn btn-success submit_btn invoice-save-btm" accesskey="g">

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
         <div class="form-group">
 					 <label>Porcentaje &nbsp;</label>
 					 <div class="input-group">
 							 <input value="" type="number" class="form-control" value="0" min="0" name="taxRate" id="taxRate" placeholder="Porcentaje descuento">
 							 <div class="input-group-addon">%</div>
 					 </div>
 			 </div>
 			 <div class="form-group">
 					 <label>Descuento &nbsp;</label>
 					 <div class="input-group">
 							 <div class="input-group-addon currency">$</div>
 							 <input value="" type="number" class="form-control" name="taxAmount" id="taxAmount" placeholder="Monto del descuento">
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
             <label>Total a pagar: &nbsp;</label>
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

 
  <?php include 'perfumeria_modal_ibague.php'; ?>   
  <?php include 'create_new_client.php'; ?>
  <?php include 'editar_cliente.php'; ?>
 </div>

 
 </div>
 
 
 
 
 <script type="text/javascript">
	$(document).ready(function(){

		//obtener los datos
		function obtener_datos(){
			$.ajax({
				url:"mostrar_datos.php",
				method:"POST",
				success: function(data){
					$("#responses").html(data)
				}
			})
		}
		obtener_datos();

	$(document).on("click", "#eliminar", function(e){
	 if(confirm("estas seguro de eliminar este producto ?")){
			 e.preventDefault();
				 var id = $(this).data("id");

				$.ajax({
					url:"eliminar.php",
					method:"POST",
					data:{id: id},
					success: function(data){

						obtener_datos();
						alert(data);
					}
				})

	 };
 })

 $(document).on("click", "#actualizar", function(){
	 function run_calcular(e, id){
		 calculateTotal(id);
	 }
		 obtener_datos();
 })

 $(document).on("click", "#actualizar", function(){
	 var sumatotales = [];
		$("[id^=monto]").each(function(){
		 sumatotales.push(parseFloat($(this).val()))
		})
		 if (sumatotales != 0){totales = sumatotales.reduce(function(a,b){return a+b})}else{
			 totales = 0;
		 }

	 document.getElementById("okok").value= totales;
	console.log("esta es mi suma"+totales);

})

 var sinv = 0;

	 if(!isNaN(a) && !isNaN(b)){
		 totales = sumatotales.reduce(function(a,b){return a+b})
 		document.getElementById("okok").value= totales;
}else{
document.getElementById("okok").value= sinv;}

 });
</script>
 
 
 <script>
 function ver_datos(id, e){
 var dato = document.getElementById('producto'+id);
 e.preventDefault();
 }


 $("#mibuscador").on('change',function(){
 	$.ajax({
 		url:'methods/conexionibague.php',
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
 	});


 </script>

	  <script type="text/javascript">
				function ver_datos(id, e){
					var dato = document.getElementById('cliente'+id);
					e.preventDefault();
				}

				$("#buscarcliente").on('change',function(){
					$.ajax({
						url:'methods/conexiones.php',
						type:'POST',
						dataType:'json',
						data:{key:'Q1',cliente:$(this).val()}
					}).done(function(d){

						let padre = $("#buscarcliente").parent().parent().parent();
						padre.find("[name^=tele]").val(d.resultado.telefono)
						padre.find("[name^=direccion]").val(d.resultado.direccion)
						padre.find("[name^=ciudad]").val(d.resultado.ciudad)
						padre.find("[name^=companyName]").val(d.resultado.nombres)
						padre.find("[name^=cedula]").val(d.resultado.cedula)
						padre.find("[name^=email]").val(d.resultado.email)
					}).fail(function(e){console.log("ERROR:",e);});
				})

				function run_calcular(e, id){
					calculateTotal(id);
				}

				$(document).ready(function(){
					$('#buscarcliente').select2();
				});
			</script>



 <script type="text/javascript">
function ver_datos(id, e){
var dato = document.getElementById('cliente'+id);
e.preventDefault();
}


$("#buscarcomercial").on('change',function(){
	$.ajax({
		url:'methods/conexiones.php',
		type:'POST',
		dataType:'json',
		data:{key:'Q1',cliente:$(this).val()}
	}).done(function(d){

		let padre = $("#buscarcomercial").parent().parent().parent();
	}).fail(function(e){console.log("ERROR:",e);});
})

function run_calcular(e, id){
	 calculateTotal(id);
}

$(document).ready(function(){
			$('#buscarcomercial').select2();
	});


</script>


	  <script type="text/javascript">
				function ver_datos(id, e){
					var dato = document.getElementById('cliente'+id);
					e.preventDefault();
				}

				$("#buscarcliente").on('change',function(){
					$.ajax({
						url:'methods/conexiones.php',
						type:'POST',
						dataType:'json',
						data:{key:'Q1',cliente:$(this).val()}
					}).done(function(d){

						let padre = $("#buscarcliente").parent().parent().parent();
						padre.find("[name^=tele]").val(d.resultado.telefono)
						padre.find("[name^=direccion]").val(d.resultado.direccion)
						padre.find("[name^=ciudad]").val(d.resultado.ciudad)
						padre.find("[name^=companyName]").val(d.resultado.nombres)
						padre.find("[name^=cedula]").val(d.resultado.cedula)
						padre.find("[name^=email]").val(d.resultado.email)
					}).fail(function(e){console.log("ERROR:",e);});
				})

				function run_calcular(e, id){
					calculateTotal(id);
				}

				$(document).ready(function(){
					$('#buscarcliente').select2();
				});
			</script>
			
				<script type="text/javascript">
				function ver_datos(id, e){
					var dato = document.getElementById('cliente'+id);
					e.preventDefault();
				}

				$("#buscarclientes").on('change',function(){
					$.ajax({
						url:'methods/conexiones.php',
						type:'POST',
						dataType:'json',
						data:{key:'Q1',cliente:$(this).val()}
					}).done(function(d){

						let padre = $("#buscarclientes").parent().parent().parent();
						padre.find("[name^=telefonos]").val(d.resultado.telefono)
						padre.find("[name^=direccions]").val(d.resultado.direccion)
						padre.find("[name^=ciudads]").val(d.resultado.ciudad)
						padre.find("[name^=nombres]").val(d.resultado.nombres)
						padre.find("[name^=ccs]").val(d.resultado.cedula)
						padre.find("[name^=emails]").val(d.resultado.email)
					}).fail(function(e){console.log("ERROR:",e);});
				})

				function run_calcular(e, id){
					calculateTotal(id);
				}

				$(document).ready(function(){
					$('#buscarclientes').select2();
				});
			</script>

	<!-- agregar cliente -->
<script type="text/javascript">
$(document).ready(function(){
 $('#guardaremos').click(function(){
	 var datos=$('#client_information').serialize();
	 $.ajax({
		 type:"POST",
		 url:"send_nuevo_cliente.php",
		 data:datos,
		 success:function(r){
			 console.log(r);
			 if(r!=0 && !isNaN(r)){//SI ES DISTINTO A 0 Y ES UN NUMERO
				 alert("agregado con exito");

				 console.log(datos);
			 }else{//ES 0(NO SE EJECUTO LA CONSULTA) O EXISTE UN ERROR EXPLICATIVO(STRING)
				 alert("no funciona, Escribir nombre y cedula. Posiblemente este cliente ya esta registrado");
				 console.log(datos);
			 }
		 }
	 });
	 return false;
 });
});
</script>

<!-- Guardar edicion cliente -->

<script type="text/javascript">
$(document).ready(function(){
 $('#guardaremos_edit').click(function(){
	 var datos=$('#client_informationes').serialize();
	 $.ajax({
		 type:"POST",
		 url:"send_edit_cliente.php",
		 data:datos,
		 success:function(r){
			 console.log(r);
			 if(r!=0 && !isNaN(r)){//SI ES DISTINTO A 0 Y ES UN NUMERO
				 alert("Cliente agregado con exito");

				 console.log(datos);
			 }else{//ES 0(NO SE EJECUTO LA CONSULTA) O EXISTE UN ERROR EXPLICATIVO(STRING)
				 alert("no funciona, Contactar al desarrollador");
				 console.log(datos);
			 }
		 }
	 });
	 return false;
 });
});
</script>





 <script type="text/javascript">
$("#mibuscadores").on('change',function(){
 $.ajax({
	url:'methods/conexion.php',
	type:'POST',
	dataType:'json',
	data:{key:'Q1',producto:$(this).val()}
 }).done(function(d){

	let padre = $("#mibuscadores").parent().parent().parent();
	padre.find("[name^=codigo]").val(d.resultado.id)
	padre.find("[name^=stocks]").val(d.resultado.stock)
 }).fail(function(e){console.log("ERROR:",e);});
})

</script>

			<script type="text/javascript">

						$(document).ready(function(){
							$('#mibuscadores').select2();
						});
				/*		$(document).ready(function(){
							$('#opcionesPerfumeria').select2();
						});*/
						$(document).ready(function(){
							$('#splash').select2();
						});
						$(document).ready(function(){
							$('#crema').select2();
						});
						$(document).ready(function(){
							$('#perfume_preparado1').select2();
						});
						$(document).ready(function(){
							$('#opciones_preparado_sencillo').select2();
						});
						$(document).ready(function(){
							$('#opciones_preparado_lujo').select2();
						});
						$(document).ready(function(){
							$('#mibuscadors2').select2();
						});
						$(document).ready(function(){
							$('#mibuscadors3').select2();
						});
						$(document).ready(function(){
							$('#mibuscadors4').select2();
						});
						$(document).ready(function(){
							$('#opciones_preparado_recarga').select2();
						});
						$(document).ready(function(){
							$('#mibuscadorsplash120').select2();
						});
						$(document).ready(function(){
							$('#mibuscadorsplash250').select2();
						});
						$(document).ready(function(){
							$('#mibuscadorcrema30').select2();
						});
						$(document).ready(function(){
							$('#mibuscadorcrema60').select2();
						});
						$(document).ready(function(){
							$('#mibuscadorcrema120').select2();
						});
						$(document).ready(function(){
							$('#mibuscadorcrema250').select2();
						});
						$(document).ready(function(){
				    	$('#buscarclientes').select2();
				        });
				        
				          $(document).ready(function(){
				    	$('#mibuscadorPreparaS100ml').select2();
				        });
						$(document).ready(function(){
				    	$('#mibuscadorPreparaS50ml').select2();
				        });
						$(document).ready(function(){
				    	$('#mibuscadorPreparaS30ml').select2();
				        });
						$(document).ready(function(){
				    	$('#mibuscadorAfterEnvase').select2();
				        });
						$(document).ready(function(){
				    	$('#mibuscadorOnzasps').select2();
				        });
		 </script>


<!--INSERTANDO CODIGO Y STOCK DE PRODUCTOS -->
<!--splash  -->
<script type="text/javascript">
$("#mibuscadorsplash250").on('change',function(){
 $.ajax({
	url:'methods/conexion.php',
	type:'POST',
	dataType:'json',
	data:{key:'Q1',producto:$(this).val()}
 }).done(function(d){

	let padre = $("#mibuscadores").parent().parent().parent();
	padre.find("[name^=envases]").val(d.resultado.id)
	padre.find("[name^=stockenvases]").val(d.resultado.stock)
 }).fail(function(e){console.log("ERROR:",e);});
})
</script>
<!--splash  -->
<script type="text/javascript">
$("#mibuscadorsplash120").on('change',function(){
 $.ajax({
	url:'methods/conexion.php',
	type:'POST',
	dataType:'json',
	data:{key:'Q1',producto:$(this).val()}
 }).done(function(d){

	let padre = $("#mibuscadores").parent().parent().parent();
	padre.find("[name^=envases]").val(d.resultado.id)
	padre.find("[name^=stockenvases]").val(d.resultado.stock)
 }).fail(function(e){console.log("ERROR:",e);});
})
</script>
<!--crema 30  -->
<script type="text/javascript">
$("#mibuscadorcrema30").on('change',function(){
 $.ajax({
	url:'methods/conexion.php',
	type:'POST',
	dataType:'json',
	data:{key:'Q1',producto:$(this).val()}
 }).done(function(d){

	let padre = $("#mibuscadores").parent().parent().parent();
	padre.find("[name^=envases]").val(d.resultado.id)
	padre.find("[name^=stockenvases]").val(d.resultado.stock)
 }).fail(function(e){console.log("ERROR:",e);});
})
</script>
<!--crema 60  -->
<script type="text/javascript">
$("#mibuscadorcrema60").on('change',function(){
 $.ajax({
	url:'methods/conexion.php',
	type:'POST',
	dataType:'json',
	data:{key:'Q1',producto:$(this).val()}
 }).done(function(d){

	let padre = $("#mibuscadores").parent().parent().parent();
	padre.find("[name^=envases]").val(d.resultado.id)
	padre.find("[name^=stockenvases]").val(d.resultado.stock)
 }).fail(function(e){console.log("ERROR:",e);});
})
</script>
<!--crema 120  -->
<script type="text/javascript">
$("#mibuscadorcrema120").on('change',function(){
 $.ajax({
	url:'methods/conexion.php',
	type:'POST',
	dataType:'json',
	data:{key:'Q1',producto:$(this).val()}
 }).done(function(d){

	let padre = $("#mibuscadores").parent().parent().parent();
	padre.find("[name^=envases]").val(d.resultado.id)
	padre.find("[name^=stockenvases]").val(d.resultado.stock)
 }).fail(function(e){console.log("ERROR:",e);});
})
</script>
<!--crema 250  -->
<script type="text/javascript">
$("#mibuscadorcrema250").on('change',function(){
 $.ajax({
	url:'methods/conexion.php',
	type:'POST',
	dataType:'json',
	data:{key:'Q1',producto:$(this).val()}
 }).done(function(d){

	let padre = $("#mibuscadores").parent().parent().parent();
	padre.find("[name^=envases]").val(d.resultado.id)
	padre.find("[name^=stockenvases]").val(d.resultado.stock)
 }).fail(function(e){console.log("ERROR:",e);});
})
</script>

<!-- after shave-->
<script type="text/javascript">
$("#mibuscadorAfterEnvase").on('change',function(){
 $.ajax({
	url:'methods/conexion.php',
	type:'POST',
	dataType:'json',
	data:{key:'Q1',producto:$(this).val()}
 }).done(function(d){

	let padre = $("#mibuscadores").parent().parent().parent();
	padre.find("[name^=envases]").val(d.resultado.id)
 }).fail(function(e){console.log("ERROR:",e);});
})

</script>
<!-- Onzas de perfumeria -->

<script type="text/javascript">
$("#mibuscadorOnzasps").on('change',function(){
 $.ajax({
	url:'methods/conexion.php',
	type:'POST',
	dataType:'json',
	data:{key:'Q1',producto:$(this).val()}
 }).done(function(d){

	let padre = $("#mibuscadores").parent().parent().parent();
	padre.find("[name^=envases]").val(d.resultado.id)
 }).fail(function(e){console.log("ERROR:",e);});
})

</script>


<!-- SENCILLO DE 30ML -->
<script type="text/javascript">
$("#mibuscadorPreparaS30ml").on('change',function(){
 $.ajax({
	url:'methods/conexion.php',
	type:'POST',
	dataType:'json',
	data:{key:'Q1',producto:$(this).val()}
 }).done(function(d){

	let padre = $("#mibuscadores").parent().parent().parent();
	padre.find("[name^=envases]").val(d.resultado.id)
 }).fail(function(e){console.log("ERROR:",e);});
})

</script>
<!-- SENCILLO DE 50ML -->

<script type="text/javascript">
$("#mibuscadorPreparaS50ml").on('change',function(){
 $.ajax({
	url:'methods/conexion.php',
	type:'POST',
	dataType:'json',
	data:{key:'Q1',producto:$(this).val()}
 }).done(function(d){

	let padre = $("#mibuscadores").parent().parent().parent();
	padre.find("[name^=envases]").val(d.resultado.id)
 }).fail(function(e){console.log("ERROR:",e);});
})

</script>

<!-- SENCILLO DE 100ML -->
<script type="text/javascript">
$("#mibuscadorPreparaS100ml").on('change',function(){
 $.ajax({
	url:'methods/conexion.php',
	type:'POST',
	dataType:'json',
	data:{key:'Q1',producto:$(this).val()}
 }).done(function(d){

	let padre = $("#mibuscadores").parent().parent().parent();
	padre.find("[name^=envases]").val(d.resultado.id)
 }).fail(function(e){console.log("ERROR:",e);});
})

</script>





		 
<!-- lujo 30ml -->
<script type="text/javascript">
$("#mibuscadors2").on('change',function(){
 $.ajax({
	url:'methods/conexion.php',
	type:'POST',
	dataType:'json',
	data:{key:'Q1',producto:$(this).val()}
 }).done(function(d){

	let padre = $("#mibuscadores").parent().parent().parent();
	padre.find("[name^=envases]").val(d.resultado.id)
 }).fail(function(e){console.log("ERROR:",e);});
})

</script>
<!--lujo50ml -->
<script type="text/javascript">
$("#mibuscadors3").on('change',function(){
 $.ajax({
	url:'methods/conexion.php',
	type:'POST',
	dataType:'json',
	data:{key:'Q1',producto:$(this).val()}
 }).done(function(d){

	let padre = $("#mibuscadores").parent().parent().parent();
	padre.find("[name^=envases]").val(d.resultado.id)
 }).fail(function(e){console.log("ERROR:",e);});
})

</script>
<!-- lujo 100ml -->
<script type="text/javascript">
$("#mibuscadors4").on('change',function(){
 $.ajax({
	url:'methods/conexion.php',
	type:'POST',
	dataType:'json',
	data:{key:'Q1',producto:$(this).val()}
 }).done(function(d){

	let padre = $("#mibuscadores").parent().parent().parent();
	padre.find("[name^=envases]").val(d.resultado.id)

 }).fail(function(e){console.log("ERROR:",e);});
})

</script>

<script type="text/javascript">
      $(document).ready(function(){
      $('#try').click(function(){
	     var datos=$('#information').serialize();
	  $.ajax({
		 type:"POST",
		 url:"send_modal.php",
		 data:datos,
		 success:function(r){
			 console.log(r);
			 if(r!=0 && !isNaN(r)){
				 alert("Perfumeria especial agregado con exito");
				 console.log(datos);
			 }else{
				 alert("no funciona");
				 console.log(datos);
			 }
		 }
	 });
	 return false;
 });
});
</script>


 <script type="text/javascript">
 
 var datos = <?= json_encode($user); ?>;
 
	$(document).ready(function(){
		$('#guardando').click(function(){
			var datos=$('#invoice-form').serialize();
			$.ajax({
				type:"POST",
				url:"send_ajax_ibague.php",
				data:datos,
				success:function(r){
					console.log(r);
					if(r!=0 && !isNaN(r)){//SI ES DISTINTO A 0 Y ES UN NUMERO
					   if(datos == 27){
						alert("Cotizacion finalizada exitosamente, recuerda que los productos de esta cotizacion aun no se descuentan del inventario. ");
						var respuesta = confirm("¿Qieres Imprimir esta cotizacion?");
						if (respuesta == true){
							windowObjectReference = window.open(
						  	"imprimir.php?invoice_id="+r,
								"DescriptiveWindowName",
								"resizable,scrollbars,status"
							);
							setTimeout(function(){
							windowObjectReference.print();
								windowObjectReference.close()
							},6000);
                            window.location="search_ibague/index.php";

						}
						else {
						
							window.location="search_ibague/index.php";
						}
					   }else{
					  	alert("Cotizacion guarda exitosamente, pendiente por finalizar. ");
					    window.location="search_ibague_1/index.php";
					   }	
					}else{
						alert("Completar todos los datos,en caso tal de no funcionar contactar con el desarrollador");
					}
				}
			});
			return false;
		});
	});
</script>

<script type="text/javascript">
document.getElementById("modal-btn").addEventListener("click", function(event){
  event.preventDefault()
});
</script>

<script type="text/javascript">

$("[doiclicksito]").click(function(evt){
evt.preventDefault();

});

</script>

<script type="text/javascript">
  document.getElementById("myBtn").addEventListener("click", function(event){
  event.preventDefault()
});
</script>
<script type="text/javascript">
  document.getElementById("myBtnes").addEventListener("click", function(event){
  event.preventDefault()
});
</script>

<script type="text/javascript">
  document.getElementById("myBtn").addEventListener("click", function(event){
  event.preventDefault()
   document.getElementById("myModal").style.display = "block";
  
});

document.getElementById("cerrar").addEventListener("click", function(event){
  event.preventDefault()
   document.getElementById("myModal").style.display = "none";
  
});


</script>


 <script type="text/javascript">
 function PasarValor()
{
document.getElementById("companyName").value = document.getElementById("nombre").value;
document.getElementById("cedula").value = document.getElementById("cc").value;
document.getElementById("email").value = document.getElementById("emails").value;
document.getElementById("tele").value = document.getElementById("telefono").value;
document.getElementById("direccion").value = document.getElementById("direcciones").value;
document.getElementById("ciudad").value = document.getElementById("ciudades").value;
}
//pasar valores editando clientes
 function PasarValores()
{
document.getElementById("companyName").value = document.getElementById("nombres").value;
document.getElementById("cedula").value = document.getElementById("ccs").value;
document.getElementById("email").value = document.getElementById("emailss").value;
document.getElementById("tele").value = document.getElementById("telefonos").value;
document.getElementById("direccion").value = document.getElementById("direccioness").value;
document.getElementById("ciudad").value = document.getElementById("ciudadess").value;
}

 </script>
 
<script src="js/demo_funciones.js"></script>

 <?php include('footer.php');?>

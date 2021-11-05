<!DOCTYPE html>
<html lang="es">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Reporte Ventas JJ</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- Bootstrap Y JQuery -->
<link href="../css/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="../css/jquery/dist/jquery.min.js"></script>
<script src="../css/pdf_object/pdfobject.js"></script>
<style>
.pdfobject-container { height: 60rem; border: 1rem solid rgba(0,0,0,.1); }
.modal-dialog{background-color: #fff; padding: 20px 15px;}
#cancel{margin: 5px; display: block;}
.cargando{position: absolute;width: 30px;right: -40px;top: -2px;}
.hide{display: none;}
</style>
</head>

<body>
<div class="container">
	<div class="row">
		<div class="slide_uno col-md-12 col-sm-12 col-xs-12">
			<h2 class="text-center">Reporte de ventas JJQUIMIENVASES</h2>
			<div class="clearfix"></div>
			<table class="table table-striped table-bordered">
				<div class="row">
					<div class="col-sm-12">
						<div id="datatable_length">
							<!-- RANGO DE FECHAS A BUSCAR Y EXPORTAR -->
							<label style="font-weight: normal;">Desde: <input class="form-control" type="date" id="bd-desde"/></label>
							<label style="font-weight: normal;">Hasta: <input class="form-control" type="date" id="bd-hasta"/></label>
							<button id="rango_fecha" class="btn-sm btn-primary">Buscar</button>
							<!-- BOTON PARA EXPORTAR EL RANGO DE FECHAS -->
							<a onClick="javascript:reportePDF();" class="btn-sm btn-danger" style="padding: 8px 15px; cursor: pointer; position: relative;">Exportar PDF<span><img src="../cargando.gif" class="cargando hide"></span></a>
						</div>
					</div>

				</div>
				<div class="row">
					<thead>
					<tr>
						<th width="10">N°</th>
						<th width="20">Fecha</th>
						<th width="10">Cotizacion</th>
						<th width="30">Cliente</th>
						<th width="30">Monto</th>
					</tr>
					</thead>
					<!-- CONTENEDOR DONDE SE IMPRIMEN LA CONSULTA POR FECHAS -->
					<tbody id="actualizar">
						<?php include('../includes/imprimir_bitacora.php'); ?>
					</tbody>
					<tfoot>
						<button type="button" id="sumar_datos" name="button">Sumar Datos</button>

						 <tr>
					 		<td colspan="4">MONTO TOTAL:</td>
					 		<td> <input type="text" name="" id="okok" value=""> </td>
					 	</tr>

					</tfoot>
				</div>
			</table>

			<table>

			</table>
		</div>
	</div>
</div>

<div class="modal fade" id="ver-pdf" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="x_panel">
		<div class="x_title">
			<h2 class="text-center">Reporte Generado</h2>
			<div class="clearfix"></div>
		</div>

		 <div id="view_pdf"></div>
			<a id="cancel" class="btn btn-primary" data-dismiss="modal" aria-hidden="true">Cancelar</a>
		</div>
	</div>
</div>

<script type="text/javascript">
(function(){
	$('#rango_fecha').on('click',function(){
		var desde = $('#bd-desde').val();
		var hasta = $('#bd-hasta').val();
		var url = '../dao/busca_por_fecha.php';
		$.ajax({
		type:'POST',
		url:url,
		data:'desde='+desde+'&hasta='+hasta,
		success: function(datos){
			$('#actualizar').html(datos);
		}
	});
	return false;
	});
})();

function reportePDF(){
	var desde = $('#bd-desde').val();
	var hasta = $('#bd-hasta').val();
	var url = '../dao/exportar_pdf.php';
	$('.cargando').removeClass('hide');
	$.ajax({
		type:'POST',
		url:url,
		data:'desde='+desde+'&hasta='+hasta,
		success: function(datos){
			$('.cargando').addClass('hide');
			$('#ver-pdf').modal({
				show:true,
				backdrop:'static'
			});
			PDFObject.embed("../temp/reporte.pdf", "#view_pdf");
		}
	});
	return false;
}


</script>

<!-- Bootstrap -->
<script src="../css/bootstrap/dist/js/bootstrap.min.js"></script>


<script type="text/javascript">
$(document).ready(function(){

 $(document).on("click", "#sumar_datos", function(){
	 var sumatotales = [];
		$("[id^=totales]").each(function(){
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



</body>
</html>

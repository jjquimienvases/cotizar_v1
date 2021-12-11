<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
function formatear($num){
	setlocale(LC_MONETARY, 'en_US');
	return "$" . number_format($num, 2);
}
include('conexion.php');
// include('conexiones.php');
// $mysqli2 = conec();tar


$tmp = array();
$res = array();

$status = "s_factura";
$status2 = "pendiente";

$sel = $con->query("SELECT * FROM files INNER JOIN factura_orden ON factura_orden.order_id = files.order_id WHERE files.estado = '$status' OR files.estado = '$status2'");
while ($row = $sel->fetch_assoc()) {
    $tmp = $row;
    array_push($res, $tmp);
}
?>
<?php
$resultado = "";
if (isset($_POST['buscar_cotizacion'])) {
 $id = $_POST['producto'];
 $sql = "SELECT * FROM files INNER JOIN factura_orden ON factura_orden.order_id = files.order_id WHERE factura_orden.order_id='$id'  OR factura_orden.order_receiver_name LIKE '%$id%' ";
 $r = $con->query($sql);
 if ($o = $r->fetch_object()) {
   $resultado = $o;
 }

}

include_once '../conexion_proveedor.php';
    // SELECT * FROM files WHERE order_id LIKE :campo OR order_date LIKE :campo OR description LIKE :campo;
if(isset($_POST['btn_buscar'])){
  $buscar_text=$_POST['buscar'];
  $select_buscar=$con->prepare('
  
    SELECT * FROM files INNER JOIN factura_orden ON factura_orden.order_id = files.order_id WHERE factura_orden.order_id LIKE :campo OR factura_orden.order_date LIKE :campo OR files.description LIKE :campo;'
    
  );
  
//   $select_buscar->bindParam("campo");

  $select_buscar->execute(array(
    ':campo' =>"%".$buscar_text."%"
  ));

  $res=$select_buscar->fetchAll();

}




$mysqli2 = new mysqli ('ftp.jjquimienvases.com', 'jjquimienvases_jjadmin', 'LeinerM4ster', 'jjquimienvases_cotizar');  

 ?>


<html>
    <head>
        <meta charset="UTF-8">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/blueimp-md5/2.18.0/js/md5.js" integrity="sha512-NpfrQEgzOExS1Ax8fjITKrgBFK87lZbBmvWdZk4suiCC4tsHPrTCsulgIA7Z/+CeWhDpEP/f36mNWgZXDKtTAA==" crossorigin="anonymous"></script>
        <script src="jquery-3.1.1.min.js"></script>
        <script src="../js/invoice.js"></script>
        <title>Factura</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    </head>
    <body>
      <?php include '../barra_asistente.php'; ?>

        <!-- <div class="container"> -->
            <div class="row justify-content-md-center">
                <div class="col-md-auto">
                    <h1>Adjuntar Factura</h1>
                </div>
            </div>
            <div class="row justify-content-md-center">
                <div class="col-8">
                  <center>  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" >
                        Agregar Factura
                    </button> </center>
 <hr>

 <center><h2>Buscar Cotizaciones</h2>
 <div class="barra__buscador">
   <form action="" class="formulario" method="post">
     <input type="text" name="buscar" placeholder="buscar ID  o Fecha"
     value="<?php if(isset($buscar_text)) echo $buscar_text; ?>" class="input__text">
     <input type="submit" class="btn" name="btn_buscar" value="Buscar">
   </form>
 </div> </center>
 <hr>

                    <table class="table table-hover table-bordered" width="100%">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">Fecha</th>
                                <th scope="col">Cotizacion</th>
                                <th scope="col">Cliente</th>
                                <th scope="col">Comprobante</th>
                                <th scope="col">Punto de venta</th>
                                <th scope="col">Notas</th>
                                <th scope="col">Estado</th>
                                <th scope="col">MONTO</th>
                                <th scope="col">PDF Cotizacion</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($res as $val) { ?>
                                    <form class="" action="" method="post">
                                <tr>
                                    <td> <center>  <?php echo $val['order_date'] ?> </center> </td>

                                    <td> <center> <input type="text" name="id" value="<?php echo $val['order_id']; ?>"> </center> </td>
                                    <td> <center> <?php echo $val['order_receiver_name'] ?> </center> </td>
                                    <td> <center> <img src="./imagenes/<?php echo $val['file_name'];?>" alt="<?php echo $val['order_id'];?>" class="img-fluid" width="100" height="100" style="margin-left: 20px" ></center> </td>
                                    <td> <center> <?php echo $val['id_punto_venta'] ?> </center> </td>
                                    <td> <center> <?php echo $val['description'] ?> </center> </td>
                                    <td> <center><?php echo $val['estado'] ?></center></td>
                                    <td> <center><?php
                                    $monto = $val['order_total_after_tax'];
                                    echo formatear($monto);  ?></center></td>
                                    <?php if(isset($val['order_id'])){
                                        echo '<td> <center> <a href="../print_invoice.php?invoice_id='.$val["order_id"].'" title="Imprimir Factura"><div class="btn btn-primary"><span class="glyphicon glyphicon-print">Ver PDF</span></div></a> </center> </td>';
                                      } ?>
                                  

                                </tr>
                                  </form>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        <!-- </div> -->
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Aprobar Una Cotizacion</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                      <h3>Adjuntar Facturas</h3>

                        <form enctype="multipart/form-data" id="form1">
                          <!-- <div class="form-group">
                              <label for="title">Cotizacion</label>
                              <input type="text" class="form-control" id="cotizacion" name="cotizacion" value="" >
                          </div> -->

                          <div style="text-align: center;">
                            <select id="buscarcliente" style="width: 100%" name="cotizacion">
                              <option value="0">Elegir una cotizacion:</option>
                                 <?php
                                   $query = $mysqli2 -> query ("SELECT * FROM files WHERE estado = 'pendiente' or estado = 's_factura' ORDER BY order_date DESC ");
                                   while ($valores = mysqli_fetch_array($query)) {
                                     echo '<option value="'.$valores[order_id].'">'.$valores[order_id].','.$valores[title].'</option>';
                                   }

                                 ?>
                            </select>
                        </div>
                        <hr>
                        <div class="form-group">
                          <label for="select">Seleccionar Punto de empaque y/o despacho:</label>
                           <select class="select" name="bodega_descuento_stock">
                              <option value="producto_av" selected>Bodega AV</option>
                              <option value="producto">Punto Principal</option>
                              <option value="producto_d1">Punto D1</option>
                              <option value="productos_ibague">Ibague</option>
                           </select>
                        </div> 
                        <hr>
                        <div class="form-group">
                          <label for="description">Adjuntar Factura:</label>
                          <input type="file" class="form-control" id="file" name="file">
                        </div>


                            <!-- <div class="form-group">
                                <label for="title">Cliente</label>
                                <input type="text" class="form-control" id="title" name="title" value="" >
                            </div> -->
                            <!-- <div class="form-group col-md5">
                                <label for="description">Datos adicionales</label>
                                <input type="text" class="form-control" id="description" name="description" value="">
                                <input class="form-control" type="hidden" placeholder=" numero de factura" name="factura" value="">
                            </div> -->

                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-primary" onclick="onSubmitForm()">Guardar</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="modalPdf" tabindex="-1" aria-labelledby="modalPdf" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ver archivo</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <iframe id="iframePDF" frameborder="0" scrolling="no" width="100%" height="500px"></iframe>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>

                    </div>
                </div>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

       <script>
                            function onSubmitForm() {
                                var frm = document.getElementById('form1');
                                var data = new FormData(frm);
                                var xhttp = new XMLHttpRequest();
                                xhttp.onreadystatechange = function () {
                                    if (this.readyState == 4) {
                                        var msg = xhttp.responseText;
                                        if (msg == 'success') {
                                            alert(msg);
                                            $('#exampleModal').modal('hide')
                                        } else {
                                            alert(msg);
                                        }

                                    }
                                };
                                xhttp.open("POST", "upload_factura.php", true);
                                xhttp.send(data);
                                $('#form1').trigger('reset');
                            }
                            function openModelPDF(url) {
                                $('#modalPdf').modal('show');
                                $('#iframePDF').attr('src','<?php echo 'http://' . $_SERVER['HTTP_HOST'] . '/upload/'; ?>'+url);
                            }
        </script>

        <script type="text/javascript">
        	$(document).ready(function(){ //peticion ajax para enviar el form principal
        		$('#finalizar').click(function(){
        			var datos=$('#cotizacion').serialize();
        			$.ajax({
        				type:"POST",
        				url:"finished.php",
        				data:datos,
        				success:function(r){
        					console.log(r);
        					if(r!=0 && !isNaN(r)){//SI ES DISTINTO A 0 Y ES UN NUMERO
        						alert("!Felicitaciones¡ Completaste el empaque de esta cotizacion");
        					}else{//ES 0(NO SE EJECUTO LA CONSULTA) O EXISTE UN ERROR EXPLICATIVO(STRING)
        						alert("no funciona");
        					}
        				}
        			});
        			return false;
        		});
        	});
        </script>

        <script type="text/javascript">
          function ver_datos(id, e){
            var dato = document.getElementById('cliente'+id);
            e.preventDefault();
          }

          $("#buscarcliente").on('click',function(){
            $.ajax({
              url:'conexiones.php',
              type:'POST',
              dataType:'json',
              data:{key:'Q1',cliente:$(this).val()}
            }).done(function(d){

              let padre = $("#buscarcliente").parent().parent().parent();
              padre.find("[name^=title]").val(d.resultado.title)
              padre.find("[name^=cotizacion]").val(d.resultado.order_id)

            }).fail(function(e){console.log("ERROR:",e);});
          })

          // $(document).ready(function(){
          // 	$('#buscarcliente').select2();
          // });
        </script>


    </body>
</html>

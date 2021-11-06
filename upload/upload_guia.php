<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
include "../globals.php";

$tmp = array();
$res = array();

$status = "alistamiento";

$sel = $cnx->query("SELECT * FROM files WHERE estado = '$status'");

$seleccion = $cnx->query("SELECT count(*) AS total FROM files WHERE estado = '$status'");
$data=mysqli_fetch_assoc($seleccion);
$cuenta = $data['total'];


  if ($cuenta > 0) {
    while ($row = $sel->fetch_assoc()) {
        $tmp = $row;
        array_push($res, $tmp);
    }
  }else{
  echo "NO TIENES COTIZACIONES PENDIENTES POR ALISTAMIENTO";
}


?>
<?php
// $resultado = "";
// if (isset($_POST['buscar_cotizacion'])) {
//  $id = $_POST['producto'];
//  $sql = "SELECT * FROM factura_orden WHERE order_id='$id'  OR order_receiver_name LIKE '%$id%' ";
//  $r = $cnx->query($sql);
//  if ($o = $r->fetch_object()) {
//   $resultado = $o;
//  }

// }

include_once '../conexion_proveedor.php';
  
if(isset($_POST['btn_buscar'])){
    $buscador = $_POST['buscar'];
    $sql = "SELECT * FROM files WHERE order_id LIKE '%$buscador%' OR order_date LIKE '%$buscador%'";
    $res = $cnx->query($sql);
 
// var_dump($res);
}


// if(isset($_POST['btn_buscar'])){
//   $buscar_text=$_POST['buscar'];
//   $select_buscar=$cnx->prepare(
// //   'SELECT * FROM files fs INNER JOIN factura_orden_prodcuto fp ON fs.order_id = fp.order_id WHERE fs.order_id LIKE :campo OR fs.order_date LIKE :campo;'
//   'SELECT * FROM files fs INNER JOIN factura_orden_prodcuto fp ON fs.order_id = fp.order_id WHERE fp.order_id LIKE :campo OR fp.order_date LIKE :campo;'
//   );

//   $select_buscar->execute(array(
//     ':campo' =>"%".$buscar_text."%"
//   ));

//   $res=$select_buscar->fetchAll();

// }






 ?>


<html>
    <head>
        <meta charset="UTF-8">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/blueimp-md5/2.18.0/js/md5.js" integrity="sha512-NpfrQEgzOExS1Ax8fjITKrgBFK87lZbBmvWdZk4suiCC4tsHPrTCsulgIA7Z/+CeWhDpEP/f36mNWgZXDKtTAA==" crossorigin="anonymous"></script>
        <script src="jquery-3.1.1.min.js"></script>

        <title>Adjuntar Guia</title>
        <!--<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">-->
       <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    </head>
    <body>
      <?php 
    //   include '../barra_bodega.php'; 
      ?>
      <button class="btn btn-warning"><a href="../panel_bodega.php">Volver al menu principal</a> </button>
      <button class="btn btn-danger"><a href="../traspasos/new_demo.php">Ir a traspasos</a> </button>
      
        <!-- <div class="container"> -->
            <div class="row justify-content-md-center">
                <div class="col-md-auto">
                    <h1>Cotizaciones Pendientes Por Alistamiento</h1>
                </div>
            </div>
            <div class="row justify-content-md-center">
                <div class="col-8">
                  <center>  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" >
                      Adjuntar guia y completar cotizacion
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
                                <th scope="col" colspan="2">PDF Cotizacion</th>
                                <th scope="col">Documentos</th>
                                <th scope="col">Notas</th>
                                <th scope="col">Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($res as $val) {
                        
                            ?>
                              
                                    <form class="" action="finished.php" method="post">
                                <tr>
                                    <td><?php echo $val['order_date'] ?> </td>

                                    <td> <input type="text" name="id" value="<?php echo $val['order_id']; ?>">  </td>
                                    <td><?php echo $val['title'] ?></td>
                                    <td><img src="./imagenes/<?php echo $val['file_name'];?>" alt="<?php echo $val['order_id'];?>" target="_blank" class="img-fluid" width="100" height="100" style="margin-left: 20px" ></td>
                                    <?php if(isset($val['order_id'])){
                                        echo '<td> <a href="../print_invoice.php?invoice_id='.$val["order_id"].'" title="Imprimir Factura"><div class="btn btn-primary"><span class="glyphicon glyphicon-print">Ver PDF</span></div></a></td>';
                                      } ?>
                            
                                          <?php 
                                         
                                            
                                        echo '<td> <a href="../print_etiquetas.php?invoice_id='.$val["order_id"].'"><button type="button" class="btn btn-warning">  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-stickies" viewBox="0 0 16 16">
  <path d="M1.5 0A1.5 1.5 0 0 0 0 1.5V13a1 1 0 0 0 1 1V1.5a.5.5 0 0 1 .5-.5H14a1 1 0 0 0-1-1H1.5z"/>
  <path d="M3.5 2A1.5 1.5 0 0 0 2 3.5v11A1.5 1.5 0 0 0 3.5 16h6.086a1.5 1.5 0 0 0 1.06-.44l4.915-4.914A1.5 1.5 0 0 0 16 9.586V3.5A1.5 1.5 0 0 0 14.5 2h-11zM3 3.5a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 .5.5V9h-4.5A1.5 1.5 0 0 0 9 10.5V15H3.5a.5.5 0 0 1-.5-.5v-11zm7 11.293V10.5a.5.5 0 0 1 .5-.5h4.293L10 14.793z"/>
</svg> </button></a></td>';
                                            
                                        ?>

                                    <td>
                                        <!--<button onclick="openModelPDF('<?php echo $val['url'] ?>')" class="btn btn-success" type="button">Modal</button>-->
                                        <a class="btn btn-primary" target="_black" href="<?php echo 'http://' . $_SERVER['HTTP_HOST'] . '/upload/' . $val['url']; ?>" >Factura</a>
                                    </td>
                                    
                            

                                    <td> <?php echo $val['description'] ?> </td>
                                   <td> <?php echo $val['estado']; ?>  </td>
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
                      <h3>Adjuntar Guia</h3>

                        <form enctype="multipart/form-data" id="form1">
                          <!-- <div class="form-group">
                              <label for="title">Cotizacion</label>
                              <input type="text" class="form-control" id="cotizacion" name="cotizacion" value="" >
                          </div> -->

                          <div style="text-align: center;">
                            <select id="buscarcliente" style="width: 100%" name="cotizacion">
                              <option value="0">Elegir una cotizacion:</option>
                                 <?php
                                   $query = $cnx -> query ("SELECT * FROM files WHERE estado = 'alistamiento' ORDER BY order_date DESC ");
                                   while ($valores = mysqli_fetch_array($query)) {
                                     echo '<option value="'.$valores[order_id].'">'.$valores[order_id].','.$valores[title].'</option>';
                                   }

                                 ?>
                            </select>
                        </div>
                        <hr>
                        <div class="form-group">
                            <label for="imagen">Adjuntar Guia:</label>
                            <input type="file" class="form-control" id="imagen" name="imagen">
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
                                xhttp.open("POST", "send_ajax_guia.php", true);
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
        <!-- <script type="text/javascript">
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
        </script> -->
    </body>
</html>

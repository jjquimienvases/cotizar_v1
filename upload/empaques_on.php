<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
include('conexion.php');

$tmp = array();
$res = array();

$status = "finalizado";

$sel = $con->query("SELECT * FROM files WHERE estado = '$status' ORDER BY order_date DESC LIMIT 20");
while ($row = $sel->fetch_assoc()) {
    $tmp = $row;
    array_push($res, $tmp);
}
?>
<?php
$resultado = "";
if (isset($_POST['buscar_cotizacion'])) {
 $id = $_POST['producto'];
 $sql = "SELECT * FROM factura_orden WHERE order_id='$id'  OR order_receiver_name LIKE '%$id%' ";
 $r = $con->query($sql);
 if ($o = $r->fetch_object()) {
   $resultado = $o;
 }

}

include_once '../conexion_proveedor.php';

if(isset($_POST['btn_buscar'])){
  $buscar_text=$_POST['buscar'];
  $select_buscar=$con->prepare('
    SELECT * FROM files WHERE order_id LIKE :campo OR order_date LIKE :campo;'
  );

  $select_buscar->execute(array(
    ':campo' =>"%".$buscar_text."%"
  ));

  $res=$select_buscar->fetchAll();

}



$href = "../asistente.php";

 ?>


<html>
    <head>
        <meta charset="UTF-8">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/blueimp-md5/2.18.0/js/md5.js" integrity="sha512-NpfrQEgzOExS1Ax8fjITKrgBFK87lZbBmvWdZk4suiCC4tsHPrTCsulgIA7Z/+CeWhDpEP/f36mNWgZXDKtTAA==" crossorigin="anonymous"></script>
        <script src="jquery-3.1.1.min.js"></script>

        <title>Cotizaciones Finalizadas</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    </head>
    <body>
      <hr>
      <button class="btn btn-warning"><a href="<?= $href ?>">Regresar al Menu</a> </button>
      



            <div class="row justify-content-md-center">
                <div class="col-8">
  <h3> Cotizaciones Finalizadas </h3>
 <hr>

 <h2>Buscar Cotizaciones</h2>

 <div class="barra__buscador">
   <form action="" class="formulario" method="post">
     <input type="text" name="buscar" placeholder="buscar ID  o Fecha"
     value="<?php if(isset($buscar_text)) echo $buscar_text; ?>" class="input__text">
     <input type="submit" class="btn" name="btn_buscar" value="Buscar">
   </form>
 </div>

                    <table class="table table-hover table-bordered" width="100%">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">Fecha</th>
                                <th scope="col">Cotizacion</th>
                                <th scope="col">Cliente</th>
                                <th scope="col">Comprobante</th>
                                <th scope="col"><center>Factura</center> </th>
                                <th scope="col">PDF Cotizacion</th>
                                
                                <th scope="col">Guia</th>
                                <th scope="col">Notas</th>
                                <th scope="col">Estado</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($res as $val) { ?>

                                <tr>
                                    <td> <center>  <?php echo $val['order_date'] ?> </center> </td>
                                    <td> <center> <input type="text" name="id" value="<?php echo $val['order_id']; ?>"> </center> </td>
                                    <td> <center> <?php echo $val['title'] ?> </center> </td>
                                    <?php if(isset($val['order_id'])){echo '<td> <center> <a href="../print_invoice.php?invoice_id='.$val["order_id"].'" title="Imprimir Factura"><div class="btn btn-primary"><span class="glyphicon glyphicon-print">Ver PDF</span></div></a> </center> </td>';  } ?>
                                    <td> <center> <img src="./imagenes/<?php echo $val['file_name'];?>" alt="<?php echo $val['order_id'];?>" class="img-fluid" width="100" height="100" style="margin-left: 20px" ></center> </td>
                                    <td>
                                       <a class="btn btn-primary" target="_black" href="<?php echo 'http://' . $_SERVER['HTTP_HOST'] . '/upload/' . $val['url']; ?>" >Factura</a>
                                    </td>
                                    <td><img src="./imagenes/<?php echo $val['archivo_name'];?>" alt="<?php echo $val['order_id'];?>" class="img-fluid" width="100" height="100" ></td>
                                    <td> <center> <?php echo $val['estado'] ?> </center> </td>
                                    <td> <center> <?php echo $val['description'] ?> </center> </td>

                                </tr>

                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Aprobar y alistar cotizacion</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                      <h3>Buscar Cotizacion</h3>
                      <div class="contenedor">
                        <form class="" action="" method="post">
                          <center><div class="input-contenedor">
                            <input type="text"  placeholder="Cliente o factura" name="producto" size="50" id="producto" required autocomplete="off" autofocus>
                            <input type="hidden" name="buscar_cotizacion" size="200">
                          </div></center>
                        </form>
                      </div>
                        <form enctype="multipart/form-data" id="form1">
                          <div class="form-group">
                              <label for="title">Cotizacion</label>
                              <input type="text" class="form-control" id="cotizacion" name="cotizacion" value="<?=isset($resultado->order_id)?$resultado->order_id:''?>" readonly>
                          </div>
                            <div class="form-group">
                                <label for="title">Cliente</label>
                                <input type="text" class="form-control" id="title" name="title" value="<?=isset($resultado->order_receiver_name)?$resultado->order_receiver_name:''?>" readonly>
                            </div>
                            <div class="form-group col-md5">
                                <label for="description">Datos adicionales</label>
                                <input type="hidden" class="form-control" id="description" name="description" value="default">
                                <input class="form-control" type="text" placeholder=" codigo de aprobacion de pago" name="codigo" value="">
                                <input class="form-control" type="text" placeholder=" numero de factura" name="factura" value="">
                            </div>
                            <div class="form-group">
                                <label for="description">Archivo</label>
                                <input type="file" class="form-control" id="file" name="file">
                            </div>
                            <div class="form-group">
                                <label for="imagen">Imagen</label>
                                <input type="file" class="form-control" id="imagen" name="imagen">
                            </div>
                            <input type="hidden" class="form-control" id="vendedor" name="vendedor" value="<?=isset($resultado->order_receiver_name)?$resultado->order_receiver_name:''?>" readonly>
                            <input type="hidden" class="form-control" id="estadoactual" name="estadoactual" value="alistamiento" readonly>
                            <input type="hidden" class="" id="monto" name="monto" value="<?=isset($resultado->order_total_after_tax)?$resultado->order_total_after_tax:''?>" readonly>
                            <input class="form-control" type="hidden" placeholder="Metodo de pago" name="metodo" value="<?=isset($resultado->metodopago)?$resultado->metodopago:''?>" readonly>
                            <input class="form-control" type="hidden" placeholder="Estado" name="estado" value="alistamiento" readonly>
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
                                xhttp.open("POST", "upload.php", true);
                                xhttp.send(data);
                                $('#form1').trigger('reset');
                            }
                            function openModelPDF(url) {
                                $('#modalPdf').modal('show');
                                $('#iframePDF').attr('src','<?php echo 'http://' . $_SERVER['HTTP_HOST'] . '/upload/'; ?>'+url);
                            }
        </script>



    </body>
</html>

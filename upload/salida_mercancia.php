<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
include('conexion.php');
session_start();

$id_rol = $_SESSION['id_rol'];

$hoy = '';
$ma���ana = '';
$ahora = time();
$unDiaEnSegundos = 24 * 60 * 60;
$manana = $ahora + $unDiaEnSegundos;
$mananaLegible = date("Y-m-d", $manana);
# ahoraLegible ���nicamente es para demostrar
$ahoraLegible = date("Y-m-d", $ahora);
$hoy = $ahoraLegible . "&nbsp" . "07:10:55";
$tomorrow = $mananaLegible . "&nbsp" . "07:50:55";
$demo_fecha = "2021-03-02 07:50:50";
$demo_fecha_2 = "2021-03-05 18:50:50";
$tmp = array();
$res = array();

$status = "finalizado";


//NECESITO PONER UN LIMITE DE FECHA QUE SEA SOLO LAS DEL DIA
$sel = $con->query("SELECT * FROM files WHERE estado LIKE '%$status%' AND order_date BETWEEN '$hoy' AND '$tomorrow'");
// $sel = $con->query("SELECT * FROM files WHERE estado LIKE '%$status%' AND order_date BETWEEN '$demo_fecha' AND '$demo_fecha_2' ");
while ($row = $sel->fetch_assoc()) {
    $tmp = $row;
    array_push($res, $tmp);
}
?>
<?php
$resultado = "";
if (isset($_POST['buscar_cotizacion'])) {
    $id = $_POST['producto'];
    $sql = "SELECT * FROM files WHERE order_id='$id'  OR title LIKE '%$id%' OR order_date LIKE '%$id%'";
    $r = $con->query($sql);
    if ($o = $r->fetch_object()) {
        $resultado = $o;
    }
}

include_once '../conexion_proveedor.php';

if (isset($_POST['btn_buscar'])) {
    $buscar_text = $_POST['buscar'];
    $select_buscar = $con->prepare(
        '
    SELECT * FROM files WHERE order_id LIKE :campo OR order_date LIKE :campo AND estado LIKE "%Finalizado%";'
    );

    $select_buscar->execute(array(
        ':campo' => "%" . $buscar_text . "%"
    ));

    $res = $select_buscar->fetchAll();
}




$mysqli2 = new mysqli('127.0.0.1', 'cotizar', 'LeinerM4ster', 'cotizar');


?>


<html>

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/blueimp-md5/2.18.0/js/md5.js" integrity="sha512-NpfrQEgzOExS1Ax8fjITKrgBFK87lZbBmvWdZk4suiCC4tsHPrTCsulgIA7Z/+CeWhDpEP/f36mNWgZXDKtTAA==" crossorigin="anonymous"></script>
    <!--<script src="jquery-3.1.1.min.js"></script>-->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>

    <title>Factura</title>
    <style>
        a {
            text-decoration: none;
            color: white;
        }
    </style>

</head>

<body>
    <!--<?php include '../barra_asistente.php'; ?>-->
    <button class="btn btn-warning"> <a href="../panel_bodega_perfumeria.php">VOLVER AL PANEL DE BODEGA</a> </button>
    <!-- <div class="container"> -->
    <div class="row justify-content-md-center">
        <div class="col-md-auto">
            <h1>APROBAR SALIDA DE MERCANCIA BODEGA PRINCIPAL</h1>
        </div>
    </div>
    <div class="row justify-content-md-center">
        <div class="col-8">
            <center> <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                    Click aqui para aprobar salida de mercancia
                </button> </center>
            <hr>

            <center>
                <h2>Buscar Cotizaciones</h2>
                <div class="barra__buscador">
                    <form action="" class="formulario" method="post">
                        <input type="text" name="buscar" placeholder="buscar ID  o Fecha" value="<?php if (isset($buscar_text)) echo $buscar_text; ?>" class="input__text">
                        <input type="submit" class="btn" name="btn_buscar" value="Buscar">
                    </form>
                </div>
            </center>
            <hr>

            <center><button class="btn btn-success"><A href="salida_mercancia.php">REFRESH</A></button></center>
            <hr>

            <table class="table table-hover table-bordered" width="100%">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Fecha</th>
                        <th scope="col">Cotizacion</th>
                        <th scope="col">Cliente</th>
                        <th scope="col">PDF Cotizacion</th>
                        <th scope="col">Foto Pago</th>
                        <th scope="col">PDF Factura</th>
                        <th scope="col">Foto Pedido</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Notas</th>

                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($res as $val) { ?>
                        <?php $cotizacion = $val['order_id'];
                        // $consulta_total = "SELECT * FROM factura_orden WHERE order_id =$cotizacion";
                        ?>
                        <form class="" action="" method="post">
                            <tr>
                                <td>
                                    <center> <?php echo $val['order_date'] ?> </center>
                                </td>
                                <td>
                                    <center> <input type="text" name="id" value="<?php echo $val['order_id']; ?>"> </center>
                                </td>
                                <td>
                                    <center> <?php echo $val['title'] ?> </center>
                                </td>
                                <?php if (isset($val['order_id'])) {
                                    echo '<td> <center> <a href="../print_invoice.php?invoice_id=' . $val["order_id"] . '" title="Imprimir Factura"><div class="btn btn-primary"><span class="glyphicon glyphicon-print">Ver PDF</span></div></a> </center> </td>';
                                } ?>
                                <td>
                                    <center> <img src="./imagenes/<?php echo $val['file_name']; ?>" alt="<?php echo $val['order_id']; ?>" class="img-fluid" width="100" height="100" style="margin-left: 20px"></center>
                                </td>
                                <td>
                                    <a class="btn btn-primary" target="_black" href="<?php echo 'http://' . $_SERVER['HTTP_HOST'] . '/upload/' . $val['url']; ?>">Factura</a>
                                </td>
                                <td><img src="./imagenes/<?php echo $val['archivo_name']; ?>" alt="<?php echo $val['order_id']; ?>" class="img-fluid" width="100" height="100"></td>
                                <td>
                                    <center> <?php echo $val['estado'] ?> </center>
                                </td>
                                <td>
                                    <center> <?php echo $val['description'] ?> </center>
                                </td>
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

                        <div style="text-align: center;">
                            <select id="buscarcliente" style="width: 100%" name="cotizacion" class="form-control">
                                <option value="0">Elegir una cotizacion:</option>
                                <?php
                                $query = $mysqli2->query("SELECT * FROM files WHERE estado LIKE '%finalizado%' AND order_date BETWEEN '$hoy' AND '$tomorrow' ORDER BY order_date DESC ");
                                while ($valores = mysqli_fetch_array($query)) {
                                    echo '<option value="' . $valores[order_id] . '">' . $valores[order_id] . ',' . $valores[title] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <hr>
                        <!--<label for="">Cliente:</label>-->

                        <!--<input type="text" name="cliente" value="" class="form-control">-->
                        <!--<input type="hidden" name="cotizacion" value="" class="form-control">-->
                        <hr>
                        <div class="form-group">
                            <label for="description">Adjuntar Foto:</label>
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
            xhttp.onreadystatechange = function() {
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
            xhttp.open("POST", "send_ajax_salida.php", true);
            xhttp.send(data);
            $('#form1').trigger('reset');
        }

        function openModelPDF(url) {
            $('#modalPdf').modal('show');
            $('#iframePDF').attr('src', '<?php echo 'http://' . $_SERVER['HTTP_HOST'] . '/upload/'; ?>' + url);
        }
    </script>

    <!-- <script type="text/javascript">
        	$(document).ready(function(){ //peticion ajax para enviar el form principal
        		$('#finalizar').click(function(){
        			var datos=$('#cotizacion').serialize();
        			$.ajax({
        				type:"POST",
        				url:"send.php",
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
        </script> -->

    <script type="text/javascript">
        //   function ver_datos(id, e){
        //     var dato = document.getElementById('cliente'+id);
        //     e.preventDefault();
        //   }

        //   $("#buscarcliente").on('click',function(){
        //     $.ajax({
        //       url:'conexiones.php',
        //       type:'POST',
        //       dataType:'json',
        //       data:{key:'Q1',cliente:$(this).val()}
        //     }).done(function(d){

        //       let padre = $("#buscarcliente").parent().parent().parent();
        //       padre.find("[name^=cliente]").val(d.resultado.title)
        //       padre.find("[name^=cotizacion]").val(d.resultado.order_id)


        //     }).fail(function(e){console.log("ERROR:",e);});
        //   })

        // $(document).ready(function(){
        // 	$('#buscarcliente').select2();
        // });
    </script>

</body>

</html>
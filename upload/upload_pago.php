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

$status3 = "s_factura";
$status = "pendiente";
$status2 = "alistamiento";

$sel = $con->query("SELECT * FROM files WHERE estado = '$status' OR estado = '$status2' OR estado = '$status3' ORDER BY order_date DESC");


$seleccion = $con->query("SELECT count(*) AS total FROM files WHERE estado = '$status' OR estado = '$status2' OR estado = '$status3'");
$data = mysqli_fetch_assoc($seleccion);
$cuenta = $data['total'];


if ($cuenta > 0) {
    while ($row = $sel->fetch_assoc()) {
        $tmp = $row;
        array_push($res, $tmp);
    }
} else {
    echo "AGREGAR UNA NUEVA COTIZACION A PENDIENTES";
}
?>
<?php
$resultado = "";
if (isset($_POST['buscar_cotizacion'])) {
    $id = $_POST['producto'];
    $sql = "SELECT * FROM factura_orden WHERE order_id='$id'";
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
    SELECT * FROM files WHERE order_id LIKE :campo OR order_date LIKE :campo AND estado = "alistamiento";'
    );

    $select_buscar->execute(array(
        ':campo' => "%" . $buscar_text . "%"
    ));

    $res = $select_buscar->fetchAll();
}

$conexion = new mysqli('127.0.0.1', 'cotizar', 'LeinerM4ster', 'cotizar');
?>


<html>

<head>
    <meta charset="UTF-8">
    <!-- <script src="../jquery-3.1.1.min.js"></script> -->
    <script src="../jquery-3.5.1.min.js"></script>
    <!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/blueimp-md5/2.18.0/js/md5.js" integrity="sha512-NpfrQEgzOExS1Ax8fjITKrgBFK87lZbBmvWdZk4suiCC4tsHPrTCsulgIA7Z/+CeWhDpEP/f36mNWgZXDKtTAA==" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <title>Agregar Cotizacion a pendientes</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
</head>

<body>
    <?php include '../barraComerciales.php'; ?>


    <div class="row justify-content-md-center">
        <div class="col-md-auto">
            <h1>Adjuntar Informacion</h1>
        </div>
    </div>
    <div class="row justify-content-md-center">
        <div class="col-8">
            <center> <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                    Subir nueva cotizacion a pendientes
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

            <table class="table table-hover table-bordered" width="110%">
                <thead>
                    <tr class="table-danger">
                        <th scope="col">Fecha</th>
                        <th scope="col">Cotizacion</th>
                        <th scope="col">Cliente</th>
                        <th scope="col">Comprobante</th>
                        <th scope="col">Punto de venta</th>
                        <th scope="col">Estado</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($res as $val) { ?>
                        <form class="" action="" method="post">
                            <tr>
                                <td><?php echo $val['order_date'] ?></td>
                                <td> <input type="text" name="id" value="<?php echo $val['order_id']; ?>"> </td>
                                <td><?php echo $val['title'] ?></td>
                                <td>
                                    <center> <img src="./imagenes/<?php echo $val['file_name']; ?>" alt="<?php echo $val['order_id']; ?>" class="img-fluid" width="100" height="100"></center>
                                </td>
                                <td> <?php echo $val['id_punto_venta']; ?> </td>
                                <td> <?php echo $val['estado']; ?> </td>
                            </tr>
                        </form>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal -->
    <?php include 'modal_call_pago.php'; ?>
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
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

    <script>
        function onSubmitForm() {

            Swal.fire({
                title: 'Bebe estas segura de solicitar esta factura?',
                showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: `Si, Estoy segura papasito`,
                denyButtonText: `No, papi.`,
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {



                    var frm = document.getElementById('form1');
                    var data = new FormData(frm);
                    var xhttp = new XMLHttpRequest();
                    xhttp.onreadystatechange = function() {
                        if (this.readyState == 4) {
                            var msg = xhttp.responseText;
                            if (msg != 0) {
                                // alert(msg);
                                Swal.fire({
                                    title: 'Perfecto!',
                                    text: 'Me encantas bebecita.',
                                    imageUrl: 'corazon.png',
                                    imageWidth: 400,
                                    imageHeight: 200,
                                    imageAlt: 'Custom image',
                                })
                                $('#exampleModal').modal('hide')
                            } else {
                                // alert(msg);
                                Swal.fire({
                                    title: 'No funciona :( !',
                                    text: 'Me encantas bebecita.',
                                    imageUrl: 'corazon.png',
                                    imageWidth: 400,
                                    imageHeight: 200,
                                    imageAlt: 'Custom image',
                                })
                            }

                        }
                    };
                    xhttp.open("POST", "send_ajax_pago.php", true);
                    xhttp.send(data);
                    $('#form1').trigger('reset');
                } else if (result.isDenied) {
                    Swal.fire('Cancelaste la subida al mostrador', '', 'info')
                }
            })
        }



        function openModelPDF(url) {
            $('#modalPdf').modal('show');
            $('#iframePDF').attr('src', '<?php echo 'http://' . $_SERVER['HTTP_HOST'] . '/upload/'; ?>' + url);
        }

        function onSubmitMostrador() {
            Swal.fire({
                title: 'Estas seguro de subir esta cotizacion al mostrador?',
                showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: `Si, Estoy seguro`,
                denyButtonText: `No`,
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
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
                    xhttp.open("POST", "send_info_mostrador.php", true);
                    xhttp.send(data);
                    $('#form1').trigger('reset');
                    // Swal.fire('Saved!', '', 'success')
                } else if (result.isDenied) {
                    Swal.fire('Cancelaste la subida al mostrador', '', 'info')
                }
            })

        }


        function openModelPDF(url) {
            $('#modalPdf').modal('show');
            $('#iframePDF').attr('src', '<?php echo 'http://' . $_SERVER['HTTP_HOST'] . '/upload/'; ?>' + url);
        }

        function ver_datos(id, e) {
            var dato = document.getElementById('cliente' + id);
            e.preventDefault();
        }

        $("#consultor").on('click', function() {
            let data_ = $("#buscarcliente").val()
            $.ajax({
                url: 'scripts/consultas.php',
                type: 'POST',
                dataType: 'json',
                data: {
                    key: 'Q1',
                    cliente: data_
                }
            }).done(function(d) {

                let padre = $("#buscarcliente").parent().parent().parent();
                padre.find("[name^=title]").val(d.resultado.order_receiver_name);
                padre.find("[name^=vendedor]").val(d.resultado.order_receiver_address);
                padre.find("[name^=fecha]").val(d.resultado.order_date);
                padre.find("[name^=monto]").val(d.resultado.order_total_after_tax);
                padre.find("[name^=cotizacion]").val(d.resultado.order_id);
            }).fail(function(e) {

            });
        })
    </script>


</body>

</html>
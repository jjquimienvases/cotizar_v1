<?php
//  include_once "consultas.php";
if (!isset($_SESSION)) {
    session_start();
}

$user = $_SESSION['userid'];
$user_rol = $_SESSION['id_rol'];
// $caja = isCajaCerradaLastDay($user);
// if (empty($caja)) {
//     header("Location:panel_ibague.php");
// }
if ($_SESSION['id_rol'] == 7) {
} else if ($_SESSION['id_rol'] == 3) {
    header("Location:create_invoice_d1_.php");
} else if ($_SESSION['id_rol'] == 2) {
    header("Location:create_invoice_2_.php");
}

$rol_usuario = $_SESSION['id_rol'];
if ($rol_usuario == 1) {
    $tabla = "producto_prueba";
} else if ($rol_usuario == 2) {
    $tabla = "producto";
} else if ($rol_usuario == 3) {
    $tabla = "producto_d1";
} else if ($rol_usuario == 4) {
    $tabla = "producto_av";
} else if ($rol_usuario == 6) {
    $tabla = "producto_av";
} else if ($user == 27) {
    $tabla = "productos_ibague2";
} else if ($rol_usuario == 7) {
    $tabla = "productos_ibague";
} else if ($rol_usuario == 9) {
    $tabla = "producto_av";
}

include 'Invoice.php';

$invoice = new Invoice();
$invoice->checkLoggedIn();

?>
<?php

include 'conectar.php';
$conexion = conectar();

?>

<title>Crear cotizaciones</title>
<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="css/select2.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
</script>
<script src="jquery-3.1.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous">
</script>
<link rel="stylesheet" type="text/css" href="alertifyjs/css/alertify.css">
<link rel="stylesheet" type="text/css" href="alertifyjs/css/themes/default.css">
<script src="alertifyjs/alertify.min.js"></script>
<link href="//cdn.jsdelivr.net/npm/@sweetalert2/theme-minimal@4/minimal.css" rel="stylesheet">
<script src="//cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.js"></script>
<script src="js/select2.min.js"></script>
<script src="js/invoice_ibague_.js"></script>
<script src="js/crear_clientes.js"></script>
<script src="js/cotizacion_prueba.js"></script>
<script src="scripts/alertas.js"></script>
<script src="js/calcular_perfumeria.js"></script>


<style>
    table {
        width: 80%;
    }

    #invoiceItem {
        width: 90%;
    }

    #buscador {
        width: 10%;
    }

    #cod {
        width: 5%;
    }

    #tot {
        width: 10%;
    }

    #prod {
        width: 15%;
    }

    #cat {
        width: 3%;
    }

    #productCode {
        width: 3%;
    }

    td,
    th {
        margin-left: 2px;

    }

    #limpiar {
        margin-left: 450px;

    }
</style>

<?php include 'container_ibague.php'; ?>
<div class="row">
    <div class="col-md-12 col-xl-12 col-sm-12 col-lg-12 ">
        <form id="invoice-form" method="post" class="invoice-form" role="form" novalidate>
            <input type="hidden" value="agregarCotizacion" name="metodo">
            <!-- <input type="hidden" value="callCotizacion" name="metodo"> -->
            <input type="hidden" value="agregarClientes" name="clientes">
            <input type="hidden" value="<?php echo $tabla; ?>" id='tabla' name=rol>
            <div class="load-animate animated fadeInUp">
                <div class="row">
                    <div class="col-md-6 col-xl-6 col-sm-6 col-lg-6">
                        <h2 class="title">Crear una nueva cotizacion</h2>
                        <?php include 'menud1.php'; ?>
                        <input id="currency" type="hidden" value="$">
                        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                            <h3>De,</h3>
                            <?php echo $_SESSION['user']; ?><br>
                            <?php echo $_SESSION['address']; ?><br>
                            <?php echo $_SESSION['mobile']; ?><br>
                            <?php echo $_SESSION['email']; ?><br>
                        </div>
                    </div>
                    <div class="col-md-6 col-xl-6 col-sm-6 col-lg-6 ">
                        <input type="button" class="btn btn-outline-dark" id="limpiar" value="Limpiar" name="limpiar">
                        <input type="button" class="btn btn-outline-dark" id="ver_stocks" value="Ver Stocks" name="ver_stocks">
                        <h3>Para,</h3>
                        <div class="form-group">
                            <div class="buscarcliente">
                                <datalist id="buscarclient">
                                    <option value="">Seleccione un cliente</option>
                                    <?php
                                    $query = $conexion->query("SELECT * FROM clientes ORDER BY nombres ASC");
                                    while ($valores = mysqli_fetch_array($query)) {
                                        echo '<option value="' . $valores["cedula"] . '">' . $valores["cedula"] . ',' . $valores["nombres"] . '</option>';
                                    }
                                    ?>
                                </datalist>
                                <input class="form-control" list="buscarclient" name="cedulasres" id="buscarcliente" type="text" placeholder="Buscar Cliente">
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="companyName" id="companyName" placeholder="Nombre de Empresa o cliente" autocomplete="off" required>
                        </div>
                        <div class="form-group">
                            <input type="hidden" class="form-control" name="idcliente" id="idcliente" placeholder="" autocomplete="off" required>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control " name="id_cedula" id="cedula" placeholder="cedula o nit" autocomplete="off" required>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="email" id="email" placeholder="Correo electronico" autocomplete="off" required>
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

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text bg-primary text-white" for="inputGroupSelect01">Puntos
                                    Naturales</label>
                            </div>
                            <input value="" type="text-tarea" class="form-control" readonly autocomplete="off" name="puntosN" id="puntosN" placeholder="" readonly>
                            <div id="check" class="input-group-text">
                                <input type="hidden" value="" name="Pnaturales" id="Pnaturales" class="bg-primary " aria-label="Checkbox for following text input">
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text bg-success text-white" autocomplete="off" for="inputGroupSelect01">Puntos Especiales</label>
                            </div>
                            <input value="" type="text-tarea" class="form-control" readonly name="puntosE" id="puntosE" placeholder="" readonly>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text bg-success text-white" autocomplete="off" for="inputGroupSelect01">Descuento Programado</label>
                            </div>
                            <input value="" type="text-tarea" class="form-control" name="descuento_p" id="descuento_p" placeholder="" readonly>
                        </div>
                        <div id="" class="form-group">
                            <select name="Especificos" class="form-control" id="especificos">
                                <option value="Naturales">Naturales</option>
                                <option value="Especiales">Especiales</option>
                                <option value="Distribuidores">Distribuidores</option>
                                <option value="Distribuidores">Colaboradores</option>
                                <option value="daniel">Daniel Perfumeria</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <a class="form-control btn btn-danger" onclick="create_clients()">Agregar
                                Clientes o Actualizar Clientes</a>
                        </div>
                        <div class="form-group">
                            <div style="text-align: center;">
                                <select id="buscarcomercial" style="width: 100%" name="address">
                                    <option value="0">Busca tu nombre:</option>
                                    <?php
                                    $query = $conexion->query("SELECT * FROM factura_usuarios order by first_name");
                                    while ($valores = mysqli_fetch_array($query)) {
                                        echo '<option value="' . $valores['first_name'] . '&nbsp;' . $valores['last_name'] . '">' . $valores['first_name'] . '&nbsp;' . $valores['last_name'] . '</option>';
                                    }

                                    ?>
                                </select>
                            </div>
                        </div>
                        <hr>



                        <div class="form-group">
                            <label for=""> Distribuidores</label>
                            <td><input class="itemRus" type="checkbox" autocomplete="off" id="distri" name="distri" value=""></td>
                        </div>

                        <div class="form-group">
                            <label>Promocion PETS</label>
                            <td> <input class="p_especial" type="checkbox" id="p_especial" name='p_especial'> </td>
                        </div>
                        <div class="form-group">
                            <label>DIPE</label>
                            <td> <input class="pp_item_p" type="checkbox" id="pp_item_p" name='pp_item_p'> </td>
                        </div>
                        <div class="form-group">
                            <label>MARLON BAYONA</label>
                            <td> <input class="mb" type="checkbox" id="mb" name='mb'> </td>
                        </div>

                        <?php
                        if ($user_rol == 4) {
                            echo '  <div class="form-group">
                        <label>Precio Docena</label>
                        <td> <input class="price_docena" type="checkbox" id="price_docena" name="price_docena"> </td> 
                     </div>';
                        } else {
                        }

                        ?>

                        <hr>
                        <div class="form-group">
                            <?php
                            if ($user == 27) {
                                $val = "<input type='hidden' name='metodopago'  value='mostrador_ibague_2'>";
                            } else if ($user_rol == 7) {
                                $val = "<input type='hidden' name='metodopago'  value='mostrador_ibague_1'>";
                            } else if ($user_rol == 4) {
                                $val = "<input type='hidden' name='metodopago'  value='bancolombia'>";
                            }

                            echo $val;
                            ?>
                            <!--<p>Elegir en que sede estas ubicado</p>-->
                            <!--<select name="metodopago" class="form-control">-->
                            <!--    <option value="mostrador_ibague_1" selected>ibague 1</option>-->
                            <!--    <option value="mostrador_ibague_2">ibague 2</option>-->
                            <!--</select>-->
                            <!--<input type="hidden" value="pendiente" name="estados">-->
                        </div>



                    </div>

                </div>
            </div>
            <br>
            <!--- Tabla de buscar producto -->
            <div class="row">
                <div class="col-md-12 col-xl-12 col-lg-12 col-12 col-sm-12">
                    <table class="table table-bordered  table-hover" id="invoiceItem">
                        <tr>
                            <th width="2%"><input id="checkAll" class="formcontrol" type="checkbox"></th>
                            <th id="buscador">
                                <center>Buscar aqui</center>
                            </th>
                            <th id="cat">
                                <center>Cat</center>
                            </th>
                            <th id="cod">
                                <center>Codigo</center>
                            </th>
                            <th id="prod">
                                <center>Producto</center>
                            </th>
                            <th width="8%">
                                <center>Stock</center>
                            </th>
                            <th width="8%">
                                <center>Empaque</center>
                            </th>

                            <th id="tE" width="1%">

                            </th>
                            <th></th>
                            <th width="5%">
                                <center>Cantidad</center>
                            </th>
                            <th width="8%">
                                <center>Unitario</center>
                            </th>
                            <th id="tot" class="col-6">
                                <center>Total</center>
                            </th>
                            <th></th>
                            <div>
                                <th></th>
                                <th></th>
                                <th></th>
                            </div>
                        </tr>
                        <tr>

                        </tr>

                    </table>
                    <button class="btn btn-danger delete" id="removeRows" type="button">- Borrar</button>
                    <button class="btn btn-success" id="addRows" type="button" accesskey="a">+ Agregar Más</button>
                    <button class="btn btn-warning" id="btnadd" type="button">+ Agregar Perfume</button>
                </div>
            </div>
            <!--- finaliza la tabla buscar producto -->
            <br>
            <!--- Empieza la fila de perfumeria especial -->
            <div class="row">
                <div class="col-md-6 col-xl-6 col-sm-6 col-lg-6">
                    <h3>Notas: </h3>
                    <div class="form-group">
                        <textarea class="form-control txt" rows="5" name="notes" id="notes" placeholder="Notas"></textarea>
                    </div>
                    <br>
                    <hr>

                </div>
                <div class="col-md-6 col-xl-6 col-sm-6 col-6 col-lg-6">
                    <br>
                    <center>
                        <div class="col-md-8 col-xl-8 col-sm-8 col-8 col-lg-8">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="inputGroupSelect01">Sub Total $</label>
                                </div>
                                <input value="" type="text-tarea" class="form-control" autocomplete="off" name="subTotal" id="subTotal" placeholder="Subtotal" readonly>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="inputGroupSelect01">Total $</label>
                                </div>
                                <input value="" type="number" class="form-control" name="totalAftertax" autocomplete="off" id="totalAftertax" placeholder="Total" readonly>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="inputGroupSelect01">Porcentaje %</label>
                                </div>
                                <input value="" type="number" class="form-control" value="0" min="0" name="taxRate" autocomplete="off" id="taxRate" placeholder="Porcentaje descuento" readonly>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="inputGroupSelect01">Descuento $</label>
                                </div>
                                <input value="" type="number" class="form-control" autocomplete="off" name="taxAmount" id="taxAmount" placeholder="Monto del descuento" readonly>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="inputGroupSelect01">Abono $</label>
                                </div>
                                <input value="" type="number" class="form-control" autocomplete="off" name="amountPaid" id="amountPaid" placeholder="Cantidad pagada" readonly>
                                <div id="check" class="input-group-text">
                                    <input type='checkbox' name='abono' class="bg-primary " aria-label="Checkbox for following text input">
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="inputGroupSelect01">Total a pagar $</label>
                                </div>
                                <input value="" type="number" class="form-control" autocomplete="off" name="amountDue" id="amountDue" placeholder="Cantidad debida" readonly>
                            </div>
                        </div>
                    </center>
                </div>
            </div>
            <br>
            <!-- la fila de Elegir factura -->
            <div class="row">
                <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                    <hr>
                    <hr>
                    <!-- Botom para guardar -->
                    <div class="guardado_group">
                        <input type="hidden" value="<?php echo $_SESSION['userid']; ?>" id="user_id" class="form-control" name="userId">
                        <input type="hidden" value="<?php echo $_SESSION['id_rol']; ?>" id="user_rol" class="form-control">
                        <button data-loading-text="Guardando factura..." type="button" onclick="send_ajax()" name="invoice_btn" value="" class="btn btn-success rounded-pill">FInalizar </button>
                        <!--<input id="guardando" data-loading-text="Guardando factura..." type="submit" name="invoice_btn" value="FINALIZAR" doiclicksito class="btn btn-success submit_btn invoice-save-btm" accesskey="g">-->
                        <!--<input id="guardando_call" data-loading-text="Guardando factura..." type="submit" name="invoice_btn" value="FINALIZAR" doiclicksito class="btn btn-success submit_btn invoice-save-btm" accesskey="g">-->
                    </div>
                    <!-- termina el boton -->
                </div>

            </div>
            <!-- Termina la fila elegir factura -->
            <div class="clearfix"></div>

        </form>
    </div>
</div>
<?php //include 'perfumeria_modal.php';
?>



<script type="text/javascript">
    function run_calcular(e, id) {
        calculateTotal(id);
    }

    function send_ajax() {


        let user_id = $("#user_id").val();
        let user_rol = $("#user_rol").val();
        let cedula = $("#cedula").val();
        let comercial = $("#buscarcomercial").val();
        let name_client = $("#companyName").val();

        Swal.fire({
            title: 'Estas seguro de guardar esta cotizacion?',
            showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: 'Si, Finalizar',
            denyButtonText: `No, Comprobar datos`,
        }).then((result) => {

            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                if (cedula == "") {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Debes escribir el numero de identificacion!',

                    })
                } else if (comercial == 0) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Debes escribir el nombre del comercial!',

                    })
                } else if (name_client == "") {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Debes escribir el nombre del cliente!',

                    })
                } else {
                    var datos = $('#invoice-form').serialize();
                    $.ajax({
                        type: "POST",
                        url: "ajax/ajax_create_.php",
                        data: datos,
                        success: function(r) {
                            console.log(r);
                            if (r != 0 && !isNaN(r)) { //SI ES DISTINTO A 0 Y ES UN NUMERO
                                Swal.fire('Guardado con exito!', '', 'success')
                                if (user_rol == "4") {
                                    window.location.href = "search/index.php";
                                } else if (user_id == "8") {
                                    window.location.href = "try_caja/index.php";
                                } else if (user_id == "2") {
                                    window.location.href = "search/index.php";
                                } else if (user_id == "9") {
                                    window.location.href = "try_caja/index.php";
                                } else if (user_id == "26") {
                                    window.location.href = "try_caja/index.php";
                                } else if (user_id == "27") {
                                    window.location.href = "try_caja/index.php";
                                } else if (user_rol == "2") {
                                    window.location.href = "search_mostrador/index.php";
                                } else if (user_rol == "3") {
                                    window.location.href = "try_caja/index.php";
                                } else if (user_rol == "7") {
                                    window.location.href = "search_ibague_1/index.php";
                                }
                                console.log(datos);
                            } else if (r == "no_session") {
                                Swal.fire('Se Cerro la session!', 'porfavor iniciar session y guardar la cotizacion', 'info')

                            } else { //ES 0(NO SE EJECUTO LA CONSULTA) O EXISTE UN ERROR EXPLICATIVO(STRING)
                                alert("no funciona");
                                console.log(datos);
                            }
                        }
                    });
                    return false;
                }

            } else if (result.isDenied) {
                Swal.fire('Changes are not saved', '', 'info')
            }
        })

    }

    function create_clients() {
        //defino variables
        let cedula = $("#cedula").val();
        let nombre = $("#companyName").val();
        let telefono = $("#tele").val();
        let ciudad = $("#ciudad").val();
        let direccion = $("#direccion").val();
        let email = $("#email").val();
        let tipo_cliente = $("#especificos").val();


        Swal.fire({
            title: '¿Estas Seguro?',
            text: 'Recuerda que si el cliente ya esta creado solo vamos a actualizar la informacion del mismo.',
            showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: 'Si Crear',
            denyButtonText: `No, Validar datos`,
        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {

                $.ajax({
                    type: "POST",
                    url: "ajax/ajax_create_client.php",
                    data: {
                        cedula: cedula,
                        nombre: nombre,
                        telefono: telefono,
                        ciudad: ciudad,
                        direccion: direccion,
                        email: email,
                        tipo_cliente: tipo_cliente
                    },
                    success: function(r) {
                        console.log(r);
                        if (r == 1) { //SI ES DISTINTO A 0 Y ES UN NUMERO
                            Swal.fire('Cliente creado con exito!', '', 'success')

                        } else if (r == 2) {
                            Swal.fire('Cliente Actualziado con exito!', '', 'success')
                        } else if (r == "na") {
                            Swal.fire('No funciona la actualizacion de cliente!', '', 'info')
                        } else if (r == "nc") {
                            Swal.fire('No funciona la creacion de cliente!', '', 'info')
                        } else { //ES 0(NO SE EJECUTO LA CONSULTA) O EXISTE UN ERROR EXPLICATIVO(STRING)
                            Swal.fire('No funciona nada contactar al desarrollador!', '', 'error')

                        }
                    }
                });
                return false;


            } else if (result.isDenied) {
                Swal.fire('Changes are not saved', '', 'info')
            }
        })


    }
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $("#addRows").trigger("click");


        //obtener los datos
        function obtener_datos() {
            $.ajax({
                url: "mostrar_datos.php",
                method: "POST",
                success: function(data) {
                    $("#responses").html(data)
                }
            })
        }
        obtener_datos();
    });
</script>

<script>
    function ver_datos(id, e) {
        var dato = document.getElementById('producto' + id);
        e.preventDefault();
    }

    $("#mibuscador").on('change', function() {
        $.ajax({
            url: 'methods/conexiond1 .php',
            type: 'POST',
            dataType: 'json',
            data: {
                key: 'Q1',
                producto: $(this).val()
            }
        }).done(function(d) {
            if (d.resultado.id_categoria == 4) {

            } else {
                let padre = $("#mibuscador").parent().parent().parent();
                padre.find("[name^=idCategoria]").val(d.resultado.id_categoria)
                padre.find("[name^=productCode]").val(d.resultado.id)
                padre.find("[name^=productName]").val(d.resultado.contratipo)
                padre.find("[name^=productStock]").val(d.resultado.stock)
                padre.find("[name^=productUnidad]").val(d.resultado.unidad)
                padre.find("[name^=price]").val(d.resultado.gramo)
            }
        }).fail(function(e) {

        });
    })

    function run_calcular(e, id) {
        calculateTotal(id);
    }


    $(document).ready(function() {
        $('#mibuscador').select2();
    });
</script>

<script type="text/javascript">
    function ver_datos(id, e) {
        var dato = document.getElementById('cliente' + id);
        e.preventDefault();
    }

    $("#buscarcliente").on('keyup', function() {
        $.ajax({
            url: 'methods/conexiones.php',
            type: 'POST',
            dataType: 'json',
            data: {
                key: 'Q1',
                cliente: $(this).val()
            }
        }).done(function(d) {

            let padre = $("#buscarcliente").parent().parent().parent();
            padre.find("[name^=tele]").val(d.resultado.telefono);
            padre.find("[name^=direccion]").val(d.resultado.direccion);
            padre.find("[name^=idcliente]").val(d.resultado.id);
            padre.find("[name^=ciudad]").val(d.resultado.ciudad);
            padre.find("[name^=companyName]").val(d.resultado.nombres);
            padre.find("[name^=id_cedula]").val(d.resultado.cedula);
            padre.find("[name^=email]").val(d.resultado.email);
            padre.find("[name^=puntosN]").val(d.resultado.puntos_naturales);
            padre.find("[name^=puntosE]").val(d.resultado.puntos_perfumeria);
            padre.find("[name^=Especificos]").val(d.resultado.venta_condicion);
            padre.find("[name^=descuento_p]").val(d.resultado.descuento);
            if (d.resultado.puntos_naturales >= 1000) {
                padre.find("[name^=Pnaturales]").prop("type", "checkbox");
                padre.find("[name^=Pnaturales]").val(d.resultado.puntos_naturales);
            } else {
                padre.find("[name^=Pnaturales]").prop("type", "hidden");
            }

        }).fail(function(e) {

        });
    })

    $("#buscarclientes").on('change', function() {
        $.ajax({
            url: 'methods/conexiones.php',
            type: 'POST',
            dataType: 'json',
            data: {
                key: 'Q1',
                cliente: $(this).val()
            }
        }).done(function(d) {

            let padre = $("#buscarclientes").parent().parent().parent();
            padre.find("[name^=telefonos]").val(d.resultado.telefono)
            padre.find("[name^=direccions]").val(d.resultado.direccion)
            padre.find("[name^=ciudads]").val(d.resultado.ciudad)
            padre.find("[name^=nombres]").val(d.resultado.nombres)
            padre.find("[name^=ccs]").val(d.resultado.cedula)
            padre.find("[name^=emails]").val(d.resultado.email)
        }).fail(function(e) {

        });
    })

    function run_calcular(e, id) {
        calculateTotal(id);
    }

    $(document).ready(function() {
        $('#buscarclientes').select2();
    });
</script>

<script type="text/javascript">
    function run_calcular(e, id) {
        calculateTotal(id);
    }

    $(document).ready(function() {
        $('#buscarclientes').select2();
    });
</script>

<!-- agregar cliente -->
<script type="text/javascript">
    $(document).ready(function() {
        $('#guardaremos').click(function() {
            var datos = $('#client_information').serialize();
            $.ajax({
                type: "POST",
                url: "send_nuevo_cliente.php",
                data: datos,
                success: function(r) {
                    console.log(r);
                    if (r != 0 && !isNaN(r)) { //SI ES DISTINTO A 0 Y ES UN NUMERO
                        alert("agregado con exito");

                        console.log(datos);
                    } else { //ES 0(NO SE EJECUTO LA CONSULTA) O EXISTE UN ERROR EXPLICATIVO(STRING)
                        alert("no funciona");
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
    function ver_datos(id, e) {
        var dato = document.getElementById('cliente' + id);
        e.preventDefault();
    }


    $("#buscarcomercial").on('change', function() {
        $.ajax({
            url: 'methods/conexiones.php',
            type: 'POST',
            dataType: 'json',
            data: {
                key: 'Q1',
                cliente: $(this).val()
            }
        }).done(function(d) {

            let padre = $("#buscarcomercial").parent().parent().parent();
        }).fail(function(e) {

        });
    })
    $("#buscar_envases").on('change', function() {
        var tabla = $("#tabla").val();
        $.ajax({
            url: 'methods/conexion_.php',
            type: 'POST',
            dataType: 'json',
            data: {
                key: 'Q3',
                cliente: $(this).val(),
                tabla: tabla
            }
        }).done(function(d) {

            let padre = $("#buscar_envases").parent().parent().parent();
        }).fail(function(e) {

        });
    })

    function run_calcular(e, id) {
        calculateTotal(id);
    }

    $(document).ready(function() {
        $('#buscarcomercial').select2();

        $('#ver_stocks').click(function() {
            windowObjectReference = window.open(

                "stocks/index.php",

                "DescriptiveWindowName",

                "resizable,scrollbars,status"

            );
        });

    });
</script>


<script type="text/javascript">
    $("#mibuscadores").on('change', function() {
        $.ajax({
            url: 'methods/conexion.php',
            type: 'POST',
            dataType: 'json',
            data: {
                key: 'Q1',
                producto: $(this).val()
            }
        }).done(function(d) {

            let padre = $("#mibuscadores").parent().parent().parent();
            padre.find("[name^=codigo]").val(d.resultado.id)
            padre.find("[name^=stocks]").val(d.resultado.stock)
        }).fail(function(e) {

        });
    })
</script>


<!--AÑADIENDO LA LIBRERIA SELECT 2 A LOS DIFERENTES SELECTS DEL MODAL -->
<script type="text/javascript">
    $(document).ready(function() {
        $('#mibuscadores').select2();
    });
</script>
</script>

<script type="text/javascript">
    $("[doiclicksito]").click(function(evt) {
        evt.preventDefault();

    });
</script>

<script src="js/perfumeria_prueba.js"></script>

<?php include 'footer.php'; ?>
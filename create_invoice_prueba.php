<?php

if (!isset($_SESSION)) {
    session_start();
}

$user = $_SESSION['userid'];
$user_rol = $_SESSION['id_rol'];
if ($_SESSION['id_rol'] == 3) {
} else if ($_SESSION['id_rol'] == 7) {
} else if ($_SESSION['id_rol'] == 4) {
    header("Location:create_invoice_.php");
} else if ($_SESSION['id_rol'] == 2) {
    header("Location:create_invoice2.php");
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

$mysqli2 = new mysqli('ftp.jjquimienvases.com', 'jjquimienvases_jjadmin', 'LeinerM4ster', 'jjquimienvases_cotizar');

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
<script src="js/invoice_prueba.js"></script>
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
        margin-left: 450px;e

    }
</style>

<?php include 'container.php'; ?>
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
                        <h3>Para,</h3>
                        <div class="form-group">
                            <div class="buscarcliente">
                                <datalist id="buscarclient">
                                    <option value="">Seleccione un cliente</option>
                                    <?php
                                    $query = $mysqli2->query("SELECT * FROM clientes ORDER BY nombres ASC");
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
                            <input value="" type="text-tarea" class="form-control" readonly autocomplete="off" name="puntosN" id="puntosN" placeholder="">
                            <div id="check" class="input-group-text">
                                <input type="hidden" value="" name="Pnaturales" id="Pnaturales" class="bg-primary " aria-label="Checkbox for following text input">
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text bg-success text-white" autocomplete="off" for="inputGroupSelect01">Puntos Especiales</label>
                            </div>
                            <input value="" type="text-tarea" class="form-control" readonly name="puntosE" id="puntosE" placeholder="">
                        </div>
                        <div id="" class="form-group">
                            <select name="especificos" class="form-control">
                                <option value="Naturales">Naturales</option>
                                <option value="Especiales">Especiales</option>
                                <option value="Distribuidores">Distribuidores</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <a class="form-control btn btn-danger" name="btnAddClientes" id="btnAddClientes">Agregar
                                Clientes o Actualizar Clientes</a>
                        </div>
                        <div class="form-group">
                            <div style="text-align: center;">
                                <select id="buscarcomercial" style="width: 100%" name="address">
                                    <option value="0">Busca tu nombre:</option>
                                    <?php
                                    $query = $mysqli2->query("SELECT * FROM factura_usuarios order by first_name");
                                    while ($valores = mysqli_fetch_array($query)) {
                                        echo '<option value="' . $valores['first_name'] . '&nbsp;' . $valores['last_name'] . '">' . $valores['first_name'] . '&nbsp;' . $valores['last_name'] . '</option>';
                                    }

                                    ?>
                                </select>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group">
                            <label> COTIZACION DE IBAGUE </label>
                            <td><input class="itemRows" type="checkbox" id="sede" name="sede"></td>
                        </div>
                        <div class="form-group">
                            <label for=""> Clientes Especiales Perfumeria</label>
                            <td><input class="cEspeciales" type="checkbox" id="cEspeciales" name="cEspeciales"></td>
                        </div>

                        <div class="form-group">
                            <label for=""> PUNTO QUIMICO</label>
                            <td><input class="itemRous" type="checkbox" id="quimico" name="quimico"></td>
                        </div>
                        <div class="form-group">
                            <label for=""> ALGRANEL</label>
                            <td><input class="itemRus" type="checkbox" id="granel" name="granel"></td>
                        </div>

                        <div class="form-group">
                            <label for="">Perfume preparado</label>
                            <td><input class="itempreparado" type="checkbox" id="perfume" name="perfume"></td> ||
                            <label for="">Perfume Lujo</label>
                            <td><input class="itemlujo" type="checkbox" id="envase" name="envase"> </td>
                        </div>
                        <div class="form-group">
                            <label for=""> Distribuidores</label>
                            <td><input class="itemRus" type="checkbox" autocomplete="off" id="distri" name="distri" value=""></td>
                        </div>

                        <hr>
                        <div class="form-group">
                            <p>Elegir un metodo de pago</p>
                            <select name="metodopago" class="pagoselection">
                                <option value="mostradord1" selected>Mostrador D1</option>
                                <option value="davivienda">Davivienda</option>
                                <option value="daviplata">Daviplata</option>
                                <option value="nequi">Nequi</option>
                                <option value="mostrador">Mostrador</option>
                                <option value="contraentrega">contraentrega</option>
                                <option value="facebook">Facebook</option>
                            </select>
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
                                <input value="" type="text-tarea" class="form-control" autocomplete="off" name="subTotal" id="subTotal" placeholder="Subtotal">
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="inputGroupSelect01">Total $</label>
                                </div>
                                <input value="" type="number" class="form-control" name="totalAftertax" autocomplete="off" id="totalAftertax" placeholder="Total">
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="inputGroupSelect01">Porcentaje %</label>
                                </div>
                                <input value="" type="number" class="form-control" value="0" min="0" name="taxRate" autocomplete="off" id="taxRate" placeholder="Porcentaje descuento">
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="inputGroupSelect01">Descuento $</label>
                                </div>
                                <input value="" type="number" class="form-control" autocomplete="off" name="taxAmount" id="taxAmount" placeholder="Monto del descuento">
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="inputGroupSelect01">Cantidad Pagada $</label>
                                </div>
                                <input value="" type="number" class="form-control" autocomplete="off" name="amountPaid" id="amountPaid" placeholder="Cantidad pagada">
                                <div id="check" class="input-group-text">
                                    <input type='checkbox' name='abono' class="bg-primary " aria-label="Checkbox for following text input">
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="inputGroupSelect01">Total a pagar $</label>
                                </div>
                                <input value="" type="number" class="form-control" autocomplete="off" name="amountDue" id="amountDue" placeholder="Cantidad debida">
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
                        <input type="hidden" value="<?php echo $_SESSION['userid']; ?>" class="form-control" name="userId">
                        <input id="guardando" data-loading-text="Guardando factura..." type="submit" name="invoice_btn" value="Guardar Factura" doiclicksito class="btn btn-success submit_btn invoice-save-btm" accesskey="g">
                        <input id="guardando_call" data-loading-text="Guardando factura..." type="submit" name="invoice_btn" value="Guardar call" doiclicksito class="btn btn-success submit_btn invoice-save-btm" accesskey="g">

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
    $(document).ready(function() {
        $('#opcionesPerfumeria').select2();
    });
    $(document).ready(function() {
        $('#splash').select2();
    });
    $(document).ready(function() {
        $('#crema').select2();
    });
    $(document).ready(function() {
        $('#perfume_preparado1').select2();
    });
    $(document).ready(function() {
        $('#opciones_preparado_sencillo').select2();
    });
    $(document).ready(function() {
        $('#opciones_preparado_lujo').select2();
    });
    $(document).ready(function() {
        $('#mibuscadors2').select2();
    });
    $(document).ready(function() {
        $('#mibuscadors3').select2();
    });
    $(document).ready(function() {
        $('#mibuscadors4').select2();
    });
    $(document).ready(function() {
        $('#opciones_preparado_recarga').select2();
    });
    $(document).ready(function() {
        $('#mibuscadorsplash120').select2();
    });
    $(document).ready(function() {
        $('#mibuscadorsplash250').select2();
    });
    $(document).ready(function() {
        $('#mibuscadorcrema30').select2();
    });
    $(document).ready(function() {
        $('#mibuscadorcrema60').select2();
    });
    $(document).ready(function() {
        $('#mibuscadorcrema120').select2();
    });
    $(document).ready(function() {
        $('#mibuscadorcrema250').select2();
    });
    $(document).ready(function() {
        $('#buscarclientes').select2();
    });

    $(document).ready(function() {
        $('#mibuscadorPreparaS100ml').select2();
    });
    $(document).ready(function() {
        $('#mibuscadorPreparaS50ml').select2();
    });
    $(document).ready(function() {
        $('#mibuscadorPreparaS30ml').select2();
    });
    $(document).ready(function() {
        $('#mibuscadorAfterEnvase').select2();
    });
    $(document).ready(function() {
        $('#mibuscadorOnzasps').select2();
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
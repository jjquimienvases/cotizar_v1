<?php include '../conectar.php';
session_start();
$user = $_SESSION["user"];

$usuario = preg_replace('([^A-Za-z0-9 ])', ' ', $user);


?>

<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/blueimp-md5/2.18.0/js/md5.js" integrity="sha512-NpfrQEgzOExS1Ax8fjITKrgBFK87lZbBmvWdZk4suiCC4tsHPrTCsulgIA7Z/+CeWhDpEP/f36mNWgZXDKtTAA==" crossorigin="anonymous"></script> -->
<script src="../jquery-3.5.1.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
<title>Registrar Proveedores</title>
<link rel="stylesheet" href="css/estilos.css">
<!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script> -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>





<div class="contenedors">

    <div class="form-group">
        <div class="text-center mt-4">
            <h4 class="btn btn-danger">BIENVENIDO <?= ($user) ?> EN ESTE APARTADO PUEDES REGISTRAR UN NUEVO PROVEEDOR</h4>
        </div>
        <hr>
        <div class="container">
            <div class="row">
                <button class="btn btn-warning" id="btn"><a href="../asistente.php">Regresar al panel asistente</a></button>
                <button class="btn btn-info" id="btn"><a href="asignar.php">Asignar Productos</a></button>
                <button class="btn btn-success" id="btn"><a href="index.php">Lista De Proveedores</a></button>

            </div>

            <form method="post" id="formulario_1" class="needs-validation">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="empresa">Empresa</label>
                        <input type="text" class="form-control" name="empresa" id="empresa" placeholder="Compañia" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="nit">NIT</label>
                        <input type="number" class="form-control" id="nit" name="nit" placeholder="NIT" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="telefono">Telefono</label>
                        <input type="number" class="form-control" name="telefono" id="telefono" placeholder="Telefono Compañia" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="direccion">Direccion</label>
                        <input type="text" class="form-control" id="direccion" name="direccion" placeholder="Direccion Compañia" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="asesor">Asesor</label>
                        <input type="text" class="form-control" name="asesor" id="asesor" placeholder="Nombre Asesor" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="tel_asesor">Telefono/Asesor</label>
                        <input type="number" class="form-control" id="tel_asesor" name="tel_asesor" placeholder="Telefono Asesor" required>
                    </div>
                </div>

                <button class="btn btn-primary" id="finalizar" type="button">Registrar Nuevo Proveedor</button>
            </form>
        </div>


    </div>

    <script>
        $(document).ready(function() {
            $('#finalizar').on("click", function(e) {

                // console.log("hola");
                e.preventDefault();
                var datos = $('#formulario_1').serialize();
                $.ajax({
                    type: "POST",
                    url: "ajax/ajax_proveedor.php",
                    data: datos,
                    success: function(r) {
                        Swal.fire({
                            icon: "success",
                            title: "Perfecto!!",
                            text: "¿Deseas agregar otro proveedor?",
                            confirmButtonText: "Si quiero",
                            showCancelButton: true,
                            cancelButtonText: "No, No quiero",
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                let padre = $("#formulario_1").parent().parent().parent();
                                padre.find("[name^=empresa]").val("");
                                padre.find("[name^=nit]").val("");
                                padre.find("[name^=telefono]").val("");
                                padre.find("[name^=asesor]").val("");
                                padre.find("[name^=tel_asesor]").val("");
                                padre.find("[name^=direccion]").val("");
                            } else {

                                window.location = "index.php";
                            }

                        });
                    }
                });
                /*  return false; */
            });
        });
    </script>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
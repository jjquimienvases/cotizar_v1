<!-- CSS -->

<title>Asignar Producto</title>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
<!-- jQuery and JS bundle w/ Popper.js -->

<!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script> -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
<link rel="stylesheet" href="css/estilos.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/blueimp-md5/2.18.0/js/md5.js" integrity="sha512-NpfrQEgzOExS1Ax8fjITKrgBFK87lZbBmvWdZk4suiCC4tsHPrTCsulgIA7Z/+CeWhDpEP/f36mNWgZXDKtTAA==" crossorigin="anonymous"></script>
<script src="../jquery-3.1.1.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<?php

$conexion = mysqli_connect('173.230.154.140', 'cotizar', 'LeinerM4ster', 'cotizar');

?>






<div class="container">
    <center>
        <h3>Asignar Producto -> Proveedor</h3>
    </center>

    <hr>

    <div class="row">
        <button class="btn btn-warning" id="btn"><a href="../asistente.php">Regresar al panel asistente</a></button>
        <button class="btn btn-info" id="btn"><a href="anadir.php" target="_blank">Crear Nuevo Proveedor</a></button>
        <button class="btn btn-success" id="btn"><a href="index.php">Lista De Proveedores</a></button>
    </div>
    <div class="container-form">

        <form class="" action="" method="post" id="formulario">

            <label for="">Proveedor:</label>

            <div class="form-group">

                <div style="text-align: center;">

                    <select id="buscarproveedor" style="width: 100%" name="proveedor">

                        <option value="0">Buscar Proveedor:</option>

                        <?php

                        $query = $conexion->query("SELECT * FROM proveedor");

                        while ($valores = mysqli_fetch_array($query)) {

                            echo '<option value="' . $valores["codigo"] . '">' . $valores["empresa"] . ',' . $valores["asesor"] . '</option>';
                        }



                        ?>

                    </select>

                </div>

            </div>

            <label for="">Producto:</label>

            <div class="form-group">

                <div style="text-align: center;">

                    <select id="buscarproducto" style="width: 100%" name="producto">

                        <option value="0">Buscar Producto:</option>

                        <?php

                        $query = $conexion->query("SELECT * FROM producto");

                        while ($valores = mysqli_fetch_array($query)) {

                            echo '<option value="' . $valores["id"] . '">' . $valores["id"] . ',' . $valores["contratipo"] . '</option>';
                        }



                        ?>

                    </select>

                </div>

            </div>

            <label for="precio">Precio:</label>

            <input type="text" id="precio" name="precio" value="" class="form-control">

            <br><br>

            <button type="button" name="button" id="try" class="btn btn-danger">Asignar Producto</button>

        </form>

    </div>

</div>



<!-- send informacion de asignacion -->

<script type="text/javascript">
    $(document).ready(function() {
        $('#try').click(function() {
            var datos = $('#formulario').serialize();
            $.ajax({
                type: "POST",
                url: "ajax/ajax_productos.php",
                data: datos,
                success: function(r) {
                    console.log(r);
                    if (r != 0 && !isNaN(r)) {

                        //SI ES DISTINTO A 0 Y ES UN NUMERO


                        Swal.fire({
                            icon: "success",
                            title: "Perfecto!!",
                            text: "¿Deseas Asignar otro producto?",
                            confirmButtonText: "Si quiero",
                            showCancelButton: true,
                            cancelButtonText: "No, No quiero",
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                // window.location = "asignar.php";
                            } else {

                                window.location = "index.php";
                            }

                        });


                    } else { //ES 0(NO SE EJECUTO LA CONSULTA) O EXISTE UN ERROR EXPLICATIVO(STRING)

                        alert("no funciona");

                    }

                }

            });

            return false;

        });

    });


    $('#buscarproducto').select2();
    $('#buscarproveedor').select2();
</script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
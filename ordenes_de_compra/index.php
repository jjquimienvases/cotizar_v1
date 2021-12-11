<!-- -->

<?php
include 'conexion.php';

session_start();

$id_usuario = $_SESSION['userid'];
$user_name = $_SESSION['user'];
$user_rol = $_SESSION['id_rol'];


 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <script src="../jquery-3.1.1.min.js"></script>
    <script src="js/funciones.js"></script>
    <script src="../js/select2.js"></script>
    <link rel="stylesheet" type="text/css" href="../css/select2.css">

    <link href="//cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
    <link href="//cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
    <title>Solicitar mercancia</title>
</head>

<body>
    <div class='container'>
        <?php 
        $boton_back = "";
          if($user_rol == 6){
              $boton_back = "<button class='btn btn-warning><a href='../panel_bodega.php'>Volver a mi panel</a> </button>";
              echo $boton_back;
          }else if($user_rol == 5){
              $boton_back = "<button class='btn btn-success><a href='../asistente.php'>Volver a mi panel</a> </button>";
              echo $boton_back;
          }
        ?>
        
        <div class="row">
            <div class="col-5 col-md-5 col-lg-5">
                <div id="info_traslado">
                    <form action="" method="post" id="formulario" name="formulario">
                        <!--Tarjeta #1 este es el formulario de solicitude de mercancia -->
                        <div class="">
                            <div class="card-section card-section-third border rounded">
                                <div class="card-header card-header-third rounded">
                                    <center><span style="color:green;">Busca el producto que necesitas.</span></center>
                                    <br>
                                    <div style="text-aling: center;">
                                        <select id="mibuscador" style="width:100%" class="custom-select">
                                            <option value="">Buscar un producto</option>
                                            <?php
                    $consulta_producto = $conexion ->query("SELECT * FROM producto_av ORDER BY id ASC");
                     while($valores = mysqli_fetch_array($consulta_producto)){
                     echo '<option value="'.$valores["id"].'">'.$valores["id"].','.$valores["contratipo"].'</option>';
                     }
                   ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="card-body text-center mb-2">
                                    <hr>
                                    <div class="form-group">
                                        <label for="codigo">Codigo:</label>
                                        <input type="number" class="form-control" name="codigo" id="codigo"
                                            placeholder="Codigo del producto" readonly>
                                        <label for="producto">Producto:</label>
                                        <input type="text" class="form-control" name="producto" id="producto"
                                            placeholder="Nombre del producto">
                                        <label for="cantidad">Cantidad:</label>
                                        <input type="number" class="form-control" name="cantidad" id="cantidad"
                                            placeholder="Cantidad a solicitar">
                                    </div>

                                    <hr>
                                    <div class="btn__form">
                                        <input class="btn btn-success" type="submit" id="guardando"
                                            value="Solicitar Producto">
                                        <input class="btn btn-danger" type="reset" value="Vaciar">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" class="input" value="<?php echo $user_rol; ?>" name="rol">
                        <!-- dependiendo el rol del usuario vamos a determinar la bodega destino-->
                        <input type="hidden" class="input" value="<?php echo $user_name; ?>" name="nombre_solicitante">
                        <!-- dependiendo el rol del usuario vamos a determinar la bodega destino-->
                    </form>
                </div>
            </div>
            <div class="col-6 col-md-6 col-lg-6">
                    <div class="">
                        <div class="">
                            <center>
                                <h2> Mercancia Solicitada </h2>
                            </center>
                        </div>
                        <div class="card-body text-center mb-2 ">
                            <hr>
                            <form class="" id="fmActualizar" action="index.html" method="post">
                                <input type="hidden" name="metodo" value="UpdateOrdenes">
                                <div class="" id="responses"></div>
                                <button type="button" class="btn btn-outline-secondary" 
                                    id="finalizar_solicitudes">Finalizar Solicitud</button>
                            </form>

                        </div>
                    </div>
                
            </div>
        </div>
    </div>
</body>
<script>
$("#mibuscador").on('change', function() {
    $.ajax({
        url: 'conexion.php',
        type: 'POST',
        dataType: 'json',
        data: {
            key: 'Q1',
            producto: $(this).val()
        }
    }).done(function(d) {
        let padre = $("#mibuscador").parent().parent().parent();
        padre.find("[name^=codigo	]").val(d.resultado.id)
        padre.find("[name^=producto	]").val(d.resultado.contratipo)
    }).fail(function(e) {
        console.log("ERROR:", e);
    });
})


$("#finalizar_solicitudes").on('click', function() {
    $.ajax({
        url: 'ajax_create_solicitud.php',
        type: 'POST',
        dataType: 'json',
        data: {
            key: 'Q1',
           
        }
    }).done(function(d) {
      Swal.fire({
  icon: 'success',
  title: 'Cargado con exito...',
  text: 'Excelente'

})
    }).fail(function(e) {
        console.log("ERROR:", e);
    });
})



$(document).ready(function() {
    $('#mibuscador').select2();
});
</script>

</html>
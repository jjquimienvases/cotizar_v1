<?php 
include 'conexion.php';

session_start();
$user_rol = $_SESSION['id_rol'];

?>

<!DOCTYPE html>
<html lang="en">
    

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
    <script src="js/alertas.js">
    </script>
    <link href="//cdn.jsdelivr.net/npm/@sweetalert2/theme-minimal@4/minimal.css" rel="stylesheet">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
</head>

<body>
    <div class="container">
        <?php 
        $boton_back = "";
          if($user_rol == 6){
              $boton_back = "<button class='btn btn-warning'><a href='../panel_bodega.php'>Volver a mi panel</a> </button>";
              echo $boton_back;
          }else{
              $boton_back = "<button class='btn btn-warning'><a href='../asistente.php'>Volver a mi panel</a> </button>";
              echo $boton_back;
          }
        ?>
        <form action="" method="POST" id="consultar_ordenes">
            <input type="hidden" name="metodo" value="consultar">
            <div class="row">
                <div class="col-md-5">
                <span>De</span>
                    <div class="form-group">
                        <input class="form-control" autocomplete="off" type="date" name="fechaI">
                    </div>
                </div>
                <div class="col-md-5">
                <span>Hasta</span>
                    <div class="form-group">
                        <input class="form-control" type="date" autocomplete="off" name="fechaF">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class='col-md-4'>
                    <select name="estado" class='form-control ' id="estado" autocomplete="off">
                        <option value="">Todas</option>
                        <option value="Solicitud">Solictud</option>
                        <option value="Pendiente">Pendiente</option>
                        <option value="Solicitud Finalizada">Solicitud Finalizada</option>
                        <option value="Finalizado">Finalizado</option>
                    </select>
                </div>

            </div>

        </form>
        <br>
        <input type="submit" class='btn btn-success' id="btnConsultar">


        <div id="tabla">

        </div>

    </div>

</body>

</html>
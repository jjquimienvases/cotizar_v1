<?php
include 'conexion.php';
session_start();
$user_rol = $_SESSION['id_rol'];
$user_id = $_SESSION['userid'];
$user_name = $_SESSION['user'];
$date = DATE('Y-m-d H:i:s');

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="../jquery-3.1.1.min.js"></script>
    <script src="../Lib/sweetalert2/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="css/style.scss">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="../Lib/sweetalert2/sweetalert2.min.js"></script>
    <script src="../Lib/fontawesome/svg-with-js/js/fontawesome-all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.5.2/bootbox.min.js"></script>
    <!-- <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script> -->
    <title>Cierre De Caja</title>
</head>

<body>
    <div class="container">
        <div class="text-center mt-3">
            <img src="../logo.png" alt="logo" width="250" height="210">
        </div>
        <div class="card mt-3">

            <div class="text-center text-danger mt-3">
                <b>
                    <h3>Cierre De Caja</h3>
                </b>
            </div>
            <div class="container mt-2 mb-2">
                <form method="post" id="form_1">
                    <div class="form-row ">
                        <div class="form-group col-md-6 ">
                            <label for="inputAddress2">Efectivo</label>
                            <input type="number" class="form-control" name="efectivo" id="inputAddress2" placeholder="Escribe la cantidad de dinero recibida en efectivo">
                        </div>
                        <div class="container form-group col-md-6">
                            <label for="inputAddress">Datafono</label>
                            <input type="number" class="form-control" name="datafono" id="inputAddress" placeholder="Escribe la cantidad de dinero recibida en datafono">
                        </div>
                    </div>


                    <div class="form-row mt-2">
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Bancolombia/Nequi</label>
                            <input type="number" class="form-control" id="inputEmail4" name="bancolombia" placeholder="Escribe la cantidad de dinero recibida en Bancolombia o Nequi">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputPassword4">Davivienda/Daviplata</label>
                            <input type="number" class="form-control" id="inputPassword4" name="davivienda" placeholder="Escribe la cantidad de dinero recibida en Davivienda o Davivienda">
                        </div>

                    </div>
                    <button type="button" class="btn btn-primary" id="close">Cerrar Caja</button>
                    
                      <button type="button" class="btn btn-danger" id="open_cuadre">Cuadre Caja | SOLO IBAGUE SEDE PRINCIPAL</button>
                </form>
            </div>

        </div>
        <div class="card mt-3">
            <div class="text-center text-danger mt-3">
                <b>
                    <h3>Gastos Y Novedades</h3>
                </b>
            </div>
            <div class="container mt-2 mb-2">
                <form method="post" id="form_2">
                    <div>
                        <label for="">Escribe aqui la novedad.</label>
                        <input type="text" class="form-control" name="novedad" placeholder="Escribe aqui la razon de la novedad">
                        <hr>
                        <label>Escribe aqui el total sin puntos.</label>
                        <input type="number" class="form-control" name="monto" placeholder="Escribe el total en efectivo sin puntos">
                    </div>
                    <br>
                    <button type="button" class="btn btn-warning" id="send_novedad">Subir Novedad</button>
                </form>
            </div>

        </div>



    </div>
    <script src="js/funciones.js"></script>
</body>

</html>
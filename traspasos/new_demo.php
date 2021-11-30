<?php

include 'conexion.php';

session_start();

$usuario_id = $_SESSION['userid'];

$user_rol = $_SESSION['id_rol'];

$user_name = $_SESSION['user'];

?>
<html>
<head>
    <meta charset="utf-8">
    <script src="jquery-3.1.1.min.js"></script>
    <!--Jquery -->
    <script src="../js/select2.js"></script> <!-- libreria de select 2-->
    <link rel="stylesheet" type="text/css" href="../css/select2.css">
    <link rel="stylesheet" type="text/css" href="./css/estilos.css">
    <link href="//cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.js"></script>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">

    </script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">

    </script>

    <script src="js/funciones.js"></script>

    <script src="js/alertas.js"></script>

    <title>Solicitar Traspaso</title>
</head>
<body>
    <div id="contenedor_principal">

        <?php

        $link_call = "<button class='btn btn-success' id='boton_panel'><a href='../Panel_Comerciales.php'> Regregar a tu panel principal </a> </button>";

        $link_bodega = "<button class='btn btn-success' id='boton_panel'><a href='../panel_bodega.php'> Regregar a tu panel principal </a> </button>";

        $link_ibague = "<button class='btn btn-success' id='boton_panel'><a href='../panel_ibague.php'> Regregar a tu panel principal </a> </button>";

        $link_d1 = "<button class='btn btn-success' id='boton_panel'><a href='../panel_d1.php'> Regregar a tu panel principal </a> </button>";

        $link_mostrador = "<button class='btn btn-success' id='boton_panel'><a href='../panel_mostrador.php'> Regregar a tu panel principal </a> </button>";
        $link_bodega_p = "<button class='btn btn-success' id='boton_panel'><a href='../panel_bodega_perfumeria.php'> Regregar a tu panel principal </a> </button>";

        if ($user_rol == 4) {

            echo $link_call;
        } else if ($user_rol == 7) {

            echo $link_ibague;
        } else if ($user_rol == 2) {

            echo $link_mostrador;
        } else if ($user_rol == 6) {

            echo $link_bodega;
        } else if ($user_rol == 3) {

            echo $link_d1;
        } else if ($user_rol == 1) {

            echo $link_call;
        }
         else if ($user_rol == 9) {

            echo $link_bodega_p;
        }
        ?>
        <?php
        if ($user_rol == 9) {
            include "./idrol=9.php";
        } else {
            include "./traspasos_inicio.php";
        }
        ?>

    

</body>



</html>



<script type="text/javascript">
    //Script para determinar e imprimir la informacion del producto seleccionado

    function ver_datos(id, e) {

        var dato = document.getElementById('cliente' + id);

        e.preventDefault();

    }



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

            padre.find("[name^=codigo]").val(d.resultado.id)

            padre.find("[name^=producto]").val(d.resultado.contratipo)
            padre.find("[name^=categoria]").val(d.resultado.id_categoria)

        }).fail(function(e) {

            console.log("ERROR:", e);

        });

    })



    $(document).ready(function() {

        $('#mibuscador').select2();

    });
</script>
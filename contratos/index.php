<?php
include 'conexion.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contratos JJ QUIMIENVASES SAS</title>

    <?php include 'includes/head.php' ?>

</head>

<body>
    <div class="text-center mt-2">
        <h3 class="text-danger">Completar los datos y generar documentos</h3>
     <button class="btn btn-primary"><a>Regresar al panel</a></button>    
    </div>
    <div class="mt-2" id="info_data">
        <div id="izquierda">
            <?php include 'includes/form.php' ?>
        </div>
        <div id="derecha">
            <?php include 'includes/table_info.php' ?>

        </div>
    </div>
</body>
<?php include 'includes/foot.php' ?>

</html>
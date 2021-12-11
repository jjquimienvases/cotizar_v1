<?php
$con = new mysqli('ftp.jjquimienvases.com', 'jjquimienvases_jjadmin', 'LeinerM4ster', 'jjquimienvases_cotizar');

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/estilos_targetas.css">
    <script src="catalogo_e/fontawesome/svg-with-js/js/fontawesome-all.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Generar Reporte</title>
</head>

<body>
    <div class="container">
        <div class="mt-4">
            <h5 class="text-right text-danger">Buscar y seleccionar el cliente que deseas generar el reporte de ventas</h5>
            <form method="post" action="print_reporte.php">
                <div class="form-group">
                    <div class="buscarcliente">
                        <datalist id="buscarclient">
                            <option value="">Seleccione un cliente</option>
                            <?php
                            $query = $con->query("SELECT * FROM clientes ORDER BY nombres ASC");
                            while ($valores = mysqli_fetch_array($query)) {
                                echo '<option value="' . $valores["cedula"] . '">' . $valores["cedula"] . ',' . $valores["nombres"] . '</option>';
                            }
                            ?>
                        </datalist>
                        <input class="form-control" list="buscarclient" name="cedulasres" id="buscarcliente" type="text" placeholder="Buscar Cliente">
                    </div>
                </div>
                <hr>
                <h3 class="text-right text-danger">Seleccionar la fecha que deseas filtrar</h3>
                <label for="inicial">Fecha Inicial</label>
                <input type="date" id="inicial" name="inicial" class="form-control">
                <label for="final">Fecha Final</label>
                <input type="date" id="final" name="final" class="form-control">
        </div>
        <br>
        <div>
            <button type="submit" name="submit" class="btn btn-success text-right">Generar Reporte</button>
        </div>

        </form>


    </div>
</body>

</html>
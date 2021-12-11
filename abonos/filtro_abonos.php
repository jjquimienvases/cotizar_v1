<?php
include 'conexion.php';
$inicio = $_POST["inicio"];
$fin = $_POST["final"];

$sql = $con->query("SELECT * FROM order_abono oa INNER JOIN file_abono fa ON oa.order_id = fa.order_id WHERE DATE(fa.order_date) BETWEEN '$inicio' AND '$fin'");

$total = 0;

function formatear($num)
{
    setlocale(LC_MONETARY, 'en_US');
    return "$" . number_format($num, 2);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">

    <title>Filtrar abonos</title>
</head>

<body>
    <div class="container">
        <form action="" method="post">
            <div class="row">
                <label for="inicial" class="text-success">Fecha Inicial:</label>
                <input type="date" id="inicial" name="inicio" class="form-control col">
                <br>
                <label for="final" class="text-success">Fecha Final:</label>
                <input type="date" name="final" id="final" class="form-control col">
            </div>

            <button type="submit" class="btn btn-success">Consultar</button>
        </form>

        <table class="table table-bordered table">
            <thead>
                <tr>
                    <th>FECHA</th>
                    <th>COTIZACION</th>
                    <th>CLIENTE</th>
                    <th>ABONO</th>
                </tr>
            </thead>
            <tbody>

                <?php foreach ($sql as $fila) : ?>
                    <tr>
                        <td> <?= $fila['order_date'] ?> </td>
                        <td> <?= $fila['order_id'] ?> </td>
                        <td> <?= $fila['order_receiver_name'] ?> </td>
                        <td> <?= formatear($fila['nuevo_abono']) ?> </td>
                    </tr>
                    <?php $total += $fila['nuevo_abono'];  ?>
                <?php endforeach; ?>

            </tbody>
            <tfoot>
                <tr>
                    <td colspan="2">TOTAL:</td>
                    <td colspan="2" class="text-right"> <?php echo formatear($total); ?> </td>
                </tr>
            </tfoot>
        </table>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>
</body>

</html>
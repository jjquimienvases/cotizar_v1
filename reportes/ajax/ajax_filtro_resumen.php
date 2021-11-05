<?php
include '../conexion.php';
$con = conectar();
$fecha_inicio = $_GET['fecha_inicio'];
$fecha_final = $_GET['fecha_final'];
include 'ajax_consulta_mostrador.php';
include 'ajax_consulta_d1.php';
include 'ajax_consulta_ibague1.php';
include 'ajax_consulta_ibague2.php';
include 'ajax_consulta_call_c.php';

function formatear($num){
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

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- CSS only -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.24/datatables.min.css" />
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.24/datatables.min.js"></script>
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
    <title> Resumen JJ <?= $date ?></title>
    <style>
     li{
 list-style: none;
     }
    </style>
</head>

<body>
 
    <div class="container">
        <form action="" method="GET">
            <input type="date" name="fecha_inicio" class="form-control">
            <input type="date" name="fecha_final" class="form-control">
            
            <button type="submit" class="btn btn-success">SEND</button>
        </form>
        <table class="table">
            <thead>
                <tr>
                    <th>Punto Venta</th>
                    <th>Metodos de pago</th>
                    <th>Caja</th>
                    <th>Diferencia</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Motrador Principal</td>
                    <td>
                        <ul>
                            <li>Efectivo: <?= formatear($total_efectivo) ?></li>
                            <li>Datafono: <?= formatear( $total_datafono) ?></li>
                            <li>Bancolombia: <?= formatear($total_bancolombia) ?></li>
                            <li>Davivienda: <?= formatear($total_davivienda) ?></li>
                        </ul>
                    </td>

                    <td>
                        <ul>
                            <li>Efectivo: <?= formatear($efectivo) ?></li>
                            <li>Datafono: <?= formatear($datafono) ?></li>
                            <li>Bancolombia: <?= formatear($bancolombia) ?></li>
                            <li>Davivienda: <?= formatear($davivienda) ?></li>
                        </ul>
                    </td>
                    <td>
                        <ul>
                            <li>Efectivo: <?= formatear($efectivo - $total_efectivo)  ?></li>
                            <li>Datafono: <?= formatear($datafono - $total_datafono)  ?></li>
                            <li>Bancolombia: <?= formatear($bancolombia - $total_bancolombia)  ?></li>
                            <li>Davivienda: <?= formatear($davivienda - $total_davivienda) ?></li>
                        </ul>
                    </td>
                    <td>
                        <ul>
                            <li>Suma Cotizar: <?= formatear($suma); ?> </li>
                            <li>Suma Caja: <?= formatear($suma_caja); ?> </li>
                            <li>Diferencia: <?= formatear($suma_caja - $suma); ?> </li>
                        </ul>
                    </td>
                </tr>
                <tr>
                    <td>Motrador D1</td>
                    <td>
                        <ul>
                            <li>Efectivo: <?= formatear($total_efectivo_d1) ?></li>
                            <li>Datafono: <?= formatear($total_datafono_d1) ?></li>
                            <li>Bancolombia: <?= formatear($total_bancolombia_d1) ?></li>
                            <li>Davivienda: <?= formatear($total_davivienda_d1) ?></li>
                        </ul>
                    </td>
                    <td>
                        <ul>
                            <li>Efectivo: <?= formatear($efectivo_d1) ?></li>
                            <li>Datafono: <?= formatear($datafono_d1) ?></li>
                            <li>Bancolombia: <?= formatear($bancolombia_d1) ?></li>
                            <li>Davivienda: <?= formatear($davivienda_d1) ?></li>
                        </ul>
                    </td>
                    <td>
                        <ul>
                            <li>Efectivo: <?= formatear($efectivo_d1 - $total_efectivo_d1)  ?></li>
                            <li>Datafono: <?= formatear($datafono_d1 - $total_datafono_d1)  ?></li>
                            <li>Bancolombia: <?= formatear($bancolombia_d1 - $total_bancolombia_d1)  ?></li>
                            <li>Davivienda: <?= formatear($davivienda_d1 - $total_davivienda_d1) ?></li>
                        </ul>
                    </td>
                    <td>
                        <ul>
                            <li>Suma Cotizar: <?= formatear($suma_d1); ?> </li>
                            <li>Suma Caja: <?= formatear($suma_caja_d1); ?> </li>
                            <li>Diferencia: <?= formatear($suma_caja_d1 - $suma_d1) ?> </li>
                        </ul>
                    </td>

                </tr>
                <tr>
                    <td>Motrador Ibague 1</td>
                    <td>
                        <ul>
                            <li>Efectivo: <?= formatear($total_efectivo_ib1) ?></li>
                            <li>Datafono: <?= formatear($total_datafono_ib1) ?></li>
                            <li>Bancolombia: <?= formatear($total_bancolombia_ib1) ?></li>
                            <li>Davivienda: <?= formatear($total_davivienda_ib1) ?></li>
                        </ul>
                    </td>
                    <td>
                        <ul>
                            <li>Efectivo: <?= formatear($efectivo_ib1) ?></li>
                            <li>Datafono: <?= formatear($datafono_ib1) ?></li>
                            <li>Bancolombia: <?= formatear($bancolombia_ib1) ?></li>
                            <li>Davivienda: <?= formatear($davivienda_ib1) ?></li>
                        </ul>
                    </td>
                    <td>
                        <ul>
                            <li>Efectivo: <?= formatear($efectivo_ib1 - $total_efectivo_ib1)  ?></li>
                            <li>Datafono: <?= formatear($datafono_ib1 - $total_datafono_ib1)  ?></li>
                            <li>Bancolombia: <?= formatear($bancolombia_ib1 - $total_bancolombia_ib1)  ?></li>
                            <li>Davivienda: <?= formatear($davivienda_ib1 - $total_davivienda_ib1) ?></li>
                        </ul>
                    </td>
                    <td>
                        <ul>
                            <li>Suma Cotizar: <?= formatear($suma_ib1); ?> </li>
                            <li>Suma Caja: <?= formatear($suma_caja_ib1); ?> </li>
                            <li>Diferencia: <?= formatear($suma_caja_ib1 - $suma_ib1) ?> </li>
                        </ul>
                    </td>

                </tr>
                <tr>
                    <td>Motrador Ibague 2</td>
                    <td>
                        <ul>
                            <li>Efectivo: <?= formatear($total_efectivo_ib2) ?></li>
                            <li>Datafono: <?= formatear($total_datafono_ib2) ?></li>
                            <li>Bancolombia: <?= formatear($total_bancolombia_ib2) ?></li>
                            <li>Davivienda: <?= formatear($total_davivienda_ib2) ?></li>
                        </ul>
                    </td>
                    <td>
                        <ul>
                            <li>Efectivo: <?= formatear($efectivo_ib2) ?></li>
                            <li>Datafono: <?= formatear($datafono_ib2) ?></li>
                            <li>Bancolombia: <?= formatear($bancolombia_ib2) ?></li>
                            <li>Davivienda: <?= formatear($davivienda_ib2) ?></li>
                        </ul>
                    </td>
                    <td>
                        <ul>
                            <li>Efectivo: <?= formatear($efectivo_ib2 - $total_efectivo_ib2)  ?></li>
                            <li>Datafono: <?= formatear($datafono_ib2 - $total_datafono_ib2)  ?></li>
                            <li>Bancolombia: <?= formatear($bancolombia_ib2 - $total_bancolombia_ib2)  ?></li>
                            <li>Davivienda: <?= formatear($davivienda_ib2 - $total_davivienda_ib2) ?></li>
                        </ul>
                    </td>
                    <td>
                        <ul>
                            <li>Suma Cotizar: <?= formatear($suma_ib2); ?> </li>
                            <li>Suma Caja: <?= formatear($suma_caja_ib2); ?> </li>
                            <li>Diferencia: <?= formatear($suma_caja_ib2 - $suma_ib2) ?> </li>
                        </ul>
                    </td>

                </tr>
               <tr>
<td>Ventas Call Center</td>
<td> <?=  formatear($total_call); ?> </td>
               </tr>
            </tbody>
        </table>
    </div>
</body>

</html>
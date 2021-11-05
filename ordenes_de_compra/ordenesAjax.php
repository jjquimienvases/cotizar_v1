<?php
require_once "../Model/main.php";

require_once "../Controller/ordenesControlador.php";
$ordenes = new ordenesControlador();

if (isset($_POST['metodo'])) {
    switch ($_POST['metodo']) {
        case "UpdateOrdenes":
            echo $ordenes->actualizar_estado_finalizado();
            break;
        case "consultar":
           
           echo $ordenes->consultar_ordenes_de_compra();
            break;
        case "update_pendiente":
           
           echo $ordenes->actualizar_estado_pendiente();
            break;
    }
}

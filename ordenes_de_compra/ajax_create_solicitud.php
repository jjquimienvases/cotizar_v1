<?php

$con = new mysqli('173.230.154.140', 'cotizar', 'LeinerM4ster', 'cotizar');

$estado = "Solicitud Finalizada";

$sql_update = $con->query("UPDATE solicitud_productos SET estado = '$estado' WHERE estado = 'solicitud'");

if ($sql_update) {
    echo 1;
} else {
    echo 0;
}

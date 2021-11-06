<?php

include "../globals.php";

$estado = "Solicitud Finalizada";

$sql_update = $cnx->query("UPDATE solicitud_productos SET estado = '$estado' WHERE estado = 'solicitud'");

if($sql_update){
    echo 1;
}else{
    echo 0;
}




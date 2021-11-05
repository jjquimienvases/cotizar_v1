<?php

$con = new mysqli('ftp.jjquimienvases.com', 'jjquimienvases_jjadmin', 'LeinerM4ster', 'jjquimienvases_cotizar');

$estado = "Solicitud Finalizada";

$sql_update = $con->query("UPDATE solicitud_productos SET estado = '$estado' WHERE estado = 'solicitud'");

if($sql_update){
    echo 1;
}else{
    echo 0;
}




<?php

include_once '../../clases/Consulta.php';
$c = new Consulta();

function getConsultaInventarios($punto){
global  $c;
$sql = "SELECT * FROM $punto";
$result = $c->find($sql);
return $result;
}
function getConsultaPositivos($punto){
global  $c;
$sql = "SELECT * FROM $punto WHERE stock > 0";
$result = $c->find($sql);
return $result;
}
function getConsultaNegativos($punto){
global  $c;
$sql = "SELECT * FROM $punto WHERE stock < 0";
$result = $c->find($sql);
return $result;
}
function getConsultaPerfumeria($punto){
global  $c;
$sql = "SELECT * FROM $punto WHERE id_categoria = 4";
$result = $c->find($sql);
return $result;
}
function getConsultaPerfumeria_Ambiental($punto){
global  $c;
$sql = "SELECT * FROM $punto WHERE id_categoria = 21 OR id_categoria = 13";
$result = $c->find($sql);
return $result;
}
function getConsultaOtrosItems($punto){
global  $c;
$sql = "SELECT * FROM $punto WHERE id_categoria != 4";
$result = $c->find($sql);
return $result;
}

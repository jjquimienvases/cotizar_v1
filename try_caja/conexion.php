<?php
function conectar()
{
    $servidor = "173.230.154.140";
    $nombreBd = "cotizar";
    $usuario = "cotizar";
    $pass = "LeinerM4ster";
    $conexion = new mysqli($servidor, $usuario, $pass, $nombreBd);
    if ($conexion->connect_error) {
        die("Connection failed: " . $conexion->connect_error);
    }
    return $conexion;
}
$con = conectar();
if ($con->connect_errno) {
    die('fail');
}

function file_name($string)
{

    // Tranformamos todo a minusculas

    $string = strtolower($string);

    //Rememplazamos caracteres especiales latinos

    $find = array('á', 'é', 'í', 'ó', 'ú', 'ñ');

    $repl = array('a', 'e', 'i', 'o', 'u', 'n');

    $string = str_replace($find, $repl, $string);

    // Añadimos los guiones

    $find = array(' ', '&', '\r\n', '\n', '+');
    $string = str_replace($find, '-', $string);

    // Eliminamos y Reemplazamos otros carácteres especiales

    $find = array('/[^a-z0-9\-<>]/', '/[\-]+/', '/<[^>]*>/');

    $repl = array('', '-', '');

    $string = preg_replace($find, $repl, $string);

    return $string;
}

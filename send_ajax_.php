<?php

$metodo = $_POST['metodo'];
require_once "./Model/main.php";
require_once "./Model/cotizacionModelo.php";
require_once "./Model/clienteModelo_prueba.php";
require_once "./Model/order_abonoModelo.php";
require_once "./Controller/cotizacionControlador_prueba.php";
require_once "./Controller/cotizacionControlador_call.php";
require_once "./puntos_perfumeria/funciones.php";
$cotizacionCotroller = new cotizacionControlador_prueba();
$callCotizacion = new cotizacion_controlador_call();
session_start();
switch ($metodo) {
    case "agregarCotizacion":
        echo $cotizacionCotroller->agregar_Cotizacion_controlador();
        break;
    
     case "callCotizacion":
        echo $callCotizacion->agregar_Cotizacion_controlador_call();
        break;
}
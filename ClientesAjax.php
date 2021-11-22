<?php
$metodo = $_POST['clientes'];
require_once "./Model/main.php";
require_once "./Model/cotizacionModelo.php";
require_once "./Model/clienteModelo.php";
require_once "./Controller/clientesControlador.php";
require_once "./puntos_perfumeria/funciones.php";

$clientes=new clientesControlador();
session_start();
switch ($metodo) {
    case "agregarClientes":
        echo $clientes->crear_clientes_controlador();
        break;
}
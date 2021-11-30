<?php
include '../conexion.php';
session_start();

require '../../vendor/autoload.php';
use Automattic\WooCommerce\Client;

$sql_ = "SELECT * FROM producto_av";
$execute = $conexion->query($sql_);

foreach($execute as $data){
    
    $item_code = $data['id'];
    $item_name = $data['contratipo'];
    $stock = $data['stock'];
    $costo = $data['gramo'];
    $categoria = $data['id_categoria'];
    $genero = $data['genero'];
include '../formulas.php';
$unitarios = round(($unitario), 2) ;
$docenas = round(($docena / 1.19), 2) ; 
$centenas = round(($centena / 1.19), 2) ;
$millars = round(($millar / 1.19), 2) ;
    $visibilidad = "visible"; 
    $categoria_woo =73;
     $descripcion_corta = "item generado desde api";
 $descripcion_comercial = "item generado desde api";
 $src = "https://cotizar.jjquimienvases.com/items/imagenes/logo.png";
 
 $url_API_woo = 'https://jjquimienvases.com/';
 $ck_API_woo = 'ck_ff0e53d849d5f361fb6cfb47af9cba0e0d2a9de9';
 $cs_API_woo = 'cs_fd9a7c915e130e830d1efc434bd4ca12ace1ca4a';
 
 $woocommerce = new Client(
     $url_API_woo,
    $ck_API_woo,
    $cs_API_woo,
    ['version' => 'wc/v3']
);
    include 'json_create_all.php';
}
    



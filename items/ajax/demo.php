<?php

 require_once '../../vendor/autoload.php';
use Automattic\WooCommerce\Client;

#AQUI VAMOS A CONECTTARNOS AL WOO COOMMERCE
$url_API_woo = 'https://jjquimienvases.com/';
$ck_API_woo = 'ck_f54b6d5f9028d30848d3bde15d108399123e216f';
$cs_API_woo = 'cs_b7f6d6b08c93f2605c661cd113cafa580d618322';
// CONEXION AL WOOCOMMERCE 
$woocommerce = new Client(
    $url_API_woo,
    $ck_API_woo,
    $cs_API_woo,
    [
        'wp_api' => true,
        'version' => 'wc/v3',
        'query_string_auth' => true // Force Basic Authentication as query string true and using under HTTPS
    ]
);

$myjson = json_encode($woocommerce->get('products/categories/38'));

// print_r($woocommerce);
print_r($myjson);

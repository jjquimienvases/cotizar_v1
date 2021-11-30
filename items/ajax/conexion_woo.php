<?php

$url_API_woo = 'https://jjquimienvases.com/';
$ck_API_woo = 'ck_f54b6d5f9028d30848d3bde15d108399123e216f';
$cs_API_woo = 'cs_b7f6d6b08c93f2605c661cd113cafa580d618322';
// CONEXION AL WOOCOMMERCE 
$woocommerce = new Client(
    $url_API_woo,
    $ck_API_woo,
    $cs_API_woo,
    [
        'version' => 'wc/v3'

    ]
);
<?php
 
 require '../../vendor/autoload.php';
 use Automattic\WooCommerce\Client;
 include '../conexion.php';
if($_SERVER['REQUEST_METHOD'] == 'POST'){
 $id = $_POST['id_item'];
}
$nombreImg=$_FILES['imagen']['name'];
$ruta=$_FILES['imagen']['tmp_name'];
$destino="../imagenes/".$nombreImg;
$src = "https://cotizar.jjquimienvases.com/items/imagenes/".$nombreImg;
if(copy($ruta, $destino)){
$sql_insert = $conexion->query("UPDATE producto_av SET imagen = '$src' WHERE id = $id");
$sql_insert_ib = $conexion->query("UPDATE productos_ibague SET imagen = '$src' WHERE id = $id");
}
 $json = [];
 $ns = new stdClass();
$ns->id= $id;

$ns->src = $src;

$json = '[';
				$json .= json_encode($ns);
				$json .= ']';

// print_r($json);

// return;

$url_API_woo = 'https://jjquimienvases.com/';
$ck_API_woo = 'ck_f54b6d5f9028d30848d3bde15d108399123e216f';
$cs_API_woo = 'cs_b7f6d6b08c93f2605c661cd113cafa580d618322';
// CONEXION AL WOOCOMMERCE 
$woocommerce = new Client(
    $url_API_woo,
    $ck_API_woo,
    $cs_API_woo,
    ['version' => 'wc/v3']
);

$items_origin = json_decode($json, true);

$param_sku = '';
foreach ($items_origin as $item) { //este foreach se encarga de armar un arreglo con el sku seleccionado
    $param_sku .= $item['id'] . ',';
}
$products = $woocommerce->get('products/?sku=' . $param_sku);
// print_r($param_sku);
// Construimos la data en base a los productos recuperados
$item_data = [];
foreach ($products as $product) {

    // Filtramos el array de origen por sku
    $sku = $product->sku;
    $search_item = array_filter($items_origin, function ($item) use ($sku) {
        return $item['id'] == $sku;
    });
    $search_item = reset($search_item);
    $meta = $product->meta_data;
    // Formamos el array a actualizar
    $item_data[] = [
        'id' => $product->id,
        'images' => [
            [
                'src' => $search_item['src']
            ]
        ]
    ];
}



$data = [
    'update' => $item_data,
];

$result = $woocommerce->post('products/batch', $data);

if($sql_insert){
    echo $sql_insert;
}else{
    echo 0;
}
// $data = [
//     'update' => [
//         [
//             'sku' => $id,
//             'regular_price'=>100,
//             'images' => [
//                 [
//                     // 'src' => 'http://demo.woothemes.com/woocommerce/wp-content/uploads/sites/56/2013/06/cd_4_angle.jpg'
//                     'src' => $src
//                 ]
//             ]
//         ]
//     ]
// ];

// $result = $woocommerce->post('products/batch', $data);

?>
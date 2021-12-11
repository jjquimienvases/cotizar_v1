<?php



// require '../../vendor/autoload.php';
// use Automattic\WooCommerce\Client;
include '../conexion.php';
// $url_API_woo = 'https://jjquimienvases.com/';
// $ck_API_woo = 'ck_f54b6d5f9028d30848d3bde15d108399123e216f';
// $cs_API_woo = 'cs_b7f6d6b08c93f2605c661cd113cafa580d618322';
// // CONEXION AL WOOCOMMERCE 
// $woocommerce = new Client(
//     $url_API_woo,
//     $ck_API_woo,
//     $cs_API_woo,
//     ['version' => 'wc/v3']
// );


$archivo = fopen("plasticoos1.csv", "r");
$sql = "";

while (($datos = fgetcsv($archivo, 20000, ",")) == true) {

    //variables
    $skus = $datos['0'];
    $id_categoria = $datos['2'];
    $imagen = $datos['3'];
    $src = $datos['3'];
    $sub_categoria_catalogo = $datos['5'];
    $visibility = $datos['4'];
    // $categoria_woo_1 = 37;
    $categoria_woo_1 = $datos['6'];
    $categoria_woo_2 = $datos['7'];
    // $categoria_woo_3 = $datos['8'];
    // $categoria_woo_4 = $datos['9'];

    //obtenemos documento para definir precios de los productos
    include 'formulas.php';
$unitarios = round(($unitario), 2) ;
$docenas = round(($docena), 2) ; 
$centenas = round(($centena), 2) ;
$millars = round(($millar), 2) ;

    $param_sku = '';
// este foreach se encarga de armar un arreglo con el sku seleccionado
 
    //primera consulta SQL
  $sql = "UPDATE producto_av SET imagen = '$imagen', visibilidad = $visibility, sub_categoria = $sub_categoria_catalogo WHERE id = $skus";
   
   
 //Vamoos a actualizar la columna imagen cliente

    // include 'ajax_json_update.php';
    
//   print_r($id_categoria);
//   return;
    // include 'json_update.php';
    

     $execute = $conexion->query($sql);

    //vamos a actualizar del woo la imagen, categoria, precio unitario de los productos

  if($execute){
      echo $execute;
  }else{
      echo "no funciona: ".$skus;
  }
}
$contador = 0;




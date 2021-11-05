<?php

include '../conexion.php';
session_start();


if($_SERVER['REQUEST_METHOD'] == 'POST'){
 $item_code = $_POST['id'];
 $item_name = $_POST['contratipo'];
 $costo = $_POST['precio'];
 $genero = $_POST['genero'];
 $categoria = $_POST['id_categoria'];
 $unidad_empaque = $_POST['unidadxemp'];
 $ubicacion = $_POST['ubicacion'];
 $peso = $_POST['peso'];
 $stock = $_POST['stock'];
 $stock_minimo = $_POST['stock_minimo'];
 $stock_maximo = $_POST['stock_maximo'];
 $nombre_proveedor = $_POST['nombre_proveedor']; 
 $categoria_woo = $_POST['id_categoria_woo']; 
 $descripcion_corta = $_POST['descripcion_corta'];
 $descripcion_comercial = $_POST['descripcion_comercial'];
 if(isset($_POST['visibilidad'])){
     $visibilidad = "visible"; 
 }else{
     $visibilidad = "hidden";
 }
}


$nombreImg=$_FILES['imagen']['name'];
$ruta=$_FILES['imagen']['tmp_name'];
$destino="../imagenes/".$nombreImg;
$src = "https://cotizar.jjquimienvases.com/items/imagenes/".$nombreImg;
if(copy($ruta, $destino)){
           $sql_ = "INSERT INTO producto_av (id,contratipo,stock,genero,gramo,id_categoria,peso,ubicacion,unidad,minimo,maximo,imagen,name_prov,visibilidad) VALUES ($item_code,'$item_name',$stock,'$genero', $costo,$categoria,$peso,'$ubicacion','$unidad_empaque', $stock_minimo,$stock_maximo,'$src','$nombre_proveedor',1)";
           $sql_1 = "INSERT INTO producto (id,contratipo,stock,genero,gramo,id_categoria,peso,ubicacion,unidad,minimo,maximo,imagen,visibilidad) VALUES ($item_code,'$item_name',$stock,'$genero', $costo,$categoria,$peso,'$ubicacion','$unidad_empaque', $stock_minimo,$stock_maximo,'$src',1)";
           $sql_2 = "INSERT INTO producto_d1 (id,contratipo,stock,genero,gramo,id_categoria,peso,ubicacion,unidad,minimo,maximo,imagen,visibilidad) VALUES ($item_code,'$item_name',$stock,'$genero', $costo,$categoria,$peso,'$ubicacion','$unidad_empaque', $stock_minimo,$stock_maximo,'$src',1)";
           $sql_3 = "INSERT INTO productos_ibague (id,contratipo,stock,genero,gramo,id_categoria,peso,ubicacion,unidad,minimo,maximo,imagen,visibilidad) VALUES ($item_code,'$item_name',$stock,'$genero', $costo,$categoria,$peso,'$ubicacion','$unidad_empaque', $stock_minimo,$stock_maximo,'$src',1)";
           $sql_4 = "INSERT INTO productos_ibague2 (id,contratipo,stock,genero,gramo,id_categoria,peso,ubicacion,unidad,minimo,maximo,imagen,visibilidad) VALUES ($item_code,'$item_name',$stock,'$genero', $costo,$categoria,$peso,'$ubicacion','$unidad_empaque', $stock_minimo,$stock_maximo,'$src',1)";
 
}

 include '../formulas.php';
$unitarios = round(($unitario), 2) ;
$docenas = round(($docena / 1.19), 2) ; 
$centenas = round(($centena / 1.19), 2) ;
$millars = round(($millar / 1.19), 2) ;
 
$execute = $conexion->query($sql_); 
$execute_1 = $conexion->query($sql_1); 
$execute_2 = $conexion->query($sql_2); 
$execute_3 = $conexion->query($sql_3); 
$execute_4 = $conexion->query($sql_4); 
// return;

 if($execute){
     echo $execute;
 }else{
     echo 0;
 }
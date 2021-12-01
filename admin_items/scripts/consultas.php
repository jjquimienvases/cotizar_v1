<?php
 require '../conexion.php';

 function productos_(){
    $sql = "SELECT * FROM producto_av";
 }

 function categorias_padres(){
     $sql = "SELECT * FROM categorias";
 }

 function sub_categorias(){
     $sql = "SELECT * FROM sub_categoria";
 }

 function materia_prima(){
     $sql = "SELECT * FROM materia_prima";
 }
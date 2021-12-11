<?php
$puntos_de_venta = ["mostradorjj", "mostradord1", "mostrador_ibague_1", "mostrador_ibague_2", "bancolombia"];
$conexions = conectar();

$sql_u = $conexions->query("SELECT first_name FROM factura_usuarios WHERE id_rol != 0");

//$comerciales = [];
//foreach($sql_u as $datas){
  //$comerciales = $datas;  
//}
$comerciales = ["tamara", "maria", "sergio", "velasco", "nidia", "karen", "leiner", "michel", "elizabeth", "diego", "linda", "jimenez","fernando","laura","alejandra","abaunza"];

$metodos = ["bancolombia", "davivienda", "efectivo", "credito", "datafono", "mercado libre", "contra entrega","multiple"];

$punto_venta_novedades = ["Mostrador Principal", "Mostrador D1", "Ibague 1", "Ibague 2"];
$canal = ["call center","redes sociales","tienda virtual"];

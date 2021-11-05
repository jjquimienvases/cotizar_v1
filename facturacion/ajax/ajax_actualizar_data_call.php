<?php 

//  include '../conexion.php';
 $con = new mysqli ('ftp.jjquimienvases.com','jjquimienvases_jjadmin','LeinerM4ster','jjquimienvases_cotizar');

         $codigo = $_POST['codigo'];
         $id_factura = $_POST['id_factura'];
         $id_f_nuevo = $id_factura;
         $inserta_id = $con->query("INSERT INTO factura_id (id,order_id) VALUES ($id_f_nuevo,$codigo)");
         if($inserta_id){
             return "funciona la actualizacion";
         }else{
             return 0;
         }

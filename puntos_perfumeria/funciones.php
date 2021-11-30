<?php
   include 'conexion.php';
   $conexion = conectar();

   $consulta_puntos_clientes = $conexion ->query("SELECT cliente_id,documento,mililitros FROM clientes INNER JOIN puntos ON puntos.cliente_id = clientes.id");


   function getPoints($idcliente,$cedula,$puntos,$especial_np){
     $conexion = conectar();
     // echo $idcliente ."<br>";
     // echo $puntos."<br>" ;
     // echo $cedula."<br>";
     // echo $especial_np;
       $consultando_cedula = $conexion ->query("SELECT cliente_id,documento,mililitros FROM clientes INNER JOIN puntos ON puntos.cliente_id = clientes.id WHERE clientes.documento = $cedula");
       if($consultando_cedula){
              while ($data = mysqli_fetch_array($consultando_cedula)) {
              $documento_nw = $data['documento'];
              $militros_nw = $data['mililitros'];
              $id_cliente = $data['cliente_id'];
              $nuevos_puntos_nw = $especial_np + $militros_nw;
        }
       $update_other_page = $conexion ->query("UPDATE puntos SET mililitros = $nuevos_puntos_nw WHERE cliente_id = $id_cliente");
        
       }else{
          $consultando_cliente = $conexion ->query("SELECT cliente_id,documento FROM clientes WHERE documento = $cedula");
          
              while ($data_cliente = mysqli_fetch_array($consultando_cliente)) {$id_cliente_nw = $data_cliente['id'];}
                $nuevos_puntos_nw = $especial_np;
                $consulta_insertar = $conexion ->query("INSERT INTO puntos (cliente_id,mililitros) VALUES ($id_cliente_nw,$nuevos_puntos_nw)");
                //  if($consulta_insertar){
                //      echo "cliente insertado en puntos";
                //  }else{
                //      echo "no funcion la insercion del cliente en puntos";
                //  }
       }
     
   }

   function deletePoints($idcliente,$cedula,$puntos,$especial_np){
     $conexion = conectar();
     $consultando_cedula = $conexion ->query("SELECT cliente_id,documento,mililitros FROM clientes INNER JOIN puntos ON puntos.cliente_id = clientes.id WHERE clientes.documento = $cedula");
    //  echo $idcliente ."<br>";
    //  echo $puntos."<br>" ;
    //  echo $cedula."<br>";
    //  echo $especial_np;
      while ($data = mysqli_fetch_array($consultando_cedula)) {
            $documento_nw = $data['documento'];
            $militros_nw = $data['mililitros'];
            $id_cliente = $data['cliente_id'];
            $nuevos_puntos_nw = $militros_nw - $especial_np;
      }
      $change_other_page = $conexion ->query("UPDATE puntos SET mililitros = $nuevos_puntos_nw WHERE cliente_id = $id_cliente");

   }
   
     function createClient($clientes, $cedula, $telefono,$email){
      global $conexion;

$separador = " ";
$clienteps = explode($separador, $clientes);
$nombre = $clienteps[0];
$apellidos = $clienteps[1];

         $contrasena = "none";
         $sede = 1;
         $creador = 1;
         $distribuidor = 0;
         $token = " ";
         // $emaail = "prueba@gmail.com";
         $date = date("Y-m-d H:i:s");
         $res = "SI";
         $sql_insert_new_client = "INSERT INTO `clientes`(`user`, `password`, `documento`, `nombres`, `apellidos`, `telefono`, `email`, `sede`, `creado_por`, `distribuidor`, `remember_token`, `clienteactualizado`)
          VALUES ($cedula,'$contrasena',$cedula,'$clientes','$clientes',$telefono,'$email',$sede,$creador,$distribuidor,'$token','$res')";
         $execute = $conexion->query($sql_insert_new_client);

         if($execute){
           $puntos = 0;
           $last_id = mysqli_insert_id($conexion);
           $sql_insert_puntos = $conexion->query("INSERT INTO puntos(`cliente_id`,`mililitros`) VALUES ($last_id,$puntos)"); 
         }else{
            
         $sql_insert_new_client;
         }
  
   }
?>

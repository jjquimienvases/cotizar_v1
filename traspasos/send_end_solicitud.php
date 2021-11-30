<?php
   include 'conexion.php';
//   require_once "../main.php";
   require_once "./element/TraspasosControlador.php";
   $TraCo=new TraspasosControlador();
   session_start();
     //consultando bodega
     
    
     $metodo=$_POST['metodo'];

switch($metodo){
case "consultar":
  echo $TraCo->consultar_Traspasos_controlador();
  break;
  case "UpdateTraspasos":
  //Se esta actualizando la tabla //
  echo $TraCo->actualizar_traspasos_a_finalizado();
 
    break;
    case "FinalizarTraspasos":
     echo $TraCo->actualizar_traspasos_a_transito();
 break;
 case "UpdateCantidad":
  echo $TraCo->actualizar_cantidad_traspasos();
  break;
 case "Cancelar":
  $id = $_POST["idtraspaso"];

$consulta = $conexion->query("update traspasos set estado='Solicitud Pendiente' where id=".$id );
   if(!$consulta){
     echo "error al eliminar este registro";
     exit();
   }else{
     echo "Se elimino correctamente este registro";
   }

  break;
  

}


    
 ?>
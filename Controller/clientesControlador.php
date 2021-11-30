<?php

class clientesControlador extends clienteModelo
{
    public function crear_clientes_controlador()
    {

        $cliente = $_POST['companyName'];
        $ciudad = $_POST['ciudad'];
        $direccion = $_POST['direccion'];
        $telefono = $_POST['tele'];
        $cedula = $_POST['id_cedula'];
        $email = $_POST['email'];
        $puntosN = $_POST['puntosN'];
        $puntosE = $_POST['puntosE'];
        $especificos=$_POST['Especificos'];

        $datos = [
            "_order_receiver_name" => $cliente,
            "_ciudad" => $ciudad,
            "_nombres" => $cliente,
            "_telefono" => $telefono,
            "_direccion" => $direccion,
            "_tel_client" => $telefono,
            "_cedula" => $cedula,
            "_email" => $email,
            "_puntos_perfumeria" => $puntosE,
            "_puntos_naturales" => $puntosN,
            "_venta_condicion" => $especificos,

        ];
     
        $check_usuario = main::ejecutar_consulta_simples("SELECT cedula FROM clientes
        WHERE cedula='" . $cedula . "'");
        if ($check_usuario->rowCount() > 0) {
            $id_rol = $_SESSION['id_rol'];
            if($id_rol == 4 || $id_rol == 5 || $id_rol == 1 || $id_rol == 7 || $id_rol == 2 || $id_rol == 3){
         $actualizarusuario = clienteModelo::actualizar_clientes($datos);
         if($actualizarusuario->rowCount()==1){
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Se actualizo Cliente".$id_rol,
                "Texto" => "Se actualizo cliente un nuevo cliente",
                "Tipo" => "succes",
            ];
            echo json_encode($alerta);
            exit();
         }else{
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Agregar Cliente ",
                "Texto" => "Error no se pudo crear el cliente",
                "Tipo" => "error",
            ];
            echo json_encode($alerta);
            exit();
         }
                
            }else{
                 $alerta = [
                "Alerta" => "simple",
                "Titulo" => "No estas habitado para actualizar clientes",
                "Texto" => "Consultar la cedula del cliente correctamente",
                "Tipo" => "error",
            ];
            echo json_encode($alerta);
            exit();
            }
          
        } else {
            createClient($clientes, $cedula, $telefono,$email);
            $agregarclientes = clienteModelo::agregar_cliente_modelo($datos);
            if ($agregarclientes->rowCount() == 1) {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Agregar Cliente ",
                    "Texto" => "se creo un nuevo cliente",
                    "Tipo" => "succes",
                ];
                echo json_encode($alerta);
                exit();
            } else {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Agregar Cliente ",
                    "Texto" => "Error no se pudo crear el cliente",
                    "Tipo" => "error",
                ];
                echo json_encode($alerta);
                exit();
            }

        }
    }
}
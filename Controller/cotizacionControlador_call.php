<?php
class Cotizacion_controlador_call extends cotizacionModelo
{
    public function agregar_Cotizacion_controlador_call()
    {
        $clientes = new clienteModelo();
        $order_abono = new order_abonoModelo();
        $rol_usuario = $_SESSION['id_rol'];
        if ($rol_usuario == 1) {
            $tabla = "producto_av";
        } else if ($rol_usuario == 2) {
            $tabla = "producto";
        } else if ($rol_usuario == 3) {
            $tabla = "producto_d1";
        } else if ($rol_usuario == 4) {
            $tabla = "producto_av";
        } else if ($rol_usuario == 6) {
            $tabla = "producto_av";
        } else if ($rol_usuario == 7) {
            $tabla = "productos_ibague";
        } else if ($rol_usuario == 9) {
            $tabla = "producto_av";
        }
        

        $usuario = $_POST['userid'];
        $idcliente = $_POST['idcliente'];
        $cliente = $_POST['companyName'];
        $cliente = $_POST['companyName'];
        $ciudad = $_POST['ciudad'];
        $direccion = $_POST['direccion'];
        $telefono = $_POST['tele'];
        $cedula = $_POST['id_cedula'];
        $comercial = $_POST['address'];
        $subtotal = $_POST['subTotal'];
        $taxA = $_POST['taxAmount'];
        $taxR = $_POST['taxRate'];
        $totalAft = $_POST['totalAftertax'];
        $amountP = $_POST['amountPaid'];
        $amountD = $_POST['amountDue'];
        $nota = $_POST['notes'];
        $metodo = $_POST['metodopago'];
        $email = $_POST['email'];
        $status = "finalizado";
        $puntosN = $_POST['puntosN'];
        $puntosE = $_POST['puntosE'];
        $checkN = (isset($_POST['Pnaturales'])) ? $_POST['Pnaturales'] : "";
        $puntos_especiales = [];
        $cont = 0;
        $stocknuevo = [];
        $gramosNuevos_demo = [];
        $fecha = date("d-m-y H:i:s");
        
        
                $datos = [
      "_userid" => $usuario,
            "_order_receiver_name" => $cliente,
            "_ciudad" => $ciudad,
            "_nombres" => $cliente,
            "_direccion" => $direccion,
            "_tel_client" => $telefono,
            "_cedula" => $cedula,
            "_order_receiver_address" => $comercial,
            "_order_total_before_tax" => $subtotal,
            "_order_total_tax" => $taxA,
            "_order_tax_per" => $taxR,
            "_order_total_after_tax" => $totalAft,
            "_order_amount_paid" => $amountP,
            "_order_total_amount_due" => $amountD,
            "_note" => $nota,
            "_metodopago" => $metodo,
            "_email" => $email,
            "_estado" => $estado,
            "_puntos_perfumeria" => $puntosE,
            "_puntos_naturales" => $puntosN,
            "_venta_condicion" => "Naturales",
            "fecha" => $fecha,
            "estado" => "pendiente",
            "rol" =>$rol_usuario

        ];

        //------ Productos-----//
        $codigo = (isset($_POST['productCode'])) ? $_POST['productCode'] : "";
        $contratipo = (isset($_POST['productName'])) ? $_POST['productName'] : "";
        $cantidad = (isset($_POST['quantity'])) ? $_POST['quantity'] : "";
        $unitario = (isset($_POST['unitario'])) ? $_POST['unitario'] : "";
        $resultado = (isset($_POST['result'])) ? $_POST['result'] : "";
        $categoria = (isset($_POST['idCategoria'])) ? $_POST['idCategoria'] : "";
        $stockactual = (isset($_POST['productStock'])) ? $_POST['productStock'] : "";
        $gramos = (isset($_POST['gramos'])) ? $_POST['gramos'] : "";
        $tapa = (isset($_POST['Tapa'])) ? $_POST['Tapa'] : "";
        $envase = (isset($_POST['Envase'])) ? $_POST['Envase'] : "";
        $capacidad = (isset($_POST['Capacidad'])) ? $_POST['Capacidad'] : "";
        $perfume = (isset($_POST['op'])) ? $_POST['op'] : "";
        $capacidad = (isset($_POST['Puntos'])) ? $_POST['Puntos'] : "";
        $abono = (isset($_POST['abono'])) ? $_POST['abono'] : "";
        $gramosAdicionales = (isset($_POST['gramos_adicionales'])) ? $_POST['gramos_adicionales'] : "";

        //--- Validar Campos --//
        if ($cliente == "" || $cedula == "" || $comercial == "0") {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error",
                "Texto" => "Por favor llene los campos",
                "Tipo" => "error",
            ];
            echo json_encode($alerta);
            exit();
        }
         $agregarCotizacion = cotizacionModelo::agregar_Cotizacion_modelo($datos);
        if (isset($abono) && !empty($abono)) {
         $order_a = main::ejecutar_consulta_simples("INSERT INTO order_abono (order_id,order_receiver_name,comercial,deuda,abono,restante,metodo_de_pago,order_date,estado,id_rol)value($agregarCotizacion,'".$cliente."','".$comercial."','".$subtotal."','".$amountP."','".$amountD."','".$metodo."','".$fecha."','".$estado."',$rol_usuario)");
        }
        if ($agregarCotizacion > 0) {
            for ($i = 0; $i < count($codigo); $i++) {
                if ($gramos[$i] == "0") {
                    $datos_producto = [
                        "_order_id" => $agregarCotizacion,
                        "_item_code" => $codigo[$i],
                        "_item_name" => $contratipo[$i],
                        "_order_item_quantity" => $cantidad[$i],
                        "_order_item_unitario" => $unitario[$i],
                        "_order_item_price" => $unitario[$i],
                        "_item_categoria" => $categoria[$i],
                        "_order_item_final_amount" => $resultado[$i],
                        "_envases" => $envase[$i],
                        "_tapa" => $tapa[$i],
                        "_gramos" => $gramos[$i],
                    ];
                } elseif (isset($perfume[$i]) && $perfume[$i] == "Perfume Lujo") {

                    $contratipo[$i] = $contratipo[$i] . "," . $envase[$i];
                    $datos_producto = [
                        "_order_id" => $agregarCotizacion,
                        "_item_code" => $codigo[$i],
                        "_item_name" => $contratipo[$i],
                        "_order_item_quantity" => $cantidad[$i],
                        "_order_item_unitario" => $unitario[$i],
                        "_order_item_price" => $unitario[$i],
                        "_item_categoria" => $categoria[$i],
                        "_order_item_final_amount" => $resultado[$i],
                        "_envases" => $envase[$i],
                        "_tapa" => $tapa[$i],
                        "_gramos" => $gramos[$i],
                    ];
                } else {
                    $datos_producto = [
                        "_order_id" => $agregarCotizacion,
                        "_item_code" => $codigo[$i],
                        "_item_name" => $contratipo[$i],
                        "_order_item_quantity" => $cantidad[$i],
                        "_order_item_unitario" => $unitario[$i],
                        "_order_item_price" => $unitario[$i],
                        "_item_categoria" => $categoria[$i],
                        "_order_item_final_amount" => $resultado[$i],
                        "_envases" => $envase[$i],
                        "_tapa" => $tapa[$i],
                        "_gramos" => $gramos[$i],
                    ];
                }

                // agregar productos en la tabla factura_orden_productos
                $agregarProducto = cotizacionModelo::agregar_producto_modelo($datos_producto);
            }
            if ($agregarProducto->rowCount() >= 1) {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Se agrego una nueva cotizacion",
                    "Texto" => "Ya se creo la cotizacion",
                    "Tipo" => "success",
                    "bodega" => $rol_usuario,
                    "tabla" => $tabla,
                ];
                echo json_encode($alerta);
                exit();
            }
        }else {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error",
                "Texto" => "No se guardo el cliente",
                "Tipo" => "error",
            ];
            echo json_encode($alerta);
            exit();
        }
    }
}
<?php

class cotizacionControlador extends cotizacionModelo
{
    public function agregar_Cotizacion_controlador()
    {
        $clientes = new clienteModelo();

        $usuario = $_POST['userId'];
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
        $status = "pendiente";
        $puntosN = $_POST['puntosN'];
        $puntosE = $_POST['puntosE'];
        $puntos_especiales = [];
        $cont = 0;
        $stocknuevo = [];
        $datos = [
            "_userid" => $usuario,
            "_order_receiver_name" => $cliente,
            "_ciudad" => $ciudad,
            "_nombres" => $cliente,
            "_telefono" => $telefono,
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
            "_estado" => $status,
            "_puntos_perfumeria" => $puntosE,
            "_puntos_naturales" => $puntosN,
            "_venta_condicion" => "Naturales",

        ];
        $check_usuario = main::ejecutar_consulta_simples("SELECT cedula FROM clientes
            WHERE cedula='" . $cedula . "'");
        if ($check_usuario->rowCount() > 0) {
            $actualizarusuario = $clientes->actualizar_clientes($datos);

        } else {
            $agregarclientes = $clientes->agregar_cliente_modelo($datos);
            if ($agregarclientes->rowCount() == 1) {
                $alerta = [
                    "Alerta" => "recargar",
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
      
      
      //ESTE APARTADO ES PARA NO DEJAR GUARDAR LA COTIZACION EN CASO TAL DE QUE EL STOCK SEA MENOR A LA CANTIDAD QUE SE VA A VENDER
      
        // for ($i = 0; $i < count($codigo); $i++) {

        //     if ($stockactual[$i] == 0) {
        //         $alerta = [
        //             "Alerta" => "simple",
        //             "Titulo" => "Stock Vacio",
        //             "Texto" => "El stok de " . $contratipo[$i] . " se encuentra vacio",
        //             "Tipo" => "error",
        //         ];
        //         echo json_encode($alerta);
        //         exit();
        //     } elseif ($cantidad[$i] > $stockactual[$i]) {
        //         $alerta = [
        //             "Alerta" => "simple",
        //             "Titulo" => $contratipo[$i],
        //             "Texto" => " La Cantidad es mayor al stock actual ",
        //             "Tipo" => "error",
        //         ];
        //         echo json_encode($alerta);
        //         exit();
        //     }

        // }
     
     
     
        $agregarCotizacion = cotizacionModelo::agregar_Cotizacion_modelo($datos);
        $puntose = [];
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
                } else {
                    if (isset($perfume[$i]) && $perfume[$i] == "Perfume Lujo") {

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

                }
                // agregar productos en la tabla factura_orden_productos
                $agregarProducto = cotizacionModelo::agregar_producto_modelo($datos_producto);
                // verificar si es un producto o perfumeria
                if ($gramos[$i] != "0") {
                    // se esta descontanto el stock de perfumeria
                    $gramosNuevos_demo[$i] = $cantidad[$i] * $gramos[$i];
                    // VALOR DE GRAMOS ADICIONALES (INPUT) + $GAMOSNUEVOS
                    if(isset($gramosAdicionales[$i]) && $gramosAdicionales[$i] > 0){
                         $gramosNuevos[$i] = $gramosNuevos_demo[$i] + $gramosAdicionales[$i]; 
                        
                    }    
                    
                    $stocknuevo[$i] = $stockactual[$i] - $gramosNuevos[$i];
                    $descontar_stock = main::ejecutar_consulta_simples("UPDATE productos_ibague set stock=" . $stocknuevo[$i] . " where id='" . $codigo[$i] . "'");
                    // se esta consulatando el stock de envases
                    $consultar_gramos = main::ejecutar_consulta_simples("SELECT  * from productos_ibague where id=" . $envase[$i]);
                    while ($valor = $consultar_gramos->fetch(PDO::FETCH_ASSOC)) {
                        $gramos_descuento[$i] = $valor['stock'] - $cantidad[$i];
                        // se esta descontanto el stock de envase
                        $descontar_gramos = main::ejecutar_consulta_simples("UPDATE productos_ibague set stock=" . $gramos_descuento[$i] . " where id='" . $envase[$i] . "'");

                    }if (!empty($tapa[$i])) {
                        // se esta consultadando la el stock de la tapa
                        $consultar_tapas = main::ejecutar_consulta_simples("SELECT  * from productos_ibague where id=" . $tapa[$i]);
                        while ($valor = $consultar_tapas->fetch(PDO::FETCH_ASSOC)) {
                            $total_tapas[$i] = $valor['stock'] - $cantidad[$i];
                            // se esta descontanto el stock de tapa
                            $descontar_gramos = main::ejecutar_consulta_simples("UPDATE productos_ibague set stock=" . $total_tapas[$i] . " where id='" . $tapa[$i] . "'");

                        }
                    }

                } elseif (isset($stockactual[$i])) {
                    // se esta descontanto el stock de producto normales
                    $stocknuevo[$i] = $stockactual[$i] - $cantidad[$i];
                    $descontar_stock = main::ejecutar_consulta_simples("UPDATE productos_ibague set stock=" . $stocknuevo[$i] . " where id='" . $codigo[$i] . "'");

                }
                if (isset($capacidad[$i]) && $capacidad[$i] > 0) {

                    switch ($capacidad[$i]) {
                        case "30 ML":
                            $especial = $cantidad[$i] * 0.5;
                            $puntos_especiales[$i] = floatval($puntosE + $especial);

                            break;
                        case "50 ML":
                            $especial = $cantidad[$i] * 1;
                            $puntos_especiales[$i] = floatval($puntosE + $especial);
                            break;
                        case "100 ML":
                            $especial = $cantidad[$i] * 2;
                            $puntos_especiales[$i] = floatval($puntosE + $especial);
                            break;
                    }
                    if ($puntos_especiales[$i] > 60) {
                        $alerta = [
                            "Alerta" => "recargar",
                            "Titulo" => "Ya se creo la cotizacion ",
                            "Texto" => "Ya tiene mas de 60 puntos",
                            "Tipo" => "info",
                        ];
                        echo json_encode($alerta);
                        exit();
                    } else {
                        if ($puntosE > 60) {
                            $alerta = [
                                "Alerta" => "recargar",
                                "Titulo" => "Ya se creo la cotizacion ",
                                "Texto" => "Ya tiene mas de 60 puntos",
                                "Tipo" => "info",
                            ];
                            echo json_encode($alerta);
                            exit();
                        }
                        $añadir_puntos = main::ejecutar_consulta_simples("UPDATE clientes SET puntos_perfumeria=" . $puntos_especiales[$i] . " WHERE cedula='" . $cedula . "';");
                    }

                }

            }
            $puntos = 0;

            if ($agregarProducto->rowCount() >= 1) {

                if ($subtotal >= 1.000) {
                    $puntos = $subtotal / 1000;
                    $p = explode(".", $puntos);

                    $puntos_naturales = $puntosN + $p[0];
                    $añadir_puntos = main::ejecutar_consulta_simples("UPDATE clientes SET puntos_naturales=" . $puntos_naturales . " WHERE cedula=" . $cedula . ";");

                }

                $alerta = [
                    "Alerta" => "recargar",
                    "Titulo" => "Se agrego una nueva cotización",
                    "Texto" => "Ya se creo la cotizacion",
                    "Tipo" => "success",
                ];
                echo json_encode($alerta);
                exit();
            } else {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ocurrio un error",
                    "Texto" => "No sea cabron",
                    "Tipo" => "error",
                ];
                echo json_encode($alerta);
                exit();
            }

        } else {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error",
                "Texto" => "No sea cabron",
                "Tipo" => "error",
            ];
            echo json_encode($alerta);
            exit();
        }

    }

}

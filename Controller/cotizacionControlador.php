<?php


class cotizacionControlador_prueba extends cotizacionModelo
{
    public function agregar_Cotizacion_controlador()
    {
        $clientes = new clienteModelo();
        $order_abono = new order_abonoModelo();
        $rol_usuario = $_SESSION['id_rol'];
        $user_id = $_SESSION['userid'];
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


        $estado = "pendiente";
        $usuario = $_POST['userId'];
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
            "fecha" => $fecha,
            "estado" => "pendiente",
            "rol" => $rol_usuario

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



    print_r($_POST['Puntos']);
        print_r($_POST['Capacidad']);
        exit;
        //--- Validar Campos --//
        if ($cliente == "" || $cedula == "") {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error",
                "Texto" => "Por favor completar los datos del cliente",
                "Tipo" => "error",
            ];
            echo json_encode($alerta);
            exit();
        } else if ($comercial == "0") {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error",
                "Texto" => "Por favor agregar el nombre de quien esta haciendo la cotizacion",
                "Tipo" => "error",
            ];
            echo json_encode($alerta);
            exit();
        } else if ($resultado == "" || $subtotal == "" || $subtotal == "0") {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error",
                "Texto" => "Verificar cotizacion, recuerda que no puedes guardar cotizaciones en 0",
                "Tipo" => "error",
            ];
            echo json_encode($alerta);
            exit();
        }
        $agregarCotizacion = cotizacionModelo::agregar_Cotizacion_modelo($datos);
        $puntose = [];
        if (isset($abono) && !empty($abono)) {

            $order_a = main::ejecutar_consulta_simples("INSERT INTO order_abono (order_id,order_receiver_name,comercial,deuda,abono,restante,metodo_de_pago,order_date,estado,id_rol)value($agregarCotizacion,'" . $cliente . "','" . $comercial . "','" . $subtotal . "','" . $amountP . "','" . $amountD . "','" . $metodo . "','" . $fecha . "','" . $estado . "',$rol_usuario)");

            //$order_abono->agregar_order_bono($datos, $agregarCotizacion);


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
                } else if (isset($perfume[$i])) {
                    $contratipo[$i] = $perfume[$i];

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
                if ($rol_usuario == 4) {
                    $agregarProducto = cotizacionModelo::agregar_producto_modelo($datos_producto);
                } else {


                    // agregar productos en la tabla factura_orden_productos
                    $agregarProducto = cotizacionModelo::agregar_producto_modelo($datos_producto);

                    // verificar si es un producto o perfumeria
                    if ($gramos[$i] != "0") {

                        // se esta descontanto el stock de perfumeria
                        $gramosNuevos[$i] = floatval($cantidad[$i] * $gramos[$i]);
                        // VALOR DE GRAMOS ADICIONALES (INPUT) + $GAMOSNUEVOS
                        if (isset($gramosAdicionales[$i]) && $gramosAdicionales[$i] > 0) {
                            $gramosNuevos[$i] = floatval($gramosNuevos[$i] + $gramosAdicionales[$i]);
                        }

                        $stocknuevo[$i] = floatval($stockactual[$i] - $gramosNuevos[$i]);

                        $descontar_stock = main::ejecutar_consulta_simples("UPDATE " . $tabla . " set stock=" . $stocknuevo[$i] . " where id='" . $codigo[$i] . "'");
                        // se esta consulatando el stock de envases
                        $consultar_gramos = main::ejecutar_consulta_simples("SELECT  * from " . $tabla . " where id=" . $envase[$i]);
                        while ($valor = $consultar_gramos->fetch(PDO::FETCH_ASSOC)) {
                            $gramos_descuento[$i] = $valor['stock'] - $cantidad[$i];
                            if (isset($gramosAdicionales[$i]) && $gramosAdicionales[$i] > 0) {
                                $gramos_descuento[$i] =  floatval($gramos_descuento[$i] - $gramosAdicionales[$i]);
                            }
                            // se esta descontanto el stock de envase
                            $descontar_gramos = main::ejecutar_consulta_simples("UPDATE " . $tabla . " set stock=" . $gramos_descuento[$i] . " where id='" . $envase[$i] . "'");
                        }
                        if (!empty($tapa[$i])) {
                            // se esta consultadando la el stock de la tapa
                            $consultar_tapas = main::ejecutar_consulta_simples("SELECT  * from " . $tabla . " where id=" . $tapa[$i]);
                            while ($valor = $consultar_tapas->fetch(PDO::FETCH_ASSOC)) {
                                $total_tapas[$i] = $valor['stock'] - $cantidad[$i];
                                // se esta descontanto el stock de tapa
                                $descontar_gramos = main::ejecutar_consulta_simples("UPDATE " . $tabla . " set stock=" . $total_tapas[$i] . " where id='" . $tapa[$i] . "'");
                            }
                        }
                    } elseif (isset($stockactual[$i])) {
                        // se esta descontanto el stock de producto normales
                        $stocknuevo[$i] = $stockactual[$i] - $cantidad[$i];
                        $descontar_stock = main::ejecutar_consulta_simples("UPDATE " . $tabla . " set stock=" . $stocknuevo[$i] . " where id='" . $codigo[$i] . "'");
                    }
                    if (isset($capacidad[$i]) && $capacidad[$i] != 0) {
                        $consultar = $clientes->consultar_cliente($idcliente);
                        if ($consultar->rowCount() == 1) {
                            $row = $consultar->fetch();
                            switch ($capacidad[$i]) {
                                case "30 ML":

                                    $especial = $cantidad[$i] * 0.5;
                                    $especial_np = $cantidad[$i] * 2.5;
                                    $puntos_especiales[$i] = floatval($row['puntos_perfumeria'] + $especial);
                                    getPoints($idcliente, $cedula, $puntos_especiales[$i], $especial_np);
                                    break;
                                case "50 ML":
                                    $especial = $cantidad[$i] * 1;
                                    $especial_np = $cantidad[$i] * 5;
                                    $puntos_especiales[$i] = floatval($row['puntos_perfumeria'] + $especial);
                                    getPoints($idcliente, $cedula, $puntos_especiales[$i], $especial_np);
                                    break;
                                case "100 ML":
                                    $especial = $cantidad[$i] * 2;
                                    $especial_np = $cantidad[$i] * 10;
                                    $puntos_especiales[$i] = floatval($row['puntos_perfumeria'] + $especial);
                                    getPoints($idcliente, $cedula, $puntos_especiales[$i], $especial_np);
                                    break;
                            }

                            if ($capacidad[$i] == "50ML Premio") {
                                $especial = $cantidad[$i] * 10;
                                $especial_np = $cantidad[$i] * 50;
                                $puntos_especiales[$i] = floatval($row['puntos_perfumeria'] - $especial);
                                deletePoints($idcliente, $cedula, $puntos_especiales[$i], $especial_np);
                            } else if ($capacidad[$i] == "100ML Premio") {
                                $especial = $cantidad[$i] * 20;
                                $especial_np = $cantidad[$i] * 100;
                                $puntos_especiales[$i] = floatval($row['puntos_perfumeria'] - $especial);
                                deletePoints($idcliente, $cedula, $puntos_especiales[$i], $especial_np);
                            } else if ($capacidad[$i] == "100ML aumentar") {
                                $especial = $cantidad[$i] * 10;
                                $especial_np = $cantidad[$i] * 50;
                                $puntos_especiales[$i] = floatval($row['puntos_perfumeria'] - $especial);
                                deletePoints($idcliente, $cedula, $puntos_especiales[$i], $especial_np);
                            }
                            $añadir_puntos = $clientes->actualizar_puntos_especiales($idcliente, $puntos_especiales[$i]);
                        }
                    }
                }
            }
            $puntos = 0;
            if ($agregarProducto->rowCount() >= 1) {
                if ($rol_usuario == 4) {
                } else {


                    if (isset($checkN) && !empty($checkN)) {
                        $descuentos = $puntosN - 1000;
                        $añadir_puntos = $clientes->actualizar_puntos_clientes_naturales($idcliente, $descuentos);
                        $puntos = floatval($subtotal / 1000);
                        $p = explode(".", $puntos);
                        $puntos_naturales = $descuentos + $p[0];
                        $añadir_puntos = $clientes->actualizar_puntos_clientes_naturales($idcliente, $puntos_naturales);
                    } elseif ($subtotal >= 1.000) {
                        $puntos = floatval($subtotal / 1000);
                        $p = explode(".", $puntos);
                        $puntos_naturales = $puntosN + $p[0];
                        $añadir_puntos = $clientes->actualizar_puntos_clientes_naturales($idcliente, $puntos_naturales);
                    }
                }
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Se agrego una nueva cotización",
                    "Texto" => "Ya se creo la cotizacion",
                    "Tipo" => "success",
                    "bodega" => $rol_usuario,
                    "tabla" => $tabla,
                    "acciones" => $user_id,
                ];
                echo json_encode($alerta);
                exit();
            } else {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ocurrio un error",
                    "Texto" => "No se agregaron los productos",
                    "Tipo" => "error",
                ];
                echo json_encode($alerta);
                exit();
            }
        } else {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error",
                "Texto" => "No se guardo la informacion del cliente",
                "Tipo" => "error",
            ];
            echo json_encode($alerta);
            exit();
        }
    }
}

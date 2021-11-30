<?php

$con = new mysqli('173.230.154.140', 'cotizar', 'LeinerM4ster', 'cotizar');

//recibo las variables

session_start();
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
} else if ($user_id == 27) {
    $tabla = "productos_ibague2";
} else if ($rol_usuario == 7) {
    $tabla = "productos_ibague";
} else if ($rol_usuario == 9) {
    $tabla = "producto_av";
}

$estado = "pendiente";
$usuario = $_POST['userId'];
$idcliente = $_POST['idcliente'];
$cliente = $_POST['companyName'];
$ciudad = $_POST['ciudad'];
$direccion = $_POST['direccion'];
$telefono = $_POST['tele'];
$cedula = $_POST['id_cedula'];
$comercial = $_POST['address'];
$subtotal = $_POST['subTotal'];
$taxA = $_POST['taxAmount'];
if ($taxA == 0 || $taxA == null) {
    $taxA = 0;
} else {
}
$taxR = $_POST['taxRate'];
$totalAft = $_POST['totalAftertax'];
$amountP = $_POST['amountPaid'];
if ($amountP == 0 || $amountP == null) {
    $amountP = 0;
} else {
    $amountP = $_POST['amountPaid'];
}
$amountD = $_POST['amountDue'];
if ($amountD == 0 || $amountD == null) {
    $amountD = 0;
} else {
    $amountD = $_POST['amountDue'];
}
$nota = $_POST['notes'];
$metodo = $_POST['metodopago'];
$email = $_POST['email'];
$status = "finalizado";
$puntosN = $_POST['puntosN'];
$puntosE = $_POST['puntosE'];
$checkN = (isset($_POST['Pnaturales'])) ? $_POST['Pnaturales'] : "";
$puntos_perfumeria = [];
$cont = 0;
$stocknuevo = [];
$gramosNuevos_demo = [];
$fecha = date("d-m-y H:i:s");


//items 
//------ Productos-----//
$codigo = (isset($_POST['productCode'])) ? $_POST['productCode'] : "";
$contratipo = (isset($_POST['productName'])) ? $_POST['productName'] : "";
$categoria = (isset($_POST['idCategoria'])) ? $_POST['idCategoria'] : "";
if ($cedula == "1110532395" && $categoria == 4) {
    $cantidades = (isset($_POST['quantity'])) ? $_POST['quantity'] : "";
    $cantidad = $cantidades / 2;
} else {
    $cantidad = (isset($_POST['quantity'])) ? $_POST['quantity'] : "";
}
$unitario = (isset($_POST['unitario'])) ? $_POST['unitario'] : "";
$resultado = (isset($_POST['result'])) ? $_POST['result'] : "";
$stockactual = (isset($_POST['productStock'])) ? $_POST['productStock'] : "";
$gramos = (isset($_POST['gramos'])) ? $_POST['gramos'] : "";
$tapa = (isset($_POST['Tapa'])) ? $_POST['Tapa'] : "";
$envase = (isset($_POST['Envase'])) ? $_POST['Envase'] : "";
$capacidad = (isset($_POST['Capacidad'])) ? $_POST['Capacidad'] : "";
$perfume = (isset($_POST['op'])) ? $_POST['op'] : "";
$capacidad_puntos = (isset($_POST['Puntos'])) ? $_POST['Puntos'] : "";
$abono = (isset($_POST['abono'])) ? $_POST['abono'] : "";
$gramosAdicionales = (isset($_POST['gramos_adicionales'])) ? $_POST['gramos_adicionales'] : "";
$capacidad_recarga = $_POST['Capacidad'];





//consultando cliente

$sql_c = $con->query("SELECT * FROM clientes WHERE cedula = $cedula");
foreach ($sql_c as $data_c) {
    $puntos_e = $data_c['puntos_perfumeria'];
    $puntos_n = $data_c['puntos_naturales'];
    $id_c = $data_c['id'];
}


//consulta_ agregar cotizacion


$execute = ("INSERT INTO `factura_orden`(user_id, order_receiver_name, tel_client, direccion, ciudad, order_receiver_address, order_total_before_tax, order_total_tax, order_tax_per, order_total_after_tax, order_amount_paid, order_total_amount_due, note, metodopago,codigof, cedula, email, estado,metodo_de_pago,new_date)
           VALUES ($usuario,'$cliente',$telefono,'$direccion','$ciudad','$comercial',$subtotal,$taxA,$taxR,$totalAft,$amountP,$amountD,'$nota','$metodo',0,'$cedula','$email','$estado','$estado','none')");
$sql_add = $con->query($execute);

$date_ = DATE("Y-m-d h:m:s");
$id_ =  mysqli_insert_id($con);

if ($sql_add) {


    //insertando items
    for ($i = 0; $i < count($codigo); $i++) {

        $new_name = $perfume[$i] . " " . $capacidad_puntos[$i];
        if ($gramos[$i] == 0) {
            $execute_items = ("INSERT INTO factura_orden_producto (order_id, item_code, item_name, order_item_quantity, item_categoria, order_item_unitario, order_item_final_amount, order_date,gramos,envases,tapa)
                       VALUES ('$id_', '$codigo[$i]', '$contratipo[$i]', '$cantidad[$i]', '$categoria[$i]','$unitario[$i]', '$resultado[$i]','$date_',0,0,0)");
            $sqlInsertarProductos = $con->query($execute_items);

            if ($sqlInsertarProductos) {
                print_r("se ingresaron lo items");
            } else {
                print_r($execute_items);
            }

            return;
            if ($sqlInsertarProductos and $rol_usuario != 4) {
                $con_stock = $con->query("SELECT stock FROM $tabla WHERE id = $codigo[$i]");
                $stock = floatval($con_stock->fetch_row()[0]);
                $nuevostock = $stock - $cantidad[$i];
                $sql_update_stock = $con->query("UPDATE $tabla SET stock = $nuevostock WHERE id = $codigo[$i]");
            } else {
            }
        } else { //aqui agregamos gramos y y perfumeria especial 
            $sqlInsertarProductos = $con->query("INSERT INTO factura_orden_producto (order_id, item_code, item_name, order_item_quantity, item_categoria, order_item_unitario, order_item_final_amount, order_date,gramos,envases,tapa)
                       VALUES ('$id_', '$codigo[$i]', '$perfume[$i] $capacidad_puntos[$i]', '$cantidad[$i]', '$categoria[$i]','$unitario[$i]', '$resultado[$i]','$fecha[$i]','$gramos[$i]','$envase[$i]','$tapa[$i]')");
        }
        //esencia
        if ($sqlInsertarProductos and $rol_usuario != 4) {
            $con_stock = $con->query("SELECT stock FROM $tabla WHERE id = $codigo[$i]");
            $stock = floatval($con_stock->fetch_row()[0]);
            $nuevostock_g = $stock - ($gramos[$i] * $cantidad[$i]);
            $sql_update_stock_g = $con->query("UPDATE $tabla SET stock = $nuevostock WHERE id = $codigo[$i]");
            //tapas 
            $con_stock_t = $con->query("SELECT stock FROM $tabla WHERE id = $tapa[$i]");
            $stock_t = floatval($con_stock->fetch_row()[0]);
            $nuevostock_t = $stock_t - $cantidad[$i];
            $sql_update_stock_t = $con->query("UPDATE $tabla SET stock = $nuevostock_t WHERE id = $tapa[$i]");
            //envasers
            $con_stock_e = $con->query("SELECT stock FROM $tabla WHERE id = $envase[$i]");
            $stock_e = floatval($con_stock->fetch_row()[0]);
            $nuevostock_e = $stock_e - $cantidad[$i];
            $sql_update_stock_e = $con->query("UPDATE $tabla SET stock = $nuevostock_e WHERE id = $envase[$i]");
        } else {
        }


        //sumandopuntos
        if ($capacidad_puntos[$i] != 0 || $capacidad_puntos[$i] != "") {
            //sumandopuntos

            if ($rol_usuario != 4) {
                switch ($capacidad_puntos[$i]) {
                    case "30 ML":
                        $especial = $cantidad[$i] * 0.5;
                        $sql_cs = $con->query("SELECT * FROM clientes WHERE cedula = $cedula");
                        foreach ($sql_cs as $data_c) {
                            $puntos_es = $data_c['puntos_perfumeria'];
                        }
                        $new_point = floatval($puntos_es) + $especial;
                        $update_puntos = $con->query("UPDATE clientes SET puntos_perfumeria = $new_point WHERE cedula = $cedula");

                        break;
                    case "50 ML":
                        $especial = $cantidad[$i] * 1;
                        $sql_cs = $con->query("SELECT * FROM clientes WHERE cedula = $cedula");
                        foreach ($sql_cs as $data_c) {
                            $puntos_es = $data_c['puntos_perfumeria'];
                        }
                        $new_point = floatval($puntos_es) + $especial;
                        $update_puntos = $con->query("UPDATE clientes SET puntos_perfumeria = $new_point WHERE cedula = $cedula");
                        break;
                    case "100 ML":
                        $especial = $cantidad[$i] * 2;
                        $sql_cs = $con->query("SELECT * FROM clientes WHERE cedula = $cedula");
                        foreach ($sql_cs as $data_c) {
                            $puntos_es = $data_c['puntos_perfumeria'];
                        }
                        $new_point = floatval($puntos_es) + $especial;
                        $update_puntos = $con->query("UPDATE clientes SET puntos_perfumeria = $new_point WHERE cedula = $cedula");
                        break;
                }


                switch ($capacidad_recarga[$i]) {
                    case "Recarga 30 ML":
                        $especial = $cantidad[$i] * 0.5;
                        $sql_cs = $con->query("SELECT * FROM clientes WHERE cedula = $cedula");
                        foreach ($sql_cs as $data_c) {
                            $puntos_es = $data_c['puntos_perfumeria'];
                        }
                        $new_point = floatval($puntos_es) + $especial;
                        $update_puntos = $con->query("UPDATE clientes SET puntos_perfumeria = $new_point WHERE cedula = $cedula");
                        break;
                    case "Recarga 50 ML":
                        $especial = $cantidad[$i] * 1;
                        $sql_cs = $con->query("SELECT * FROM clientes WHERE cedula = $cedula");
                        foreach ($sql_cs as $data_c) {
                            $puntos_es = $data_c['puntos_perfumeria'];
                        }
                        $new_point = floatval($puntos_es) + $especial;
                        $update_puntos = $con->query("UPDATE clientes SET puntos_perfumeria = $new_point WHERE cedula = $cedula");
                        break;
                    case "Recarga 100 ML":
                        $especial = $cantidad[$i] * 2;
                        $sql_cs = $con->query("SELECT * FROM clientes WHERE cedula = $cedula");
                        foreach ($sql_cs as $data_c) {
                            $puntos_es = $data_c['puntos_perfumeria'];
                        }
                        $new_point = floatval($puntos_es) + $especial;
                        $update_puntos = $con->query("UPDATE clientes SET puntos_perfumeria = $new_point WHERE cedula = $cedula");
                        break;
                }

                // if ($capacidad_recarga[$i] == "Recarga 30 ML") {
                //     $especial = $cantidad[$i] * 0.5;
                //       $sql_cs = $con->query("SELECT * FROM clientes WHERE cedula = $cedula");
                //             foreach ($sql_cs as $data_c){$puntos_es = $data_c['puntos_perfumeria'];} 
                //     $new_point = floatval($puntos_es) + $especial;
                //     $update_puntos = $con->query("UPDATE clientes SET puntos_perfumeria = $new_point WHERE cedula = $cedula");
                // } else if ($capacidad_recarga[$i] == "Recarga 50 ML") {
                //     $especial = $cantidad[$i] * 1;
                //     $sql_cs = $con->query("SELECT * FROM clientes WHERE cedula = $cedula");
                //             foreach ($sql_cs as $data_c){$puntos_es = $data_c['puntos_perfumeria'];}
                //     $new_point = floatval($puntos_es) + $especial;
                //     $update_puntos = $con->query("UPDATE clientes SET puntos_perfumeria = $new_point WHERE cedula = $cedula");
                // } else if ($capacidad_recarga[$i] == "Recarga 100 ML") {
                //     $especial = $cantidad[$i] * 2;
                //     $sql_cs = $con->query("SELECT * FROM clientes WHERE cedula = $cedula");
                //             foreach ($sql_cs as $data_c){$puntos_es = $data_c['puntos_perfumeria'];}
                //     $new_point = floatval($puntos_es) + $especial;
                //     $update_puntos = $con->query("UPDATE clientes SET puntos_perfumeria = $new_point WHERE cedula = $cedula");
                // }

                if ($capacidad_puntos[$i] == "50ML Premio") {

                    $especial = $cantidad[$i] * 10;
                    $sql_cs = $con->query("SELECT * FROM clientes WHERE cedula = $cedula");
                    foreach ($sql_cs as $data_c) {
                        $puntos_es = $data_c['puntos_perfumeria'];
                    }
                    $new_point = floatval($puntos_es) - $especial;
                    $update_puntos = $con->query("UPDATE clientes SET puntos_perfumeria = $new_point WHERE cedula = $cedula");
                } else if ($capacidad_puntos[$i] == "100ML Premio") {
                    $especial = $cantidad[$i] * 20;
                    $sql_cs = $con->query("SELECT * FROM clientes WHERE cedula = $cedula");
                    foreach ($sql_cs as $data_c) {
                        $puntos_es = $data_c['puntos_perfumeria'];
                    }
                    $new_point = floatval($puntos_es) - $especial;
                    $update_puntos = $con->query("UPDATE clientes SET puntos_perfumeria = $new_point WHERE cedula = $cedula");
                } else if ($capacidad_puntos[$i] == "100ML aumentar") {
                    $especial = $cantidad[$i] * 10;
                    $sql_cs = $con->query("SELECT * FROM clientes WHERE cedula = $cedula");
                    foreach ($sql_cs as $data_c) {
                        $puntos_es = $data_c['puntos_perfumeria'];
                    }
                    $new_point = floatval($puntos_es) - $especial;
                    $update_puntos = $con->query("UPDATE clientes SET puntos_perfumeria = $new_point WHERE cedula = $cedula");
                }
            } else {
            }
        }
    }

    if ($sqlInsertarProductos) {
        echo 1;
    } else {
        echo 0;
    }
} else {
    echo $sqlInsertarProductos;
}

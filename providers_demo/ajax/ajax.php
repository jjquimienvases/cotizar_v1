<?php 
require '../conexion.php';
$puntos = ["producto","producto_av","productos_ibague","productos_ibague2","producto_d1"];
$date = DATE("Y-m-d H:m:s");
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $order = $_POST['orders'];
    $bodega = $_POST['bodega'];
    $factura = $_POST['factura'];
    $proveedor = $_POST['provider'];
    $result = $_POST['result_'];
    $creador = $_POST['creator'];
    $estado = "credito";
    $total = 0;
    $nuevo_stock = 0;
    $demo_total = str_replace("$", "", $result);
    $total_demo = str_replace(",", "", $demo_total);
    $total = floatval($total_demo);
    $tipo = "pdf";
    $file_name = $_FILES['file']['name'];
    $new_name_file = null;
    if ($file_name != '' || $file_name != null) {
        $file_type = $_FILES['file']['type'];

        list($type, $extension) = explode('/', $file_type);
        if ($file_type == 'application/pdf') {
            $dir = 'archivos/';
            $extension = 'pdf';
            $file_tmp_name = $_FILES['file']['tmp_name'];
            $new_name_file = $dir . $file_name;
            if (copy($file_tmp_name, $new_name_file)) {

                $ins = "INSERT INTO `file_order_shop`(`order_id`, `proveedor`, `url_pdf`, `file_name`, `file_ruta`, `bodega`, `estado`,`factura`, `result`) 
                VALUES ($order,'$proveedor','$new_name_file','','','$bodega','$estado',$factura,$total)";
                $execute = $con->query($ins);

                if($execute){
                    $sql_get_items = $con->query("SELECT * FROM order_shop_products WHERE order_id = $order");
                    foreach($sql_get_items as $data){
                        $id = $data['item_id'];
                        $cantidad = $data['cantidad'];
                        $costo = $data['item_unitario'];
                        $id_proveedor = $data['id_proveedor'];
                        $sql_get_stock = $con->query("SELECT stock AS stock_actual FROM $bodega WHERE id = $id");
                        foreach($sql_get_stock as $data_s){
                            $stock_actual = $data_s['stock_actual'];
                            $nuevo_stock = $stock_actual + $cantidad;
                            $sql_update_info = $con->query("UPDATE $bodega SET stock = $nuevo_stock WHERE id = $id");
                        }
                        foreach($puntos as $punto){
                            $sql_update_price = $con->query("UPDATE $punto SET gramo = $costo WHERE id = $id");
                        }

                        $sql_update_provider_price = $con->query("UPDATE proveedor_producto SET precio = $costo WHERE proveedor_id = $id_proveedor AND producto_id = $id");

                        //intentando actualizar la informacion de la tabla de solicitud ordenes de compra

                        $sql_update_info = $con->query("UPDATE solicitud_productos SET quantity_agree = $cantidad, fecha_aprobacion = '$date', asistente = '$creador', estado = 'finalizado' WHERE item_id = $id AND estado LIKE '%Solicitud Finalizada%'");
                    }
                    $update_status_items = $con->query("UPDATE order_shop_products SET estado = 'finalizado' WHERE order_id = $order");
                    $update_status_order = $con->query("UPDATE order_shop_id SET estado = 'finalizado' WHERE order_id = $order");

                    if($update_status_order){
                        echo "success";
                    }else{
                        echo "no funciono bro";
                    }
                }else{
                    echo "error";
                }

            }else{      
                echo "No cargo la factura";
            }

        }

    }else{
        echo "no funciona";
    }

}
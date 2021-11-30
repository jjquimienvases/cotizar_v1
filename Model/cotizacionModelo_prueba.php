<?php

class cotizacionModelo extends main
{

    public static function agregar_Cotizacion_modelo($datos)
    {
        //  $con = new mysqli('173.230.154.140', 'cotizar', 'LeinerM4ster', 'cotizar');

        $pdo = main::conectar();
        $stmt = $pdo->prepare("INSERT INTO factura_orden (user_id, order_receiver_name, tel_client, direccion, ciudad, order_receiver_address, order_total_before_tax, order_total_tax, order_tax_per, order_total_after_tax, order_amount_paid, order_total_amount_due, note, metodopago,cedula,email,estado)
        VALUES (:USERID,:ORDER_RECEIVER_NAME,:TEL_CLIENT,
        :DIRRECION,:CIUDAD,:ORDER_RECEIVER_ADDRES,:ORDER_TOTAL_BEFORE_TAX,:ORDER_TOTAL_TAX,:ORDER_TAX_PER,
        :ORDER_TOTAL_AFTER_TAX,:ORDER_AMOUNT_PAID,:ORDER_TOTAL_AMOUNT_DUE,:NOTE,:METODO,:CEDULA,:EMAIL,:ESTADO)");
        $stmt->bindParam(':USERID', $datos['_userid'], PDO::PARAM_INT);
        $stmt->bindParam(':ORDER_RECEIVER_NAME', $datos['_order_receiver_name']);
        $stmt->bindParam(':TEL_CLIENT', $datos['_tel_client']);
        $stmt->bindParam(':DIRRECION', $datos['_direccion']);
        $stmt->bindParam(':CIUDAD', $datos['_ciudad']);
        $stmt->bindParam(':ORDER_RECEIVER_ADDRES', $datos['_order_receiver_address']);
        $stmt->bindParam(':ORDER_TOTAL_BEFORE_TAX', $datos['_order_total_before_tax']);
        $stmt->bindParam(':ORDER_TOTAL_TAX', $datos['_order_total_tax']);
        $stmt->bindParam(':ORDER_TAX_PER', $datos['_order_tax_per']);
        $stmt->bindParam(':ORDER_TOTAL_AFTER_TAX', $datos['_order_total_after_tax']);
        $stmt->bindParam(':ORDER_AMOUNT_PAID', $datos['_order_amount_paid']);
        $stmt->bindParam(':ORDER_TOTAL_AMOUNT_DUE', $datos['_order_total_amount_due']);
        $stmt->bindParam(':NOTE', $datos['_note']);
        $stmt->bindParam(':METODO', $datos['_metodopago']);
        $stmt->bindParam(':CEDULA', $datos['_cedula']);
        $stmt->bindParam(':EMAIL', $datos['_email']);
        $stmt->bindParam(':ESTADO', $datos['_estado']);

        $stmt->execute();

        $id = $pdo->lastInsertId();
        return $id;

        //     $user_id = $datos['_userid'];
        //     $cliente = $datos['_order_receiver_name'];
        //     $telefono = $datos['_tel_client'];
        //     $direccion = $datos['_direccion'];
        //     $ciudad = $datos['_ciudad'];
        //     $comercial = $datos['_order_receiver_address'];
        //     $order_total_b_t = $datos['_order_total_before_tax'];
        //     $order_total_tax = $datos['_order_total_tax'];
        //     $order_tax_per = $datos['_order_tax_per'];
        //     $order_total_a_t = $datos['_order_total_after_tax'];
        //     $order_amount_p = $datos['_order_amount_paid'];
        //     $order_amount_d = $datos['_order_total_amount_due'];
        //     $note = $datos['_note'];
        //     $metodop = $datos['_metodopago'];
        //     $cedula = $datos['_cedula'];
        //     $email = $datos['_email'];
        //     $estado = $datos['_estado'];

        // $sql = "INSERT INTO `factura_orden`(`user_id`, `order_receiver_name`, `tel_client`, `direccion`, `ciudad`, `order_receiver_address`, `order_total_before_tax`, `order_total_tax`, `order_tax_per`, `order_total_after_tax`, `order_amount_paid`, `order_total_amount_due`, `note`, `metodopago`, `cedula`, `email`, `estado`)
        // VALUES ($user_id,'$cliente',$telefono,'$direccion','$ciudad','$comercial',$order_total_b_t,$order_total_tax,$order_tax_per,$order_total_a_t,$order_amount_p,$order_amount_d,'$note','$metodop','$cedula','$email','$estado')";

        // $execute = $con->query($sql);   
        // $id =  mysqli_insert_id($con);

        // return $id;


    }

    public static function agregar_producto_modelo($datos)
    {
        $stmt = main::conectar()->prepare("INSERT INTO `factura_orden_producto` (`order_id`, `item_code`, `item_name`, `order_item_quantity`, `order_item_unitario`, `order_item_price`, `item_categoria`, `order_item_final_amount`,gramos,envases,tapa)
        VALUES (:ORDER_ID, :ITEM_CODE, :ITEM_NAME, :ORDER_ITEM_QUANTITY, :ORDER_ITEM_UNITARIO, :ORDER_ITEM_PRICE,:ITEM_CATEGORIA,:ORDER_ITEM_FINAL_AMOUNT,:GRAMOS,:ENVASES,:TAPA);");
        $stmt->bindParam(':ORDER_ID', $datos['_order_id']);
        $stmt->bindParam(':ITEM_CODE', $datos['_item_code']);
        $stmt->bindParam(':ITEM_NAME', $datos['_item_name']);
        $stmt->bindParam(':ORDER_ITEM_QUANTITY', $datos['_order_item_quantity']);
        $stmt->bindParam(':ORDER_ITEM_UNITARIO', $datos['_order_item_unitario']);
        $stmt->bindParam(':ORDER_ITEM_PRICE', $datos['_order_item_price']);
        $stmt->bindParam(':ITEM_CATEGORIA', $datos['_item_categoria']);
        $stmt->bindParam(':ORDER_ITEM_FINAL_AMOUNT', $datos['_order_item_final_amount']);
        $stmt->bindParam(':GRAMOS', $datos['_gramos']);
        $stmt->bindParam(':ENVASES', $datos['_envases']);
        $stmt->bindParam(':TAPA', $datos['_tapa']);
        $stmt->execute();
        return $stmt;
    }

    public static function actualizar_stock_modelo($stock, $codigo)
    {
        $stmt = main::conectar()->prepare("UPDATE producto_prueba set stock=:STOCK where id=ID;");
        $stmt->bindParam(':STOCK', $stock);
        $stmt->bindParam(':ID', $codigo);
        $stmt->execute();
        return $stmt;
    }
}

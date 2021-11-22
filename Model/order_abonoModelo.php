<?php

class order_abonoModelo extends main
{
    public static function agregar_order_bono($datos,$orden)
    {
        
        // $stmt = main::conectar()->prepare("INSERT INTO order_abono (order_id,order_receiver_name,comercial,deuda,abono,restante,metodo_de_pago,order_date,estado,id_rol)
        // values (:ORDER_ID,:ORDER_RECEIVER_NAME,:COMERCIAL,:DEUDA,:ABONO,:RESTANTE,:METODO,:ORDER_DATE,:ROL);");
        // $stmt->bindParam(':ORDER_ID', $orden);
        // $stmt->bindParam(':ORDER_RECEIVER_NAME', $datos['_order_receiver_name']);
        // $stmt->bindParam(':COMERCIAL', $datos['_order_receiver_address']);
        // $stmt->bindParam(':DEUDA', $datos['_order_total_after_tax']);
        // $stmt->bindParam(':ABONO', $datos['_order_amount_paid']);
        // $stmt->bindParam(':RESTANTE', $datos['_order_total_amount_due']);
        // $stmt->bindParam(':METODO', $datos['_metodopago']);
        // $stmt->bindParam(':ORDER_DATE', $datos['fecha']);
        // $stmt->bindParam(':ESTADO', $datos['estado']);
        // $stmt->bindParam(':ROL', $datos['rol']);
        
        // $stmt->execute();
        return "PRO";
    }
}

<?php

class facturamodificadaModelo extends main
{
    public static function consultar_facturamodificada_Modelo()
    {
    }

    public static function total_de_venta()
    {
        $stmt = main::conectar()->prepare("SELECT COUNT(total) AS total_venta FROM factura_modificada ");
        $stmt->execute();
        $row2 = $stmt->fetch();
        return $row2['total_venta'];
    }
    public static function monto_total()
    {
        $stmt = main::conectar()->prepare("SELECT SUM(total) AS monto_total FROM factura_modificada;");
        $stmt->execute();
        $row2 = $stmt->fetch();
        return $row2['monto_total'];
    }
    public static function total_de_venta_fecha($hoy, $manana)
    {
        $stmt = main::conectar()->prepare("SELECT COUNT(total) AS total_venta FROM factura_modificada  WHERE order_date BETWEEN '$hoy' and '$manana' ");
        $stmt->execute();
        $row2 = $stmt->fetch();
        return $row2['total_venta'];
    }
    public static function monto_total_fecha($hoy, $manana)
    {
        $stmt = main::conectar()->prepare("SELECT SUM(total) AS monto_total FROM factura_modificada WHERE order_date BETWEEN '$hoy' and '$manana'");
        $stmt->execute();
        $row2 = $stmt->fetch();
        return $row2['monto_total'];
    }
    public static function monto_total_redes($canal)
    {
        $stmt = main::conectar()->prepare("SELECT SUM(total) AS monto_total FROM factura_modificada where canal=:canal;");
        $stmt->bindParam(":canal", $canal);
        $stmt->execute();
        $row2 = $stmt->fetch();
        return $row2['monto_total'];
    }

    public static function total_de_venta_redes($canal)
    {
        $stmt = main::conectar()->prepare("SELECT COUNT(total) AS total_venta FROM factura_modificada where canal=:canal");
        $stmt->bindParam(":canal", $canal);
        $stmt->execute();
        $row2 = $stmt->fetch();
        return $row2['total_venta'];
    }
    public static function monto_total_redes_fecha($canal, $hoy, $manana)
    {
        $stmt = main::conectar()->prepare("SELECT SUM(total) AS monto_total FROM factura_modificada where canal=:canal and order_date BETWEEN '$hoy' and '$manana';");
        $stmt->bindParam(":canal", $canal);
        $stmt->execute();
        $row2 = $stmt->fetch();
        return $row2['monto_total'];
    }

    public static function total_de_venta_redes_fecha($canal, $hoy, $manana)
    {
        $stmt = main::conectar()->prepare("SELECT COUNT(total) AS total_venta FROM factura_modificada where canal=:canal and order_date BETWEEN '$hoy' and '$manana' ");
        $stmt->bindParam(":canal", $canal);
        $stmt->execute();
        $row2 = $stmt->fetch();
        return $row2['total_venta'];
    }
    public static function total_de_venta_metodo($metodo)
    {
        $stmt = main::conectar()->prepare("SELECT COUNT(total) AS total_venta FROM factura_modificada WHERE metodopago like'%$metodo%'");

        $stmt->execute();
        $row2 = $stmt->fetch();
        return $row2['total_venta'];
    }
    public static function total_de_venta_metodo_fecha($metodo, $hoy, $manana)
    {
        $stmt = main::conectar()->prepare("SELECT COUNT(total) AS total_venta FROM factura_modificada WHERE metodopago like'%$metodo%' and  order_date BETWEEN '$hoy' and '$manana'");

        $stmt->execute();
        $row2 = $stmt->fetch();
        return $row2['total_venta'];
    }
    public static function monto_total_metodo($metodo)
    {
        $stmt = main::conectar()->prepare("SELECT SUM(total) AS monto_total FROM factura_modificada  WHERE metodopago like'%$metodo%'");

        $stmt->execute();
        $row2 = $stmt->fetch();
        return $row2['monto_total'];
    }
    public static function monto_total_metodo_fecha($metodo, $hoy, $manana)
    {
        $stmt = main::conectar()->prepare("SELECT SUM(total) AS monto_total FROM factura_modificada  WHERE metodopago like'%$metodo%' and order_date BETWEEN '$hoy' and '$manana'");

        $stmt->execute();
        $row2 = $stmt->fetch();
        return $row2['monto_total'];
    }
    public static function total_de_venta_contra($metodo)
    {
        $total = 0;
        $stmt = main::conectar()->prepare("SELECT COUNT(metodopago) as total_venta FROM factura_modificada WHERE metodopago  like'%$metodo%';");
        $stmt->execute();
        $row2 = $stmt->fetch();
        return $row2['total_venta'];
    }
    public static function monto_total_contra($metodo)
    {
        $stmt = main::conectar()->prepare("SELECT SUM(total) AS monto_total FROM factura_modificada  WHERE metodopago  like'%$metodo%'");
        $stmt->execute();
        $row2 = $stmt->fetch();
        return $row2['monto_total'];
    }
    public static function total_de_venta_contra_fecha($metodo, $hoy, $manana)
    {
        $total = 0;
        $stmt = main::conectar()->prepare("SELECT COUNT(metodopago) as total_venta FROM factura_modificada WHERE metodopago  like'%$metodo%' and order_date BETWEEN '$hoy' and '$manana'");
        $stmt->execute();
        $row2 = $stmt->fetch();
        return $row2['total_venta'];
    }
    public static function monto_total_contra_fecha($metodo, $hoy, $manana)
    {
        $stmt = main::conectar()->prepare("SELECT SUM(total) AS monto_total FROM factura_modificada  WHERE metodopago  like'%$metodo%' and order_date BETWEEN '$hoy' and '$manana'");
        $stmt->execute();
        $row2 = $stmt->fetch();
        return $row2['monto_total'];
    }

    public static function monto_total_factura_modificada_fecha($metodo, $hoy, $manana)
    {
        $stmt = main::conectar2()->query("SELECT sum(factura_modificada.total) as monto from factura_modificada inner join factura_orden on factura_modificada.order_id=factura_orden.order_id where factura_orden.order_date between '$hoy' and '$manana' and factura_modificada.metodopago like '%$metodo%'");
        $stmt->execute();
        $row2 = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $row2['monto'];
    }
}

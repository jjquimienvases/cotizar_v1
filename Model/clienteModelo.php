<?php

class clienteModelo extends main
{

    public static function actualizar_puntos_clientes_naturales($cedula,$puntos)
    {
        $stmt=main::conectar()->prepare("UPDATE clientes SET puntos_naturales=:PUNTOS where cedula=:CEDULA");
        $stmt->bindParam(':PUNTOS',$puntos);
        $stmt->bindParam(':CEDULA',$cedula);
        $stmt->execute();
        return $stmt;
    }

    public static function consultar_cliente($cedula){
        $stmt=main::conectar()->prepare("SELECT * FROM clientes where cedula=".$cedula);
        $stmt->execute();
        return $stmt;
    }
    public static function agregar_cliente_modelo($datos){
       $stmt=main::conectar()->prepare("INSERT INTO `clientes` (`nombres`, `cedula`, `direccion`, `ciudad`, `telefono`, `email`, `puntos_perfumeria`, `puntos_naturales`, `venta_condicion`) 
       VALUES (:NOMBRE, :CEDULA,:DIRRECION ,:CIUDAD , :TELEFONO, :EMAIL, :PUNTOS_P, :PUNTOS_N,:CONDICION );");
       $stmt->bindParam(':NOMBRE',$datos['_nombres']);
       $stmt->bindParam(':CEDULA',$datos['_cedula']);
       $stmt->bindParam(':DIRRECION',$datos['_direccion']);
       $stmt->bindParam(':CIUDAD',$datos['_ciudad']);
       $stmt->bindParam(':TELEFONO',$datos['_telefono']);
       $stmt->bindParam(':EMAIL',$datos['_email']);
       $stmt->bindParam(':PUNTOS_P',$datos['_puntos_perfumeria']);
       $stmt->bindParam(':PUNTOS_N',$datos['_puntos_naturales']);
       $stmt->bindParam(':CONDICION',$datos['_venta_condicion']);
       $stmt->execute();
       return $stmt;
    }

    public static function actualizar_clientes($datos){
        $stmt=main::conectar()->prepare("UPDATE `clientes` SET `nombres` = :NOMBRE, `cedula` = :CEDULA, `direccion` = :DIRRECION, `ciudad` = :CIUDAD, `telefono` = :TELEFONO, `email` = :EMAIL, `puntos_perfumeria` = :PUNTOS_P, `puntos_naturales` = :PUNTOS_N, `venta_condicion` = :CONDICION 
        WHERE `clientes`.`cedula` = :CEDULA; ");
        $stmt->bindParam(':NOMBRE',$datos['_nombres']);
        $stmt->bindParam(':CEDULA',$datos['_cedula']);
        $stmt->bindParam(':DIRRECION',$datos['_direccion']);
        $stmt->bindParam(':CIUDAD',$datos['_ciudad']);
        $stmt->bindParam(':TELEFONO',$datos['_telefono']);
        $stmt->bindParam(':EMAIL',$datos['_email']);
        $stmt->bindParam(':PUNTOS_P',$datos['_puntos_perfumeria']);
        $stmt->bindParam(':PUNTOS_N',$datos['_puntos_naturales']);
        $stmt->bindParam(':CONDICION',$datos['_venta_condicion']);
        $stmt->execute();
        return $stmt;
    }
      public static function actualizar_puntos_especiales($cedula,$puntos){
        $stmt=main::conectar()->prepare("UPDATE clientes SET puntos_perfumeria= :PUNTOS WHERE cedula=:CEDULA");
        $stmt->bindParam(':PUNTOS',$puntos);
        $stmt->bindParam(':CEDULA',$cedula);
        $stmt->execute();
        return $stmt;

    }
}

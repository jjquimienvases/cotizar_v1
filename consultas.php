<?

require "clases/Consulta2.php";
require "globals/variables.php";

$c = new Consulta();



function getPuntoVenta($user_rol) {

    $punto_de_venta = "";
    
  if ($user_rol == 10) {
        $punto_de_venta = "Call Center";
    } else if ($user_rol == 8) {
        $punto_de_venta = "mostradorjj";
    } else if ($user_rol == 9) {
        $punto_de_venta = "mostradord1";
    } else if ($user_id == 26) {
        $punto_de_venta = "mostrador_ibague_1";
    } else if ($user_id == 27) {
        $punto_de_venta = "mostrador_ibague_2";
    } else if ($user_id == 20) {
        $punto_de_venta = "Oficina";
    } else {
        $punto_de_venta = "Desarrollador";
    }

    return $punto_de_venta;
}



function cerrarCaja($session, $monto) {
    global $c, $soloFecha;

    $id = $session["userid"];
    $user = $session["user"];

    $punto_de_venta = getPuntoVenta($id);
    $sql = "INSERT INTO finish_day (usuario, punto_venta, id_rol_usuario, monto, order_date) VALUES ('$user', '$punto_de_venta', '$id', $monto, '$soloFecha');";
    $result = $c->exec($sql);
    
}



function isCajaCerrada($id, $fecha = null) {
    global $c, $soloFecha;

    $fechaQ = $fecha ? $fecha : $soloFecha;
    $usuarios = [8,9,26,27];
    
foreach($usuarios as $usuario){
    
    $num = $c->findOne("SELECT * FROM finish_day WHERE DATE(order_date) = '$fechaQ' AND id_rol_usuario = $usuario");
}

    return $num;
}

function isCajaCerradaLastDay($id) {
    global $c;

    $DOMINGO = "sunday";
    
    $lastday = getDateWithInterval(1, false);
    $twoDays = getDateWithInterval(2, false);
    $dow = getWeekDay($lastday);
    $dow2 = getWeekDay($twoDays);

    $caja = null;

    
    $cajaNoCerrada = false;
    $caja = isCajaCerrada($id, $lastday);
    
    if ($dow === $DOMINGO) {
        $caja = isCajaCerrada($id, $twoDays); 
        // print_r($caja);
    }
    
    return $caja;
}
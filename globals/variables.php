<?php


$soloFecha = date('Y-m-d');
$fechaYHora = date('Y-m-d H:i:s');

function getDateWithInterval(int $days, $after = true)
{
    if ($after) {
        return date("Y-m-d", strtotime("+$days day"));
    }
    return date("Y-m-d", strtotime("-$days day"));
}

function  getWeekDay($fecha = null)
{
    global $soloFecha;

    $unix = strtotime($fecha ?? $soloFecha);
    $dow = date("l", $unix);
    return strtolower($dow);
}

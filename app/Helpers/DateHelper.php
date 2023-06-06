<?php

use Carbon\Carbon;

function formatFecha($fecha)
{
    $now = Carbon::now();
    $fecha = Carbon::parse($fecha);
    Carbon::setLocale('es');

    if ($fecha->diffInDays($now) > 0) {
        return $fecha->isoFormat('LL'); // Ejemplo: 15 de octubre de 2022
    }
    return $fecha->locale('es')->diffForHumans(); // Ejemplo: hace 5 minutos
}

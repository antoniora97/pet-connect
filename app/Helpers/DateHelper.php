<?php

use Carbon\Carbon;

function formatFecha($fecha) {
    $now = Carbon::now();
    $fecha = Carbon::parse($fecha);
    Carbon::setLocale('es');

    if ($fecha->diffInDays($now) > 0) {
        return $fecha->isoFormat('LL'); // Ejemplo: 15 de octubre de 2022
    }
    return $fecha->locale('es')->diffForHumans(); // Ejemplo: hace 5 minutos
}

function timeFormat($fecha)
{
    $carbonFecha = Carbon::parse($fecha);
    $diferencia = $carbonFecha->diffForHumans(null, true, true, 2);

    $unidades = [
        'y' => 'a',
        'mo' => 'm',
        'w' => 's',
        'd' => 'd',
        'h' => 'h',
        'm' => 'min',
        's' => 'seg',
    ];

    foreach ($unidades as $unidad => $nombre) {
        if (str_contains($diferencia, $unidad)) {
            $valor = intval($diferencia);
            return $valor . $nombre;
        }
    }

    return $diferencia;
}

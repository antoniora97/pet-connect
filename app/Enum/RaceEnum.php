<?php

namespace App\Enum;

enum RaceEnum: int
{
    case PASTOR_MALINOIS = 1;
    case MASTIN = 2;
    case BODEGUERO = 3;

    public function name(): string
    {
        return match ($this) {
            RaceEnum::PASTOR_MALINOIS => 'Pastor malinois',
            RaceEnum::MASTIN => 'Mastín',
            RaceEnum::BODEGUERO => 'Bodeguero'
        };
    }
}

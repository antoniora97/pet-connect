<?php

namespace App\Enum;

enum RaceEnum: int
{
    case PASTOR_MALINOIS = 1;
    case MASTIN = 2;
    case BODEGUERO = 3;
    case PERRO_BARBILLA = 4;
    case SHAR_PEI = 5;
    case COCKER = 6;
    case AMERICAN_STANDFORD = 7;
    case YORKSHIRE = 8;

    public function name(): string
    {
        return match ($this) {
            RaceEnum::PASTOR_MALINOIS => 'Pastor Malinois',
            RaceEnum::MASTIN => 'Mastín',
            RaceEnum::PERRO_BARBILLA => 'Perro Barbilla',
            RaceEnum::SHAR_PEI => 'Shar Pei',
            RaceEnum::COCKER => 'Cocker',
            RaceEnum::AMERICAN_STANDFORD => 'American Standford',
            RaceEnum::YORKSHIRE => 'Yorkshire'
        };
    }
}

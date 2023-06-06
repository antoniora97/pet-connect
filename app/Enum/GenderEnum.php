<?php

namespace App\Enum;

enum GenderEnum: int
{
    case MALE = 1;
    case FEMALE = 2;

    public function name(): string
    {
        return match ($this) {
            GenderEnum::MALE => 'Macho',
            GenderEnum::FEMALE => 'Hembra'
        };
    }
}

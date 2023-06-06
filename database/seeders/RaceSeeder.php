<?php

namespace Database\Seeders;

use App\Enum\RaceEnum;
use App\Models\Race;
use Illuminate\Database\Seeder;

class RaceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Race::create([
            'id' => RaceEnum::PASTOR_MALINOIS,
            'name' => RaceEnum::PASTOR_MALINOIS->name()
        ]);

        Race::create([
            'id' => RaceEnum::MASTIN,
            'name' => RaceEnum::MASTIN->name()
        ]);

        Race::create([
            'id' => RaceEnum::BODEGUERO,
            'name' => RaceEnum::BODEGUERO->name()
        ]);
    }
}

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
            'id' => RaceEnum::PERRO_BARBILLA,
            'name' => RaceEnum::PERRO_BARBILLA->name()
        ]);

        Race::create([
            'id' => RaceEnum::SHAR_PEI,
            'name' => RaceEnum::SHAR_PEI->name()
        ]);

        Race::create([
            'id' => RaceEnum::COCKER,
            'name' => RaceEnum::COCKER->name()
        ]);

        Race::create([
            'id' => RaceEnum::AMERICAN_STANDFORD,
            'name' => RaceEnum::AMERICAN_STANDFORD->name()
        ]);

        Race::create([
            'id' => RaceEnum::YORKSHIRE,
            'name' => RaceEnum::YORKSHIRE->name()
        ]);
    }
}

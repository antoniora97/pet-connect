<?php

namespace Database\Seeders;

use App\Enum\GenderEnum;
use App\Models\Gender;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GenderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Gender::create([
            'id' => GenderEnum::MALE,
            'name' => GenderEnum::MALE->name()
        ]);

        Gender::create([
            'id' => GenderEnum::FEMALE,
            'name' => GenderEnum::FEMALE->name()
        ]);
    }
}

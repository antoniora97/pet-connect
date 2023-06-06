<?php

namespace Database\Seeders;

use App\Enum\GenderEnum;
use App\Enum\RaceEnum;
use App\Models\Pet;
use Illuminate\Database\Seeder;

class PetSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Pet::create([
            'id' => 1,
            'name' => 'timon',
            'username' => 'timonxulo',
            'biographie' => '',
            'profile_img' => 'timon.jpeg',
            'race_id' => RaceEnum::PASTOR_MALINOIS,
            'gender_id' => GenderEnum::MALE,
            'user_id' => 1
        ]);

        Pet::create([
            'id' => 2,
            'name' => 'pumba',
            'username' => 'pumbaxula',
            'biographie' => '',
            'profile_img' => 'pumba.jpeg',
            'race_id' => RaceEnum::BODEGUERO,
            'gender_id' => GenderEnum::FEMALE,
            'user_id' => 1
        ]);

        Pet::create([
            'id' => 3,
            'name' => 'faraon',
            'username' => 'faraonxulo',
            'biographie' => '',
            'profile_img' => 'faraon.jpeg',
            'race_id' => RaceEnum::MASTIN,
            'gender_id' => GenderEnum::MALE,
            'user_id' => 2
        ]);

        Pet::create([
            'id' => 4,
            'name' => 'anubis',
            'username' => 'anubona',
            'biographie' => '',
            'profile_img' => 'anubis.jpeg',
            'race_id' => RaceEnum::MASTIN,
            'gender_id' => GenderEnum::FEMALE,
            'user_id' => 3
        ]);

        Pet::create([
            'id' => 5,
            'name' => 'kovu',
            'username' => 'olekovu',
            'biographie' => '',
            'profile_img' => 'kovu.jpeg',
            'race_id' => RaceEnum::MASTIN,
            'gender_id' => GenderEnum::MALE,
            'user_id' => 4
        ]);

        Pet::create([
            'id' => 6,
            'name' => 'luna',
            'username' => 'lunalunita',
            'biographie' => '',
            'profile_img' => 'luna.jpeg',
            'race_id' => RaceEnum::MASTIN,
            'gender_id' => GenderEnum::MALE,
            'user_id' => 5
        ]);

        Pet::create([
            'id' => 7,
            'name' => 'lea',
            'username' => 'leaamopu',
            'biographie' => '',
            'profile_img' => 'lea.jpeg',
            'race_id' => RaceEnum::MASTIN,
            'gender_id' => GenderEnum::FEMALE,
            'user_id' => 6
        ]);
    }
}

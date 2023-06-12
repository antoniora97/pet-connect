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
            'biographie' => 'Recuerda quién eres. Eres más de lo que te conviertes.',
            'profile_img' => 'timon.jpeg',
            'race_id' => RaceEnum::PERRO_BARBILLA,
            'gender_id' => GenderEnum::MALE,
            'user_id' => 1
        ]);

        Pet::create([
            'id' => 2,
            'name' => 'pumba',
            'username' => 'pumbaxula',
            'biographie' => 'El pasado puede doler, pero tal como yo lo veo, puedes o huir de él o aprender.',
            'profile_img' => 'pumba.jpeg',
            'race_id' => RaceEnum::PASTOR_MALINOIS,
            'gender_id' => GenderEnum::FEMALE,
            'user_id' => 1
        ]);

        Pet::create([
            'id' => 3,
            'name' => 'faraon',
            'username' => 'faraonxulo',
            'biographie' => 'Todo lo que ves existe juntos en un delicado equilibrio.',
            'profile_img' => 'faraon.jpeg',
            'race_id' => RaceEnum::MASTIN,
            'gender_id' => GenderEnum::MALE,
            'user_id' => 2
        ]);

        Pet::create([
            'id' => 4,
            'name' => 'anubis',
            'username' => 'anubona',
            'biographie' => '¡Oh sí, el pasado puede doler! Pero, como yo lo veo, puedes o huir de él o aprender.',
            'profile_img' => 'anubis.jpeg',
            'race_id' => RaceEnum::AMERICAN_STANDFORD,
            'gender_id' => GenderEnum::FEMALE,
            'user_id' => 3
        ]);

        Pet::create([
            'id' => 5,
            'name' => 'kovu',
            'username' => 'olekovu',
            'biographie' => 'El ciclo de la vida continúa. Nosotros seremos reemplazados, tú debes llevar el legado.',
            'profile_img' => 'kovu.jpeg',
            'race_id' => RaceEnum::SHAR_PEI,
            'gender_id' => GenderEnum::MALE,
            'user_id' => 4
        ]);

        Pet::create([
            'id' => 6,
            'name' => 'luna',
            'username' => 'lunalunita',
            'biographie' => '¡Hakuna Matata! Es una forma de ser, sin preocupaciones lo tienes que entender.',
            'profile_img' => 'luna.jpeg',
            'race_id' => RaceEnum::COCKER,
            'gender_id' => GenderEnum::FEMALE,
            'user_id' => 5
        ]);

        Pet::create([
            'id' => 7,
            'name' => 'lea',
            'username' => 'leaamopu',
            'biographie' => 'Recuerda, nunca olvides quién eres.',
            'profile_img' => 'lea.jpeg',
            'race_id' => RaceEnum::PASTOR_MALINOIS,
            'gender_id' => GenderEnum::FEMALE,
            'user_id' => 6
        ]);

        Pet::create([
            'id' => 8,
            'name' => 'golfo',
            'username' => 'golfillo',
            'biographie' => 'Recuerda, nunca olvides quién eres.',
            'profile_img' => 'golfo.jpeg',
            'race_id' => RaceEnum::YORKSHIRE,
            'gender_id' => GenderEnum::MALE,
            'user_id' => 7
        ]);

        Pet::create([
            'id' => 9,
            'name' => 'lara',
            'username' => 'laraxula',
            'biographie' => 'Recuerda, nunca olvides quién eres.',
            'profile_img' => 'lara.jpeg',
            'race_id' => RaceEnum::YORKSHIRE,
            'gender_id' => GenderEnum::FEMALE,
            'user_id' => 7
        ]);

        Pet::create([
            'id' => 10,
            'name' => 'hancock',
            'username' => 'hancockxicle',
            'biographie' => 'Recuerda, nunca olvides quién eres.',
            'profile_img' => 'hancock.jpeg',
            'race_id' => RaceEnum::YORKSHIRE,
            'gender_id' => GenderEnum::MALE,
            'user_id' => 7
        ]);

        Pet::create([
            'id' => 11,
            'name' => 'jackie',
            'username' => 'jackiexan',
            'biographie' => 'Recuerda, nunca olvides quién eres.',
            'profile_img' => 'jackie.jpeg',
            'race_id' => RaceEnum::YORKSHIRE,
            'gender_id' => GenderEnum::FEMALE,
            'user_id' => 7
        ]);
    }
}

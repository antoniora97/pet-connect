<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'id' => 1,
            'person1_name' => 'Antonio Ramos',
            'person2_name' => 'Angie Ruiz',
            'profile_img' => 'default.png',
            'bg_image' => 'default.jpg',
            'biographie' => "Compartiendo risas y aventuras, abrazando cada momento juntos. 🌿🌼",
            'email' => 'aa@g.com',
            'password' => Hash::make('password')
        ]);

        User::create([
            'id' => 2,
            'person1_name' => 'Saray Viaña',
            'person2_name' => '',
            'profile_img' => 'default.png',
            'bg_image' => 'default.jpg',
            'biographie' => "Amor incondicional en cuatro patas. Mi vida con mascotas. 🐾❤️",
            'email' => 's@g.com',
            'password' => Hash::make('password')
        ]);

        User::create([
            'id' => 3,
            'person1_name' => 'Judit Copano',
            'person2_name' => '',
            'profile_img' => 'default.png',
            'bg_image' => 'default.jpg',
            'biographie' => "Aventuras diarias con mis peludos compañeros. ¡Mascotas en acción! 🐶🐱",
            'email' => 'j@g.com',
            'password' => Hash::make('password')
        ]);

        User::create([
            'id' => 4,
            'person1_name' => 'Gema Carpio',
            'person2_name' => '',
            'profile_img' => 'default.png',
            'bg_image' => 'default.jpg',
            'biographie' => "Risas, travesuras y mucho cariño. La vida junto a mis adorables mascotas. 🐾❤️",
            'email' => 'g@g.com',
            'password' => Hash::make('password')
        ]);

        User::create([
            'id' => 5,
            'person1_name' => 'Adrián Segura',
            'person2_name' => '',
            'profile_img' => 'default.png',
            'bg_image' => 'default.jpg',
            'biographie' => "Compañeros leales y travesuras interminables. Mi vida está llena de mascotas. 🐾😄",
            'email' => 'a@g.com',
            'password' => Hash::make('password')
        ]);

        User::create([
            'id' => 6,
            'person1_name' => 'Miguel Reyes',
            'person2_name' => '',
            'profile_img' => 'default.png',
            'bg_image' => 'default.jpg',
            'biographie' => "El hogar más feliz con mis peludos consentidos. Amor puro y travesuras aseguradas. 🏡🐾",
            'email' => 'm@g.com',
            'password' => Hash::make('password')
        ]);

        User::create([
            'id' => 99,
            'person1_name' => 'admin',
            'person2_name' => '',
            'profile_img' => 'default.png',
            'bg_image' => 'default.jpg',
            'biographie' => "",
            'email' => 'admin@admin.com',
            'password' => Hash::make('password')
        ]);
    }
}

<?php

namespace Database\Seeders;

use App\Models\Province;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CreateProvinceSeeder extends Seeder{
     /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $provinces = [
            [
                'id' => 1,
                'name' => 'Araba/Álava'
            ],
            [
                'id' => 2,
                'name' => 'Albacete'
            ],
            [
                'id' => 3,
                'name' => 'Alicante/Alacant'
            ],
            [
                'id' => 4,
                'name' => 'Almerí­a'
            ],
            [
                'id' => 5,
                'name' => 'Ávila'
            ],
            [
                'id' => 6,
                'name' => 'Badajoz'
            ],
            [
                'id' => 7,
                'name' => 'Balears, Illes'
            ],
            [
                'id' => 8,
                'name' => 'Barcelona'
            ],
            [
                'id' => 9,
                'name' => 'Burgos'
            ],
            [
                'id' => 10,
                'name' => 'Cáceres'
            ],
            [
                'id' => 11,
                'name' => 'Cádiz'
            ],
            [
                'id' => 12,
                'name' => 'Castellón/Castellà'
            ],
            [
                'id' => 13,
                'name' => 'Ciudad Real'
            ],
            [
                'id' => 14,
                'name' => 'Córdoba'
            ],
            [
                'id' => 15,
                'name' => 'Coruña, A'
            ],
            [
                'id' => 16,
                'name' => 'Cuenca'
            ],
            [
                'id' => 17,
                'name' => 'Girona'
            ],
            [
                'id' => 18,
                'name' => 'Granada'
            ],
            [
                'id' => 19,
                'name' => 'Guadalajara'
            ],
            [
                'id' => 20,
                'name' => 'Gipuzkoa'
            ],
            [
                'id' => 21,
                'name' => 'Huelva'
            ],
            [
                'id' => 22,
                'name' => 'Huesca'
            ],
            [
                'id' => 23,
                'name' => 'Jaén'
            ],
            [
                'id' => 24,
                'name' => 'León'
            ],
            [
                'id' => 25,
                'name' => 'Lleida'
            ],
            [
                'id' => 26,
                'name' => 'Rioja, La'
            ],
            [
                'id' => 27,
                'name' => 'Lugo'
            ],
            [
                'id' => 28,
                'name' => 'Madrid'
            ],
            [
                'id' => 29,
                'name' => 'Málaga'
            ],
            [
                'id' => 30,
                'name' => 'Murcia'
            ],
            [
                'id' => 31,
                'name' => 'Navarra'
            ],
            [
                'id' => 32,
                'name' => 'Ourense'
            ],
            [
                'id' => 33,
                'name' => 'Asturias'
            ],
            [
                'id' => 34,
                'name' => 'Palencia'
            ],
            [
                'id' => 35,
                'name' => 'Palmas, Las'
            ],
            [
                'id' => 36,
                'name' => 'Pontevedra'
            ],
            [
                'id' => 37,
                'name' => 'Salamanca'
            ],
            [
                'id' => 38,
                'name' => 'Santa Cruz de Tenerife'
            ],
            [
                'id' => 39,
                'name' => 'Cantabria'
            ],
            [
                'id' => 40,
                'name' => 'Segovia'
            ],
            [
                'id' => 41,
                'name' => 'Sevilla'
            ],
            [
                'id' => 42,
                'name' => 'Soria'
            ],
            [
                'id' => 43,
                'name' => 'Tarragona'
            ],
            [
                'id' => 44,
                'name' => 'Teruel'
            ],
            [
                'id' => 45,
                'name' => 'Toledo'
            ],
            [
                'id' => 46,
                'name' => 'Valencia/València'
            ],
            [
                'id' => 47,
                'name' => 'Valladolid'
            ],
            [
                'id' => 48,
                'name' => 'Bizkaia'
            ],
            [
                'id' => 49,
                'name' => 'Zamora'
            ],
            [
                'id' => 50,
                'name' => 'Zaragoza'
            ],
            [
                'id' => 51,
                'name' => 'Ceuta'
            ],
            [
                'id' => 52,
                'name' => 'Melilla'
            ],
        ];

        foreach ($provinces as $province) {
            Province::create($province);
        }
    }
}

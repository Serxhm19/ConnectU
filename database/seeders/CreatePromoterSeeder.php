<?php

namespace Database\Seeders;

use App\Models\promoter;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CreatePromoterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $promoters = [
            [
                'NIF' => '1234656',
                'user' => 1,
                'name' => 'Promoter 1',
                'description' => 'Description promoter 1',
                'email' => 'email@promoter.com',
                'category_id' => 1,
                'password' => bcrypt('12345678')
            ],
            [
                'NIF' => '1256456',
                'user' => 3,
                'name' => 'Promoter 2',
                'description' => 'Description promoter 2',
                'email' => 'email@promoter.com',
                'category_id' => 2,
                'password' => bcrypt('12345678')

            ],
            [
                'NIF' => '5241646',
                'user' => 2,
                'name' => 'Promoter 3',
                'description' => 'Description promoter 3',
                'email' => 'email@promoter.com',
                'category_id' => 3,
                'password' => bcrypt('12345678')

            ],
        ];

        foreach ($promoters as $promoter) {
            promoter::create($promoter);
        }
    }
}

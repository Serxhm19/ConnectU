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
                'NIF' => 1,
                'name' => 'Promoter 1',
                'description' => 'Description promoter 1',
                'category_id' => 1
            ],
            [
                'NIF' => 2,
                'name' => 'Promoter 2',
                'description' => 'Description promoter 2',
                'category_id' => 2
            ],
            [
                'NIF' => 3,
                'name' => 'Promoter 3',
                'description' => 'Description promoter 3',
                'category_id' => 3
            ],
        ];

        foreach ($promoters as $promoter) {
            promoter::create($promoter);
        }
    }
}

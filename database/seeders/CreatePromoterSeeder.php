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
                'name' => '2024-06-10',
                'description' => 'Description promoter 1',
                'category_id' => ''
            ],
            [
                'NIF' => 2,
                'name' => '2024-02-28',
                'description' => 'Description promoter 2',
                'category_id' => ''
            ],
            [
                'NIF' => 3,
                'name' => '2024-01-15',
                'description' => 'Description promoter 3',
                'category_id' => ''
            ],
        ];

        foreach ($promoters as $promoter) {
            promoter::create($promoter);
        }
    }
}

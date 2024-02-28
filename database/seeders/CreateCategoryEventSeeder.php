<?php

namespace Database\Seeders;

use App\Models\category_event;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CreateCategoryEventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                'id' => 1,
                'name' => 'category1',
                'description' => 'desc category1'
            ],
            [
                'id' => 2,
                'name' => 'category2',
                'description' => 'desc category2'
            ],
            [
                'id' => 3,
                'name' => 'category3',
                'description' => 'desc category3'
            ],
        ];

        foreach ($categories as $category) {
            category_event::create($category);
        }
    }
}

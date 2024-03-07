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
                "id"=> 1,
                "name"=> "conference",
                "description"=> "Events where talks, panel discussions, and presentations on specific topics take place, both in person and online."
            ],
            [
                "id"=> 2,
                "name"=> "workshop",
                "description"=> "Intensive learning sessions focused on specific skills, such as cooking workshops, professional development seminars, etc."
            ],
            [
                "id"=> 3,
                "name"=> "trade fair",
                "description"=> "Events where companies and organizations showcase their products, services, or ideas, both in physical and virtual environments."
            ],
            [
                "id"=> 4,
                "name"=> "live performance",
                "description"=> "Live musical, theatrical, dance, or other forms of entertainment presentations."
            ],
            [
                "id"=> 5,
                "name"=> "sports event",
                "description"=> "Sports competitions, tournaments, races, and other sports-related events."
            ],
            [
                "id"=> 6,
                "name"=> "professional meeting",
                "description"=> "Opportunities to network, exchange ideas, and collaborate with other professionals in your field."
            ],
            [
                "id"=> 7,
                "name"=> "cultural event",
                "description"=> "Art exhibitions, cultural festivals, film screenings, poetry readings, etc."
            ],
            [
                "id"=> 8,
                "name"=> "gastronomic event",
                "description"=> "Wine tastings, food festivals, cooking classes, gastronomic tours, etc."
            ],
            [
                "id"=> 9,
                "name"=> "lifestyle event",
                "description"=> "Yoga classes, meditation retreats, health and wellness fairs, etc."
            ],
            [
                "id"=> 10,
                "name"=> "family event",
                "description"=> "Activities and entertainment designed for families and children, such as magic shows, picnics, etc."
            ]
        ];

        foreach ($categories as $category) {
            category_event::create($category);
        }
    }
}

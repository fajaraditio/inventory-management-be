<?php

namespace Database\Seeders;

use App\Models\ProductCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $productCategoryList = [
            [
                'name' => 'AC RAC',
                'description' => 'AC RAC stands for air conditioner that is installed through a window or wall and is usually in the shape of a rectangle or square. It can either cool or heat a single room, and the air is distributed through ventilation in the front of the unit.',
            ],
            [
                'name' => 'AC LCAC',
                'description' => 'LCAC stands for Light Commercial Air Conditioner. The features in LCAC are build-in drain pump, LED Display, Fireproof and airproof electric box and Turbo cooling',
            ],
        ];

        foreach ($productCategoryList as $productCategoryItem) {
            ProductCategory::firstOrCreate($productCategoryItem);
        }
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ProductCategory; // Ensure this is the correct namespace for your model

class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            "jewelery",
            "electronics",
            "men's clothing",
            "women's clothing",
            "Other"
        ];

        foreach ($categories as $category) {
            $obj = new ProductCategory();
            $obj->category = $category;
            $obj->save();
        }
    }
}

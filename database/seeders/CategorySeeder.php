<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Technology',
            'Lifestyle',
            'Education',
            'Health & Fitness',
            'Travel',
            'Food',
            'Business',
            'Entertainment',
            'Fashion',
            'Sports',
        ];

        foreach ($categories as $category) {
            Category::updateOrCreate(
                ['slug' => Str::slug($category)],
                [
                    'title' => $category,
                    'description' => $category . ' related blogs and articles.',
                ]
            );
        }
    }
}

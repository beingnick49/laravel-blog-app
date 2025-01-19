<?php

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\Category;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        Category::truncate();
        Blog::truncate();
        User::truncate();
        Schema::enableForeignKeyConstraints();

        $this->call([
            CategorySeeder::class,
            UserSeeder::class,
            BlogSeeder::class,
        ]);
    }
}

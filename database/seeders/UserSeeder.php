<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::updateOrCreate(['email' => "admin@blog.com"], [
            'name' => "admin",
            'username' => "admin",
            'email' => "admin@blog.com",
            'password' => Hash::make("secret"),
            'role' => 'admin',
            'status' => 1,
        ]);

        User::updateOrCreate(['email' => "user1@blog.com"], [
            'name' => "user1",
            'username' => "user1",
            'email' => "user1@blog.com",
            'password' => Hash::make("secret"),
        ]);

        User::updateOrCreate(['email' => "user2@blog.com"], [
            'name' => "user2",
            'username' => "user2",
            'email' => "user2@blog.com",
            'password' => Hash::make("secret"),
        ]);
    }
}

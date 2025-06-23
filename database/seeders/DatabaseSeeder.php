<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Category;
use App\Models\Course;
use App\Models\Review;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Ensure a user with ID 1 exists for review fallback
        User::updateOrCreate(
            ['id' => 1],
            [
                'name' => 'Test User',
                'email' => 'test@example.com',
                'password' => bcrypt('password'),
            ]
        );

        User::factory(10)->create();
        Author::factory(10)->create();
        Category::factory(5)->create();

        // Create courses, which depend on authors and categories
        Course::factory(25)->create();

        // Create reviews, which depend on users and courses
        Review::factory(100)->create();


    }
}
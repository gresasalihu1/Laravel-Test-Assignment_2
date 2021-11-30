<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\Comment\CommentsTableSeeder;
use Database\Seeders\Post\PostsTableSeeder;
use Database\Seeders\User\UsersTableSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([UsersTableSeeder::class]);
        $this->call([PostsTableSeeder::class]);
        $this->call([CommentsTableSeeder::class]);
    }
}

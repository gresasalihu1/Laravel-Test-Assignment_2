<?php

namespace Database\Seeders\Post;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('posts')->insert([
            [
                'id' => '1',
                'title' => 'Titulli1',
                'description' => 'Description1',
                'user_id' => '1',
                'image' => 'lala',
            ], [
                'id' => '2',
                'title' => 'Titulli2',
                'description' => 'Description2',
                'user_id' => '1',
                'image' => 'lalala',
            ]
        ]);
    }
}

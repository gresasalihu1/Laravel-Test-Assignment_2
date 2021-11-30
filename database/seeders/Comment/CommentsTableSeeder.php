<?php

namespace Database\Seeders\Comment;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('comments')->insert([
            [
                'id' => '1',
                'user_id' => '1',
                'post_id' => '1',
                'message' => 'udwhqiduhqwiudh',
            ], [
                'id' => '2',
                'user_id' => '2',
                'post_id' => '2',
                'message' => 'hciwuhciwuhciuwhichu',
            ]
        ]);
    }
}

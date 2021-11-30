<?php

namespace Database\Seeders\User;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'id' => '1',
                'first_name' => 'Gresa',
                'last_name' => 'Salihu',
                'email' => 'gresas@gmail.com',
                'password' => bcrypt('Gresa123'),
            ], [
                'id' => '2',
                'first_name' => 'Era',
                'last_name' => 'Salihu',
                'email' => 'eras@gmail.com',
                'password' => bcrypt('Era12345'),
            ]
        ]);
    }
}

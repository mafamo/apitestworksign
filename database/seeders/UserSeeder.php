<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Test 1',
            'email' => 'test1@test.com',
            'created_at' => '2022-05-01 09:00:00',
            'updated_at' => '2022-05-01 09:00:00'
        ]);
        DB::table('users')->insert([
            'name' => 'Test 2',
            'email' => 'test2@test.com',
            'created_at' => '2022-05-01 10:00:00',
            'updated_at' => '2022-05-01 10:00:00'
        ]);
    }
}

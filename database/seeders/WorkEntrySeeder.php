<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WorkEntrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('work_entries')->insert([
            'user_id' => 1,
            'start_date' => '2022-05-01 10:00:00',
            'end_date' => '2022-05-01 18:00:00',
            'created_at' => '2022-05-01 09:00:00',
            'updated_at' => '2022-05-01 09:00:00'
        ]);
        DB::table('work_entries')->insert([
            'user_id' => 2,
            'start_date' => '2022-05-01 10:00:00',
            'end_date' => '2022-05-01 18:00:00',
            'created_at' => '2022-05-01 09:00:00',
            'updated_at' => '2022-05-01 09:00:00'
        ]);
        DB::table('work_entries')->insert([
            'user_id' => 1,
            'start_date' => '2022-05-02 10:00:00',
            'end_date' => '2022-05-02 18:00:00',
            'created_at' => '2022-05-02 09:00:00',
            'updated_at' => '2022-05-02 09:00:00'
        ]);
        DB::table('work_entries')->insert([
            'user_id' => 1,
            'start_date' => '2022-05-03 10:00:00',
            'created_at' => '2022-05-03 09:00:00',
            'updated_at' => '2022-05-03 09:00:00'
        ]);
    }
}

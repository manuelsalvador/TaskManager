<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StateTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        DB::table('states')->insert([
            'state' => 'Backlog',
        ]);

        DB::table('states')->insert([
            'state' => 'To do',
        ]);

        DB::table('states')->insert([
            'state' => 'In progress',
        ]);

        DB::table('states')->insert([
            'state' => 'Done',
        ]);
    }
}

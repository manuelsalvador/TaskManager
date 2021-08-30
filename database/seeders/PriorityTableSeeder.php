<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PriorityTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('priorities')->insert([
            'priority' => 'Low',
        ]);

        DB::table('priorities')->insert([
            'priority' => 'Medium',
        ]);

        DB::table('priorities')->insert([
            'priority' => 'High',
        ]);
    }
}

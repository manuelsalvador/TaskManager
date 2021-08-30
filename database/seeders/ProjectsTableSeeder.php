<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;

use Illuminate\Database\Seeder;

class ProjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('projects')->insert([
            'title' => 'Progetto bello',
            'description' => 'Un bellissimo progetto, il più bello dei progetti',
            'customer_id' => '1'
        ]);

    }
}

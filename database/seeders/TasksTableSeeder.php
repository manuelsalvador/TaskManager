<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TasksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tasks')->insert([
            'title' => 'Task di prova',
            'description' => 'Una descrizione per un di prova',
            'priority' => '1',
            'state' => '1',
            'user_id' => null,
            'project_id' => '1',
        ]);
    }
}

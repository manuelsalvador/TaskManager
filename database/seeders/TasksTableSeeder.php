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
            'title' => 'task di prova',
            'description' => 'una bella descrizione per un bel task di prova',
            'priority' => '1',
            'state' => '1',
            'developer_id' => '2',
            'project_id' => '1',
        ]);
    }
}

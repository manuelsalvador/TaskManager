<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('customers')->insert([
            'name' => 'Mark',
            'surname' => 'Antonio',
            'address' => 'via di qui',
            'phone' => '0432111111',
            'email' => 'mark@antonio.it',
        ]);
    }
}

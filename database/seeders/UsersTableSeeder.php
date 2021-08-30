<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

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
            'name'=>'Manuel',
            'email'=>'manuel@pm.it',
            'role'=>'1',
            'password'=>Hash::make('12345678')
        ]);

        DB::table('users')->insert([
            'name'=>'Mario',
            'email'=>'mario@dev1.it',
            'role'=>'2',
            'password'=>Hash::make('12345678')
        ]);
    }
}

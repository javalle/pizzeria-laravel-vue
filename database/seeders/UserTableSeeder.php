<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@pizzeria.com',
            'password' => \bcrypt('12345'),
        ]);
        
        DB::table('users')->insert([
            'name' => 'pep',
            'email' => 'pepe@cliente.com',
            'password' => \bcrypt('pepepepe'),
        ]);
        
    }
}

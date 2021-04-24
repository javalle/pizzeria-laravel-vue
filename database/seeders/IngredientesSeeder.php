<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Ingredientes;
use Illuminate\Support\Facades\DB;

class IngredientesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ingredientes')->truncate();
        DB::table('ingredientes')->insert([
            'nombre' => 'peperoni'
        ]);
        DB::table('ingredientes')->insert([
            'nombre' => 'tomate'
        ]);
        DB::table('ingredientes')->insert([
            'nombre' => 'queso'
        ]);
        DB::table('ingredientes')->insert([
            'nombre' => 'oregano'
        ]);
    }
}

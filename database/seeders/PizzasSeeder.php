<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Pizzas;
use Illuminate\Support\Facades\DB;

class PizzasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pizzas')->truncate();
        DB::table('pizzas')->insert([
            'name' => 'peperoni',
            'precio' => 3,
            'imagen' =>  '',
            'ingredientes' => 'peperoni,tomate,queto,oregano'
        ]);
        DB::table('pizzas')->insert([
            'name' => 'margarita',
            'precio' => 2,
            'imagen' => '',
            'ingredientes' => 'tomate,queto,oregano'
        ]);     

    }
}

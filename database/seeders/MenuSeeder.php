<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Seeder;


class MenuSeeder extends Seeder
{
    public function run()
    {
        Menu::insert([
            ['name' => 'Kopi Hitam', 'type' => 'drink', 'price' => 10000],
            ['name' => 'Teh Manis', 'type' => 'drink', 'price' => 8000],
            ['name' => 'Roti Bakar', 'type' => 'food', 'price' => 15000],
            ['name' => 'Mie Goreng', 'type' => 'food', 'price' => 18000],
        ]);
    }
}


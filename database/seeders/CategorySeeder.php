<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if(!Category::where('name', 'Informática')->first()) {
            Category::create([
                'name' => 'Informática',
                'cadastrado_por' => 1
            ]);
        }

        if(!Category::where('name', 'Celulares e Smartphones')->first()) {
            Category::create([
                'name' => 'Celulares e Smartphones',
                'cadastrado_por' => 1
            ]);
        }

        if(!Category::where('name', 'Eletrodomésticos')->first()) {
            Category::create([
                'name' => 'Eletrodomésticos',
                'cadastrado_por' => 1
            ]);
        }

        if(!Category::where('name', 'Móveis')->first()) {
            Category::create([
                'name' => 'Móveis',
                'cadastrado_por' => 1
            ]);
        }

        if(!Category::where('name', 'Moda')->first()) {
            Category::create([
                'name' => 'Moda',
                'cadastrado_por' => 1
            ]);
        }
    }
}

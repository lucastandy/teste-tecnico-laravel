<?php

namespace Database\Seeders;

use App\Models\Products;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        if(!Products::where('name', 'Mouse')->first()) {
            Products::create([
                'name' => 'Mouse',
                'category_id' => 1,
                'description' => 'Mouse simples',
                'purchase_price'=> 30.00,
                'sale_price'=> 39,
                'stock_quantity'=> 20,
                'image_path' => 'mouse.jpeg',
                'cadastrado_por' => 1
            ]);
        }

        if(!Products::where('name', 'Teclado')->first()) {
            Products::create([
                'name' => 'Teclado',
                'category_id' => 1,
                'description' => 'Teclado para computador',
                'purchase_price'=> 50,
                'sale_price'=> 56,
                'stock_quantity'=> 30,
                'image_path' => 'teclado.png',
                'cadastrado_por' => 1
            ]);
        }

        if(!Products::where('name', 'Monitor')->first()) {
            Products::create([
                'name' => 'Monitor',
                'category_id' => 1,
                'description' => 'Monitor para computador',
                'purchase_price'=> 1200.00,
                'sale_price'=> 1800.00,
                'stock_quantity'=> 25,
                'image_path' => 'monitor.png',
                'cadastrado_por' => 1
            ]);
        }

        if(!Products::where('name', 'Celular Samsung')->first()) {
            Products::create([
                'name' => 'Celular Samsung',
                'category_id' => 2,
                'description' => 'Celular Samsung útima geração',
                'purchase_price'=> 7999.00,
                'sale_price'=> 9499.00,
                'stock_quantity'=> 50,
                'image_path' => 'celular_samsung.png',
                'cadastrado_por' => 1
            ]);
        }

        if(!Products::where('name', 'iPhone')->first()) {
            Products::create([
                'name' => 'iPhone',
                'category_id' => 2,
                'description' => 'iPhone útima geração',
                'purchase_price'=> 8999.00,
                'sale_price'=> 10999.00,
                'stock_quantity'=> 40,
                'image_path' => 'iphone.png',
                'cadastrado_por' => 1
            ]);
        }

        if(!Products::where('name', 'Smartphone Motorola')->first()) {
            Products::create([
                'name' => 'Smartphone Motorola',
                'category_id' => 2,
                'description' => 'Smartphone Motorola 5º geração',
                'purchase_price'=> 1300.00,
                'sale_price'=> 1650.00,
                'stock_quantity'=> 15,
                'image_path' => 'smartphone_motorola.png',
                'cadastrado_por' => 1
            ]);
        }

        if(!Products::where('name', 'Galadeira')->first()) {
            Products::create([
                'name' => 'Geladeira',
                'category_id' => 3,
                'description' => 'Geladeira simples',
                'purchase_price'=> 2800.00,
                'sale_price'=> 3500.00,
                'stock_quantity'=> 15,
                'image_path' => 'geladeira.png',
                'cadastrado_por' => 1
            ]);
        }

        if(!Products::where('name', 'Fogão')->first()) {
            Products::create([
                'name' => 'Fogão',
                'category_id' => 3,
                'description' => 'Fogão moderno',
                'purchase_price'=> 650.00,
                'sale_price'=> 800.00,
                'stock_quantity'=> 30,
                'image_path' => 'fogao.png',
                'cadastrado_por' => 1
            ]);
        }

        if(!Products::where('name', 'Máquina de lavar')->first()) {
            Products::create([
                'name' => 'Maquina de lavar',
                'category_id' => 3,
                'description' => 'Máquina de lavar Roupa 10 kg',
                'purchase_price'=> 1800.00,
                'sale_price'=> 2500.00,
                'stock_quantity'=> 25,
                'image_path' => 'maquina_lavar.png',
                'cadastrado_por' => 1
            ]);
        }

        if(!Products::where('name', 'Mesa de Jantar')->first()) {
            Products::create([
                'name' => 'Mesa de Jantar',
                'category_id' => 4,
                'description' => 'Mesa de Jantar 6 cadeiras',
                'purchase_price'=> 800.00,
                'sale_price'=> 1200.00,
                'stock_quantity'=> 12,
                'image_path' => 'mesa_jantar.png',
                'cadastrado_por' => 1
            ]);
        }

        if(!Products::where('name', 'Cama')->first()) {
            Products::create([
                'name' => 'Cama',
                'category_id' => 4,
                'description' => 'Cama de casal',
                'purchase_price'=> 1200.00,
                'sale_price'=> 1500.00,
                'stock_quantity'=> 35,
                'image_path' => 'cama.png',
                'cadastrado_por' => 1
            ]);
        }

        if(!Products::where('name', 'Sofá')->first()) {
            Products::create([
                'name' => 'Sofá',
                'category_id' => 4,
                'description' => 'Sofá Retrátil 3 lugares',
                'purchase_price'=> 2200.00,
                'sale_price'=> 3000.00,
                'stock_quantity'=> 8,
                'image_path' => 'sofa.png',
                'cadastrado_por' => 1
            ]);
        }

        if(!Products::where('name', 'Calça')->first()) {
            Products::create([
                'name' => 'Calça',
                'category_id' => 5,
                'description' => 'Calça última coleção',
                'purchase_price'=> 150.00,
                'sale_price'=> 250.00,
                'stock_quantity'=> 100,
                'image_path' => 'calca.png',
                'cadastrado_por' => 1
            ]);
        }

        if(!Products::where('name', 'Blusa')->first()) {
            Products::create([
                'name' => 'Blusa',
                'category_id' => 5,
                'description' => 'Blusa coleção inverno',
                'purchase_price'=> 250.00,
                'sale_price'=> 400.00,
                'stock_quantity'=> 150,
                'image_path' => 'blusa.png',
                'cadastrado_por' => 1
            ]);
        }
    }
}

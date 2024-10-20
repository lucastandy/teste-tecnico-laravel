<?php

namespace Database\Seeders;

use App\Models\Customers;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if(!Customers::where('email', 'joaopaulo@gmail.com')->first()) {

            Customers::create([
                'name' => 'João Paulo',
                'email' => 'joaopaulo@gmail.com',
                'cpf' => '123.456.789-01',
                'phone' =>'(88) 98956-8599',
                'cadastrado_por' => 1
            ]);
            
        }

        if(!Customers::where('email', 'mariaaraujo@gmail.com')->first()) {

            Customers::create([
                'name' => 'Maria Araújo',
                'email' => 'mariaaraujo@gmail.com',
                'cpf' => '256.789.123-01',
                'phone' =>'(88) 98911-8897',
                'cadastrado_por' => 1
            ]);
            
        }

        if(!Customers::where('email', 'joseantonio@gmail.com')->first()) {

            Customers::create([
                'name' => 'José Antônio',
                'email' => 'joseantonio@gmail.com',
                'cpf' => '115.523.789-01',
                'phone' =>'(88) 98941-8297',
                'cadastrado_por' => 1
            ]);
            
        }

        if(!Customers::where('email', 'manoelaaguiar@gmail.com')->first()) {

            Customers::create([
                'name' => 'Manoela Aguiar',
                'email' => 'manoelaaguiar@gmail.com',
                'cpf' => '558.639.123-01',
                'phone' =>'(88) 9889-8365',
                'cadastrado_por' => 1
            ]);
            
        }

        if(!Customers::where('email', 'adrianosilva@gmail.com')->first()) {

            Customers::create([
                'name' => 'Adriano Silva',
                'email' => 'adrianosilva@gmail.com',
                'cpf' => '785.159.123-01',
                'phone' =>'(88) 9855-7594',
                'cadastrado_por' => 1
            ]);
            
        }
    }
}

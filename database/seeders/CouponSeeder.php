<?php

namespace Database\Seeders;

use App\Models\Coupons;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CouponSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if(!Coupons::where('code', 'GANHEI5')->first()) {
            Coupons::create([
                'code' => 'GANHEI5',
                'discount' => 0.05,
                'expires_at' => '2024-10-25',
                'cadastrado_por' => 1
            ]);
        }

        if(!Coupons::where('code', 'GANHEI10')->first()) {
            Coupons::create([
                'code' => 'GANHEI10',
                'discount' => 0.10,
                'expires_at' => '2024-10-26',
                'cadastrado_por' => 1
            ]);
        }

        if(!Coupons::where('code', 'GANHEI15')->first()) {
            Coupons::create([
                'code' => 'GANHEI15',
                'discount' => 0.15,
                'expires_at' => '2024-10-27',
                'cadastrado_por' => 1
            ]);
        }

        if(!Coupons::where('code', 'GANHEI20')->first()) {
            Coupons::create([
                'code' => 'GANHEI20',
                'discount' => 0.20,
                'expires_at' => '2024-10-28',
                'cadastrado_por' => 1
            ]);
        }
    }
}

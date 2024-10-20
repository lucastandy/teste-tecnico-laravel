<?php

namespace Database\Seeders;

use App\Models\StatusModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Status extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if(!StatusModel::where('name', 'em aberto')->first()) {
            StatusModel::create([
                'name' => 'em aberto',
            ]);
        }

        if(!StatusModel::where('name', 'Finalizada')->first()) {
            StatusModel::create([
                'name' => 'Finalizada',
            ]);
        }
    }
}

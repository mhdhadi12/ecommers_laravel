<?php

namespace Database\Seeders;
use App\Models\Ssatuan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SsatuanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Ssatuan::create([
            'nama'=> 'Helai',
         ]);
    }
}
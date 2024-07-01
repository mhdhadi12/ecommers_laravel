<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'nama' => 'hadi',
            'email' => 'hadiparker12@gmail.com',
            'role' => 'Admin',
            'password' => Hash::make('hadi123'),
            'no_hp' => 81234567890,
            'alamat' => 'aksnfasnfaskfnaskj',
        ]);

        User::create([
            'nama' => 'hadi',
            'email' => 'muhammadhdi125@gmail.com',
            'role' => 'Customer',
            'password' => Hash::make('hadi125'),
            'no_hp' => 81234567890,
            'alamat' => 'aksnfasnfaskfnaskj',
        ]);
    }
}

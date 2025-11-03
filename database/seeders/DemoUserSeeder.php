<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class DemoUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'demo@huit.edu.vn'],
            [
                'name' => 'Demo User',
                'password' => Hash::make('password123'),
            ]
        );
    }
}

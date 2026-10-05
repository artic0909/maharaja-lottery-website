<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed Master Admin User
        User::updateOrCreate(
            ['email' => 'admin@mail.com'],
            [
                'name' => 'Master Admin',
                'password' => Hash::make('12345678'),
                'email_verified_at' => now(),
            ]
        );
    }
}

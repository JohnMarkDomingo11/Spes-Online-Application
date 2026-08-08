<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        // Create the single admin account
        if (! User::where('email', 'pesocamalaniugan@gmail.com')->exists()) {
            User::create([
                'name'     => 'PESO Admin',
                'username' => 'pesoadmin',
                'email'    => 'pesocamal@gmail.com',
                'password' => Hash::make('admin123'),
                'role'     => 'admin',
            ]);
        }
    }
}

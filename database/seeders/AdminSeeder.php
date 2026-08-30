<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        $adminEmail = 'lgulallo@gmail.com';

        $admin = User::where('email', $adminEmail)
            ->orWhere('username', 'pesoadmin')
            ->first();

        if ($admin) {
            $admin->email = $adminEmail;
            $admin->role = 'admin';
            $admin->username = $admin->username ?: 'pesoadmin';
            $admin->save();

            return;
        }

        User::create([
            'name'     => 'PESO Admin',
            'username' => 'pesoadmin',
            'email'    => $adminEmail,
            'password' => Hash::make('admin123'),
            'role'     => 'admin',
        ]);
    }
}

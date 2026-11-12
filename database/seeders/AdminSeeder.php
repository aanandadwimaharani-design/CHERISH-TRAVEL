<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        $adminEmail = env('ADMIN_EMAIL', 'admin@cherishtravel.com');
        $adminUsername = env('ADMIN_USERNAME', 'admin');
        $adminPassword = env('ADMIN_PASSWORD');

        if (!$adminPassword) {
            $adminPassword = Str::random(20);
            echo "Admin password generated: {$adminPassword}" . PHP_EOL;
            echo "Simpan password ini. Anda dapat mengubahnya melalui .env (ADMIN_PASSWORD)." . PHP_EOL;
        }

        User::updateOrCreate(
            ['email' => $adminEmail],
            [
                'name' => 'Admin CHERISH TRAVEL',
                'username' => $adminUsername,
                'password' => Hash::make($adminPassword),
                'role' => 'admin',
                'email_verified_at' => now(),
            ]
        );
    }
}

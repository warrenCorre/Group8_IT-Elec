<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create admin user
        User::firstOrCreate(
            ['email' => 'admin@group8.com'],
            [
                'name'       => 'Admin',
                'password'   => Hash::make('admin1234'),
                'is_admin'   => 1,
            ]
        );

        // Create member users matching the members table emails
        $memberUsers = [
            ['name' => 'Michael Salvado', 'email' => 'michael.salvado@group8.com', 'password' => Hash::make('password'), 'is_admin' => 0],
            ['name' => 'Jefril Intima',   'email' => 'jefril.intima@group8.com',   'password' => Hash::make('password'), 'is_admin' => 0],
            ['name' => 'Flor Albert Asa', 'email' => 'flor.asa@group8.com',        'password' => Hash::make('password'), 'is_admin' => 0],
            ['name' => 'Leandro Tuyor',   'email' => 'leandro.tuyor@group8.com',   'password' => Hash::make('password'), 'is_admin' => 0],
            ['name' => 'Juster Loreto',   'email' => 'juster.loreto@group8.com',   'password' => Hash::make('password'), 'is_admin' => 0],
            ['name' => 'Axel Jay Laride', 'email' => 'axel.laride@group8.com',     'password' => Hash::make('password'), 'is_admin' => 0],
        ];

        foreach ($memberUsers as $user) {
            User::firstOrCreate(['email' => $user['email']], $user);
        }

        // Seed member cards
        $this->call(MembersTableSeeder::class);
    }
}

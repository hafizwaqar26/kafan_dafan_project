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
        // Locations (countries → union councils)
        $this->call([
            LocationSeeder::class,
        ]);

        // Default admin user
        User::updateOrCreate(
            ['email' => 'admin@dawateislami.org'],
            [
                'name'     => 'Admin',
                'password' => Hash::make('123456'),
            ]
        );
    }
}
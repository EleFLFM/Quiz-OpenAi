<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $this->call(RoleSeeder::class);

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@test.com',
            'password' => Hash::make('test'),
        ])->assignRole('Administrador');


        User::factory()->create([
            'name' => 'Fray Herrera',
            'email' => 'Fray@gmail.com',
            'password' => Hash::make('123456789'),
        ])->assignRole('Administrador');
    }
}

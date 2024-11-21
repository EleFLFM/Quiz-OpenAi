<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Llama al RoleSeeder
        $this->call(RoleSeeder::class);

        // Crea un usuario administrador
        $admin = User::firstOrCreate(
            ['email' => 'test@test.com'],
            [
                'name' => 'Test User',
                'password' => Hash::make('test'),
            ]
        );

        // Asignar el rol de administrador al usuario
        $admin->assignRole('Administrador');
    }
}

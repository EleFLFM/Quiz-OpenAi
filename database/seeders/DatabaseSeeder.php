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
        // Llama al RoleSeeder para crear los roles
        $this->call(RoleSeeder::class);

        // Crear un único usuario administrador
        $admin = User::factory()->create([
            'name' => 'test',
            'email' => 'test@test.com',
            'password' => Hash::make('test'),  // Cambia la contraseña a algo seguro
        ]);
        $admin->assignRole('Administrador');

        // Crear varios usuarios estudiantes
        User::factory(10)->create()->each(function ($user) {
            $user->assignRole('usuario');
        });
        $this->call(TestResultsTableSeeder::class);

    }
}

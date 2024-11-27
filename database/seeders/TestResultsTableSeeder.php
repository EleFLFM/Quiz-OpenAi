<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TestResult;
use App\Models\User;

class TestResultsTableSeeder extends Seeder
{
    public function run()
    {
        // Asegúrate de que haya usuarios en la base de datos
        $users = User::all();

        // Si no hay usuarios, crea algunos de ejemplo
        if ($users->isEmpty()) {
            $users = User::factory(10)->create(); // Genera 10 usuarios con un factory
            $this->command->info('Se generaron 10 usuarios ficticios para los resultados.');
        }

        // Lista de temas posibles
        $temas = [
            'Variables',
            'Condicionales',
            'Bucles',
            'Funciones',
            'POO (Programación Orientada a Objetos)',
            'Bases de Datos',
            'APIs',
        ];

        // Generar resultados para cada usuario
        foreach ($users as $user) {
            TestResult::create([
                'user_id' => $user->id,
                'calificacion' => rand(5, 10) . '/10', // Calificación aleatoria entre 5/10 y 10/10
                'puntaje' => rand(50, 100), // Puntaje aleatorio entre 50% y 100%
                'temas_refuerzo' => json_encode(
                    collect($temas)->random(rand(1, 3))->toArray()
                ), // Selecciona entre 1 y 3 temas aleatorios
            ]);
        }

        $this->command->info('Resultados de prueba generados para los usuarios existentes.');
    }
}

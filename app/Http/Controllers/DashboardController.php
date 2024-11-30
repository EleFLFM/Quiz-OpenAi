<?php

namespace App\Http\Controllers;

use App\Models\TestResult;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Estadísticas
<<<<<<< HEAD
        $totalUsuarios = User::role('usuario')->count(); // Usuarios con rol 'usuario'
=======
        $totalUsuarios = User::whereDoesntHave('roles', function ($query) {
            $query->where('name', 'administrador');
        })->count();
        // $totalUsuarios = User::role('usuario')->count(); // Usuarios con rol 'usuario'
>>>>>>> d08015db09a65d3768ade573ca37f73cd2ad964b
        $totalPruebas = TestResult::count(); // Total de pruebas realizadas
        $promedioPuntajes = TestResult::avg('puntaje'); // Promedio de puntajes
        $aprobados = TestResult::where('puntaje', '>=', 60)->count(); // Pruebas aprobadas
        $reprobados = TestResult::where('puntaje', '<', 60)->count(); // Pruebas reprobadas

        // Porcentaje de aprobados y reprobados
        $totalPruebas = $totalPruebas ?: 1; // Evitar división por cero
        $porcentajeAprobados = ($aprobados / $totalPruebas) * 100;
        $porcentajeReprobados = ($reprobados / $totalPruebas) * 100;

        // Temas más frecuentes en refuerzo
        $temasRefuerzo = TestResult::selectRaw("JSON_EXTRACT(temas_refuerzo, '$[*]') as temas")
            ->get()
            ->flatMap(function ($result) {
                return json_decode($result->temas, true);
            })
            ->countBy()
            ->sortDesc();

        // Pasar estadísticas a la vista
        return view('dashboard', compact(
            'totalUsuarios',
            'totalPruebas',
            'promedioPuntajes',
            'porcentajeAprobados',
            'porcentajeReprobados',
            'temasRefuerzo'
        ));
    }
}

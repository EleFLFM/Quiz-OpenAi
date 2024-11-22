@extends('layouts.app')

@section('main')
<div class="p-6 ">
    <h1 class="text-2xl font-bold mb-4">Resultados de los Estudiantes</h1>

    <div class="container">
        <table class="table-auto border-collapse border border-gray-300 w-full text-left">
            <thead>
                <tr class="bg-gray-200">
                    <th class="border border-gray-300 px-4 py-2">#</th>
                    <th class="border border-gray-300 px-4 py-2">Nombre</th>
                    <th class="border border-gray-300 px-4 py-2">Correo Electrónico</th>
                    <th class="border border-gray-300 px-4 py-2">Puntaje</th>
                    <th class="border border-gray-300 px-4 py-2">Estado</th>
                </tr>
            </thead>
            <tbody>
                <!-- Ejemplo de estudiantes -->
                <tr class="hover:bg-gray-100">
                    <td class="border border-gray-300 px-4 py-2">1</td>
                    <td class="border border-gray-300 px-4 py-2">Juan Pérez</td>
                    <td class="border border-gray-300 px-4 py-2">juan.perez@example.com</td>
                    <td class="border border-gray-300 px-4 py-2">85</td>
                    <td class="border border-gray-300 px-4 py-2">
                        <span class="text-green-600 font-bold">Aprobado</span>
                    </td>
                </tr>
                <tr class="hover:bg-gray-100">
                    <td class="border border-gray-300 px-4 py-2">2</td>
                    <td class="border border-gray-300 px-4 py-2">Ana García</td>
                    <td class="border border-gray-300 px-4 py-2">ana.garcia@example.com</td>
                    <td class="border border-gray-300 px-4 py-2">60</td>
                    <td class="border border-gray-300 px-4 py-2">
                        <span class="text-red-600 font-bold">Reprobado</span>
                    </td>
                </tr>
                <tr class="hover:bg-gray-100">
                    <td class="border border-gray-300 px-4 py-2">3</td>
                    <td class="border border-gray-300 px-4 py-2">Luis Martínez</td>
                    <td class="border border-gray-300 px-4 py-2">luis.martinez@example.com</td>
                    <td class="border border-gray-300 px-4 py-2">72</td>
                    <td class="border border-gray-300 px-4 py-2">
                        <span class="text-green-600 font-bold">Aprobado</span>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
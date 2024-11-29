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
                @foreach ($results as $result)
                <tr class="hover:bg-gray-100">
                    <td class="border border-gray-300 px-4 py-2">{{ $loop->iteration }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $result->user->name }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $result->user->email }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $result->puntaje }}</td>
                    <td class="border border-gray-300 px-4 py-2">
                        @if ($result->puntaje >= 60)
                        <span class="text-green-600 font-bold">Aprobado</span>
                        @else
                        <span class="text-red-600 font-bold">Reprobado</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>

        </table>
    </div>
</div>
@endsection
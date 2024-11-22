@extends('layouts.app')

@section('main')
{{-- <div class="p-6 text-gray-900 dark:text-gray-100">
    @role('Administrador')
    <p>Este contenido solo es visible para los administradores.</p>
    @else
    <p>No tienes permisos para ver este contenido.</p>
    @endrole
</div> --}}
<div class="container">
    <h1 class="mb-4">Test de Programación</h1>
    <form action="{{ route('test.submit') }}" method="POST">
        @csrf

        @foreach ($questions as $index => $question)
        <div class="mb-3">
            <label for="question{{ $index }}" class="form-label">
                {{ ($index + 1) . '. ' . $question }}
            </label>
            <input type="text" name="responses[{{ $index }}]" id="question{{ $index }}" class="form-control" required>
        </div>
        @endforeach

        <button type="submit" class="btn btn-primary">Enviar</button>
    </form>
</div>


@endsection
<style>
    .container {
        max-width: 800px;
        margin: 40px auto;
        padding: 20px;
        background-color: #ffffff;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    h2 {
        color: #2c3e50;
        margin-bottom: 30px;
        text-align: center;
        font-weight: 600;
        padding-bottom: 15px;
        border-bottom: 2px solid #eee;
    }

    .form-group {
        margin-bottom: 25px;
        background-color: #f8f9fa;
        padding: 20px;
        border-radius: 6px;
        transition: transform 0.2s ease;
    }

    .form-group:hover {
        transform: translateX(5px);
        background-color: #f1f3f5;
    }

    label {
        display: block;
        margin-bottom: 8px;
        color: #495057;
        font-weight: 500;
        font-size: 1.1em;
    }

    .form-control {
        width: 100%;
        padding: 12px;
        border: 1px solid #ced4da;
        border-radius: 4px;
        font-size: 1rem;
        transition: border-color 0.2s ease;
    }

    .form-control:focus {
        border-color: #4dabf7;
        outline: none;
        box-shadow: 0 0 0 3px rgba(77, 171, 247, 0.2);
    }

    .btn-primary {
        display: block;
        width: 100%;
        max-width: 300px;
        margin: 30px auto 0;
        padding: 12px 24px;
        background-color: #007bff;
        border: none;
        border-radius: 4px;
        color: white;
        font-size: 1.1em;
        font-weight: 500;
        cursor: pointer;
        transition: background-color 0.2s ease;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }

    .btn-primary:active {
        transform: translateY(1px);
    }
</style>
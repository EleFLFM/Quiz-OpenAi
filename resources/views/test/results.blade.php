<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Resultados de Examen</title>
</head>

<body>
    <div class="resultado-examen">
        <div class="encabezado">
            <h1>Resultados del Examen</h1>
        </div>
        <div class="detalles">
            <p><strong>Nombre:</strong> {{ auth()->user()->name }}</p>

            <p><strong>Fecha:</strong> {{ now()->format('d/m/Y') }}</p>
        </div>
        <div class="calificacion">{{ $puntaje }}</div>
        <div class="estado-aprobacion {{ $puntaje >= 60 ? 'aprobado' : 'reprobado' }}">
            {{ $puntaje >= 60 ? '¡APROBADO!' : 'REPROBADO!' }}
        </div>
        <p><strong>Puntaje:</strong> {{ number_format($puntaje, 2) }}%</p>
        <div class="temas-refuerzo">
            <h3>Temas para Refuerzo</h3>
            <ul>
                @foreach ($temas as $tema)
                <li>{{ $tema }}</li>
                @endforeach
            </ul>
        </div>
        <div>
            <div style="padding-top: 50px;" class="mt-8 text-center"> <a href="{{ route('student.educational-content') }}" class="btn btn-primary btn-lg">Volver al Inicio</a> </div>

        </div>
    </div>
</body>

</html>
<style>
    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
        color: #ffffff;
        padding: 10px 20px;
        font-size: 1.25rem;
        border-radius: 5px;
        transition: background-color 0.3s ease, transform 0.2s ease;
        text-decoration: none;
        /* Elimina el subrayado */
    }

    .btn-primary:hover {
        background-color: #0056b3;
        transform: translateY(-2px);
    }

    .btn-primary:active {
        background-color: #004085;
        transform: translateY(1px);
    }

    .text-center {
        text-align: center;
    }

    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
        padding: 20px;
    }

    .resultado-examen {
        background-color: white;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        padding: 30px;
        width: 450px;
        text-align: center;
    }

    .encabezado {
        background-color: #4CAF50;
        color: white;
        padding: 15px;
        border-radius: 5px;
        margin-bottom: 20px;
    }

    .detalles {
        text-align: left;
        margin-bottom: 20px;
    }

    .calificacion {
        font-size: 48px;
        font-weight: bold;
        color: #4CAF50;
    }

    .estado-aprobacion {
        padding: 10px;
        border-radius: 5px;
        margin-bottom: 20px;
    }

    .aprobado {
        background-color: #4CAF50;
        color: white;
    }

    .reprobado {
        background-color: #FF5252;
        color: white;
    }

    .temas-refuerzo {
        text-align: left;
        background-color: #f9f9f9;
        border-radius: 5px;
        padding: 15px;
    }

    .temas-refuerzo h3 {
        margin-top: 0;
        color: #333;
        border-bottom: 2px solid #4CAF50;
        padding-bottom: 10px;
    }

    .temas-refuerzo ul {
        padding-left: 20px;
        margin: 0;
    }

    .temas-refuerzo li {
        margin-bottom: 10px;
        color: #666;
    }
</style>
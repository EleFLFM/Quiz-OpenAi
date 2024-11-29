@extends('layouts.app')

@section('main')

@role('Administrador')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div style="margin-bottom: 50px;" class="welcome-content">

    <div class="admin-dashboard">
        <center>
            <h1 class="titulo">Dashboard</h1>
        </center>

        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon"><i class="fas fa-users"></i></div>
                <div class="stat-content">
                    <h3>Usuarios Registrados</h3>
                    <p class="stat-number">{{ $totalUsuarios }}</p>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon"><i class="fas fa-clipboard-list"></i></div>
                <div class="stat-content">
                    <h3>Pruebas Realizadas</h3>
                    <p class="stat-number">{{ $totalPruebas }}</p>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon"><i class="fas fa-chart-line"></i></div>
                <div class="stat-content">
                    <h3>Promedio de Puntajes</h3>
                    <p class="stat-number">{{ number_format($promedioPuntajes, 2) }}</p>
                </div>
            </div>
        </div>

        <div class="charts-container">
            <div class="chart-card chart-small">
                <h3>Pruebas: Aprobados vs Reprobados</h3>
                <div class="chart-wrapper">
                    <canvas id="testResultsChart"></canvas>
                </div>
            </div>
        </div>
    </div>

</div>
@else
<div class="welcome-content">
    <h1>Bienvenido, {{ auth()->user()->name ?? 'Estudiante' }}!</h1>
    <p>
        Estamos encantados de que estés aquí. Este es un espacio diseñado para ayudarte a mejorar tus habilidades y aprender de manera personalizada.
    </p>
    <a href="{{ route('test.show') }}" class="btn-primary btn-center">Elaborar Test</a>
</div>
@endrole

<script>
    // Gráfica de Resultados de Pruebas
    const testResultsCtx = document.getElementById('testResultsChart').getContext('2d');
    new Chart(testResultsCtx, {
        type: 'pie',
        data: {
            labels: ['Aprobados', 'Reprobados'],
            datasets: [{
                data: [{
                    {
                        $porcentajeAprobados
                    }
                }, {
                    {
                        $porcentajeReprobados
                    }
                }],
                backgroundColor: ['#28a745', '#dc3545']
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            let value = context.parsed;
                            return `${context.label}: ${value.toFixed(2)}%`;
                        }
                    }
                }
            }
        }
    });
</script>
@endsection

<style>
    .titulo {
        font-size: 40px;
        padding-bottom: 20px;
        margin-bottom: 30px;

    }

    .admin-dashboard {
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;
        margin-bottom: 30px;
    }

    .stat-card {
        display: flex;
        align-items: center;
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        padding: 20px;
        transition: transform 0.3s ease;
    }

    .stat-card:hover {
        transform: translateY(-5px);
    }

    .stat-icon {
        font-size: 2.5rem;
        color: #007bff;
        margin-right: 20px;
    }

    .stat-content {
        flex-grow: 1;
    }

    .stat-content h3 {
        margin: 0;
        color: #6c757d;
        font-size: 1rem;
        text-transform: uppercase;
    }

    .stat-number {
        font-size: 1.8rem;
        font-weight: bold;
        color: #333;
        margin-top: 5px;
    }

    .charts-container {
        display: flex;
        justify-content: center;
    }

    .chart-card {
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        padding: 20px;
        width: 100%;
        max-width: 500px;
    }

    .chart-small {
        max-width: 400px;
    }

    .chart-wrapper {
        position: relative;
        width: 100%;
        height: 300px;
    }

    .chart-card h3 {
        text-align: center;
        margin-bottom: 20px;
        color: #6c757d;
    }

    @media (max-width: 768px) {
        .stats-grid {
            grid-template-columns: 1fr;
        }

        .chart-card {
            max-width: 100%;
        }
    }

    /* Header */
    h1 {
        color: #333333;
        font-size: 2.2rem;
        margin-bottom: 20px;
        text-align: center;
        font-weight: bold;
        padding-bottom: 10px;
        border-bottom: 3px solid #007bff;
        background: linear-gradient(90deg, #007bff, #00c6ff);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    /* Labels */
    .form-label {
        display: block;
        margin-bottom: 8px;
        color: #495057;
        font-weight: 500;
        font-size: 1.1em;
    }

    /* Input Fields */
    .form-control {
        width: 100%;
        padding: 12px;
        border: 1px solid #ced4da;
        border-radius: 6px;
        font-size: 1rem;
        transition: box-shadow 0.3s ease, transform 0.2s ease;
    }

    .form-control:focus {
        border-color: #56cfe1;
        outline: none;
        box-shadow: 0 4px 10px rgba(86, 207, 225, 0.3);
        transform: scale(1.02);
    }



    /* Responsive Adjustments */
    @media (max-width: 576px) {
        .container {
            padding: 20px;
        }

        h1 {
            font-size: 1.8rem;
        }

        .btn-primary {
            max-width: 100%;
        }
    }
</style>
<style>
    /* General Styles */
    .welcome-container {
        max-width: 800px;
        margin: 40px auto;
        padding: 25px;
        background: linear-gradient(135deg, #fdfbfb, #ebedee);
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
        font-family: 'Roboto', sans-serif;
    }

    .welcome-content {
        max-width: 800px;
        margin: 40px auto;
        padding: 25px;
        background: linear-gradient(135deg, #fdfbfb, #ebedee);
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
        font-family: 'Roboto', sans-serif;
    }

    /* Header */
    h1 {
        font-size: 2.5rem;
        font-weight: bold;
        color: #333;
        margin-bottom: 20px;
        background: linear-gradient(90deg, #007bff, #00c6ff);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    /* Paragraph */
    p {
        font-size: 1.2rem;
        line-height: 1.8;
        color: #555;
        margin-bottom: 30px;
    }

    .btn-center {
        display: block;
        margin: 20px auto;
        /* Automático para centrar */
        text-align: center;
        /* Asegura el contenido centrado dentro del botón */
    }

    /* Button */
    .btn-primary {
        display: inline-block;
        padding: 12px 24px;
        background: linear-gradient(45deg, #007bff, #0056b3);
        color: white;
        font-size: 1.1em;
        font-weight: bold;
        border: none;
        border-radius: 6px;
        text-decoration: none;
        text-transform: uppercase;
        transition: background 0.3s ease, transform 0.2s ease, box-shadow 0.3s ease;
        cursor: pointer;
    }

    .btn-primary:hover {
        background: linear-gradient(45deg, #0056b3, #003d80);
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(0, 91, 187, 0.4);
    }

    .btn-primary:active {
        transform: translateY(1px);
    }

    /* Responsive Adjustments */
</style>
<style>
    /* Container */
    .container {
        max-width: 80%;
        margin: 40px auto;
        padding: 25px;
        background: linear-gradient(135deg, #fdfbfb, #ebedee);
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
        font-family: 'Roboto', sans-serif;
    }

    /* Header */
    h1 {
        color: #333333;
        font-size: 2.2rem;
        margin-bottom: 20px;
        text-align: center;
        font-weight: bold;
        padding-bottom: 10px;
        border-bottom: 3px solid #007bff;
        background: linear-gradient(90deg, #007bff, #00c6ff);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    /* Labels */
    .form-label {
        display: block;
        margin-bottom: 8px;
        color: #495057;
        font-weight: 500;
        font-size: 1.1em;
    }

    /* Input Fields */
    .form-control {
        width: 100%;
        padding: 12px;
        border: 1px solid #ced4da;
        border-radius: 6px;
        font-size: 1rem;
        transition: box-shadow 0.3s ease, transform 0.2s ease;
    }

    .form-control:focus {
        border-color: #56cfe1;
        outline: none;
        box-shadow: 0 4px 10px rgba(86, 207, 225, 0.3);
        transform: scale(1.02);
    }



    /* Responsive Adjustments */
    @media (max-width: 576px) {
        .container {
            padding: 20px;
        }

        h1 {
            font-size: 1.8rem;
        }

        .btn-primary {
            max-width: 100%;
        }
    }
</style>
<style>
    /* General Styles */
    .welcome-container {
        max-width: 80%;
        margin: 40px auto;
        padding: 25px;
        background: linear-gradient(135deg, #fdfbfb, #ebedee);
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
        font-family: 'Roboto', sans-serif;
    }

    .welcome-content {
        max-width: 800px;
        margin: 40px auto;
        padding: 25px;
        background: linear-gradient(135deg, #fdfbfb, #ebedee);
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
        font-family: 'Roboto', sans-serif;
    }

    /* Header */
    h1 {
        font-size: 2.5rem;
        font-weight: bold;
        color: #333;
        margin-bottom: 20px;
        background: linear-gradient(90deg, #007bff, #00c6ff);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    /* Paragraph */
    p {
        font-size: 1.2rem;
        line-height: 1.8;
        color: #555;
        margin-bottom: 30px;
    }

    .btn-center {
        display: block;
        margin: 20px auto;
        /* Automático para centrar */
        text-align: center;
        /* Asegura el contenido centrado dentro del botón */
    }

    /* Button */
    .btn-primary {
        display: inline-block;
        padding: 12px 24px;
        background: linear-gradient(45deg, #007bff, #0056b3);
        color: white;
        font-size: 1.1em;
        font-weight: bold;
        border: none;
        border-radius: 6px;
        text-decoration: none;
        text-transform: uppercase;
        transition: background 0.3s ease, transform 0.2s ease, box-shadow 0.3s ease;
        cursor: pointer;
    }

    .btn-primary:hover {
        background: linear-gradient(45deg, #0056b3, #003d80);
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(0, 91, 187, 0.4);
    }

    .btn-primary:active {
        transform: translateY(1px);
    }

    /* Responsive Adjustments */
    @media (max-width: 576px) {
        h1 {
            font-size: 2rem;
        }

        p {
            font-size: 1rem;
        }
    }
</style>
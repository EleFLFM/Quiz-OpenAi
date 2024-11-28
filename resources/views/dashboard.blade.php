@extends('layouts.app')

@section('main')
@role('usuario')
<div class="welcome-content">
    <h1>Bienvenido, {{ auth()->user()->name ?? 'Estudiante' }}!</h1>
    <p>
        Estamos encantados de que estés aquí. Este es un espacio diseñado para ayudarte a mejorar tus habilidades y aprender de manera personalizada.
    </p>
    <a href="{{ route('student.educational-content') }}" class="btn-primary btn-center">Explorar Contenido Educativo</a>
</div>
@endrole

@role('Administrador')
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
@endrole

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Gráfica de Resultados de Pruebas
    const testResultsCtx = document.getElementById('testResultsChart').getContext('2d');
    new Chart(testResultsCtx, {
        type: 'pie',
        data: {
            labels: ['Aprobados', 'Reprobados'],
            datasets: [{
                data: [{{ $porcentajeAprobados }}, {{ $porcentajeReprobados }}],
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
    .titulo{
        font-size: 40px;
        padding-bottom: 20px;

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
</style>
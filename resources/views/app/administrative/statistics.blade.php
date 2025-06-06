@extends('layouts.app')

@section('title', 'Estadísticas de la institución')

@section('content')
<section class="w-full">
    <div class="w-full max-w-7xl mx-auto py-10 space-y-10">
        <h1 class="text-3xl font-bold">Estadísticas de la Institución {{ $institucion->institucion_nombre }}</h1>

        <!-- Resumen de Totales -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            <div class="stat bg-base-200 rounded-lg border border-base-300">
                <div class="stat-title">Estudiantes</div>
                <div class="stat-value text-primary">{{ $totalEstudiantes }}</div>
                <div class="stat-desc">Matriculados este año</div>
            </div>
            <div class="stat bg-base-200 rounded-lg border border-base-300">
                <div class="stat-title">Docentes</div>
                <div class="stat-value text-secondary">{{ $totalDocentes }}</div>
            </div>
            <div class="stat bg-base-200 rounded-lg border border-base-300">
                <div class="stat-title">Administrativos</div>
                <div class="stat-value text-accent">{{ $totalAdministrativos }}</div>
            </div>
            <div class="stat bg-base-200 rounded-lg border border-base-300">
                <div class="stat-title">Materias</div>
                <div class="stat-value text-info">{{ $totalMaterias }}</div>
                <div class="stat-desc">{{ $totalGrupos }} grupos este año</div>
            </div>
        </div>

        <!-- Calendario Académico -->
        <div class="bg-base-200 rounded-lg border border-base-300 p-6">
            <h2 class="text-xl font-semibold mb-4">Calendario Académico</h2>
            <div class="w-full bg-base-300 rounded-full h-4">
                <div class="bg-primary h-4 rounded-full" style="width: {{ $porcentajeAvance }}%"></div>
            </div>
            <div class="mt-2 text-sm text-base-content/70">
                Avance del año académico: {{ $porcentajeAvance }}%
            </div>
        </div>

        <!-- Gráficos -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Inasistencias por Grupo -->
            <div class="bg-base-200 rounded-lg border border-base-300 p-6">
                <h2 class="text-xl font-semibold mb-4">Inasistencias por Grupo</h2>
                <canvas id="inasistenciasGrupoChart"></canvas>
            </div>

            <!-- Inasistencias por Materia -->
            <div class="bg-base-200 rounded-lg border border-base-300 p-6">
                <h2 class="text-xl font-semibold mb-4">Top 5 Días con más Inasistencias</h2>
                <canvas id="inasistenciasDiaChart"></canvas>
            </div>

            <!-- Rendimiento por Periodo -->
            <div class="bg-base-200 rounded-lg border border-base-300 p-6">
                <h2 class="text-xl font-semibold mb-4">Rendimiento por Periodo</h2>
                <canvas id="rendimientoPeriodoChart"></canvas>
            </div>

            <!-- Promedios por Grupo -->
            <div class="bg-base-200 rounded-lg border border-base-300 p-6">
                <h2 class="text-xl font-semibold mb-4">Promedios por Grupo</h2>
                <canvas id="promediosGrupoChart"></canvas>
            </div>
        </div>
    </div>
</section>

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Datos para los gráficos
    const inasistenciasGrupoData = {
        labels: @json($inasistenciasPorGrupo->pluck('nombre')->toArray()),
        data: @json($inasistenciasPorGrupo->pluck('inasistencias')->toArray())
    };

    const inasistenciasDiaData = {
        labels: @json($inasistenciasPorDia->pluck('nombre')->toArray()),
        data: @json($inasistenciasPorDia->pluck('inasistencias')->toArray())
    };

    const rendimientoPeriodoData = {
        labels: @json(array_column($rendimientoPorPeriodo, 'periodo')),
        aprobados: @json(array_column($rendimientoPorPeriodo, 'aprobados')),
        reprobados: @json(array_column($rendimientoPorPeriodo, 'reprobados'))
    };

    const promediosGrupoData = {
        labels: @json($promediosPorGrupo->pluck('nombre')->toArray()),
        data: @json($promediosPorGrupo->pluck('promedio')->toArray())
    };

    // Gráfico de Inasistencias por Grupo
    new Chart(document.getElementById('inasistenciasGrupoChart'), {
        type: 'bar',
        data: {
            labels: inasistenciasGrupoData.labels,
            datasets: [{
                label: 'Inasistencias',
                data: inasistenciasGrupoData.data,
                backgroundColor: 'rgba(255, 99, 132, 0.5)',
                borderColor: 'rgb(255, 99, 132)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top'
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    max: Math.ceil(Math.max(...inasistenciasGrupoData.data) * 1.2)
                }
            }
        }
    });

    // Gráfico de Inasistencias por Día
    new Chart(document.getElementById('inasistenciasDiaChart'), {
        type: 'bar',
        data: {
            labels: inasistenciasDiaData.labels,
            datasets: [{
                label: 'Inasistencias',
                data: inasistenciasDiaData.data,
                backgroundColor: 'rgba(54, 162, 235, 0.5)',
                borderColor: 'rgb(54, 162, 235)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top'
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    max: Math.ceil(Math.max(...inasistenciasDiaData.data) * 1.2)
                }
            }
        }
    });

    // Gráfico de Rendimiento por Periodo
    new Chart(document.getElementById('rendimientoPeriodoChart'), {
        type: 'bar',
        data: {
            labels: rendimientoPeriodoData.labels,
            datasets: [
                {
                    label: 'Aprobados',
                    data: rendimientoPeriodoData.aprobados,
                    backgroundColor: 'rgba(75, 192, 192, 0.5)',
                    borderColor: 'rgb(75, 192, 192)',
                    borderWidth: 1
                },
                {
                    label: 'Reprobados',
                    data: rendimientoPeriodoData.reprobados,
                    backgroundColor: 'rgba(255, 99, 132, 0.5)',
                    borderColor: 'rgb(255, 99, 132)',
                    borderWidth: 1
                }
            ]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top'
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    max: 100
                }
            }
        }
    });

    // Gráfico de Promedios por Grupo
    new Chart(document.getElementById('promediosGrupoChart'), {
        type: 'bar',
        data: {
            labels: promediosGrupoData.labels,
            datasets: [{
                label: 'Promedio',
                data: promediosGrupoData.data,
                backgroundColor: 'rgba(153, 102, 255, 0.5)',
                borderColor: 'rgb(153, 102, 255)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top'
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    max: 5
                }
            }
        }
    });
</script>
@endsection
@endsection
@extends('layouts.app')

@section('title', 'Estadísticas')

@section('content')
<section class="w-full">
    <div class="w-full max-w-[1200px] mx-auto py-10 space-y-10">
        <h1 class="text-3xl font-bold">Estadísticas Generales</h1>

        <!-- Resumen de Totales -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            <div class="stat bg-base-200 rounded-lg border border-base-300">
                <div class="stat-title">Instituciones</div>
                <div class="stat-value text-primary">{{ $totalInstituciones }}</div>
                <div class="stat-desc">+{{ $nuevasInstituciones }} este mes</div>
            </div>
            <div class="stat bg-base-200 rounded-lg">
                <div class="stat-title">Grupos Académicos</div>
                <div class="stat-value text-secondary">{{ $totalGrupos }}</div>
            </div>
            <div class="stat bg-base-200 rounded-lg">
                <div class="stat-title">Materias</div>
                <div class="stat-value text-accent">{{ $totalMaterias }}</div>
            </div>
            <div class="stat bg-base-200 rounded-lg">
                <div class="stat-title">Periodos</div>
                <div class="stat-value text-info">{{ $periodosActivos }}</div>
                <div class="stat-desc">{{ $periodosInactivos }} anterior{{ $periodosInactivos == 1 ? '' : 'es' }}</div>
            </div>
        </div>

        <!-- Gráficos de Distribución -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Administrativos por Institución -->
            <div class="bg-base-200 rounded-lg p-6">
                <h2 class="text-xl font-semibold mb-4">Administrativos por Institución</h2>
                <canvas id="administrativosChart"></canvas>
            </div>

            <!-- Docentes por Institución -->
            <div class="bg-base-200 rounded-lg p-6">
                <h2 class="text-xl font-semibold mb-4">Docentes por Institución</h2>
                <canvas id="docentesChart"></canvas>
            </div>

            <!-- Estudiantes por Institución -->
            <div class="bg-base-200 rounded-lg p-6">
                <h2 class="text-xl font-semibold mb-4">Estudiantes por Institución</h2>
                <canvas id="estudiantesChart"></canvas>
            </div>

            <!-- Tendencias de Crecimiento -->
            <div class="bg-base-200 rounded-lg p-6">
                <h2 class="text-xl font-semibold mb-4">Tendencias de Crecimiento</h2>
                <canvas id="tendenciasChart"></canvas>
            </div>
        </div>
    </div>
</section>

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Configuración común para los gráficos
    const chartConfig = {
        type: 'bar',
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top'
                }
            }
        }
    };

    // Datos para los gráficos
    const administrativosData = {
        labels: @json($administrativosPorInstitucion->pluck('nombre')->toArray()),
        data: @json($administrativosPorInstitucion->pluck('total')->toArray())
    };

    const docentesData = {
        labels: @json($docentesPorInstitucion->pluck('nombre')->toArray()),
        data: @json($docentesPorInstitucion->pluck('total')->toArray())
    };

    const estudiantesData = {
        labels: @json($estudiantesPorInstitucion->pluck('nombre')->toArray()),
        data: @json($estudiantesPorInstitucion->pluck('total')->toArray())
    };

    // Procesar datos de tendencias
    const tendenciasData = {
        labels: @json(array_column($tendencias['instituciones'], 'mes')),
        instituciones: @json(array_column($tendencias['instituciones'], 'total')),
        estudiantes: @json(array_column($tendencias['estudiantes'], 'total')),
        docentes: @json(array_column($tendencias['docentes'], 'total'))
    };

    // Gráfico de Administrativos
    new Chart(document.getElementById('administrativosChart'), {
        ...chartConfig,
        options: {
            scales: {
                y: {
                    max: Math.ceil(Math.max(...administrativosData.data) * 1.5),
                }
            }
        },
        data: {
            labels: administrativosData.labels,
            datasets: [{
                label: 'Administrativos',
                data: administrativosData.data,
                backgroundColor: 'rgba(54, 162, 235, 0.5)',
                borderColor: 'rgb(54, 162, 235)',
                borderWidth: 1
            }]
        }
    });

    // Gráfico de Docentes
    new Chart(document.getElementById('docentesChart'), {
        ...chartConfig,
        options: {
            scales: {
                y: {
                    max: Math.ceil(Math.max(...docentesData.data) * 1.5),
                }
            }
        },
        data: {
            labels: docentesData.labels,
            datasets: [{
                label: 'Docentes',
                data: docentesData.data,
                backgroundColor: 'rgba(255, 99, 132, 0.5)',
                borderColor: 'rgb(255, 99, 132)',
                borderWidth: 1
            }]
        }
    });

    // Gráfico de Estudiantes
    new Chart(document.getElementById('estudiantesChart'), {
        ...chartConfig,
        options: {
            scales: {
                y: {
                    max: Math.ceil(Math.max(...estudiantesData.data) * 1.5),
                }
            }
        },
        data: {
            labels: estudiantesData.labels,
            datasets: [{
                label: 'Estudiantes',
                data: estudiantesData.data,
                backgroundColor: 'rgba(75, 192, 192, 0.5)',
                borderColor: 'rgb(75, 192, 192)',
                borderWidth: 1
            }]
        }
    });

    // Gráfico de Tendencias
    new Chart(document.getElementById('tendenciasChart'), {
        type: 'line',
        data: {
            labels: tendenciasData.labels,
            datasets: [
                {
                    label: 'Instituciones',
                    data: tendenciasData.instituciones,
                    borderColor: 'rgb(54, 162, 235)',
                    tension: 0.1
                },
                {
                    label: 'Estudiantes',
                    data: tendenciasData.estudiantes,
                    borderColor: 'rgb(255, 99, 132)',
                    tension: 0.1
                },
                {
                    label: 'Docentes',
                    data: tendenciasData.docentes,
                    borderColor: 'rgb(75, 192, 192)',
                    tension: 0.1
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
                    beginAtZero: true
                }
            }
        }
    });
</script>
@endsection
@endsection
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Boletín de Notas</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .student-info {
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f5f5f5;
        }
        .average {
            text-align: right;
            font-size: 1.2em;
            margin-top: 20px;
        }
        .footer {
            margin-top: 50px;
            text-align: center;
            font-size: 0.8em;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Boletín de Notas</h1>
        <p>Año Académico {{ date('Y') }}</p>
    </div>

    <div class="student-info">
        <h2>Información del Estudiante</h2>
        <p><strong>Institución:</strong> {{ $institucion->institucion_nombre }}</p>
        <p><strong>Curso:</strong> {{ $estudiante->matriculas->first()->grupo->grupo_nombre }}</p>
        <p><strong>Estudiante:</strong> {{ $estudiante->usuario->usuario_nombre }} {{ $estudiante->usuario->usuario_apellido }}</p>
        <p><strong>Documento:</strong> {{ $estudiante->usuario->usuario_documento }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>Asignatura</th>
                @foreach($periodos as $periodo)
                    <th>{{ $periodo->periodo_academico_nombre }}</th>
                @endforeach
                <th>Promedio</th>
            </tr>
        </thead>
        <tbody>
            @foreach($asignaciones as $asignacion)
                @php
                    $asignacionNotas = $notas->where('asignacion_id', $asignacion->asignacion_id);
                    $promedio = $asignacionNotas->avg('nota_valor');
                @endphp
                <tr>
                    <td>{{ $asignacion->materia->materia_nombre }}</td>
                    @foreach($periodos as $periodo)
                        <td>{{ $asignacionNotas->where('periodo_academico_id', $periodo->periodo_academico_id)->first()->nota_valor ?? '-' }}</td>
                    @endforeach
                    <td>{{ $promedio ? number_format($promedio, 1) : 'N/A' }}</td>
                </tr>
            @endforeach 
        </tbody>
    </table>

    <div class="average">
        <strong>Promedio General: {{ number_format($notas->avg('nota_valor'), 1) }}</strong>
    </div>

    <div class="footer">
        <p>Este documento fue generado automáticamente el {{ date('d/m/Y H:i:s') }}</p>
    </div>
</body>
</html> 
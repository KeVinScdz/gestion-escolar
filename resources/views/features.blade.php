@extends('layouts.guest')

@section('title', 'Funcionalidad')

@section('content')
<section class="w-full px-5">
    <div class="w-full max-w-[1200px] mx-auto py-10 space-y-10">
        <div class="text-center">
            <h1 class="text-4xl font-bold mb-4">Funcionalidades por Rol</h1>
            <p class="text-lg text-gray-600 mb-12">Cada rol en MATRYERSE ofrece funciones específicas que simplifican y mejoran la experiencia dentro de la plataforma, adaptándose a las necesidades de cada usuario.</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-10">
            {{-- Estudiante --}}
            <div class="bg-white rounded-2xl border-b-4 border-blue-500 shadow-lg hover:shadow-xl transition p-6">
                <div class="flex items-center gap-2 mb-4">
                    <i class="fas fa-user-graduate text-2xl text-blue-500 mr-3"></i>
                    <h2 class="text-xl font-semibold">Estudiante</h2>
                </div>
                <p class="text-gray-700 mb-4">
                    Los estudiantes pueden consultar sus materias, horarios y calificaciones de forma clara y accesible. Además, cuentan con herramientas para hacer seguimiento a sus asistencias y observaciones, lo que les ayuda a mantenerse al día con su rendimiento académico y responsabilidades.
                </p>
                <div class="space-y-2 text-gray-600 text-sm">
                    <p><span class="inline-block w-2 h-2 bg-blue-500 rounded-full mr-2"></span>Acceso rápido a información académica.</p>
                    <p><span class="inline-block w-2 h-2 bg-blue-500 rounded-full mr-2"></span>Control sobre su propio progreso y pagos.</p>
                    <p><span class="inline-block w-2 h-2 bg-blue-500 rounded-full mr-2"></span>Mayor autonomía en la gestión de su formación.</p>
                </div>
                <p class="mt-4 text-gray-500 text-xs italic">Fomenta la autonomía y el control académico del alumno.</p>
            </div>

            {{-- Padre o Tutor --}}
            <div class="bg-white rounded-2xl border-b-4 border-green-500 shadow-lg hover:shadow-xl transition p-6">
                <div class="flex items-center gap-2 mb-4">
                    <i class="fas fa-user-friends text-2xl text-green-500 mr-3"></i>
                    <h2 class="text-xl font-semibold">Padre o Tutor</h2>
                </div>
                <p class="text-gray-700 mb-4">
                    Los padres y tutores tienen acceso a la información académica y financiera de sus hijos, permitiendo un seguimiento cercano y responsable. Pueden consultar inasistencias, notas, pagos, y recibir observaciones directamente del docente para estar siempre informados.
                </p>
                <div class="space-y-2 text-gray-600 text-sm">
                    <p><span class="inline-block w-2 h-2 bg-green-500 rounded-full mr-2"></span>Monitoreo constante del desempeño académico.</p>
                    <p><span class="inline-block w-2 h-2 bg-green-500 rounded-full mr-2"></span>Facilita la comunicación con la institución educativa.</p>
                    <p><span class="inline-block w-2 h-2 bg-green-500 rounded-full mr-2"></span>Acceso claro y actualizado a estados financieros.</p>
                </div>
                <p class="mt-4 text-gray-500 text-xs italic">Fortalece la comunicación hogar-institución.</p>
            </div>

            {{-- Docente --}}
            <div class="bg-white rounded-2xl border-b-4 border-purple-500 shadow-lg hover:shadow-xl transition p-6">
                <div class="flex items-center gap-2 mb-4">
                    <i class="fas fa-chalkboard-teacher text-2xl text-purple-500 mr-3"></i>
                    <h2 class="text-xl font-semibold">Docente</h2>
                </div>
                <p class="text-gray-700 mb-4">
                    Los docentes tienen herramientas para registrar notas, asistencias y observaciones, facilitando la gestión de sus grupos y estudiantes. Esto les permite llevar un control actualizado y eficiente, además de consultar sus horarios asignados.
                </p>
                <div class="space-y-2 text-gray-600 text-sm">
                    <p><span class="inline-block w-2 h-2 bg-purple-500 rounded-full mr-2"></span>Registro ágil y confiable del rendimiento estudiantil.</p>
                    <p><span class="inline-block w-2 h-2 bg-purple-500 rounded-full mr-2"></span>Acceso a información de grupos y estudiantes en tiempo real.</p>
                    <p><span class="inline-block w-2 h-2 bg-purple-500 rounded-full mr-2"></span>Visualización clara de sus horarios para mejor organización.</p>
                </div>
                <p class="mt-4 text-gray-500 text-xs italic">Facilita el seguimiento académico en tiempo real.</p>
            </div>

            {{-- Administrativo --}}
            <div class="bg-white rounded-2xl border-b-4 border-red-500 shadow-lg hover:shadow-xl transition p-6">
                <div class="flex items-center gap-2 mb-4">
                    <i class="fas fa-cogs text-2xl text-red-500 mr-3"></i>
                    <h2 class="text-xl font-semibold">Administrativo</h2>
                </div>
                <p class="text-gray-700 mb-4">
                    El personal administrativo cuenta con funcionalidades para gestionar el personal, matrículas, periodos académicos y configuraciones de materias, grupos y horarios. Además, tienen acceso al control financiero y académico para asegurar la operación fluida de la institución.
                </p>
                <div class="space-y-2 text-gray-600 text-sm">
                    <p><span class="inline-block w-2 h-2 bg-red-500 rounded-full mr-2"></span>Optimización de procesos administrativos y académicos.</p>
                    <p><span class="inline-block w-2 h-2 bg-red-500 rounded-full mr-2"></span>Control centralizado de matrículas y recursos humanos.</p>
                    <p><span class="inline-block w-2 h-2 bg-red-500 rounded-full mr-2"></span>Gestión financiera para un manejo eficiente de pagos.</p>
                </div>
                <p class="mt-4 text-gray-500 text-xs italic">Optimiza los procesos administrativos de la institución.</p>
            </div>
        </div>
    </div>
</section>
@endsection

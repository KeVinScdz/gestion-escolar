@extends('layouts.app')

@section('title', 'Gestión de Pagos')

@section('content')
<section class="w-full">
    <div class="w-full max-w-[1400px] mx-auto py-10 space-y-10">
        <div>
            <h1 class="text-3xl font-bold">Gestión de Pagos</h1>
            <p class="mt-2 text-base-content/80">Aquí puedes gestionar los conceptos de pago y los pagos de los estudiantes.</p>
        </div>

        <div class="p-5 rounded-lg bg-base-200 border border-base-300">
            <div class="flex justify-between items-center">
                <h2 class="card-title">Conceptos de Pago</h2>
                <button class="btn btn-primary btn-sm" onclick="document.getElementById('create_concepto_modal').show()">Crear Concepto</button>
            </div>

            <div class="overflow-x-auto mt-4">
                <table class="table w-full">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre del Concepto</th>
                            <th>Valor</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($conceptos as $concepto)
                        <tr>
                            <td>{{ explode("-", $concepto->concepto_id)[0] }}</td>
                            <td>{{ $concepto->concepto_nombre }}</td>
                            <td>${{ number_format($concepto->concepto_valor, 2) }}</td>
                            <td>
                                <div class="flex flex-wrap gap-2">
                                    <button class="btn btn-xs btn-info" onclick="openEditConceptoModal('{{ $concepto->concepto_id }}', '{{ $concepto->concepto_nombre }}', '{{ $concepto->concepto_valor }}')">Editar</button>
                                    <button class="btn btn-xs btn-error" onclick="deleteConcepto('{{ $concepto->concepto_id }}')">Eliminar</button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center">No hay conceptos de pago definidos.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Sección de Pagos de Estudiantes -->
        <div class="p-5 rounded-lg bg-base-200 border border-base-300">
            <h2 class="card-title">Pagos de Estudiantes</h2>
            <!-- Filtro de búsqueda (opcional) -->
            <form method="GET" class="my-4">
                <div class="join">
                    <input type="text" name="search" placeholder="Buscar estudiante..." class="input input-bordered join-item" value="{{ request('search') }}" />
                    <button type="submit" class="btn btn-primary join-item">Buscar</button>
                </div>
            </form>

            <div class="overflow-x-auto mt-4">
                <table class="table table-zebra w-full">
                    <thead>
                        <tr>
                            <th>Estudiante</th>
                            @foreach($conceptos as $concepto)
                            <th class="text-center">{{ $concepto->concepto_nombre }}<br><small>(${!! number_format($concepto->concepto_valor, 0) !!})</small></th>
                            @endforeach
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($estudiantes as $estudiante)
                        @php
                        $matriculaActual = $estudiante->matriculas->where('matricula_año', date('Y'))->first();
                        @endphp
                        <tr>
                            <td>{{ $estudiante->usuario->usuario_nombre }} {{ $estudiante->usuario->usuario_apellido }}</td>
                            @foreach($conceptos as $concepto)
                            <td class="text-center">
                                @if($matriculaActual)
                                @php
                                $pago = $matriculaActual->pagos->where('concepto_id', $concepto->concepto_id)->first();
                                @endphp
                                @if($pago)
                                @if($pago->pago_estado == 'pagado')
                                <span class="badge badge-success">Pagado</span>
                                <small>({{ \Carbon\Carbon::parse($pago->pago_fecha)->format('d/m/Y') }})</small>
                                @else
                                <span class="badge badge-warning">{{ ucfirst($pago->pago_estado) }}</span>
                                @endif
                                @else
                                <span class="badge badge-error">Pendiente</span>
                                @endif
                                @else
                                <span class="badge badge-ghost">Sin Matrícula</span>
                                @endif
                            </td>
                            @endforeach
                            <td class="text-center">
                                @if($matriculaActual)
                                <button class="btn btn-xs btn-success" onclick="openRegistrarPagoModal('{{ $matriculaActual->matricula_id }}', '{{ $estudiante->usuario->usuario_nombre }} {{ $estudiante->usuario->usuario_apellido }}')">Registrar Pago</button>
                                @else
                                -
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="{{ count($conceptos) + 2 }}" class="text-center">No hay estudiantes para mostrar.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-4">
                {{ $estudiantes->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
</section>

<!-- Modal Crear Concepto de Pago -->
<dialog id="create_concepto_modal" class="modal">
    <div class="modal-box">
        <h3 class="font-bold text-lg">Crear Nuevo Concepto de Pago</h3>
        <form class="upload-form space-y-4 mt-4" data-target="/api/conceptos-pago" data-method="post" data-reset="true" data-reload="true">
            @csrf
            <input type="hidden" name="institucion_id" value="{{ $usuarioSesion->administrativo->institucion_id }}">
            <div>
                <label class="label" for="create_concepto_nombre">Nombre del Concepto:</label>
                <input type="text" id="create_concepto_nombre" name="concepto_nombre" class="input input-bordered w-full" required>
            </div>
            <div>
                <label class="label" for="create_concepto_valor">Valor:</label>
                <input type="number" step="0.01" id="create_concepto_valor" name="concepto_valor" class="input input-bordered w-full" required>
            </div>
            <div class="modal-action">
                <button type="submit" class="btn btn-primary">Crear</button>
                <button type="button" class="btn" onclick="document.getElementById('create_concepto_modal').close()">Cancelar</button>
            </div>
        </form>
    </div>
    <form method="dialog" class="modal-backdrop"><button>close</button></form>
</dialog>

<!-- Modal Editar Concepto de Pago -->
<dialog id="edit_concepto_modal" class="modal">
    <div class="modal-box">
        <h3 class="font-bold text-lg">Editar Concepto de Pago</h3>
        <form id="edit_concepto_form" class="upload-form space-y-4 mt-4" data-method="put" data-reset="true" data-reload="true">
            @csrf
            <input type="hidden" id="edit_concepto_id" name="concepto_id">
            <div>
                <label class="label" for="edit_concepto_nombre_input">Nombre del Concepto:</label>
                <input type="text" id="edit_concepto_nombre_input" name="concepto_nombre" class="input input-bordered w-full" required>
            </div>
            <div>
                <label class="label" for="edit_concepto_valor_input">Valor:</label>
                <input type="number" step="0.01" id="edit_concepto_valor_input" name="concepto_valor" class="input input-bordered w-full" required>
            </div>
            <div class="modal-action">
                <button type="submit" class="btn btn-primary">Actualizar</button>
                <button type="button" class="btn" onclick="document.getElementById('edit_concepto_modal').close()">Cancelar</button>
            </div>
        </form>
    </div>
    <form method="dialog" class="modal-backdrop"><button>close</button></form>
</dialog>

<!-- Modal Registrar Pago -->
<dialog id="registrar_pago_modal" class="modal">
    <div class="modal-box">
        <h3 class="font-bold text-lg">Registrar Pago para <span id="student_name_for_payment"></span></h3>
        <form class="upload-form space-y-4 mt-4" data-target="/api/payments" data-method="post" data-reset="true" data-reload="true" data-show-alert="true">
            <input type="hidden" id="registrar_pago_matricula_id" name="matricula_id">

            <div>
                <label class="label" for="registrar_pago_concepto_id">Concepto de Pago:</label>
                <select id="registrar_pago_concepto_id" name="concepto_id" class="select select-bordered w-full" required>
                    <option disabled selected value="">Seleccione un concepto</option>
                    @foreach($conceptos as $concepto)
                    <option value="{{ $concepto->concepto_id }}" data-valor="{{ $concepto->concepto_valor }}">{{ $concepto->concepto_nombre }} (${{ number_format($concepto->concepto_valor, 2) }})</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="label" for="registrar_pago_fecha">Fecha de Pago:</label>
                <input type="date" id="registrar_pago_fecha" name="pago_fecha" class="input input-bordered w-full" value="{{ date('Y-m-d') }}" required>
            </div>
            <div>
                <label class="label" for="registrar_pago_valor">Valor Pagado:</label>
                <input type="number" step="0.01" id="registrar_pago_valor" name="pago_valor" class="input input-bordered w-full" required>
            </div>
            <div>
                <label class="label" for="registrar_pago_estado">Estado del Pago:</label>
                <select id="registrar_pago_estado" name="pago_estado" class="select select-bordered w-full" required>
                    <option value="pagado">Pagado</option>
                    <option value="pendiente">Pendiente</option>
                    <option value="anulado">Anulado</option>
                </select>
            </div>
            <div class="modal-action">
                <button type="submit" class="btn btn-primary">Registrar Pago</button>
                <button type="button" class="btn" onclick="document.getElementById('registrar_pago_modal').close()">Cancelar</button>
            </div>
        </form>
    </div>
    <form method="dialog" class="modal-backdrop"><button>close</button></form>
</dialog>

@endsection

@section('scripts')
<script>
    function openEditConceptoModal(id, nombre, valor) {
        document.getElementById('edit_concepto_id').value = id;
        document.getElementById('edit_concepto_nombre_input').value = nombre;
        document.getElementById('edit_concepto_valor_input').value = valor;
        document.getElementById('edit_concepto_form').setAttribute('data-target', '/api/conceptos-pago/' + id);
        document.getElementById('edit_concepto_modal').show();
    }

    async function deleteConcepto(id) {
        if (!confirm('¿Estás seguro de que quieres eliminar este concepto de pago?')) return;

        try {
            const response = await fetch('/api/conceptos-pago/' + id, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json'
                }
            });
            const result = await response.json();
            if (result.success) {
                alert('Concepto eliminado con éxito');
                window.location.reload();
            } else {
                alert('Error al eliminar el concepto: ' + (result.message || 'Error desconocido'));
            }
        } catch (error) {
            console.error('Error en deleteConcepto:', error);
            alert('Error de conexión al intentar eliminar el concepto.');
        }
    }

    function openRegistrarPagoModal(matriculaId, studentName) {
        document.getElementById('registrar_pago_matricula_id').value = matriculaId;
        document.getElementById('student_name_for_payment').textContent = studentName;
        // Reset and prefill valor_pagado based on selected concepto
        const conceptoSelect = document.getElementById('registrar_pago_concepto_id');
        conceptoSelect.value = ''; // Reset selection
        document.getElementById('registrar_pago_valor').value = ''; // Reset valor

        conceptoSelect.onchange = function() {
            const selectedOption = this.options[this.selectedIndex];
            const valor = selectedOption.dataset.valor;
            document.getElementById('registrar_pago_valor').value = valor ? parseFloat(valor).toFixed(2) : '';
        };
        document.getElementById('registrar_pago_modal').show();
    }
</script>
@endsection
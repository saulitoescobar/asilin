@extends('layouts.app')

@section('title', 'Lista de Empleados')

@section('content')
<div class="container mt-4">
    <h1 class="text-center">Lista de Empleados</h1>
    
    <!-- Mostrar notificación de éxito -->
    @if (session('success'))
    <div class="alert 
        @if (str_contains(session('success'), 'creado')) alert-primary
        @elseif (str_contains(session('success'), 'actualizado')) alert-success
        @elseif (str_contains(session('success'), 'eliminado')) alert-danger
        @endif
        alert-dismissible fade show" role="alert">
        {!! str_replace(session('success'), session('success'), preg_replace('/Empleado (.*?) (creado|actualizado|eliminado)/', 'Empleado <strong>$1</strong> $2', session('success'))) !!}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <!-- Botón para abrir el modal -->
    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#createEmployeeModal">
        Agregar Empleado
    </button>

    <!-- Incluir el modal desde un archivo separado -->
    @include('employees.create-modal')

    <table class="table table-striped table-hover table-bordered align-middle">
        <thead class="table-dark">
            <tr class="text-center">
                <th class="text-center">#</th>
                <th class="text-center">Nombre</th>
                <th class="text-center">DPI</th>
                <th class="text-center">Email</th>
                <th class="text-center">Teléfono Personal</th>
                <th class="text-center">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($employees as $employee)
            <tr class="text-center">
                <td class="text-center">{{ $loop->iteration }}</td>
                <td class="text-center">{{ $employee->nombre }}</td>
                <td class="text-center">{{ $employee->dpi }}</td>
                <td class="text-center">{{ $employee->email }}</td>
                <td class="text-center">{{ $employee->telefono_personal }}</td>
                <td class="text-center">
                    <!-- Botón para abrir el modal de mostrar -->
                    <a href="#" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#showEmployeeModal-{{ $employee->id }}">
                        <i class="fa fa-eye"></i>
                    </a>

                    <!-- Incluir el modal desde un archivo separado -->
                    @include('employees.show-modal', ['employee' => $employee])

                    <!-- Botón para abrir el modal de editar -->
                    <a href="#" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editEmployeeModal-{{ $employee->id }}">
                        <i class="fa fa-edit"></i>
                    </a>

                    <!-- Incluir el modal desde un archivo separado -->
                    @include('employees.edit-modal', ['employee' => $employee])

                    <!-- Botón para abrir el minimodal de confirmación -->
                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#miniConfirmDeleteModal-{{ $employee->id }}">
                        <i class="fa fa-trash"></i>
                    </button>

                    <!-- Minimodal de confirmación -->
                    <div class="modal fade" id="miniConfirmDeleteModal-{{ $employee->id }}" tabindex="-1" aria-labelledby="miniConfirmDeleteModalLabel-{{ $employee->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-sm">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="miniConfirmDeleteModalLabel-{{ $employee->id }}">Confirmar</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body text-center">
                                    ¿Eliminar al empleado <strong>{{ $employee->nombre }}</strong>?
                                </div>
                                <div class="modal-footer justify-content-center">
                                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancelar</button>
                                    <form action="{{ route('employees.destroy', $employee->id) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<style>
    .notification {
        position: fixed;
        top: 60px;
        right: 20px;
        z-index: 1050;
        max-width: 250px;
        max-height: 100px;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const alertElement = document.querySelector('.alert-danger, .alert-success, .alert-primary');
        if (alertElement) {
            alertElement.classList.add('notification');
            setTimeout(() => {
                alertElement.classList.add('fade');
                setTimeout(() => alertElement.remove(), 150);
            }, 5000); // 5 segundos
        }
    });
</script>

@endsection
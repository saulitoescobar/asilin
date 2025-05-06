@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center">Lista de Empleados</h1>
    
    <!-- Mostrar notificación de éxito -->
    @if (session('success'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <!-- Botón para abrir el modal -->
    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#createEmployeeModal">
        Agregar Empleado
    </button>

    <!-- Incluir el modal desde un archivo separado -->
    @include('employees.create-modal')

    <table class="table table-bordered">
        <thead>
            <tr class="text-center"  style="background-color: navy; color: white;">
                <th>#</th>
                <th>Nombre</th>
                <th>DPI</th>
                <th>Email</th>
                <th>Teléfono Personal</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($employees as $employee)
            <tr class="text-center">
                <td>{{ $loop->iteration }}</td>
                <td>{{ $employee->nombre }}</td>
                <td>{{ $employee->dpi }}</td>
                <td>{{ $employee->email }}</td>
                <td>{{ $employee->telefono_personal }}</td>
                <td>
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
        bottom: 20px;
        right: 20px;
        z-index: 1050;
        max-width: 250px;
        max-height: 100px;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const alertElement = document.querySelector('.alert-danger');
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
@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center">Lista de Empleados</h1>
    <a href="{{ route('employees.create') }}" class="btn btn-primary mb-3">Agregar Empleado</a>

    <table class="table table-bordered">
        <thead>
            <tr class="text-center"  style="background-color: navy; color: white;">
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
                <td>{{ $employee->nombre }}</td>
                <td>{{ $employee->dpi }}</td>
                <td>{{ $employee->email }}</td>
                <td>{{ $employee->telefono_personal }}</td>
                <td>
                    <a href="{{ route('employees.show', $employee->id) }}" class="btn btn-info btn-sm">
                        <i class="fa fa-eye"></i>
                    </a>
                    <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-warning btn-sm">
                        <i class="fa fa-edit"></i>
                    </a>
                    <form action="{{ route('employees.destroy', $employee->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">
                            <i class="fa fa-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
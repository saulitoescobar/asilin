<!-- Modal -->
<div class="modal fade" id="editEmployeeModal-{{ $employee->id }}" tabindex="-1" aria-labelledby="editEmployeeModalLabel-{{ $employee->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editEmployeeModalLabel-{{ $employee->id }}">Editar Empleado</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('employees.update', $employee->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row mb-3">
                        <label for="nombre-{{ $employee->id }}" class="col-sm-4 col-form-label">Nombre</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="nombre-{{ $employee->id }}" name="nombre" value="{{ $employee->nombre }}" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="dpi-{{ $employee->id }}" class="col-sm-4 col-form-label">DPI</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="dpi-{{ $employee->id }}" name="dpi" value="{{ $employee->dpi }}" maxlength="13" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="email-{{ $employee->id }}" class="col-sm-4 col-form-label">Email</label>
                        <div class="col-sm-8">
                            <input type="email" class="form-control" id="email-{{ $employee->id }}" name="email" value="{{ $employee->email }}" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="telefono_personal-{{ $employee->id }}" class="col-sm-4 col-form-label">Teléfono Personal</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="telefono_personal-{{ $employee->id }}" name="telefono_personal" value="{{ $employee->telefono_personal }}" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
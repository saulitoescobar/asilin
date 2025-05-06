<!-- Modal -->
<div class="modal fade" id="showEmployeeModal-{{ $employee->id }}" tabindex="-1" aria-labelledby="showEmployeeModalLabel-{{ $employee->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="showEmployeeModalLabel-{{ $employee->id }}">Detalles del Empleado</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row mb-3">
                        <label for="nombre-{{ $employee->id }}" class="col-sm-4 col-form-label">Nombre</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="nombre-{{ $employee->id }}" value="{{ $employee->nombre }}" readonly>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="dpi-{{ $employee->id }}" class="col-sm-4 col-form-label">DPI</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="dpi-{{ $employee->id }}" value="{{ $employee->dpi }}" readonly>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="email-{{ $employee->id }}" class="col-sm-4 col-form-label">Email</label>
                        <div class="col-sm-8">
                            <input type="email" class="form-control" id="email-{{ $employee->id }}" value="{{ $employee->email }}" readonly>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="telefono_personal-{{ $employee->id }}" class="col-sm-4 col-form-label">Teléfono Personal</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="telefono_personal-{{ $employee->id }}" value="{{ $employee->telefono_personal }}" readonly>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editEmployeeModal-{{ $employee->id }}" data-bs-dismiss="modal">
                    <i class="fa fa-edit"></i> Editar
                </button>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                    <i class="fa fa-sign-out-alt"></i> Salir
                </button>
            </div>
        </div>
    </div>
</div>
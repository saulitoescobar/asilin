<!-- Modal -->
<div class="modal fade" id="showCompanyModal-{{ $company->id }}" tabindex="-1" aria-labelledby="showCompanyModalLabel-{{ $company->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="showCompanyModalLabel-{{ $company->id }}">Detalles de la Empresa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row mb-3">
                        <label for="nombre-{{ $company->id }}" class="col-sm-4 col-form-label">Nombre</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="nombre-{{ $company->id }}" value="{{ $company->nombre }}" readonly>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="direccion-{{ $company->id }}" class="col-sm-4 col-form-label">Dirección</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="direccion-{{ $company->id }}" value="{{ $company->direccion }}" readonly>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="contacto-{{ $company->id }}" class="col-sm-4 col-form-label">Contacto</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="contacto-{{ $company->id }}" value="{{ $company->contacto }}" readonly>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="representante-{{ $company->id }}" class="col-sm-4 col-form-label">Representante Legal</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="representante-{{ $company->id }}" value="{{ $company->representante_legal }}" readonly>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="documentSelect-{{ $company->id }}" class="col-sm-4 col-form-label">Selecciona un documento</label>
                        <div class="col-sm-8">
                            <select class="form-select" id="documentSelect-{{ $company->id }}" onchange="showDocument(this, 'documentFrame--{{ $company->id }}')">
                                <option value="" selected disabled>Elige un documento</option>
                                @foreach ($company->legalDocuments as $document)
                                    <option value="{{ asset($document->file_path) }}">{{ $document->file_name ?? 'Documento sin nombre' }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <iframe id="documentFrame--{{ $company->id }}" src="" style="width: 100%; height: 500px; border: none; display: none;"></iframe>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                    <i class="fa fa-sign-out-alt"></i> Salir
                </button>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editCompanyModal-{{ $company->id }}" data-bs-dismiss="modal">
                    <i class="fa fa-edit"></i> Editar
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    function showDocument(select, frameId) {
        const frame = document.getElementById(frameId);
        console.log('Documento seleccionado:', select.value); // Registro para depuración
        if (select.value) {
            frame.src = select.value;
            frame.style.display = 'block';
        } else {
            frame.style.display = 'none';
        }
    }
</script>
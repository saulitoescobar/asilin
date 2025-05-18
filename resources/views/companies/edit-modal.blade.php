<!-- Modal para editar empresa -->
<div class="modal fade" id="editCompanyModal{{ $company->id }}" tabindex="-1" aria-labelledby="editCompanyModalLabel{{ $company->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editCompanyModalLabel{{ $company->id }}">Editar Empresa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('companies.update', $company->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nombre{{ $company->id }}" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="nombre{{ $company->id }}" name="nombre" value="{{ $company->nombre }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="direccion{{ $company->id }}" class="form-label">Dirección</label>
                        <input type="text" class="form-control" id="direccion{{ $company->id }}" name="direccion" value="{{ $company->direccion }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="contacto{{ $company->id }}" class="form-label">Contacto</label>
                        <input type="text" class="form-control" id="contacto{{ $company->id }}" name="contacto" value="{{ $company->contacto }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="representante_legal{{ $company->id }}" class="form-label">Representante Legal</label>
                        <input type="text" class="form-control" id="representante_legal{{ $company->id }}" name="representante_legal" value="{{ $company->representante_legal }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="documentos_legales_existentes{{ $company->id }}" class="form-label">Documentos Legales Existentes</label>
                        <ul>
                            @foreach ($company->legalDocuments as $document)
                                <li>
                                    <a href="{{ asset($document->file_path) }}" target="_blank">Ver Documento</a>
                                    <form action="{{ route('companies.deleteDocument', $document->id) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                    </form>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div id="documentos-container-{{ $company->id }}">
                        <div class="mb-3 d-flex align-items-center">
                            <input type="text" class="form-control me-2" name="documentos_nombres[]" placeholder="Nombre del archivo (opcional)">
                            <button type="button" class="btn btn-primary upload-btn">
                                <i class="fa fa-upload"></i>
                            </button>
                            <input type="file" class="form-control d-none" name="documentos_legales[]" accept=".pdf,.jpg">
                        </div>
                    </div>
                    <button type="button" class="btn btn-secondary" id="add-document-{{ $company->id }}">Agregar más documentos</button>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.getElementById('add-document-{{ $company->id }}').addEventListener('click', function() {
        const container = document.getElementById('documentos-container-{{ $company->id }}');
        const newInput = document.createElement('div');
        newInput.classList.add('mb-3', 'd-flex', 'align-items-center');
        newInput.innerHTML = `
            <input type="text" class="form-control me-2" name="documentos_nombres[]" placeholder="Nombre del archivo (opcional)">
            <button type="button" class="btn btn-primary upload-btn">
                <i class="fa fa-upload"></i>
            </button>
            <input type="file" class="form-control d-none" name="documentos_legales[]" accept=".pdf,.jpg">
        `;
        container.appendChild(newInput);

        // Add event listener for the new upload button
        const uploadBtn = newInput.querySelector('.upload-btn');
        const fileInput = newInput.querySelector('input[type="file"]');
        uploadBtn.addEventListener('click', function() {
            fileInput.click();
        });
    });

    // Add event listener for the initial upload button
    document.querySelectorAll('.upload-btn').forEach(function(btn) {
        const fileInput = btn.nextElementSibling;
        btn.addEventListener('click', function() {
            fileInput.click();
        });
    });
</script>
<script>
    // Limpia cualquier backdrop huérfano al cerrar cualquier modal
    document.querySelectorAll('.modal').forEach(function(modal) {
        modal.addEventListener('hidden.bs.modal', function () {
            document.body.classList.remove('modal-open');
            let backdrops = document.querySelectorAll('.modal-backdrop');
            backdrops.forEach(function(bd) { bd.parentNode.removeChild(bd); });
        });
    });
</script>
<script>
    // Elimina el script AJAX individual para evitar conflicto con el global
</script>
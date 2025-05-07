<!-- Modal para crear empresa -->
<div class="modal fade" id="createCompanyModal" tabindex="-1" aria-labelledby="createCompanyModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createCompanyModalLabel">Agregar Empresa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('companies.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" required>
                    </div>
                    <div class="mb-3">
                        <label for="direccion" class="form-label">Dirección</label>
                        <input type="text" class="form-control" id="direccion" name="direccion" required>
                    </div>
                    <div class="mb-3">
                        <label for="contacto" class="form-label">Contacto</label>
                        <input type="text" class="form-control" id="contacto" name="contacto" required>
                    </div>
                    <div class="mb-3">
                        <label for="representante_legal" class="form-label">Representante Legal</label>
                        <input type="text" class="form-control" id="representante_legal" name="representante_legal" required>
                    </div>
                    <div id="documentos-container">
                    </div>
                    <button type="button" class="btn btn-secondary" id="add-document">Agregar documentos</button>
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
    document.getElementById('add-document').addEventListener('click', function() {
        const container = document.getElementById('documentos-container');
        const newInput = document.createElement('div');
        newInput.classList.add('mb-3', 'd-flex', 'align-items-center');
        newInput.innerHTML = `
            <input type="text" class="form-control me-2" name="documentos_nombres[]" placeholder="Nombre del archivo (opcional)">
            <button type="button" class="btn btn-primary upload-btn">
                <i class="fa fa-upload"></i>
            </button>
            <input type="file" class="form-control d-none" name="documentos_legales[]" accept=".pdf">
        `;
        container.appendChild(newInput);

        // Add event listener for the new upload button
        const uploadBtn = newInput.querySelector('.upload-btn');
        const fileInput = newInput.querySelector('input[type="file"]');
        uploadBtn.addEventListener('click', function() {
            fileInput.click();
        });

        // Log the newly added input fields for debugging
        console.log('New input added:', newInput);
    });

    // Add event listener for the initial upload button
    console.log('Initial upload buttons:', document.querySelectorAll('.upload-btn'));
    document.querySelectorAll('.upload-btn').forEach(function(btn) {
        const fileInput = btn.nextElementSibling;
        btn.addEventListener('click', function() {
            fileInput.click();
        });
    });

    // Add event listener for form submission
    document.querySelector('form').addEventListener('submit', function(event) {
        const allInputs = document.querySelectorAll('#documentos-container input[type="file"]');
        console.log('All file inputs before submission:', allInputs);
    });
</script>
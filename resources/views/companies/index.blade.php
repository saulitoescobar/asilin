@extends('layouts.app')

@section('title', 'Lista de Empresas')

@section('content')
<div class="container mt-4">
    <h1 class="text-center">Lista de Empresas</h1>

    <!-- Mostrar notificación de éxito -->
    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <!-- Botón para abrir el modal -->
    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#createCompanyModal">
        Crear Empresa
    </button>

    <!-- Incluir el modal desde un archivo separado -->
    @include('companies.create-modal')

    <table class="table table-striped table-hover table-bordered align-middle">
        <thead class="table-dark">
            <tr class="text-center">
                <th>#</th>
                <th>Nombre</th>
                <th>Dirección</th>
                <th>Contacto</th>
                <th>Representante Legal</th>
                <th>Documentos Legales</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($companies as $company)
            <tr class="text-center">
                <td>{{ $loop->iteration }}</td>
                <td>{{ $company->nombre }}</td>
                <td>{{ $company->direccion }}</td>
                <td>{{ $company->contacto }}</td>
                <td>{{ $company->representante_legal }}</td>
                <td>
                    <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#documentsModal-{{ $company->id }}">
                        <i class="fa-solid fa-file"></i>
                    </button>

                    <!-- Modal para mostrar documentos -->
                    <div class="modal fade" id="documentsModal-{{ $company->id }}" tabindex="-1" aria-labelledby="documentsModalLabel-{{ $company->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="documentsModalLabel-{{ $company->id }}">Documentos de {{ $company->nombre }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="documentSelect-{{ $company->id }}" class="form-label">Selecciona un documento</label>
                                        <select class="form-select" id="documentSelect-{{ $company->id }}" onchange="showDocumentForDocumentsModal(this, 'documentFrame-{{ $company->id }}')">
                                            <option value="" selected disabled>Elige un documento</option>
                                            @foreach ($company->legalDocuments as $document)
                                                <option value="{{ asset($document->file_path) }}">{{ $document->file_name ?? 'Documento sin nombre' }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <iframe id="documentFrame-{{ $company->id }}" src="" style="width: 100%; height: 500px; border: none; display: none;" onload="console.log('Documento cargado en el iframe:', this.src);"></iframe>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
                <td>
                    <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#showCompanyModal-{{ $company->id }}">
                        <i class="fa fa-eye"></i>
                    </button>
                    <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editCompanyModal{{ $company->id }}">
                        <i class="fa fa-edit"></i>
                    </button>
                    <form action="{{ route('companies.destroy', $company->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">
                            <i class="fa fa-trash"></i>
                        </button>
                    </form>
                </td>

                <!-- Incluir los modales desde archivos separados -->
                @include('companies.show-modal', ['company' => $company])
                @include('companies.edit-modal', ['company' => $company])
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@push('scripts')
<script>
    (function() {
        document.querySelectorAll('form[action*="companies/"][method="post"]').forEach(function(form) {
            form.addEventListener('submit', function(e) {
                const methodInput = form.querySelector('input[name="_method"][value="PUT"]');
                if (!methodInput) return;
                e.preventDefault();
                const formData = new FormData(form);
                formData.set('_method', 'PUT');
                fetch(form.action, {
                    method: 'POST',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: formData
                })
                .then(response => {
                    if (response.ok) {
                        const modalId = form.closest('.modal').id;
                        const modal = bootstrap.Modal.getInstance(document.getElementById(modalId));
                        if (modal) modal.hide();
                        location.reload();
                    } else {
                        return response.text().then(text => { throw new Error(text); });
                    }
                })
                .catch(error => {
                    alert('Error al guardar: ' + error.message);
                });
            });
        });
    })();
</script>
@endpush
<script>
    function showDocumentForDocumentsModal(select, frameId) {
        const frame = document.getElementById(frameId);
        console.log('Dropdown seleccionado:', select);
        console.log('Valor seleccionado:', select.value); // Registro para depuración

        if (select.value) {
            frame.src = select.value;
            frame.style.display = 'block';
        } else {
            frame.style.display = 'none';
        }
    }
</script>
@endsection
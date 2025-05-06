import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap';
import '@fortawesome/fontawesome-free/css/all.min.css';
import 'datatables.net-bs5';
import 'datatables.net-bs5/css/dataTables.bootstrap5.min.css';
import $ from 'jquery';
window.$ = window.jQuery = $;

// Asegurarse de que jQuery esté completamente cargado antes de inicializar DataTables
document.addEventListener('DOMContentLoaded', function () {
    const table = document.querySelector('.table');
    if (table) {
        $(document).ready(function () {
            $(table).DataTable({
                paging: true, // Habilitar o deshabilitar la paginación
        searching: true, // Habilitar o deshabilitar la barra de búsqueda
        ordering: true, // Habilitar o deshabilitar el ordenamiento de columnas
        info: true, // Mostrar información sobre la tabla (ej. "Mostrando 1 a 10 de 50 registros")
        pageLength: 5, // Número de registros por página
        lengthMenu: [5, 10, 25, 50, 100], // Opciones de registros por página
        language: {
                    url: '/lang/Spanish.json'
                },
            });
        });
    }
});

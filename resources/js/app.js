import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap';
import '@fortawesome/fontawesome-free/css/all.min.css';
import 'datatables.net-bs5';
import 'datatables.net-bs5/css/dataTables.bootstrap5.min.css';
import $ from 'jquery';
window.$ = window.jQuery = $;

import 'datatables.net-buttons-bs5';
import 'datatables.net-buttons/js/buttons.html5.min.js';
import 'datatables.net-buttons/js/buttons.print.min.js';
import 'datatables.net-buttons/js/buttons.colVis.min.js';
import 'datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css';

import JSZip from 'jszip';
window.JSZip = JSZip;

// Asegurarse de que jQuery esté completamente cargado antes de inicializar DataTables
document.addEventListener('DOMContentLoaded', function () {
    const table = document.querySelector('.table');
    if (table) {
        $(document).ready(function () {
            const tableInstance = $(table).DataTable({
                paging: true, // Habilitar o deshabilitar la paginación
                searching: true, // Habilitar o deshabilitar la barra de búsqueda
                ordering: true, // Habilitar o deshabilitar el ordenamiento de columnas
                info: true, // Mostrar información sobre la tabla (ej. "Mostrando 1 a 10 de 50 registros")
                pageLength: 5, // Número de registros por página
                lengthMenu: [5, 10, 25, 50, 100], // Opciones de registros por página
                dom: '<"d-flex justify-content-between align-items-center mb-3"<"d-flex align-items-center"B><"d-flex align-items-center ms-auto"f>>t<"d-flex justify-content-between"i<"d-flex align-items-center justify-content-end"p>>', // Define la posición de los botones y la paginación
                buttons: [
                    {
                        extend: 'copyHtml5',
                        text: '<i class="fa fa-copy"></i>',
                        className: 'btn btn-secondary btn-sm',
                        titleAttr: 'Copiar',
                        exportOptions: {
                            columns: ':visible:not(:last-child)', // Excluir la última columna (Acciones)
                            format: {
                                body: function (data, row, column, node) {
                                    return $(node).text().trim(); // Extraer solo el texto visible
                                }
                            }
                        }
                    },
                    {
                        extend: 'excelHtml5',
                        text: '<i class="fa fa-file-excel"></i>',
                        className: 'btn btn-success btn-sm',
                        titleAttr: 'Exportar a Excel (.xlsx)',
                        exportOptions: {
                            columns: ':visible:not(:last-child)',
                            format: {
                                body: function (data, row, column, node) {
                                    return $(node).text().trim();
                                }
                            }
                        }
                    },
                    {
                        extend: 'csvHtml5',
                        text: '<i class="fa fa-file-csv"></i>',
                        className: 'btn btn-info btn-sm',
                        titleAttr: 'Exportar a CSV',
                        exportOptions: {
                            columns: ':visible:not(:last-child)',
                            format: {
                                body: function (data, row, column, node) {
                                    return $(node).text().trim();
                                }
                            }
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        text: '<i class="fa fa-file-pdf"></i>',
                        className: 'btn btn-danger btn-sm',
                        titleAttr: 'Exportar a PDF',
                        customize: function (doc) {
                            doc.styles.tableHeader = {
                                bold: true,
                                fontSize: 12,
                                color: 'white',
                                fillColor: '#4CAF50',
                                alignment: 'center'
                            };
                            doc.styles.tableBodyEven = {
                                fillColor: '#f3f3f3'
                            };
                            doc.styles.tableBodyOdd = {
                                fillColor: 'white'
                            };
                            doc.content[1].table.widths = Array(doc.content[1].table.body[0].length + 1).join('*').split('');
                        },
                        exportOptions: {
                            columns: ':visible:not(:last-child)',
                            format: {
                                body: function (data, row, column, node) {
                                    return $(node).text().trim();
                                }
                            }
                        }
                    },
                    {
                        extend: 'print',
                        text: '<i class="fa fa-print"></i>',
                        className: 'btn btn-primary btn-sm',
                        titleAttr: 'Imprimir',
                        customize: function (win) {
                            $(win.document.body).css('font-size', '10pt').css('background-color', '#f3f3f3');
                            $(win.document.body).find('table').addClass('compact').css('font-size', 'inherit');
                        },
                        exportOptions: {
                            columns: ':visible:not(:last-child)',
                            format: {
                                body: function (data, row, column, node) {
                                    return $(node).text().trim();
                                }
                            }
                        }
                    },
                    {
                        extend: 'colvis',
                        text: '<i class="fa fa-columns"></i>',
                        className: 'btn btn-warning btn-sm',
                        titleAttr: 'Visibilidad de Columnas'
                    }
                ],
                language: {
                    url: '/lang/Spanish.json'
                }
            });
        });
    }
});

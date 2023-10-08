"use strict";

// Class definition
var KTDatatablesServerSideAllowances = function () {
    // Shared variables
    var table;
    var dt;
    var filterPayment;
    var staff_id = $("#staff_id").val();

    let main_url = "/admin/staff_profile/getallowances/"+staff_id;
    var action_lang = $("#action_lang").val();
    var edit_lang = $("#edit_lang").val();
    var delete_lang = $("#delete_lang").val();

    // Private functions
    var initDatatable = function () {
        dt = $("#kt_datatable_table_allowances").DataTable({

            lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
            dom: 'Blrtip',
            searchDelay: 500,
            processing: true,
            serverSide: true,
            order: [[1, 'desc']],
            stateSave: false,
            select: {
                style: 'os',
                selector: 'td:first-child',
                className: 'row-selected'
            },
            ajax: {
                url: main_url,
            },
            columns: [
                { data: '#' },
                { data: 'id' },
                { data: 'allowances_name' },
                { data: 'amount' },
                { data: 'date' },
                { data: 'active' },
                { data: 'created_at' },
            ],
            buttons: [
                'copy',
                'excel',
                'pdf',
                'print',
                {
                    extend: 'csv',
                    charset: 'UTF-8',
                    bom: true,
                    exportOptions: {
                        columns: [ 1, 2, 3, 4 ]
                    }
                }
            ],
           
        });

        dt.buttons().container().appendTo('#export_buttons');

        table = dt.$;

        // Re-init functions on every table re-draw -- more info: https://datatables.net/reference/event/draw
        dt.on('draw', function () {
            KTMenu.createInstances();
        });
    }

  

  

    // Public methods
    return {
        init: function () {
            initDatatable();
            
        }
    }
}();

// On document ready
KTUtil.onDOMContentLoaded(function () {
    KTDatatablesServerSideAllowances.init();
});
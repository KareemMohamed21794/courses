"use strict";

// Class definition
var KTDatatablesServerSideShifts = function () {
    // Shared variables
    var table;
    var dt;
    var filterPayment;
    var staff_id = $("#staff_id").val();

    let main_url = "/admin/staff_profile/getshifts/"+staff_id;

    // Private functions
    var initDatatable = function () {
        dt = $("#kt_datatable_table_shifts").DataTable({

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
                { data: 'shift' },
                { data: 'type' },
                { data: 'date' },
                { data: 'days_string' },
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
             
            // // Add data-filter attribute
            // createdRow: function (row, data, dataIndex) {
            //     $(row).find('td:eq(4)').attr('data-filter', data.CreditCardType);
            // }
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
    KTDatatablesServerSideShifts.init();
});
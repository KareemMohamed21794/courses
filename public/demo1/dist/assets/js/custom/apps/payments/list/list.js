"use strict";

var KTPaymentsList = function () {
    var dt;
    var getUrl = document.getElementById('payments_get_url').value;
    var exportUrl = document.getElementById('payments_export_url').value;

    var buildAjaxUrl = function () {
        var status = document.getElementById('payment_status_filter').value;
        var courseId = document.getElementById('payment_course_filter').value;
        return getUrl + '?status=' + encodeURIComponent(status) + '&course_id=' + encodeURIComponent(courseId);
    };

    var currentFilters = function () {
        return {
            status: document.getElementById('payment_status_filter').value,
            course_id: document.getElementById('payment_course_filter').value,
            search: document.querySelector('[data-kt-payments-table-filter="search"]').value
        };
    };

    var initDatatable = function () {
        dt = $("#kt_payments_table").DataTable({
            displayLength: 25,
            lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "الكل"]],
            dom: 'Brltip',
            searchDelay: 400,
            processing: true,
            serverSide: true,
            order: [[0, 'desc']],
            stateSave: false,
            ajax: {
                url: buildAjaxUrl(),
            },
            columns: [
                { data: 'id' },
                { data: 'course_title' },
                { data: 'phone_number' },
                { data: 'name' },
                { data: 'payment_image', orderable: false, searchable: false },
                { data: 'status_label', orderable: false },
                { data: 'created_at' },
                { data: 'actions', orderable: false, searchable: false },
            ],
            buttons: KTReportExport.buttons(exportUrl, currentFilters),
            columnDefs: [
                {
                    targets: 2,
                    render: function (data) {
                        return '<span dir="ltr">' + data + '</span>';
                    }
                },
                {
                    targets: -1,
                    className: 'text-end'
                }
            ]
        });

        dt.buttons().container().appendTo('#export_buttons');
    };

    var handleSearch = function () {
        var filterSearch = document.querySelector('[data-kt-payments-table-filter="search"]');
        filterSearch.addEventListener('keyup', function (e) {
            dt.search(e.target.value).draw();
        });
    };

    var handleFilters = function () {
        document.getElementById('payment_status_filter').addEventListener('change', function () {
            dt.ajax.url(buildAjaxUrl()).load();
        });

        document.getElementById('payment_course_filter').addEventListener('change', function () {
            dt.ajax.url(buildAjaxUrl()).load();
        });

        document.querySelector('[data-kt-payments-table-filter="reset"]').addEventListener('click', function () {
            document.querySelector('[data-kt-payments-table-filter="search"]').value = '';
            document.getElementById('payment_status_filter').value = 'all';
            document.getElementById('payment_course_filter').value = 'all';
            dt.search('').ajax.url(buildAjaxUrl()).draw();
        });
    };

    return {
        init: function () {
            initDatatable();
            handleSearch();
            handleFilters();
        }
    };
}();

KTUtil.onDOMContentLoaded(function () {
    KTPaymentsList.init();
});

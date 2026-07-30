"use strict";

var KTCoursesList = function () {
    var dt;
    var getUrl = document.getElementById('admin_table_get_url').value;
    var exportUrl = document.getElementById('admin_table_export_url').value;

    var buildAjaxUrl = function () {
        var status = document.getElementById('course_status_filter').value;
        return getUrl + '?status=' + encodeURIComponent(status);
    };

    var currentFilters = function () {
        return {
            status: document.getElementById('course_status_filter').value,
            search: document.querySelector('[data-kt-admin-table-filter="search"]').value
        };
    };

    var initDatatable = function () {
        dt = $("#kt_courses_table").DataTable({
            displayLength: 25,
            lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "الكل"]],
            dom: 'Brltip',
            searchDelay: 400,
            processing: true,
            serverSide: true,
            order: [[0, 'desc']],
            ajax: { url: buildAjaxUrl() },
            columns: [
                { data: 'id' },
                { data: 'thumbnail', orderable: false, searchable: false },
                { data: 'title' },
                { data: 'status_label', orderable: false },
                { data: 'created_at' },
                { data: 'actions', orderable: false, searchable: false },
            ],
            buttons: KTReportExport.buttons(exportUrl, currentFilters),
            columnDefs: [
                { targets: -1, className: 'text-end' }
            ]
        });

        dt.buttons().container().appendTo('#export_buttons');
    };

    var handleSearch = function () {
        document.querySelector('[data-kt-admin-table-filter="search"]').addEventListener('keyup', function (e) {
            dt.search(e.target.value).draw();
        });
    };

    var handleFilters = function () {
        document.getElementById('course_status_filter').addEventListener('change', function () {
            dt.ajax.url(buildAjaxUrl()).load();
        });

        document.querySelector('[data-kt-admin-table-filter="reset"]').addEventListener('click', function () {
            document.querySelector('[data-kt-admin-table-filter="search"]').value = '';
            document.getElementById('course_status_filter').value = 'all';
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
    KTCoursesList.init();
});

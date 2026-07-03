"use strict";

var KTCoursesList = function () {
    var dt;
    var getUrl = document.getElementById('admin_table_get_url').value;
    var exportPdfUrl = document.getElementById('admin_table_export_pdf_url').value;

    var buildAjaxUrl = function () {
        var status = document.getElementById('course_status_filter').value;
        return getUrl + '?status=' + encodeURIComponent(status);
    };

    var exportPdf = function () {
        var status = document.getElementById('course_status_filter').value;
        var search = document.querySelector('[data-kt-admin-table-filter="search"]').value;
        var url = exportPdfUrl
            + '?status=' + encodeURIComponent(status)
            + '&search=' + encodeURIComponent(search);
        window.open(url, '_blank');
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
            buttons: [
                {
                    text: '<span class="svg-icon svg-icon-2 me-1"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"><path d="M19.5 8.25H18V4.5C18 3.67157 17.3284 3 16.5 3H7.5C6.67157 3 6 3.67157 6 4.5V8.25H4.5C3.67157 8.25 3 8.92157 3 9.75V19.5C3 20.3284 3.67157 21 4.5 21H19.5C20.3284 21 21 20.3284 21 19.5V9.75C21 8.92157 20.3284 8.25 19.5 8.25Z" fill="black"/></svg></span>تصدير PDF',
                    className: 'btn btn-light-primary',
                    action: function () { exportPdf(); }
                },
                {
                    extend: 'excel',
                    title: 'الكورسات',
                    text: 'Excel',
                    charset: 'UTF-8',
                    bom: true,
                    exportOptions: {
                        columns: [0, 2, 3, 4],
                        orthogonal: 'export',
                    }
                }
            ],
            columnDefs: [
                {
                    targets: 3,
                    render: function (data, type, row) {
                        if (type === 'export') return row.status;
                        return data;
                    }
                },
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

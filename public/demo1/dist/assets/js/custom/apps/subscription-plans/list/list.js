"use strict";

var KTSubscriptionPlansList = function () {
    var dt;
    var getUrl = document.getElementById('plans_get_url').value;
    var exportUrl = document.getElementById('plans_export_url').value;

    var buildAjaxUrl = function () {
        var status = document.getElementById('plan_status_filter').value;
        var courseId = document.getElementById('plan_course_filter').value;
        return getUrl + '?status=' + encodeURIComponent(status) + '&course_id=' + encodeURIComponent(courseId);
    };

    var currentFilters = function () {
        return {
            status: document.getElementById('plan_status_filter').value,
            course_id: document.getElementById('plan_course_filter').value,
            search: document.querySelector('[data-kt-plans-table-filter="search"]').value
        };
    };

    var initDatatable = function () {
        dt = $("#kt_plans_table").DataTable({
            displayLength: 25,
            lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "الكل"]],
            dom: 'Brltip',
            searchDelay: 400,
            processing: true,
            serverSide: true,
            order: [[0, 'desc']],
            ajax: {
                url: buildAjaxUrl(),
            },
            buttons: KTReportExport.buttons(exportUrl, currentFilters),
            columns: [
                { data: 'id' },
                { data: 'name' },
                { data: 'course_title', orderable: false },
                { data: 'duration', orderable: false },
                { data: 'price' },
                { data: 'status_label', orderable: false },
                { data: 'created_at' },
                { data: 'actions', orderable: false, searchable: false },
            ],
            columnDefs: [
                {
                    targets: -1,
                    className: 'text-end',
                    render: function (data) {
                        return data;
                    }
                }
            ]
        });

        dt.buttons().container().appendTo('#export_buttons');
    };

    var handleSearch = function () {
        var filterSearch = document.querySelector('[data-kt-plans-table-filter="search"]');
        filterSearch.addEventListener('keyup', function () {
            dt.search(filterSearch.value).draw();
        });
    };

    var handleFilters = function () {
        document.getElementById('plan_status_filter').addEventListener('change', function () {
            dt.ajax.url(buildAjaxUrl()).load();
        });
        document.getElementById('plan_course_filter').addEventListener('change', function () {
            dt.ajax.url(buildAjaxUrl()).load();
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
    KTSubscriptionPlansList.init();
});

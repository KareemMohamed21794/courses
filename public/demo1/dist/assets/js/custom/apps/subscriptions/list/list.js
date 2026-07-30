"use strict";

var KTSubscriptionsList = function () {
    var dt;
    var getUrl = document.getElementById('subscriptions_get_url').value;
    var exportUrl = document.getElementById('subscriptions_export_url').value;

    var buildAjaxUrl = function () {
        var status = document.getElementById('subscription_status_filter').value;
        var courseId = document.getElementById('subscription_course_filter').value;
        return getUrl + '?status=' + encodeURIComponent(status) + '&course_id=' + encodeURIComponent(courseId);
    };

    var currentFilters = function () {
        return {
            status: document.getElementById('subscription_status_filter').value,
            course_id: document.getElementById('subscription_course_filter').value,
            search: document.querySelector('[data-kt-subscriptions-table-filter="search"]').value
        };
    };

    var initDatatable = function () {
        dt = $("#kt_subscriptions_table").DataTable({
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
            columns: [
                { data: 'id' },
                { data: 'course_title', orderable: false },
                { data: 'phone_number' },
                { data: 'name' },
                { data: 'plan_name', orderable: false },
                { data: 'payment_image', orderable: false, searchable: false },
                { data: 'status_label', orderable: false },
                { data: 'start_date' },
                { data: 'end_date' },
                { data: 'remaining_days', orderable: false },
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
        var filterSearch = document.querySelector('[data-kt-subscriptions-table-filter="search"]');
        filterSearch.addEventListener('keyup', function () {
            dt.search(filterSearch.value).draw();
        });
    };

    var handleFilters = function () {
        document.getElementById('subscription_status_filter').addEventListener('change', function () {
            dt.ajax.url(buildAjaxUrl()).load();
        });
        document.getElementById('subscription_course_filter').addEventListener('change', function () {
            dt.ajax.url(buildAjaxUrl()).load();
        });
        document.querySelector('[data-kt-subscriptions-table-filter="reset"]').addEventListener('click', function () {
            document.querySelector('[data-kt-subscriptions-table-filter="search"]').value = '';
            document.getElementById('subscription_status_filter').value = 'all';
            document.getElementById('subscription_course_filter').value = 'all';
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
    KTSubscriptionsList.init();
});

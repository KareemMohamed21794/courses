"use strict";

// Class definition
var KTDatatablesServerSide = function () {
    // Shared variables
    var table;
    var dt;
    var filterPayment;
    var is_super = $("#is_super").val();
    var firstSegment = $("#firstSegment").val();
    let main_url = "/admin/organizing_study/get";
    var action_lang = $("#action_lang").val();
    var edit_lang = $("#edit_lang").val();
    var delete_lang = $("#delete_lang").val();

    var adminColumns = [
    { data: '#' },
    { data: 'order' },
    // { data: 'id' },
    { data: 'study_place' },
    { data: 'practical_place' },
    { data: 'proposed_time_study' },
    { data: 'maximum_number_students' },
    { data: 'proposed_study_supervisor' },
    { data: 'status' },
    { data: 'reject_notes' },
    { data: 'created_at' },
    { data: null },
   ];

    var userColumns = [
        { data: '#' },
        { data: 'order' },
        // { data: 'id' },
        { data: 'study_place' },
        { data: 'practical_place' },
        { data: 'proposed_time_study' },
        { data: 'maximum_number_students' },
        { data: 'proposed_study_supervisor' },
        { data: 'status' },
        { data: 'reject_notes' },
        
        { data: 'created_at' },
        { data: null },
    ];

     var chosenColumns = is_super === '0' ? userColumns : adminColumns;



    // Private functions
    var initDatatable = function () {

        dt = $("#kt_datatable_table").DataTable({

            displayLength: 50,
            lengthMenu: [[10, 25, 50, 100, 500, 1000, 5000, -1], [10, 25, 50, 100, 500, 1000, 5000, "All"]],
            dom: 'Brltip',
            searchDelay: 500,
            processing: true,
            serverSide: true,
            order: [[1, 'desc']],
            stateSave: true,
            select: {
                style: 'os',
                selector: 'td:first-child',
                className: 'row-selected'
            },
            ajax: {
                url: main_url,
            },
            columns: chosenColumns,
            buttons: [
                // 'copy',
                // {
                //     extend: 'pdf',
                //     text: 'PDF',
                //     charset: 'UTF-8',
                //     bom: true,
                //     exportOptions: {
                //         columns: ':not(:last-child,:first-child)',
                //     }
                // },                {
                //     extend: 'print',
                //     text: 'Print',
                //     autoPrint: true,
                //     exportOptions: {
                //         columns: ':not(:last-child,:first-child)',
                //     },
                //     customize: function (win) {
                //         $(win.document.body).find('table').addClass('display').css('font-size', '10px');
                //         $(win.document.body).find('tr:nth-child(odd) td').each(function(index){
                //             $(this).css('background-color','#D0D0D0');
                //         });
                //         $(win.document.body).find('h1').css('text-align','center');
                //     }
                // },
                {
                    extend: 'csv',
                    text: 'CSV',
                    charset: 'UTF-8',
                    bom: true,
                    exportOptions: {
                        columns: ':not(:last-child,:first-child)',
                    }
                },
                {
                    extend: 'excel',
                    text: 'EXCEL',
                    charset: 'UTF-8',
                    bom: true,
                    exportOptions: {
                        columns: ':not(:last-child,:first-child)',
                    }
                }
            ],
            columnDefs: [
                {
                    targets: 0,
                    orderable: false,
                    render: function (data) {
                        return `
                            <div class="form-check form-check-sm form-check-custom form-check-solid">
                                <input class="form-check-input checkselected" type="checkbox" value="${data}" />
                            </div>`;
                    }
                },
                {
                    targets: -1,
                    data: null,
                    orderable: false,
                    className: 'text-end permission',
                    render: function (data, type, row) {
                        var AdminContent = '';
                         // Check if segment is 'Admin'
                        if (is_super === '1') {
                            AdminContent = `


                            <!--begin::Menu item-->
                                <div class="menu-item px-3" >
                                    <a href="/admin/organizing_study_files/`+row.id+`" class="menu-link px-3" target="_blank">
                                     الملفات
                                    </a>
                                </div>

                               <!--begin::Menu item-->
                                <div class="menu-item px-3" >
                                    <a href="#" class="menu-link px-3" onclick="getData(`+row.id+`)" data-bs-toggle="modal" data-bs-target="#kt_modal_update" data-id=`+row.id+`>
                                        `+edit_lang+`
                                    </a>
                                </div>
                                <!--end::Menu item-->

                                <!--begin::Menu item-->
                                <div class="menu-item px-3">
                                    <a href="#" class="menu-link px-3" onclick="reject_accept('approved', `+row.id+`)">
                                        موافقه
                                    </a>
                                </div>
                                <!--end::Menu item-->


                                <!--begin::Menu item-->
                                <div class="menu-item px-3">
                                    <a href="#" class="menu-link px-3" data-bs-toggle="modal" data-bs-target="#kt_modal_reject"  onclick="reject(`+row.id+`)">
                                        رفض
                                    </a>
                                </div>
                                <!--end::Menu item-->

                                <!--begin::Menu item-->
                                <div class="menu-item px-3">
                                      <a href="#" class="menu-link px-3" data-id=`+row.id+` data-kt-docs-table-filter="delete_row">
                                        `+delete_lang+`
                                    </a>
                                </div>
                                <!--end::Menu item-->
 
                            `;
                        }

                        return `
                            <a href="#" class="btn btn-light btn-active-light-primary btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-kt-menu-flip="top-end">
                                `+action_lang+`
                                <span class="svg-icon svg-icon-5 m-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                            <path d="M6.70710678,15.7071068 C6.31658249,16.0976311 5.68341751,16.0976311 5.29289322,15.7071068 C4.90236893,15.3165825 4.90236893,14.6834175 5.29289322,14.2928932 L11.2928932,8.29289322 C11.6714722,7.91431428 12.2810586,7.90106866 12.6757246,8.26284586 L18.6757246,13.7628459 C19.0828436,14.1360383 19.1103465,14.7686056 18.7371541,15.1757246 C18.3639617,15.5828436 17.7313944,15.6103465 17.3242754,15.2371541 L12.0300757,10.3841378 L6.70710678,15.7071068 Z" fill="#000000" fill-rule="nonzero" transform="translate(12.000003, 11.999999) rotate(-180.000000) translate(-12.000003, -11.999999)"></path>
                                        </g>
                                    </svg>
                                </span>
                            </a>
                            <!--begin::Menu-->
                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4" data-kt-menu="true">
                               


                               `+AdminContent+`
                            </div>
                            <!--end::Menu-->
                        `;
                    },
                },
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
            initToggleToolbar();
            toggleToolbars();
            handleDeleteRows();
            KTMenu.createInstances();
        });
    }

    // Search Datatable --- official docs reference: https://datatables.net/reference/api/search()
    var handleSearchDatatable = function () {
        const filterSearch = document.querySelector('[data-kt-docs-table-filter="search"]');
        filterSearch.addEventListener('keyup', function (e) {
            dt.search(e.target.value).draw();
        });
    }

    // Filter Datatable
    var handleFilterDatatable = () => {
        // Select filter options

        const filterButton = document.querySelector('[data-kt-docs-table-filter="filter"]');

        // Filter datatable on submit
        filterButton.addEventListener('click', function () {

            var active = $('#active').val()
            // Filter datatable --- official docs reference: https://datatables.net/reference/api/search()
            var url = main_url;
            url = url+"?active="+active;
            dt.ajax.url(url);
            dt.draw();
        });
    }

    // Delete
    var handleDeleteRows = () => {
        // Select all delete buttons
        const deleteButtons = document.querySelectorAll('[data-kt-docs-table-filter="delete_row"]');



        deleteButtons.forEach(d => {
            // Delete button on click
            d.addEventListener('click', function (e) {
                e.preventDefault();

                const rowID = $(this).attr("data-id");

                // Select parent row
                const parent = e.target.closest('tr');

                // Get  name
                const RowName = parent.querySelectorAll('td')[3].innerText;

                // SweetAlert2 pop up --- official docs reference: https://sweetalert2.github.io/
                Swal.fire({
                    text: "هل أنت متأكد أنك تريد حذف   " + RowName + "?",
                    icon: "warning",
                    showCancelButton: true,
                    buttonsStyling: false,
                    confirmButtonText: "نعم ، احذف!",
                    cancelButtonText: "لا ، إلغاء",
                    customClass: {
                        confirmButton: "btn fw-bold btn-danger",
                        cancelButton: "btn fw-bold btn-active-light-primary"
                    }
                }).then(function (result) {
                    if (result.value) {
                        // Simulate delete request -- for demo purpose only

                        //======= Start Ajxa ========//

                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                            }
                        });

                        var type = "DELETE";
                        var ajaxurl = '/admin/organizing_study/'+rowID;

                        $.ajax({
                            type: type,
                            url: ajaxurl,
                            dataType: 'json',
                            success: function (data) {
                                Swal.fire({
                                    text: "حذف  " + RowName,
                                    icon: "info",
                                    buttonsStyling: false,
                                    showConfirmButton: false,
                                    timer: 2000
                                }).then(function () {
                                    Swal.fire({
                                        text: "لقد حذفت   " + RowName + "!.",
                                        icon: "success",
                                        buttonsStyling: false,
                                        confirmButtonText: "حسنًا ، حسنًا!",
                                        customClass: {
                                            confirmButton: "btn fw-bold btn-primary",
                                        }
                                    }).then(function () {
                                        // delete row data from server and re-draw datatable
                                        dt.draw();
                                    });
                                });
                            },
                            error: function (data) {
                                 Swal.fire({
                                    text: RowName + " لم يتم حذفه. ",
                                    icon: "error",
                                    buttonsStyling: false,
                                    confirmButtonText: "حسنًا ، حسنًا!",
                                    customClass: {
                                        confirmButton: "btn fw-bold btn-primary",
                                    }
                                 });
                            }
                        });
                        //======= End Ajxa ========//


                    } else if (result.dismiss === 'cancel') {
                        // Swal.fire({
                        //     text: RowName + " لم يتم حذفه. ",
                        //     icon: "error",
                        //     buttonsStyling: false,
                        //     confirmButtonText: "حسنًا ، حسنًا!",
                        //     customClass: {
                        //         confirmButton: "btn fw-bold btn-primary",
                        //     }
                        // });
                    }
                });
            })
        });
    }

    // Reset Filter
    var handleResetForm = () => {
        // Select reset button
        const resetButton = document.querySelector('[data-kt-docs-table-filter="reset"]');

        // Reset datatable
        resetButton.addEventListener('click', function () {
            // Reset payment type
            filterPayment[0].checked = true;

            // Reset datatable --- official docs reference: https://datatables.net/reference/api/search()
            dt.search('').draw();
        });
    }

    // Init toggle toolbar
    var initToggleToolbar = function () {
        // Toggle selected action toolbar
        // Select all checkboxes
        const container = document.querySelector('#kt_datatable_table');
        const checkboxes = container.querySelectorAll('[type="checkbox"]');

        // Select elements
        const deleteSelected = document.querySelector('[data-kt-docs-table-select="delete_selected"]');

        // Toggle delete selected toolbar
        checkboxes.forEach(c => {
            // Checkbox on click event
            c.addEventListener('click', function () {
                setTimeout(function () {
                    toggleToolbars();
                }, 50);
            });
        });

        // Deleted selected rows
        deleteSelected.addEventListener('click', function () {
            // SweetAlert2 pop up --- official docs reference: https://sweetalert2.github.io/
            Swal.fire({
                text: "هل أنت متأكد أنك تريد حذف المحدد؟",
                icon: "warning",
                showCancelButton: true,
                buttonsStyling: false,
                showLoaderOnConfirm: true,
                confirmButtonText: "نعم ، احذف!",
                cancelButtonText: "لا ، إلغاء",
                customClass: {
                    confirmButton: "btn fw-bold btn-danger",
                    cancelButton: "btn fw-bold btn-active-light-primary"
                },
            }).then(function (result) {
                if (result.value) {
                    // Simulate delete request -- for demo purpose only


                    var ids = [];
                    var oTable = $('#kt_datatable_table').dataTable();
                    var rowcollection =  oTable.$(".checkselected:checked", {"page": "all"});
                    rowcollection.each(function(index,elem){
                        ids.push($(elem).val());
                    });

                    //======= Start Ajxa ========//

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    var formData = {
                        ids: ids,
                    };

                    var type = "DELETE";
                    var ajaxurl = '/admin/delete_organizing_study';

                    $.ajax({
                        type: type,
                        url: ajaxurl,
                        data: formData,
                        dataType: 'json',
                        success: function (data) {
                            Swal.fire({
                                text: "حذف المحدد",
                                icon: "info",
                                buttonsStyling: false,
                                showConfirmButton: false,
                                timer: 2000
                            }).then(function () {
                                Swal.fire({
                                    text: "لقد قمت بحذف كل ما تم تحديده !.",
                                    icon: "success",
                                    buttonsStyling: false,
                                    confirmButtonText: "حسنًا ، حسنًا!",
                                    customClass: {
                                        confirmButton: "btn fw-bold btn-primary",
                                    }
                                }).then(function () {
                                    // delete row data from server and re-draw datatable
                                    dt.draw();
                                });

                                // Remove header checked box
                                const headerCheckbox = container.querySelectorAll('[type="checkbox"]')[0];
                                headerCheckbox.checked = false;
                            });
                        },
                        error: function (data) {
                            Swal.fire({
                                text: "لم يتم حذف المحدد.",
                                icon: "error",
                                buttonsStyling: false,
                                confirmButtonText: "حسنًا ، حسنًا!",
                                customClass: {
                                    confirmButton: "btn fw-bold btn-primary",
                                }
                            });
                        }
                    });
                    //======= End Ajxa ========////



                } else if (result.dismiss === 'cancel') {
                    // Swal.fire({
                    //     text: "لم يتم حذف المحدد.",
                    //     icon: "error",
                    //     buttonsStyling: false,
                    //     confirmButtonText: "حسنًا ، حسنًا!",
                    //     customClass: {
                    //         confirmButton: "btn fw-bold btn-primary",
                    //     }
                    // });
                }
            });
        });
    }

    // Toggle toolbars
    var toggleToolbars = function () {
        // Define variables
        const container = document.querySelector('#kt_datatable_table');
        const toolbarBase = document.querySelector('[data-kt-docs-table-toolbar="base"]');
        const toolbarSelected = document.querySelector('[data-kt-docs-table-toolbar="selected"]');
        const selectedCount = document.querySelector('[data-kt-docs-table-select="selected_count"]');

        // Select refreshed checkbox DOM elements
        const allCheckboxes = container.querySelectorAll('tbody [type="checkbox"]');

        // Detect checkboxes state & count
        let checkedState = false;
        let count = 0;

        // Count checked boxes
        allCheckboxes.forEach(c => {
            if (c.checked) {
                checkedState = true;
                count++;
            }
        });

        // Toggle toolbars
        if (checkedState) {
            selectedCount.innerHTML = count;
            toolbarBase.classList.add('d-none');
            toolbarSelected.classList.remove('d-none');
        } else {
            toolbarBase.classList.remove('d-none');
            toolbarSelected.classList.add('d-none');
        }
    }

    // Public methods
    return {
        init: function () {
            initDatatable();
            handleSearchDatatable();
            initToggleToolbar();
            handleFilterDatatable();
            handleDeleteRows();
            handleResetForm();
        }
    }
}();

// On document ready
KTUtil.onDOMContentLoaded(function () {
    KTDatatablesServerSide.init();
});


function reject_accept(status,id) {

    //======= Start Ajxa ========//

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        }
    });

    var type = "GET";
    var ajaxurl = '/admin/organizing_study/'+status+'/'+id+'/reject_accept';
    
    if(status == 'rejected'){
        var note = 'تم الرفض بنجاح';
    }else{
        var note = 'تمت الموافقه  بنجاح';
    }
    

    $.ajax({
        type: type,
        url: ajaxurl,
        dataType: 'json',
        success: function (data) {
            Swal.fire({
                text: 'الرجاء الانتظار قليلا',
                icon: "info",
                buttonsStyling: false,
                showConfirmButton: false,
                timer: 2000
            }).then(function () {
                Swal.fire({
                    text: note,
                    icon: "success",
                    buttonsStyling: false,
                    confirmButtonText: "حسنًا ، حسنًا!",
                    customClass: {
                        confirmButton: "btn fw-bold btn-primary",
                    }
                }).then(function () {
                    // delete row data from server and re-draw datatable
                    dt.draw();
                });
            });
        },
        error: function (data) {
        Swal.fire({
            text: "معذرة ، يبدو أنه تم اكتشاف بعض الأخطاء ، يرجى المحاولة مرة أخرى.",
            icon: "error",
            buttonsStyling: false,
            confirmButtonText: "حسنًا ، حسنًا!",
            customClass: {
                confirmButton: "btn btn-primary"
            }
        });
    }
    });
    //======= End Ajxa ========//
}

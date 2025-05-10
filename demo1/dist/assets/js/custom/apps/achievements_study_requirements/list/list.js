"use strict";

// Class definition
var KTDatatablesServerSide = function () {
    // Shared variables
    var table;
    var dt;
    var filterPayment;
    var is_super = $("#is_super").val();
    let main_url = "/admin/achievements_study_requirements/get";
    var action_lang = $("#action_lang").val();
    var edit_lang = $("#edit_lang").val();
    var delete_lang = $("#delete_lang").val();

    
    var adminColumns = [
        { data: '#' },
        { data: 'order' },
        // { data: 'id' },
        { data: 'leader' },
        { data: 'document' },
        { data: 'status' },
        { data: 'reject_notes' },
        { data: 'created_at' },
         { data: null },
       ];

    var userColumns = [
        { data: '#' },
        { data: 'order' },
        // { data: 'id' },
        { data: 'leader' },
        { data: 'document' },
        { data: 'status' },
        { data: 'reject_notes' },
        { data: 'created_at' },
            { data: null },
        ];

    var chosenColumns = is_super === '0' ? userColumns : adminColumns;


    var can_add = $("#can_add").val();
    var can_update = $("#can_update").val();
    var can_delete = $("#can_delete").val();
    var can_print = $("#can_print").val();
    var can_accept_reject = $("#can_accept_reject").val();
    
    
    var display_print = "none";
    var display_file = "none";
    var display_case = "none";
    var display_procedure = "none";
    var display_edit = "none";
    var display_delete = "none";
    var display_accept_reject = "none";
    

    if(can_print==1){
        var display_print = "";
    }

    if(can_add==1){
        var display_file = "";
        var display_case = "";
        var display_procedure = "";
    }

    if(can_update==1){
        var display_edit = "";
    }

    if(can_delete==1){
        var display_delete = "";
    }

     if(can_accept_reject==1){
        var display_accept_reject = "";
    }


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
            columns:chosenColumns,
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
                       // if (is_super === '1') {
                        return `
                            <div class="form-check form-check-sm form-check-custom form-check-solid" style="display:`+display_delete+`">
                                <input class="form-check-input checkselected" type="checkbox" value="${data}" />
                            </div>`;
                        // }else{

                        //     return `
                        //     <div class="form-check form-check-sm form-check-custom form-check-solid" style="visibility: hidden;">
                        //         <input class="form-check-input checkselected" type="checkbox" value="${data}" />
                        //     </div>`;

                        // }
                    }
                },
                {
                    targets: -1,
                    data: null,
                    orderable: false,
                    className: 'text-end',
                    render: function (data, type, row) {
                    var AdminContent = '';

                    // عرض زر التعديل إذا كان لديه صلاحية التعديل
                    // if (can_update === '1') {
                    //     AdminContent += `
                    //         <div class="menu-item px-3">
                    //             <a href="#" class="menu-link px-3" onclick="getData(${row.id})" data-bs-toggle="modal" data-bs-target="#kt_modal_update" data-id="${row.id}">
                    //                 ${edit_lang}
                    //             </a>
                    //         </div>
                    //     `;
                    // }

                    // عرض زر الموافقة إذا كان لديه صلاحية القبول/الرفض
                    if (can_accept_reject === '1') {
                        AdminContent += `
                            <div class="menu-item px-3">
                                <a href="#" class="menu-link px-3" onclick="reject_accept('approved', ${row.id})">
                                    موافقه
                                </a>
                            </div>
                            <div class="menu-item px-3">
                                <a href="#" class="menu-link px-3" data-bs-toggle="modal" data-bs-target="#kt_modal_reject" onclick="reject(${row.id})">
                                    رفض
                                </a>
                            </div>
                        `;
                    }

                    // عرض زر الحذف إذا كان لديه صلاحية الحذف
                    if (can_delete === '1') {
                        AdminContent += `
                            <div class="menu-item px-3">
                                <a href="#" class="menu-link px-3" data-id="${row.id}" data-kt-docs-table-filter="delete_row">
                                    ${delete_lang}
                                </a>
                            </div>
                        `;
                    }

                    // إذا كان لديه أي صلاحية من الصلاحيات السابقة، نعرض الزر بالكامل
                    if (AdminContent !== '') {
                        return `
                            <a href="#" class="btn btn-light btn-active-light-primary btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-kt-menu-flip="top-end">
                                ${action_lang}
                                <span class="svg-icon svg-icon-5 m-0">
                                    <!-- SVG content -->
                                </span>
                            </a>
                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4" data-kt-menu="true">
                                ${AdminContent}
                            </div>
                        `;
                    } else {
                        // لا يملك أي صلاحية لعرض العناصر
                        return `
                            <a href="#" class="btn btn-light btn-active-light-primary btn-sm" style="visibility: hidden;">
                                ${action_lang}
                            </a>
                        `;
                    }
                }

                },
                {
                    targets: 2,
                    className: 'group_name',
                     
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
                        var ajaxurl = '/admin/achievements_study_requirements/'+rowID;

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
                    var ajaxurl = '/admin/delete_achievements_study_requirements';

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
    var ajaxurl = '/admin/achievements_study_requirements/'+status+'/'+id+'/reject_accept';
    
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

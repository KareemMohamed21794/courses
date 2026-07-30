"use strict";

// Class definition
var KTDatatablesServerSide = function () {
    // Shared variables
    var table;
    var dt;
    var filterPayment;

    var segment = $("#segment").val();
    var is_super = $("#is_super").val();
    var position_id_check = $("#position_id_check").val();
    var type_segment = $("#type_segment").val();
    let main_url = "/admin/"+segment+"/get";
    var exportUrl = $("#admins_export_url").val();
    var action_lang = $("#action_lang").val();
    var edit_lang = $("#edit_lang").val();
    var delete_lang = $("#delete_lang").val();
    

    var delete_confirmation = $("#delete_confirmation").val();
    var yes_delete = $("#yes_delete").val();
    var no_delete = $("#no_delete").val();

    var can_add = $("#can_add").val();
    var can_update = $("#can_update").val();
    var can_delete = $("#can_delete").val();
    var can_print = $("#can_print").val();
    
    
    var display_print = "none";
    var display_file = "none";
    var display_case = "none";
    var display_procedure = "none";
    var display_edit = "none";
    var display_delete = "none";
    

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


    
    var adminColumns = [
    { data: '#' },
    { data: 'order' },
    { data: 'username' },
    { data: 'name' },
    { data: 'email' },
    { data: 'phone' },
    { data: 'created_at' },
    { data: null },
   ];


    var userColumns = [
    { data: '#' },
    { data: 'order' },
    { data: 'username' },
    { data: 'group_name' },
    { data: 'name' },
    { data: 'email' },
    { data: 'phone'},
    //{ data: 'address'},
    { data: 'created_at' },
    { data: null },
       
    ];

   // var chosenColumns = type_segment === '0' ? userColumns : adminColumns;
    var chosenColumns = segment === 'leaders' ? userColumns : adminColumns;

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
            stateSave: false,
            select: {
                style: 'os',
                selector: 'td:first-child',
                className: 'row-selected'
            },
            ajax: {
                url: main_url,
            },
            columns: chosenColumns,
            buttons: KTReportExport.buttons(exportUrl, function () {
                var searchInput = document.querySelector('[data-kt-docs-table-filter="search"]');

                return {
                    active: $('#active').val() || 'Active',
                    search: searchInput ? searchInput.value : ''
                };
            }),

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
                    className: 'text-end',
                    render: function (data, type, row) {

                        var AdminContent = '';

                        // Check if segment is 'lawyer'
                        if (can_delete === '1' || position_id_check == 4) {
                            
                            AdminContent = `
                                
                                <!--begin::Menu item-->
                                <div class="menu-item px-3" style="display:`+display_print+`">
                                    <a href="#" class="menu-link px-3" onclick="getData(`+row.id+`,2)" data-bs-toggle="modal" data-bs-target="#kt_modal_update" data-id=`+row.id+`>
                                       عرض
                                    </a>
                                </div>
                                <!--end::Menu item-->

                                <!--begin::Menu item-->
                                <div class="menu-item px-3" style="display:`+display_delete+`">
                                    <a href="#" class="menu-link px-3" data-id=`+row.id+` data-kt-docs-table-filter="delete_row">
                                        `+delete_lang+`
                                    </a>
                                </div>
                                <!--end::Menu item-->
 
                            `;
                        }



                        if (position_id_check == 3) {
                            
                            AdminContent = `
                                
                                <!--begin::Menu item-->
                                <div class="menu-item px-3" style="display:`+display_print+`">
                                    <a href="#" class="menu-link px-3" onclick="getData(`+row.id+`,2)" data-bs-toggle="modal" data-bs-target="#kt_modal_update" data-id=`+row.id+`>
                                       عرض
                                    </a>
                                </div>
                                <!--end::Menu item-->


                                <!--begin::Menu item-->
                                <div class="menu-item px-3" style="display:none">
                                    <a href="student_registration" class="menu-item px-3 menu-link px-3" onclick="handleClick(event, `+row.id+`)"  data-id=`+row.id+`>
                                       تسجيل  المنتسبين
                                    </a>

                                </div>
                                <!--end::Menu item-->




                                <div class="menu-item px-3" >
                                    <a href="/admin/board_directors/`+row.id+`" class="menu-link px-3" target="_blank">
                                        مجلس إدارة المجموعة  
                                    </a>
                                </div>

                                <!--begin::Menu item-->
                                <div class="menu-item px-3">
                                    <a href="/admin/group_leaders/`+row.id+`" class="menu-link px-3" target="_blank">
                                        معلومات قائد المجموعة
                                    </a>
                                </div>
                                <!--end::Menu item-->

                              
                                <!--begin::Menu item-->
                                <!--begin::Menu item-->
                                <div class="menu-item px-3" >
                                    <a href="show_students" class="menu-item px-3 menu-link px-3" onclick="ShowStudents(event, `+row.id+`)"  data-id=`+row.id+`>
                                       عرض  المنتسبين
                                    </a>

                                </div>
                                <!--end::Menu item-->


                               
 
                            `;
                        }


                        if (segment === 'leaders' && can_delete == '1') {
                            AdminContent = `
                                
                                <!--begin::Menu item-->
                                <div class="menu-item px-3" style="display:`+display_print+`">
                                    <a href="#" class="menu-link px-3" onclick="getData(`+row.id+`,2)" data-bs-toggle="modal" data-bs-target="#kt_modal_update" data-id=`+row.id+`>
                                       عرض
                                    </a>
                                </div>
                                <!--end::Menu item-->


                                <!--begin::Menu item-->
                                <div class="menu-item px-3" >
                                    <a href="student_registration" class="menu-item px-3 menu-link px-3" onclick="handleClick(event, `+row.id+`)"  data-id=`+row.id+`>
                                       تسجيل  المنتسبين
                                    </a>

                                </div>
                                <!--end::Menu item-->




                                <div class="menu-item px-3" >
                                    <a href="/admin/board_directors/`+row.id+`" class="menu-link px-3" target="_blank">
                                        مجلس إدارة المجموعة  
                                    </a>
                                </div>

                                <!--begin::Menu item-->
                                <div class="menu-item px-3">
                                    <a href="/admin/group_leaders/`+row.id+`" class="menu-link px-3" target="_blank">
                                        معلومات قائد المجموعة
                                    </a>
                                </div>
                                <!--end::Menu item-->

                              
                                <!--begin::Menu item-->
                                <!--begin::Menu item-->
                                <div class="menu-item px-3" >
                                    <a href="show_students" class="menu-item px-3 menu-link px-3" onclick="ShowStudents(event, `+row.id+`)"  data-id=`+row.id+`>
                                       عرض المنتسبين
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
                                <!--begin::Menu item-->
                                <div class="menu-item px-3" style="display:`+display_edit+`">
                                    <a href="#" class="menu-link px-3" onclick="getData(`+row.id+`,1)" data-bs-toggle="modal" data-bs-target="#kt_modal_update" data-id=`+row.id+`>
                                        `+edit_lang+`
                                    </a>
                                </div>
                                <!--end::Menu item-->

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
        if (!filterSearch) {
            return;
        }
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
                    text: delete_confirmation,
                    icon: "warning",
                    showCancelButton: true,
                    buttonsStyling: false,
                    confirmButtonText: yes_delete,
                    cancelButtonText: no_delete,
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
                        var ajaxurl = '/admin/admins/'+rowID;

                        $.ajax({
                            type: type,
                            url: ajaxurl,
                            dataType: 'json',
                            success: function (data) {
                                location.reload();
                                return false;
                                Swal.fire({
                                    text: "حذف " + RowName,
                                    icon: "info",
                                    buttonsStyling: false,
                                    showConfirmButton: false,
                                    timer: 2000
                                }).then(function () {
                                    Swal.fire({
                                        text: "لقد حذفت " + RowName + "!.",
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
                                    text: RowName + " لم يتم حذفه.",
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
                        //     text: RowName + "لم يتم حذفه.",
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
                    var ajaxurl = '/admin/delete_admins';

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


function board_directors(event, id) {
    event.preventDefault(); // Prevent default navigation
    getData(id, 2); // Execute the function
    window.open('admin/board_directors', '_blank'); // Open in a new tab
}


function encodeSecureId(id, secretKey = 'mySuperSecretKey') {
    // Convert ID to string (ensure it's a string)
    const idStr = String(id);

    // Create HMAC with SHA-256
    const encoder = new TextEncoder();
    const keyData = encoder.encode(secretKey);
    const idData = encoder.encode(idStr);
    
    return crypto.subtle.importKey(
        'raw',
        keyData,
        { name: 'HMAC', hash: 'SHA-256' },
        false,
        ['sign']
    ).then(key => {
        return crypto.subtle.sign('HMAC', key, idData);
    }).then(signature => {
        // Convert signature to hex string
        const signatureBytes = new Uint8Array(signature);
        let signatureHex = '';
        signatureBytes.forEach(byte => {
            signatureHex += ('00' + byte.toString(16)).slice(-2);
        });

        // Combine "id:signature"
        const combined = idStr + ':' + signatureHex;

        // Base64 encode the combined string
        let encoded = btoa(combined);

        // URL-safe Base64 encoding
        let urlSafe = encoded.replace(/\+/g, '-').replace(/\//g, '_').replace(/=+$/, '');
        
        return urlSafe;
    });
}


function handleClick(event, id) {
    event.preventDefault(); // Prevent default navigation
    encodeSecureId(id).then(encodedId => {
        // Execute your function after encoding the ID
        getData(id, 2);
        // Open the URL with the encoded ID in a new tab
        window.open('/student_registration/' + encodedId, '_blank'); // Open in a new tab
    });

    
}

function ShowStudents(event, id) {
    event.preventDefault(); // Prevent default navigation

    encodeSecureId(id).then(encodedId => {
        // Execute your function after encoding the ID
        getData(id, 2);

        // Open the URL with the encoded ID in a new tab
        window.open('show_students/' + encodedId, '_blank');
    });
}


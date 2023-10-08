"use strict";

// Class definition
var KTDatatablesServerSide = function () {
    // Shared variables
    var table;
    var dt;
    var filterPayment;
    var staff_id = $("#staff_id").val();

    let main_url = "/admin/staff_profile/getactivites/"+staff_id;
    var action_lang = $("#action_lang").val();
    var edit_lang = $("#edit_lang").val();
    var delete_lang = $("#delete_lang").val();

    // Private functions
    var initDatatable = function () {
        dt = $("#kt_datatable_table_activitieslist").DataTable({

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
                { data: 'status' },
                { data: 'activity_time' },
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
        // dt.on('draw', function () {
        //     //initToggleToolbar();
        //    // toggleToolbars();
        //     //handleDeleteRows();
        //     KTMenu.createInstances();
        // });
    }

    // Search Datatable --- official docs reference: https://datatables.net/reference/api/search()
    var handleSearchDatatable = function () {
        const filterSearch = document.querySelector('[data-kt-docs-table-filter="search"]');
        filterSearch.addEventListener('keyup', function (e) {
            if (e.key === 'Enter') {
                dt.search(e.target.value).draw();
            }
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
                const RowName = parent.querySelectorAll('td')[2].innerText;

                // SweetAlert2 pop up --- official docs reference: https://sweetalert2.github.io/
                Swal.fire({
                    text: "Are you sure you want to delete " + RowName + "?",
                    icon: "warning",
                    showCancelButton: true,
                    buttonsStyling: false,
                    confirmButtonText: "Yes, delete!",
                    cancelButtonText: "No, cancel",
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
                        var ajaxurl = '/admin/staff_activites/'+rowID;

                        $.ajax({
                            type: type,
                            url: ajaxurl,
                            dataType: 'json',
                            success: function (data) {
                                Swal.fire({
                                    text: "Deleting " + RowName,
                                    icon: "info",
                                    buttonsStyling: false,
                                    showConfirmButton: false,
                                    timer: 2000
                                }).then(function () {
                                    Swal.fire({
                                        text: "You have deleted " + RowName + "!.",
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
                                    text: RowName + " was not deleted.",
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
                        Swal.fire({
                            text: RowName + " was not deleted.",
                            icon: "error",
                            buttonsStyling: false,
                            confirmButtonText: "حسنًا ، حسنًا!",
                            customClass: {
                                confirmButton: "btn fw-bold btn-primary",
                            }
                        });
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
                text: "Are you sure you want to delete selected ?",
                icon: "warning",
                showCancelButton: true,
                buttonsStyling: false,
                showLoaderOnConfirm: true,
                confirmButtonText: "Yes, delete!",
                cancelButtonText: "No, cancel",
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
                    var ajaxurl = '/admin/delete_departments';

                    $.ajax({
                        type: type,
                        url: ajaxurl,
                        data: formData,
                        dataType: 'json',
                        success: function (data) {
                            Swal.fire({
                                text: "Deleting selected",
                                icon: "info",
                                buttonsStyling: false,
                                showConfirmButton: false,
                                timer: 2000
                            }).then(function () {
                                Swal.fire({
                                    text: "You have deleted all selected!.",
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
                                text: "Selected was not deleted.",
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
                    Swal.fire({
                        text: "Selected was not deleted.",
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "حسنًا ، حسنًا!",
                        customClass: {
                            confirmButton: "btn fw-bold btn-primary",
                        }
                    });
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
           // handleSearchDatatable();
            //initToggleToolbar();
            //handleFilterDatatable();
            //handleDeleteRows();
            //handleResetForm();
        }
    }
}();

// On document ready
KTUtil.onDOMContentLoaded(function () {
    KTDatatablesServerSide.init();
});
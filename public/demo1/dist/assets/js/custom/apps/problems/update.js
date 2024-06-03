"use strict";

// Class definition
var KTModalBranchesUpdate = function () {
    var submitButton;
    var cancelButton;
    var closeButton;
    var validator;
    var form;
    var modal;

    var sucessful_edit = $("#sucessful_edit").val();

    // Init form inputs
    var handleForm = function () {
        // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
        validator = FormValidation.formValidation(
            form,
            {
                fields: {
                    'admin_id': {
                        validators: {
                            notEmpty: {
                                message: 'من فضلك اختر المحامى'
                            }
                        }
                    },

                    'client_id': {
                        validators: {
                            notEmpty: {
                                message: 'من فضلك اختر العميل'
                            }
                        }
                    },

                    // 'client_type': {
                    //     validators: {
                    //         notEmpty: {
                    //             message: 'صفة الموكل في الدعوى   '
                    //         }
                    //     }
                    // },

                    'other_person': {
                        validators: {
                            notEmpty: {
                                message: '  اسم الخصم    '
                            }
                        }
                    },

                    'other_lawer': {
                        validators: {
                            notEmpty: {
                                message: 'وكيل الخصم  '
                            }
                        }
                    },

                    // 'problem_number': {
                    //     validators: {
                    //         notEmpty: {
                    //             message: 'رقم الدعوى الحالي  '
                    //         }
                    //     }
                    // },

                    // 'next_session_date': {
                    //     validators: {
                    //         notEmpty: {
                    //             message: 'تاريج الجلسة القادمة   '
                    //         }
                    //     }
                    // },

                    'cost': {
                        validators: {
                            notEmpty: {
                                message: 'التكلفه'
                            }
                        }
                    },

                    
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    bootstrap: new FormValidation.plugins.Bootstrap5({
                        rowSelector: '.fv-row',
                        eleInvalidClass: '',
                        eleValidClass: ''
                    })
                }
            }
        );

        // Action buttons
        submitButton.addEventListener('click', function (e) {
            e.preventDefault();

            // Validate form before submit
            if (validator) {
                validator.validate().then(function (status) {
                    if (status == 'Valid') {
                        // Show loading indication
                        submitButton.setAttribute('data-kt-indicator', 'on');

                        // Disable button to avoid multiple click
                        submitButton.disabled = true;

                        // Send ajax request
                        var update_id = $("#id").val();
                        axios.post("/admin/problems/"+update_id, new FormData(form))
                        .then(function (response) {
                            // Show message popup. For more info check the plugin's official documentation: https://sweetalert2.github.io/
                            Swal.fire({
                                text: sucessful_edit,
                                icon: "success",
                                buttonsStyling: false,
                                //confirmButtonText: "حسنًا ، حسنًا!",
                                customClass: {
                                    confirmButton: "btn btn-primary"
                                }
                            }).then(function (result) {
                                if (result.isConfirmed) {
                                    // Hide modal
                                    modal.hide();

                                    // Enable submit button after loading
                                    submitButton.disabled = false;

                                    $("#kt_datatable_table").DataTable().ajax.reload();
                                    // Redirect to branchs list page
                                    //window.location = form.getAttribute("data-kt-redirect");
                                }
                            });
                        }).catch(function (error) {
                             
                            let dataMessage = error.response.data.message;
                            let dataErrors = error.response.data.errors;

                            for (const errorsKey in dataErrors) {
                                if (!dataErrors.hasOwnProperty(errorsKey)) continue;
                                dataMessage += "\r\n" + dataErrors[errorsKey];
                            }

                            if (error.response) {
                                Swal.fire({
                                    text: dataMessage,
                                    icon: "error",
                                    buttonsStyling: false,
                                    confirmButtonText: "حسنًا ، حسنًا!",
                                    customClass: {
                                        confirmButton: "btn btn-primary"
                                    }
                                });
                            }
                        }).then(function () {
                            // always executed
                            // Hide loading indication
                            submitButton.removeAttribute('data-kt-indicator');

                            // Enable button
                            submitButton.disabled = false;
                        });
                                                
                    } else {
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
            }
        });

        

        cancelButton.addEventListener('click', function (e) {
            form.reset(); // Reset form
            modal.hide(); // Hide modal
            return false;
            e.preventDefault();

            Swal.fire({
                text: "هل أنت متأكد أنك تريد الإلغاء؟",
                icon: "warning",
                showCancelButton: true,
                buttonsStyling: false,
                confirmButtonText: "نعم ، قم بإلغائها!",
                cancelButtonText: "لا رجوع",
                customClass: {
                    confirmButton: "btn btn-primary",
                    cancelButton: "btn btn-active-light"
                }
            }).then(function (result) {
                if (result.value) {
                    form.reset(); // Reset form 
                    modal.hide(); // Hide modal             
                } else if (result.dismiss === 'cancel') {
                    Swal.fire({
                        text: "لم يتم إلغاء النموذج الخاص بك !.",
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "حسنًا ، حسنًا!",
                        customClass: {
                            confirmButton: "btn btn-primary",
                        }
                    });
                }
            });
        });

        closeButton.addEventListener('click', function(e){
            form.reset(); // Reset form
            modal.hide(); // Hide modal
            return false;
            e.preventDefault();

            Swal.fire({
                text: "هل أنت متأكد أنك تريد الإلغاء؟",
                icon: "warning",
                showCancelButton: true,
                buttonsStyling: false,
                confirmButtonText: "نعم ، قم بإلغائها!",
                cancelButtonText: "لا رجوع",
                customClass: {
                    confirmButton: "btn btn-primary",
                    cancelButton: "btn btn-active-light"
                }
            }).then(function (result) {
                if (result.value) {
                    form.reset(); // Reset form 
                    modal.hide(); // Hide modal             
                } else if (result.dismiss === 'cancel') {
                    Swal.fire({
                        text: "لم يتم إلغاء النموذج الخاص بك !.",
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "حسنًا ، حسنًا!",
                        customClass: {
                            confirmButton: "btn btn-primary",
                        }
                    });
                }
            });
        })
    }

    return {
        // Public functions
        init: function () {
            // Elements
            modal = new bootstrap.Modal(document.querySelector('#kt_modal_update'));

            form = document.querySelector('#kt_modal_update_form');
            submitButton = form.querySelector('#kt_modal_update_submit');
            cancelButton = form.querySelector('#kt_modal_update_cancel');
            closeButton = form.querySelector('#kt_modal_update_close');

            handleForm();
        }
    };
}();

// On document ready
KTUtil.onDOMContentLoaded(function () {
    KTModalBranchesUpdate.init();
});

function getData(id) {
    //======= Start Ajxa ========//
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        }
    });

    var type = "GET";
    var ajaxurl = '/admin/problems/'+id+'/edit';

    $.ajax({
        type: type,
        url: ajaxurl,
        dataType: 'json',
        success: function (data) {
            jQuery('#id').val(data.id);
            jQuery('#code_update').val(data.id);
            // jQuery("#admin_id_update").empty();
            jQuery('#id_secondary_update').val(data.id_secondary);
            jQuery('#admin_id_update').val(data.staff.id);
            jQuery('#admin_id_update').select2();

            if(data.type=='procedure'){
                jQuery('#client_id_update').val(data.client.id);
                jQuery('#client_id_update').select2();
            }else{
                var selectedClients = data.clients.map(function (client_id) {
                    return client_id.client_id;
                });

                //Set the selected options in the <select> element
                jQuery('#client_id_update').val(selectedClients);
                jQuery("#client_id_update").trigger("change"); // Trigger change event for select2 to update the UI



            }
            
            // if($data.type=='procedure'){
            //     jQuery('#client_id_update').val(data.client.id);
            //     jQuery('#client_id_update').select2();
            // }else{
            //     /// 
            //     var selectedClients = data.clients.map(function (client) {
            //         return client.client_id;
            //     });

            //     // Set the selected options in the <select> element
            //     jQuery('#client_id_update').val(selectedClients);
            //     jQuery("#client_id_update").trigger("change"); // Trigger change event for select2 to update the UI

            //     console.log(selectedClients);
            // }

            jQuery('#name_update').val(data.client.display_name);
            jQuery('#lawer_type_update').val(data.client.type);
            jQuery('#client_type_update').val(data.client_type);
            jQuery('#other_person_update').val(data.other_person);
            jQuery('#other_lawer_update').val(data.other_lawer);
            jQuery('#problem_number_update').val(data.problem_number);
            jQuery('#subject_update').val(data.subject);
            jQuery('#problem_date_update').val(data.problem_date);
            jQuery('#next_session_date_update').val(data.next_session_date);
            jQuery('#file_open_date_update').val(data.file_open_date);
            jQuery('#number_days_remind_update').val(data.number_days_remind);
            jQuery('#court_update').val(data.court);
            jQuery('#judge_update').val(data.judge);
            jQuery('#cost_update').val(data.cost);
            jQuery('#notes_update').val(data.notes);
            jQuery('#deadline_update').val(data.deadline);
            jQuery('#select_status_update').val(data.status);

            jQuery('#reviewer_update').val(data.reviewer);
            
 
             
  
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
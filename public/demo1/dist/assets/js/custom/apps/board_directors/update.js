"use strict";

// Class definition
var KTModalBranchesUpdate = function () {
    var submitButton;
    var cancelButton;
    var closeButton;
    var validator;
    var form;
    var modal;

    // Init form inputs
    var handleForm = function () {
        // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
        validator = FormValidation.formValidation(
            form,
            {
                fields: {

                     'first_name_update': {
                        validators: {
                            notEmpty: {
                                message: 'هذا الحقل مطلوب'
                            }
                        }
                    },

                    'father_name_update': {
                        validators: {
                            notEmpty: {
                                message: 'هذا الحقل مطلوب'
                            }
                        }
                    },



                    'family_name_update': {
                        validators: {
                            notEmpty: {
                                message: 'هذا الحقل مطلوب'
                            }
                        }
                    },


                    'job_update': {
                        validators: {
                            notEmpty: {
                                message: 'هذا الحقل مطلوب'
                            }
                        }
                    },



                    'mission_update': {
                        validators: {
                            notEmpty: {
                                message: 'هذا الحقل مطلوب'
                            }
                        }
                    },


                    'birth_date_update': {
                        validators: {
                            notEmpty: {
                                message: 'هذا الحقل مطلوب'
                            }
                        }
                    },


                    'birth_place_update': {
                        validators: {
                            notEmpty: {
                                message: 'هذا الحقل مطلوب'
                            }
                        }
                    },

                    'mobile_number_update': {
                        validators: {
                            notEmpty: {
                                message: 'هذا الحقل مطلوب'
                            }
                        }
                    },


                     'mobile_number_update': {
                        validators: {
                            notEmpty: {
                                message: 'هذا الحقل مطلوب'
                            }
                        }
                    },


                    //  'leader_id_update': {
                    //     validators: {
                    //         notEmpty: {
                    //             message: 'هذا الحقل مطلوب'
                    //         }
                    //     }
                    // },

                    
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
                        axios.post("/admin/board_directors/"+update_id, new FormData(form))
                        .then(function (response) {
                            // Show message popup. For more info check the plugin's official documentation: https://sweetalert2.github.io/
                            Swal.fire({
                                text: "تم التعديل بنجاح",
                                icon: "success",
                                buttonsStyling: false,
                                confirmButtonText: "حسنًا ، حسنًا!",
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
                             
                            let dataMessage = error.response.data.message || "معذرة ، يبدو أنه تم اكتشاف بعض الأخطاء  او المجموعه الكشفيه موجوده من قبل، يرجى المحاولة مرة أخرى.";;
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

function getData(id,action) {
    //======= Start Ajxa ========//
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        }
    });

    var type = "GET";
    var ajaxurl = '/admin/get_board_director/'+id;

    $.ajax({
        type: type,
        url: ajaxurl,
        dataType: 'json',
        success: function (data) {
            jQuery('#id').val(data.id);
            jQuery('#leader_id_update').val(data.admin.id);
            jQuery('#first_name_update').val(data.first_name);
            jQuery('#father_name_update').val(data.father_name);
            jQuery('#family_name_update').val(data.family_name);
            jQuery('#job_update').val(data.job);
            jQuery('#mission_update').val(data.mission);
            jQuery('#birth_date_update').val(data.birth_date);
            jQuery('#birth_place_update').val(data.birth_place);
            jQuery('#mobile_number_update').val(data.mobile_number);


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

    if (action == 2) {
    // Disable all input and select element
        $('input, select').prop('disabled', true);
        $('#kt_modal_update_submit').hide();
    } else {
        // Enable all input and select elements
        $('input, select').prop('disabled', false);
        $('#kt_modal_update_submit').show();
    }
}






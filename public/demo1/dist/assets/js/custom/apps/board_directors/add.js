"use strict";

// Class definition
var KTModalAdd = function () {
    var submitButton;
    var cancelButton;
    var closeButton;
    var validator;
    var form;
    var modal;
    var group_id = $("#group_id").val();
    // Init form inputs
    var handleForm = function () {
        // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
        validator = FormValidation.formValidation(
            form,
            {
                fields: {


                     'first_name': {
                        validators: {
                            notEmpty: {
                                message: 'هذا الحقل مطلوب'
                            }
                        }
                    },

                    'father_name': {
                        validators: {
                            notEmpty: {
                                message: 'هذا الحقل مطلوب'
                            }
                        }
                    },



                    'family_name': {
                        validators: {
                            notEmpty: {
                                message: 'هذا الحقل مطلوب'
                            }
                        }
                    },


                    'job': {
                        validators: {
                            notEmpty: {
                                message: 'هذا الحقل مطلوب'
                            }
                        }
                    },



                    'mission': {
                        validators: {
                            notEmpty: {
                                message: 'هذا الحقل مطلوب'
                            }
                        }
                    },


                    'birth_date': {
                        validators: {
                            notEmpty: {
                                message: 'هذا الحقل مطلوب'
                            }
                        }
                    },


                    'birth_place': {
                        validators: {
                            notEmpty: {
                                message: 'هذا الحقل مطلوب'
                            }
                        }
                    },

                    'mobile_number': {
                        validators: {
                            notEmpty: {
                                message: 'هذا الحقل مطلوب'
                            }
                        }
                    },



                    // 'leader': {
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


        submitButton.addEventListener('click', function (e) {
    e.preventDefault();

    // Validate form before submit
    if (validator) {
        validator.validate().then(function (status) {
            if (status === 'Valid') {
                // Show loading indication
                submitButton.setAttribute('data-kt-indicator', 'on');

                // Disable button to avoid multiple clicks
                submitButton.disabled = true;

                // Send ajax request
                // axios.post(submitButton.closest('form').getAttribute('action'), new FormData(form))
                axios.post("/admin/board_directors/"+group_id, new FormData(form))
                    .then(function (response) {
                        // Show success message with SweetAlert2
                        Swal.fire({
                            text: "تمت الاضافه بنجاح",
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

                                // Reload the datatable
                                $("#kt_datatable_table").DataTable().ajax.reload();

                                // Optional redirect
                                location.reload();
                            }
                        });
                    }).catch(function (error) {
                        // Handle the error
                        let dataMessage = error.response.data.message || "معذرة ، يبدو أنه تم اكتشاف بعض الأخطاء  او المجموعه الكشفيه موجوده من قبل، يرجى المحاولة مرة أخرى.";
                        let dataErrors = error.response.data.errors;

                        // Append error messages to the general message
                        for (const errorsKey in dataErrors) {
                            if (dataErrors.hasOwnProperty(errorsKey)) {
                                dataMessage += "\r\n" + dataErrors[errorsKey].join("\r\n");
                            }
                        }

                        // Display error message with SweetAlert2
                        Swal.fire({
                            text: dataMessage,
                            icon: "error",
                            buttonsStyling: false,
                            confirmButtonText: "حسنًا ، حسنًا!",
                            customClass: {
                                confirmButton: "btn btn-primary"
                            }
                        });
                    }).then(function () {
                        // Always executed: Hide loading indication and re-enable the button
                        submitButton.removeAttribute('data-kt-indicator');
                        submitButton.disabled = false;
                    });

            } else {
                // Form validation failed
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
                    var code = $('#code').val();
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
                    var code = $('#code').val();
                    form.reset(); // Reset form
                    $('#code').val(code);
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
            modal = new bootstrap.Modal(document.querySelector('#kt_modal_add'));

            form = document.querySelector('#kt_modal_add_form');
            submitButton = form.querySelector('#kt_modal_add_submit');
            cancelButton = form.querySelector('#kt_modal_add_cancel');
            closeButton = form.querySelector('#kt_modal_add_close');

            handleForm();
        }
    };
}();

// On document ready
KTUtil.onDOMContentLoaded(function () {
    KTModalAdd.init();
});





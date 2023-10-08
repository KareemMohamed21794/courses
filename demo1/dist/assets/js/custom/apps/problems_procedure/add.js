"use strict";

// Class definition
var KTModalAdd = function () {
    var submitButton;
    var cancelButton;
    var closeButton;
    var validator;
    var form;
    var modal;

    var problem_id = $("#problem_id").val();

    var sucessful_add = $("#sucessful_add").val();

    // Init form inputs
    var handleForm = function () {
        // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
        validator = FormValidation.formValidation(
            form,
            {
                fields: {
                     

                    'notes': {
                        validators: {
                            notEmpty: {
                                message: 'مطلوب   ملاحظات'
                            }
                        }
                    },

                    'date': {
                        validators: {
                            notEmpty: {
                                message: 'مطلوب   التاريخ'
                            }
                        }
                    },



                    'from': {
                        validators: {
                            notEmpty: {
                                message: 'مطلوب   من'
                            }
                        }
                    },


                    'to': {
                        validators: {
                            notEmpty: {
                                message: 'مطلوب الى'
                            },
                            callback: {
                                message: 'يجب أن يكون الوقت النهائي أكبر من الوقت البدء',
                                callback: function(input) {
                                    var fromValue = form.querySelector('[name="from"]').value;
                                    var toValue = input.value;
                                    
                                    // Compare the time values
                                    var fromTime = new Date('1970-01-01 ' + fromValue);
                                    var toTime = new Date('1970-01-01 ' + toValue);
                                    
                                    return toTime > fromTime;
                                }
                            }
                        }
                    },


                     'total_cost': {
                        validators: {
                            notEmpty: {
                                message: 'مطلوب  التكلفة الإجمالية'
                            }
                        }
                    },

                     'lawer_payment': {
                        validators: {
                            notEmpty: {
                                message: 'مطلوب  دفع المحامي'
                            }
                        }
                    },

                     'client_payment': {
                        validators: {
                            notEmpty: {
                                message: 'مطلوب  دفع  العميل'
                            }
                        }
                    },


                    //  'file': {
                    //     validators: {
                    //         notEmpty: {
                    //             message: 'مطلوب  '
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
                    axios.post("/admin/problems_procedure/"+problem_id, new FormData(form))
                        .then(function (response) {
                            // Show message popup. For more info check the plugin's official documentation: https://sweetalert2.github.io/
                            Swal.fire({
                                text: sucessful_add,
                                icon: "success",
                                buttonsStyling: false,
                                // confirmButtonText: "حسنًا ، حسنًا!",
                                customClass: {
                                    confirmButton: "btn btn-primary"
                                }
                            }).then(function (result) {
                                if (result.isConfirmed) {
                                    // Hide modal
                                    modal.hide();

                                    // Enable submit button after loading
                                    submitButton.disabled = false;

                                    //$("#kt_datatable_table").DataTable().ajax.reload();
                                    // Redirect to branchs list page
                                    window.location = form.getAttribute("data-kt-redirect");
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

function addStep() {
    $(".steps:first").clone().appendTo("#steps_container");
}

function ChangeDate(date) {
    $("#date").val(date);

    //======= Start Ajxa ========//
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });
        var problem_id = $("#problem_id").val();
        var type = "GET";
        var ajaxurl = '/admin/change_date/'+date+"/"+problem_id;

        $.ajax({
            type: type,
            url: ajaxurl,
            dataType: 'json',
            success: function (data) {
           if(data == 'date_older'){
            $("#date").val(null);
            $("#next_session_date").val(null);
            Swal.fire({
                text: "هذا التاريخ اقل من تاريخ الجلسه القادمه",
                icon: "error",
                buttonsStyling: false,
                confirmButtonText: "حسنًا ، حسنًا!",
                customClass: {
                    confirmButton: "btn btn-primary",
                }
            });
           }
            
            },
            error: function (data) {
                Swal.fire({
                    text: "Sorry, looks like there are some errors detected, please try again.",
                    icon: "error",
                    buttonsStyling: false,
                    confirmButtonText: "Ok, got it!",
                    customClass: {
                        confirmButton: "btn btn-primary"
                    }
                });
            }
        });
        //======= End Ajxa ========//

}
"use strict";

// Class definition
var KTModalBranchesUpdate = function () {
    var submitButton;
    var cancelButton;
    var closeButton;
    var validator;
    var form;
    var modal;

    let guard = $("#auth_guard").val();

    var sucessful_edit = $("#sucessful_edit").val();

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
                                    var fromValue = form.querySelector('[id="from_update"]').value;
                                    var toValue = form.querySelector('[id="to_update"]').value;
                                    
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
                        var update_id = $("#id").val();
                        axios.post("/admin/problems_procedure/"+update_id, new FormData(form))
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
                            text: " معذرة ، يبدو أنه تم اكتشاف بعض الأخطاء ، يرجى المحاولة مرة أخرى. ",
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
$('.modal-footer').show();
$('#popup_header').text('تعديل');
function getData(id,type=1) {

    if(type==2){
        $('input').prop('disabled', true);
        $('.modal-footer').hide();
        $('#popup_header').text('استعراض');
    }else{
        $('.modal-footer').show();
        $('#popup_header').text('تعديل');
    }

    //======= Start Ajxa ========//
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        }
    });

    let guard = 'admin';

    var type = "GET";
    var ajaxurl = '/'+guard+'/get_problems_procedure_data/'+id+'';

    $.ajax({
        type: type,
        url: ajaxurl,
        dataType: 'json',
        success: function (data) {
            jQuery('#id').val(data.id);
            jQuery('#notes_update').val(data.notes);
            jQuery('#next_session_date_update').val(data.next_session_date);
            jQuery('#date_update').val(data.date);
            jQuery('#from_update').val(data.from);
            jQuery('#to_update').val(data.to);
            jQuery('#total_cost_update').val(data.total_cost);
            jQuery('#lawer_payment_update').val(data.lawer_payment);
            jQuery('#client_payment_update').val(data.client_payment);
            jQuery('#judge_update').val(data.judge);
            //jQuery('#file_update').val(data.file);

        },
        error: function (data) {
            Swal.fire({
                text: " معذرة ، يبدو أنه تم اكتشاف بعض الأخطاء ، يرجى المحاولة مرة أخرى. ",
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
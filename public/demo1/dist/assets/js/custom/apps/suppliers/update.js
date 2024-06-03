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
                    'name_ar': {
                        validators: {
                            notEmpty: {
                                message: 'Name AR is required'
                            }
                        }
                    },

                    // 'name_en': {
                    //     validators: {
                    //         notEmpty: {
                    //             message: 'Name EN is required'
                    //         }
                    //     }
                    // },

                    'code': {
                        validators: {
                            notEmpty: {
                                message: 'Code is required'
                            }
                        }
                    },

                    'phone': {
                        validators: {
                            notEmpty: {
                                message: 'Phone is required'
                            }
                        }
                    },

                    'fax': {
                        validators: {
                            notEmpty: {
                                message: 'Fax is required'
                            }
                        }
                    },

                    'start_date': {
                        validators: {
                            notEmpty: {
                                message: 'Start Date is required'
                            }
                        }
                    },

                    'commercial_registration_no': {
                        validators: {
                            notEmpty: {
                                message: 'Commercial Registration NO is required'
                            }
                        }
                    },

                    'tax_registration_no': {
                        validators: {
                            notEmpty: {
                                message: 'Tax Registration NO is required'
                            }
                        }
                    },

                    'tax_file_no': {
                        validators: {
                            notEmpty: {
                                message: 'Tax File NO is required'
                            }
                        }
                    },

                    'tax_office': {
                        validators: {
                            notEmpty: {
                                message: 'Tax Office is required'
                            }
                        }
                    },

                    'type': {
                        validators: {
                            notEmpty: {
                                message: 'Type is required'
                            }
                        }
                    },

                    'country': {
                        validators: {
                            notEmpty: {
                                message: 'Country is required'
                            }
                        }
                    },

                    'governorate': {
                        validators: {
                            notEmpty: {
                                message: 'Governorate is required'
                            }
                        }
                    },

                    'city': {
                        validators: {
                            notEmpty: {
                                message: 'City is required'
                            }
                        }
                    },

                    'district': {
                        validators: {
                            notEmpty: {
                                message: 'District is required'
                            }
                        }
                    },

                    'post_number': {
                        validators: {
                            notEmpty: {
                                message: 'Post Number is required'
                            }
                        }
                    },

                    'building_number': {
                        validators: {
                            notEmpty: {
                                message: 'Building Number is required'
                            }
                        }
                    },

                    'street_name': {
                        validators: {
                            notEmpty: {
                                message: 'Street Name is required'
                            }
                        }
                    },

                    'email': {
                        validators: {
                            notEmpty: {
                                message: 'Email is required'
                            },
                            emailAddress: {
                                message: 'email Not Valid'
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
                        //======= Start Ajxa ========//

                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                            }
                        });

                        var id = jQuery('#id').val() ;

                        var formData = {
                            name_ar: jQuery('#name_ar_update').val(),
                            name_en: jQuery('#name_en_update').val(),
                            code: jQuery('#code_update').val(),
                            phone: jQuery('#phone_update').val(),
                            fax: jQuery('#fax_update').val(),
                            start_date: jQuery('#start_date_update').val(),
                            /*commercial_registration_no: jQuery('#commercial_registration_no_update').val(),
                            tax_registration_no: jQuery('#tax_registration_no_update').val(),
                            tax_file_no: jQuery('#tax_file_no_update').val(),
                            tax_office: jQuery('#tax_office_update').val(),
                            type: jQuery('#type_update').val(),
                            country: jQuery('#country_update').val(),
                            governorate: jQuery('#governorate_update').val(),
                            city: jQuery('#city_update').val(),
                            district: jQuery('#district_update').val(),
                            post_number: jQuery('#post_number_update').val(),
                            building_number: jQuery('#building_number_update').val(),
                            street_name: jQuery('#street_name_update').val(),*/
                            email: jQuery('#email_update').val(),
                            select_active: jQuery('#select_active_update').val(),
                        };

                        var type = "PATCH";
                        var ajaxurl = '/admin/suppliers/'+id;

                        $.ajax({
                            type: type,
                            url: ajaxurl,
                            data: formData,
                            dataType: 'json',
                            success: function (data) {
                                submitButton.setAttribute('data-kt-indicator', 'on');

                                // Disable submit button whilst loading
                                submitButton.disabled = true;

                                setTimeout(function() {
                                    submitButton.removeAttribute('data-kt-indicator');

                                    Swal.fire({
                                        text: "Form has been successfully submitted!",
                                        icon: "success",
                                        buttonsStyling: false,
                                        confirmButtonText: "Ok, got it!",
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
                                }, 2000);
                            },
                            error: function (data) {
                                var responseText = jQuery.parseJSON(data.responseText);

                                $.each(responseText, function(key, value){
                                    Swal.fire({
                                        text: 'Error [' + key + ']' + ' : ' + value,
                                        icon: "error",
                                        buttonsStyling: false,
                                        confirmButtonText: "Ok, got it!",
                                        customClass: {
                                            confirmButton: "btn btn-primary"
                                        }
                                    });

                                });
                            }
                        });
                        //======= End Ajxa ========//



                    } else {
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
            }
        });



        cancelButton.addEventListener('click', function (e) {
            e.preventDefault();

            Swal.fire({
                text: "Are you sure you would like to cancel?",
                icon: "warning",
                showCancelButton: true,
                buttonsStyling: false,
                confirmButtonText: "Yes, cancel it!",
                cancelButtonText: "No, return",
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
                        text: "Your form has not been cancelled!.",
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, got it!",
                        customClass: {
                            confirmButton: "btn btn-primary",
                        }
                    });
                }
            });
        });

        closeButton.addEventListener('click', function(e){
            e.preventDefault();

            Swal.fire({
                text: "Are you sure you would like to cancel?",
                icon: "warning",
                showCancelButton: true,
                buttonsStyling: false,
                confirmButtonText: "Yes, cancel it!",
                cancelButtonText: "No, return",
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
                        text: "Your form has not been cancelled!.",
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, got it!",
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
    var ajaxurl = '/admin/suppliers/'+id+'/edit';

    $.ajax({
        type: type,
        url: ajaxurl,
        dataType: 'json',
        success: function (data) {
            jQuery('#id').val(data.id);
            jQuery('#name_ar_update').val(data.name_ar);
            jQuery('#name_en_update').val(data.name_en);
            jQuery('#code_update').val(data.code);
            jQuery('#phone_update').val(data.phone);
            jQuery('#fax_update').val(data.fax);
            jQuery('#start_date_update').val(data.start_date);
            /*jQuery('#commercial_registration_no_update').val(data.commercial_registration_no);
            jQuery('#tax_registration_no_update').val(data.tax_registration_no);
            jQuery('#tax_file_no_update').val(data.tax_file_no);
            jQuery('#tax_office_update').val(data.tax_office);
            jQuery('#type_update').val(data.type);
            jQuery('#country_update').val(data.country);
            jQuery('#governorate_update').val(data.governorate);
            jQuery('#city_update').val(data.city);
            jQuery('#district_update').val(data.district);
            jQuery('#post_number_update').val(data.post_number);
            jQuery('#building_number_update').val(data.building_number);
            jQuery('#street_name_update').val(data.street_name);*/
            jQuery('#email_update').val(data.email);
            jQuery('#select_active_update').val(data.active);
            jQuery("#select_active_update").select2("val", ""+data.active+"");
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

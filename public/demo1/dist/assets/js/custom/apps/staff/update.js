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

                    'branch_id': {
                        validators: {
                            notEmpty: {
                                message: 'Branch is required'
                            }
                        }
                    },

                    'department_id': {
                        validators: {
                            notEmpty: {
                                message: 'Department is required'
                            }
                        }
                    },

                    'position_id': {
                        validators: {
                            notEmpty: {
                                message: 'Position is required'
                            }
                        }
                    },

                    'full_name_ar': {
                        validators: {
                            notEmpty: {
                                message: 'Full Name AR is required'
                            }
                        }
                    },

                    // 'full_name_en': {
                    //     validators: {
                    //         notEmpty: {
                    //             message: 'Full Name EN is required'
                    //         }
                    //     }
                    // },

                    'gender': {
                        validators: {
                            notEmpty: {
                                message: 'Gender is required'
                            }
                        }
                    },

                    // 'email': {
                    //     validators: {
                    //         notEmpty: {
                    //             message: 'Email is required'
                    //         },
                    //         emailAddress: {
                    //             message: 'email Not Valid'
                    //         }
                    //     }
                    // },

                    // 'date_of_work': {
                    //     validators: {
                    //         notEmpty: {
                    //             message: 'Date of Work is required'
                    //         }
                    //     }
                    // },

                    'insurance_no': {
                        validators: {
                            notEmpty: {
                                message: 'Insurance No is required'
                            }
                        }
                    },

                    'date_of_birth': {
                        validators: {
                            notEmpty: {
                                message: 'Date Of Birth is required'
                            }
                        }
                    },

                    // 'phone': {
                    //     validators: {
                    //         notEmpty: {
                    //             message: 'Phone is required'
                    //         }
                    //     }
                    // },

                    // 'mobile': {
                    //     validators: {
                    //         notEmpty: {
                    //             message: 'Mobile is required'
                    //         }
                    //     }
                    // },

                    // 'user_name': {
                    //     validators: {
                    //         notEmpty: {
                    //             message: 'User name is required'
                    //         }
                    //     }
                    // },

                    // 'password': {
                    //     validators: {
                    //         notEmpty: {
                    //             message: 'Password is required'
                    //         }
                    //     }
                    // },

                    // 'password_confirmation': {
                    //     validators: {
                    //         notEmpty: {
                    //             message: 'Confirm Password is required'
                    //         }
                    //     }
                    // },

                    'national_id': {
                        validators: {
                            notEmpty: {
                                message: 'National ID is required'
                            }
                        }
                    },

                    // 'address': {
                    //     validators: {
                    //         notEmpty: {
                    //             message: 'Address is required'
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
                        //======= Start Ajxa ========//
                        var id = $("#id").val();
                        var branch_id = $("#branch_id_update").val();
                        var department_id = $("#department_id_update").val();
                        var position_id = $("#position_id_update").val();
                        var full_name_ar = $("#full_name_ar_update").val();
                        var full_name_en = $("#full_name_en_update").val();
                        var gender = $("#gender_update").val();
                        var email = $("#email_update").val();
                        var date_of_work = $("#date_of_work_update").val();
                        var insurance_no = $("#insurance_no_update").val();
                        var date_of_birth = $("#date_of_birth_update").val();
                        var graduation_date = $("#graduation_date_update").val();
                        var university_ar = $("#university_ar_update").val();
                        var university_en = $("#university_en_update").val();
                        var educational_ar = $("#educational_ar_update").val();
                        var educational_en = $("#educational_en_update").val();
                        var phone = $("#phone_update").val();
                        var mobile = $("#mobile_update").val();
                        var mobile = $("#mobile_update").val();
                        var national_id = $("#national_id_update").val();
                        var finger_print_id = $("#finger_print_id_update").val();
                        var user_name = $("#user_name_update").val();
                        var password = $("#password_update").val();
                        var password_confirmation = $("#password_confirmation_update").val();
                        var select_active = $("#select_active_update").val();
                        var address = $("#address_update").val();
                        var personal_image  = $('#personal_image_update').prop('files')[0];

                        // Create form data object and append the values into it
                        var formData = new FormData();
                        formData.append('branch_id', branch_id);
                        formData.append('department_id', department_id);
                        formData.append('position_id', position_id);
                        formData.append('full_name_ar', full_name_ar);
                        formData.append('full_name_en', full_name_en);
                        formData.append('gender', gender);
                        formData.append('email', email);
                        formData.append('date_of_work', date_of_work);
                        formData.append('insurance_no', insurance_no);
                        formData.append('date_of_birth', date_of_birth);
                        formData.append('graduation_date', graduation_date);
                        formData.append('university_ar', university_ar);
                        formData.append('university_en', university_en);
                        formData.append('educational_ar', educational_ar);
                        formData.append('educational_en', educational_en);
                        formData.append('phone', phone);
                        formData.append('mobile', mobile);
                        formData.append('national_id', national_id);
                        formData.append('finger_print_id', finger_print_id);
                        formData.append('user_name', user_name);
                        formData.append('password', password);
                        formData.append('password_confirmation', password_confirmation);
                        formData.append('select_active', select_active);
                        formData.append('address', address);

                        formData.append('personal_image', personal_image);

                        formData.append('_method', 'PATCH');
                        
                        // add as many variables you want

                        $.ajax({
                            url: "/admin/staff/"+id, 
                            type: 'POST',
                            data: formData,
                            processData: false,
                            contentType: false,
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
                                }, 2000); 
                            },
                            error: function (data) {
                                var responseText = jQuery.parseJSON(data.responseText);
                                
                                $.each(responseText, function(key, value){
                                    Swal.fire({
                                        text: 'Error [' + key + ']' + ' : ' + value,
                                        icon: "error",
                                        buttonsStyling: false,
                                        confirmButtonText: "حسنًا ، حسنًا!",
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
                        confirmButtonText: "حسنًا ، حسنًا!",
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
    var ajaxurl = '/admin/staff/'+id+'/edit';

    $.ajax({
        type: type,
        url: ajaxurl,
        dataType: 'json',
        success: function (data) {
            jQuery('#id').val(data.id);
            jQuery('#branch_id_update').val(data.branch_id);
            jQuery("#branch_id_update").select2("val", ""+data.branch_id+"");
            

            jQuery('#department_id_update').val(data.position.department.id);
            // jQuery("#department_id_update").select2("val", ""+data.position.department.id+"");

            jQuery('#department_id_update').select2();
            
            jQuery('#position_id_update').val(data.position.id);
            jQuery("#position_id_update").select2("val", ""+data.position.id+"");
            jQuery('#full_name_ar_update').val(data.full_name_ar);
            jQuery('#full_name_en_update').val(data.full_name_en);
            jQuery('#gender_update').val(data.gender);
            jQuery('#email_update').val(data.email);
            jQuery('#date_of_work_update').val(data.date_of_work);
            jQuery('#graduation_date_update').val(data.graduation_date);
            jQuery('#university_ar_update').val(data.university_ar);
            jQuery('#university_en_update').val(data.university_en);
            jQuery('#educational_ar_update').val(data.educational_ar);
            jQuery('#educational_en_update').val(data.educational_en);
            jQuery('#insurance_no_update').val(data.insurance_no);
            jQuery('#date_of_birth_update').val(data.date_of_birth);
            jQuery('#phone_update').val(data.phone);
            jQuery('#mobile_update').val(data.mobile);
            jQuery('#personal_image_update_show').attr('src', data.personal_image_path);
            jQuery('#national_id_update').val(data.national_id);
            jQuery('#finger_print_id_update').val(data.finger_print_id);
            jQuery('#address_update').val(data.address);
            jQuery('#user_name_update').val(data.user_name);
            jQuery('#select_active_update').val(data.active);
            jQuery("#select_active_update").select2("val", ""+data.active+"");
            


        },
        error: function (data) {
            Swal.fire({
                text: "Sorry, looks like there are some errors detected, please try again.",
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
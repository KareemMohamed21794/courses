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
                    'name': {
                        validators: {
                            notEmpty: {
                                message: 'مطلوب اسم'
                            }
                        }
                    },

                    'username': {
                        validators: {
                            notEmpty: {
                                message: 'مطلوب  اسم المستخدم'
                            }
                        }
                    },

                    'email': {
                        validators: {
                            notEmpty: {
                                message: 'البريد الالكتروني مطلوب'
                            },
                            emailAddress: {
                                message: 'البريد الإلكتروني غير صالح'
                            }
                        }
                    },

                    // 'department_id': {
                    //     validators: {
                    //         notEmpty: {
                    //             message: 'القسم مطلوب'
                    //         }
                    //     }
                    // },

                    // 'position_id': {
                    //     validators: {
                    //         notEmpty: {
                    //             message: 'الوظيفة مطلوبة'
                    //         }
                    //     }
                    // },

                    // 'password': {
                    //     validators: {
                    //         notEmpty: {
                    //             message: 'كلمة المرور مطلوبة'
                    //         }
                    //     }
                    // },

                    // 'password_confirmation': {
                    //     validators: {
                    //         notEmpty: {
                    //             message: 'تأكيد كلمة المرور مطلوب'
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

                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                            }
                        });

                        var id = jQuery('#id').val() ;

                        var formData = {
                            name: jQuery('#name_update').val(),
                            username: jQuery('#username_update').val(),
                            email: jQuery('#email_update').val(),
                            // department_id: $("#department_id_update").val(),
                            // position_id: $("#position_id_update").val(),
                            password: jQuery('#password_update').val(),
                            password_confirmation: jQuery('#password_confirmation_update').val(),
                            //select_is_super: jQuery('#select_is_super_update').val(),
                            phone: jQuery('#phone_update').val(),
                            address: jQuery('#address_update').val(),
                        };

                        var type = "PATCH";
                        var ajaxurl = '/admin/admins/'+id;

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
                    // Swal.fire({
                    //     text: "لم يتم إلغاء النموذج الخاص بك !.",
                    //     icon: "error",
                    //     buttonsStyling: false,
                    //     confirmButtonText: "حسنًا ، حسنًا!",
                    //     customClass: {
                    //         confirmButton: "btn btn-primary",
                    //     }
                    // });
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
                    // Swal.fire({
                    //     text: "لم يتم إلغاء النموذج الخاص بك !.",
                    //     icon: "error",
                    //     buttonsStyling: false,
                    //     confirmButtonText: "حسنًا ، حسنًا!",
                    //     customClass: {
                    //         confirmButton: "btn btn-primary",
                    //     }
                    // });
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
    var ajaxurl = '/admin/admins/'+id+'/edit';

    $.ajax({
        type: type,
        url: ajaxurl,
        dataType: 'json',
        success: function (data) {
            jQuery('#id').val(data.id);
            jQuery('#name_update').val(data.name);
            jQuery('#username_update').val(data.username);
            jQuery('#email_update').val(data.email);
            jQuery('#phone_update').val(data.phone);
            jQuery('#address_update').val(data.address);
            // jQuery('#department_id_update').val(data.position.department.id);
            // jQuery('#department_id_update').select2();
            jQuery('#position_id_update').val(data.position.id);
            jQuery('#select_is_super_update').val(data.is_super);
            jQuery("#select_is_super_update").select2("val", ""+data.is_super+"");
            

            jQuery(`#position_id_update option[value="${data.position.id}"]`).attr("selected", "selected");
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

function getPositions(department_id) {
    //======= Start Ajxa ========//
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        }
    });

    var type = "GET";
    var ajaxurl = '/admin/departments/get_positions/'+department_id;

    $.ajax({
        type: type,
        url: ajaxurl,
        dataType: 'json',
        success: function (data) {
            $("[name='position_id']").empty();
            var $dropdown = $("[name='position_id']");
            $dropdown.append($("<option />").val('').text('Select Positions'));
            $.each( data, function( key, value ) {
                $dropdown.append($("<option />").val(value.id).text(value.display_name));
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

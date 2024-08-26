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

                    // 'registration_type': {
                    //     validators: {
                    //         notEmpty: {
                    //             message: 'هذا الحقل مطلوب'
                    //         }
                    //     }
                    // },

                    // 'group_classification': {
                    //     validators: {
                    //         notEmpty: {
                    //             message: 'هذا الحقل مطلوب'
                    //         }
                    //     }
                    // },


                    'group_name': {
                        validators: {
                            notEmpty: {
                                message: 'هذا الحقل مطلوب'
                            }
                        }
                    },



                    // 'date_establishment': {
                    //     validators: {
                    //         notEmpty: {
                    //             message: 'هذا الحقل مطلوب'
                    //         }
                    //     }
                    // },


                    'registration_number': {
                        validators: {
                            notEmpty: {
                                message: 'هذا الحقل مطلوب'
                            }
                        }
                    },

                    // 'phone': {
                    //     validators: {
                    //         notEmpty: {
                    //             message: 'هذا الحقل مطلوب'
                    //         }
                    //     }
                    // },



                    // 'website': {
                    //     validators: {
                    //         notEmpty: {
                    //             message: 'هذا الحقل مطلوب'
                    //         }
                    //     }
                    // },

                    // 'governorate': {
                    //     validators: {
                    //         notEmpty: {
                    //             message: 'هذا الحقل مطلوب'
                    //         }
                    //     }
                    // },



                    // 'district': {
                    //     validators: {
                    //         notEmpty: {
                    //             message: 'هذا الحقل مطلوب'
                    //         }
                    //     }
                    // },



                    // 'street_name': {
                    //     validators: {
                    //         notEmpty: {
                    //             message: 'هذا الحقل مطلوب'
                    //         }
                    //     }
                    // },


                    // 'building_number': {
                    //     validators: {
                    //         notEmpty: {
                    //             message: 'هذا الحقل مطلوب'
                    //         }
                    //     }
                    // },


                    // 'workplace': {
                    //     validators: {
                    //         notEmpty: {
                    //             message: 'هذا الحقل مطلوب'
                    //         }
                    //     }
                    // },

                    // 'job': {
                    //     validators: {
                    //         notEmpty: {
                    //             message: 'هذا الحقل مطلوب'
                    //         }
                    //     }
                    // },


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
                            registration_type: jQuery('#registration_type_update').val(),
                            group_classification: jQuery('#group_classification_update').val(),
                            group_name: jQuery('#group_name_update').val(),
                            secondary_registration_fees: jQuery('#secondary_registration_fees_update').val(),
                            date_establishment: jQuery('#date_establishment_update').val(),
                            registration_number: jQuery('#registration_number_update').val(),
                            website: jQuery('#website_update').val(),
                            governorate: jQuery('#governorate_update').val(),
                            district: jQuery('#district_update').val(),
                            street_name: jQuery('#street_name_update').val(),
                            building_number: jQuery('#building_number_update').val(),
                            workplace: jQuery('#workplace_update').val(),
                            job: jQuery('#job_update').val(),
                            alhayyuh_almuqayaduh: jQuery('#alhayyuh_almuqayaduh_update').val(),
                            alhayyuh_almuqayaduh_number: jQuery('#alhayyuh_almuqayaduh_number_update').val(),
                            leaders_number: jQuery('#leaders_number_update').val(),
                            persons_number: jQuery('#persons_number_update').val(),
                            groups: jQuery('#groups_update').val(),
                            ashbal: jQuery('#ashbal_update').val(),
                            kashafa: jQuery('#kashafa_update').val(),
                            motakadem: jQuery('#motakadem_update').val(),
                            gawala: jQuery('#gawala_update').val(),
                            
                           
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
                                            location.reload();

                                            //$("#kt_datatable_table").DataTable().ajax.reload();
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

function getData(id,action) {
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
            jQuery('#group_name_update').val(data.group_name);
            jQuery('#secondary_registration_fees_update').val(data.secondary_registration_fees);
            jQuery('#date_establishment_update').val(data.date_establishment);
            jQuery('#registration_number_update').val(data.registration_number);
            jQuery('#website_update').val(data.website);
            jQuery('#district_update').val(data.district);
            jQuery('#street_name_update').val(data.street_name);
            jQuery('#building_number_update').val(data.building_number);
            jQuery('#workplace_update').val(data.workplace);
            jQuery('#job_update').val(data.job);
            jQuery('#address_update').val(data.address);
            jQuery('#governorate_update').val(data.governorate);
            jQuery('#governorate_update').select2();
           // jQuery('#position_id_update').val(data.position.id);
            jQuery('#registration_type_update').val(data.registration_type);
           // jQuery("#registration_type_update").select2("val", ""+data.registration_type+"");
            jQuery('#group_classification_update').val(data.group_classification);
          //  jQuery("#group_cassification_update").select2("val", ""+data.group_classification+"");
            

            jQuery('#alhayyuh_almuqayaduh_update').val(data.alhayyuh_almuqayaduh);
            jQuery('#alhayyuh_almuqayaduh_number_update').val(data.alhayyuh_almuqayaduh_number);
            
            jQuery('#leaders_number_update').val(data.leaders_number);
            jQuery('#persons_number_update').val(data.persons_number);
            jQuery('#groups_update').val(data.groups);
            jQuery('#ashbal_update').val(data.ashbal);
            jQuery('#kashafa_update').val(data.kashafa);
            jQuery('#motakadem_update').val(data.motakadem);
            jQuery('#gawala_update').val(data.gawala);






            if(data.registration_type == 'muqiaduh'){
                $("#alhayyuh_almuqayaduh_id_update").show();
                $("#alhayyuh_almuqayaduh_number_id_update").show();
                $("#labelElement_update").text('رقم الهيئة المقيدة ');
            }else if(data.registration_type == 'harah'){
                $("#alhayyuh_almuqayaduh_id_update").hide();
                $("#alhayyuh_almuqayaduh_number_id_update").show();
                $("#labelElement_update").text('رقم مجلس الإدارة');
               
            }else{
                $("#alhayyuh_almuqayaduh_id_update").hide();
                $("#alhayyuh_almuqayaduh_number_id_update").hide();
            }

            if (action == 2) {
            // Disable all input and select elements
                // alert(data.is_super);
                // alert(action)
                $('input, select').prop('disabled', true);
                $('#kt_modal_update_submit').hide();
                var heading = document.getElementById("myHeading");

                if(data.is_super==1 && data.position_id==1){
                    heading.innerHTML = '<span class="fw-bolder">معلومات</span> ' + 'المدير';
                }else if(data.is_super==0 && data.position_id==2){
                    heading.innerHTML = '<span class="fw-bolder">معلومات</span> ' + 'مجموعة كشفية';
                }else if(data.is_super==0 && data.position_id==3){
                    heading.innerHTML = '<span class="fw-bolder">معلومات</span> ' + 'سكرتير';
                }else if(data.is_super==0 && data.position_id==4){
                    heading.innerHTML = '<span class="fw-bolder">معلومات</span> ' + 'مراقب';
                }else if(data.is_super==0 && data.position_id==5){
                    heading.innerHTML = '<span class="fw-bolder">معلومات</span> ' + 'مفوض تدريب';
                }else if(data.is_super==0 && data.position_id==6){
                    heading.innerHTML = '<span class="fw-bolder">معلومات</span> ' + 'أمين صندوق';
                }

                
            } else {
                // Enable all input and select elements
                $('input, select').prop('disabled', false);
                $('#kt_modal_update_submit').show();
                var heading = document.getElementById("myHeading");
                // heading.innerHTML = '<span class="fw-bolder">تحديث</span> ' + 'مدير';
            }

l


           // jQuery(`#position_id_update option[value="${data.position.id}"]`).attr("selected", "selected");
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


function RegistrationTypeUpdate(value) {
   if(value == 'muqiaduh'){
    $("#alhayyuh_almuqayaduh_id_update").show();
    $("#alhayyuh_almuqayaduh_number_id_update").show();
    $("#labelElement_update").text('رقم الهيئة المقيدة/مجلس الإدارة');
   
   }else if(value == 'harah'){
    $("#alhayyuh_almuqayaduh_id_update").hide();
    $("#alhayyuh_almuqayaduh_number_id_update").show();
    $("#labelElement_update").text('رقم مجلس الإدارة');
   
   }else{
    $("#alhayyuh_almuqayaduh_id_update").hide();
    $("#alhayyuh_almuqayaduh_number_id_update").hide();
   }
}
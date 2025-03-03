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


                    'grandfather_name': {
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

                    'scout': {
                        validators: {
                            notEmpty: {
                                message: 'هذا الحقل مطلوب'
                            }
                        }
                    },

                    'year_scout': {
                        validators: {
                            notEmpty: {
                                message: 'هذا الحقل مطلوب'
                            }
                        }
                    },


                    'place_scout': {
                        validators: {
                            notEmpty: {
                                message: 'هذا الحقل مطلوب'
                            }
                        }
                    },

                    'vacation_scout': {
                        validators: {
                            notEmpty: {
                                message: 'هذا الحقل مطلوب'
                            }
                        }
                    },

                    'academic': {
                        validators: {
                            notEmpty: {
                                message: 'هذا الحقل مطلوب'
                            }
                        }
                    },


                    'specialization_academic': {
                        validators: {
                            notEmpty: {
                                message: 'هذا الحقل مطلوب'
                            }
                        }
                    },

                    'year_academic': {
                        validators: {
                            notEmpty: {
                                message: 'هذا الحقل مطلوب'
                            }
                        }
                    },

                    'college': {
                        validators: {
                            notEmpty: {
                                message: 'هذا الحقل مطلوب'
                            }
                        }
                    },



                    'work_place': {
                        validators: {
                            notEmpty: {
                                message: 'هذا الحقل مطلوب'
                            }
                        }
                    },

                    'phone': {
                        validators: {
                            notEmpty: {
                                message: 'هذا الحقل مطلوب'
                            }
                        }
                    },

                    'Job_title': {
                        validators: {
                            notEmpty: {
                                message: 'هذا الحقل مطلوب'
                            }
                        }
                    },


                    'city': {
                        validators: {
                            notEmpty: {
                                message: 'هذا الحقل مطلوب'
                            }
                        }
                    },



                    'street': {
                        validators: {
                            notEmpty: {
                                message: 'هذا الحقل مطلوب'
                            }
                        }
                    },


                    'building_number': {
                        validators: {
                            notEmpty: {
                                message: 'هذا الحقل مطلوب'
                            }
                        }
                    },


                    'nearest_teacher': {
                        validators: {
                            notEmpty: {
                                message: 'هذا الحقل مطلوب'
                            }
                        }
                    },


                    'home_phone': {
                        validators: {
                            notEmpty: {
                                message: 'هذا الحقل مطلوب'
                            }
                        }
                    },



                    'marital_status': {
                        validators: {
                            notEmpty: {
                                message: 'هذا الحقل مطلوب'
                            }
                        }
                    },


                    'phone_comunication': {
                        validators: {
                            notEmpty: {
                                message: 'هذا الحقل مطلوب'
                            }
                        }
                    },



                    'email': {
                        validators: {
                            notEmpty: {
                                message: 'هذا الحقل مطلوب'
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
                        axios.post("/admin/group_leaders/"+update_id, new FormData(form))
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
    var ajaxurl = '/admin/get_group_leader/'+id;

    $.ajax({
        type: type,
        url: ajaxurl,
        dataType: 'json',
        success: function (data) {
            jQuery('#id').val(data.id);
           
            jQuery('#first_name_update').val(data.first_name);
            jQuery('#father_name_update').val(data.father_name);
            jQuery('#grandfather_name_update').val(data.grandfather_name);
            jQuery('#family_name_update').val(data.family_name);
            jQuery('#birth_place_update').val(data.birth_place);
            jQuery('#birth_date_update').val(data.birth_date);
            jQuery('#job_update').val(data.job);
            jQuery('#scout_update').val(data.scout);
            jQuery('#specialization_scout_update').val(data.specialization_scout);
            jQuery('#year_scout_update').val(data.year_scout);
            jQuery('#place_scout_update').val(data.place_scout);
            jQuery('#vacation_scout_update').val(data.vacation_scout);
            jQuery('#note_scout_update').val(data.note_scout);
            jQuery('#academic_update').val(data.academic);
            jQuery('#specialization_academic_update').val(data.specialization_academic);
            jQuery('#year_academic_update').val(data.year_academic);
            jQuery('#college_update').val(data.college);
            jQuery('#work_place_update').val(data.work_place);
            jQuery('#phone_update').val(data.phone);
            jQuery('#Job_title_update').val(data.Job_title);
            
            jQuery('#city_update').val(data.city);
            jQuery('#city_update').select2();

            if(!data.city || data.city.length === 0){
                $('#text_area_update').hide();
                $('#selected_area_update').hide();
                $('#amman_region_update').val(null);
                $('#area_update').val(null);
               }

               if(data.city == '1'){
                $('#selected_area_update').show();
                $('#text_area_update').hide();
                jQuery('#amman_region_update').val(data.area);
                jQuery('#amman_region_update').select2();
                $('#area_update').val(null);
                
               }

               if(data.city != '1' && data.city.length != 0){
                $('#selected_area_update').hide();
                $('#text_area_update').show();
                jQuery('#area_update').val(data.area);
                $('#amman_region_update').val(null);
                
            }


            jQuery('#street_update').val(data.street);
            jQuery('#building_number_update').val(data.building_number);
            jQuery('#nearest_teacher_update').val(data.nearest_teacher);
            jQuery('#home_phone_update').val(data.home_phone);
            jQuery('#marital_status_update').val(data.marital_status);
            jQuery('#phone_comunication_update').val(data.phone_comunication);
            jQuery('#email_update').val(data.email);
            jQuery('#fax_update').val(data.fax);
            jQuery('#mailbox_update').val(data.mailbox);
            jQuery('#city_comunication_update').val(data.city_comunication);
            jQuery('#zip_code_update').val(data.zip_code);


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


function SelectCityUpdate(city) {
     
       if(!city || city.length === 0){
        $('#text_area_update').hide();
        $('#selected_area_update').hide();
        $('#amman_region_update').val(null);
        $('#area_update').val(null);
       }

       if(city == '1'){
        $('#selected_area_update').show();
        $('#text_area_update').hide();
        
        $('#area_update').val(null);
        
       }

       if(city != '1' && city.length != 0){
        $('#selected_area_update').hide();
        $('#text_area_update').show();
        
        $('#amman_region_update').val(null);
        
       }
}






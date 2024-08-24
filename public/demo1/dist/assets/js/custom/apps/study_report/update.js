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
                    // 'file': {
                    //     validators: {
                    //         notEmpty: {
                    //             message: 'هذا الحقل مطلوب'
                    //         },
                    //         file: {
                    //             maxSize: 8 * 1024 * 1024, // 8 MB
                    //             extension: 'pdf,doc,docx,docm,dot,dotx,dotm,xls,xlsx,xlsm,xlsb',
                    //             message: 'حجم الملف يجب أن يكون أقل من 8 ميجابايت ويجب أن يكون نوعه pdf او word او excel'
                    //         }
                    //     }
                    // },
                    
                   


                    'study_place': {
                        validators: {
                            notEmpty: {
                                message: 'هذا الحقل مطلوب'
                            }
                        }
                    },

                    'study_location': {
                        validators: {
                            notEmpty: {
                                message: 'هذا الحقل مطلوب'
                            }
                        }
                    },


                    'practical_place': {
                        validators: {
                            notEmpty: {
                                message: 'هذا الحقل مطلوب'
                            }
                        }
                    },


                    'practical_location': {
                        validators: {
                            notEmpty: {
                                message: 'هذا الحقل مطلوب'
                            }
                        }
                    },


                    'proposed_time_study': {
                        validators: {
                            notEmpty: {
                                message: 'هذا الحقل مطلوب'
                            }
                        }
                    },


                    'type_qualification': {
                        validators: {
                            notEmpty: {
                                message: 'هذا الحقل مطلوب'
                            }
                        }
                    },


                    'maximum_number_students': {
                        validators: {
                            notEmpty: {
                                message: 'هذا الحقل مطلوب'
                            }
                        }
                    },


                    'proposed_study_supervisor': {
                        validators: {
                            notEmpty: {
                                message: 'هذا الحقل مطلوب'
                            }
                        }
                    },


                    'qualification_study_supervisor': {
                        validators: {
                            notEmpty: {
                                message: 'هذا الحقل مطلوب'
                            }
                        }
                    },


                    'proposed_study_leader': {
                        validators: {
                            notEmpty: {
                                message: 'هذا الحقل مطلوب'
                            }
                        }
                    },


                    'qualification_study_leader': {
                        validators: {
                            notEmpty: {
                                message: 'هذا الحقل مطلوب'
                            }
                        }
                    },



                    'list_supervisor': {
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
                        axios.post("/admin/study_report/"+update_id, new FormData(form))
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
    var ajaxurl = '/admin/organizing_study/'+id+'/edit';

    $.ajax({
        type: type,
        url: ajaxurl,
        dataType: 'json',
        success: function (data) {
            jQuery('#id').val(data.id);

            if(data.support_group == 'yes'){
                $('#support_group_update_yes').prop('checked', true);
                $('#suport_group_div_update').show(300);
            }else{
                $('#support_group_update_no').prop('checked', true);
                $("#suport_group_div_update").hide(300);
            }


            if(data.proposed_time_study == 'connected'){
               
                $('#connected_study_update').show(300);
                $("#separate_study_update").hide(300);
            }else{
                $('#connected_study_update').hide(300);
                $("#separate_study_update").show(300);
            }


            jQuery('#study_place_update').val(data.study_place);
            jQuery('#study_location_update').val(data.study_location);
            jQuery('#practical_place_update').val(data.practical_place);
            jQuery('#practical_location_update').val(data.practical_location);
            jQuery('#proposed_time_study_update').val(data.proposed_time_study);
            jQuery('#proposed_time_study_update').select2();
            jQuery('#connected_from_update').val(data.connected_from);
            jQuery('#connected_to_update').val(data.connected_to);
            jQuery('#type_qualification_update').val(data.type_qualification);
            jQuery('#type_qualification_update').select2();
            jQuery('#maximum_number_students_update').val(data.maximum_number_students);
            jQuery('#proposed_study_supervisor_update').val(data.proposed_study_supervisor);
            jQuery('#qualification_study_supervisor_update').val(data.qualification_study_supervisor);
            jQuery('#vacation_number_supervisor_update').val(data.vacation_number_supervisor);
            jQuery('#proposed_study_leader_update').val(data.proposed_study_leader);
            jQuery('#qualification_study_leader_update').val(data.qualification_study_leader);
            jQuery('#vacation_number_leader_update').val(data.vacation_number_leader);
            jQuery('#list_supervisor_update').val(data.list_supervisor);

           
            var image_path =  '../images/organizing_study/'
            // Get the image element by its id
            var file = document.getElementById("file_update");
          
            // Set the 'src' and  'href'  attribute of the image element using the JSON data
           
            file.src = image_path+data.file;
            href_file.href = image_path+data.file;
           

           

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

    function SuportGroupUpdate() {

    var  value = $('input[name="support_group_update"]:checked').val();
   
    if(value == 'yes'){
        $('#suport_group_div_update').show(300);

    }else{
        
        $("#suport_group_div_update").hide(300);
       
       $('#suport_group_update_id').select2('destroy');
       $('#suport_group_update_id').val(0).select2();return;
    }
    
    }


    function TimeStudyUpdate(value) {

   
    if(value == 'connected'){
        $('#connected_study_update').show(300);
        $('#separate_study_update').hide(300);


        // Get all input elements with name 'separate_day[]'
        const dayInputs = document.querySelectorAll('input[name="separate_day[]"]');
        const dateInputs = document.querySelectorAll('input[name="separate_date[]"]');
        
        // Iterate over each input and clear its value
        dayInputs.forEach(input => {
            input.value = '';
        });

        dateInputs.forEach(input => {
            input.value = '';
        });


    }else{
        $('#separate_study_update').show(300);
        $("#connected_study_update").hide(300);
        $('#connected_from_update').val(null);
        $('#connected_to_update').val(null);

    }
    
    }

    function addOtherPersonUpdate() {
      // Clone the first input element
      var clonedPerson = $(".other_person_other_lawer:first").clone();

      clonedPerson.val('');

      // Find all input elements within the clonedPerson and clear their values
      clonedPerson.find('input').val('');

      // Append the cloned input to the container
      $(".other_person_container").append(clonedPerson);
    }



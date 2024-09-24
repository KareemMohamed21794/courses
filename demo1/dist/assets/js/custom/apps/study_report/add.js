"use strict";

// Class definition
var KTModalAdd = function () {
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
                    
                    'support_group_yes': {
                        validators: {
                            notEmpty: {
                                message: 'هذا الحقل مطلوب'
                            }
                        }
                    },


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


                    // 'description': {
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
                    axios.post(submitButton.closest('form').getAttribute('action'), new FormData(form))
                        .then(function (response) {
                            // Show message popup. For more info check the plugin's official documentation: https://sweetalert2.github.io/
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
                                                
                    }else {
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


$( document ).ready(function() {
        $('#suport_group_div').hide();
        $('#connected_study').hide();
        $('#separate_study').hide();
        
       
    });


    function SuportGroup() {

    var  value = $('input[name="support_group"]:checked').val();
   
    if(value == 'yes'){
        $('#suport_group_div').show(300);

    }else{
        
        $("#suport_group_div").hide(300);
       
       $('#suport_group_id').select2('destroy');
       $('#suport_group_id').val(0).select2();return;
    }
    
    }


    function TimeStudy(value) {

   
    if(value == 'connected'){
        $('#connected_study').show(300);
        $('#separate_study').hide(300);


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
        $('#separate_study').show(300);
        $("#connected_study").hide(300);
        $('#connected_from').val(null);
        $('#connected_to').val(null);

    }
    
    }

    function addOtherPerson() {
      // Clone the first input element
      var clonedPerson = $(".other_person_other_lawer:first").clone();

      clonedPerson.val('');

      // Find all input elements within the clonedPerson and clear their values
      clonedPerson.find('input').val('');

      // Append the cloned input to the container
      $(".other_person_container").append(clonedPerson);
    }



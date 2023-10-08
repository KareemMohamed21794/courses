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
					// 	validators: {
					// 		notEmpty: {
					// 			message: 'Full Name EN is required'
					// 		}
					// 	}
					// },

					'gender': {
						validators: {
							notEmpty: {
								message: 'Gender is required'
							}
						}
					},

					// 'email': {
					// 	validators: {
					// 		notEmpty: {
					// 			message: 'Email is required'
					// 		},
					// 		emailAddress: {
					// 			message: 'email Not Valid'
					// 		}
					// 	}
					// },

					'date_of_work': {
						validators: {
							notEmpty: {
								message: 'Date of Work is required'
							}
						}
					},

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
					// 	validators: {
					// 		notEmpty: {
					// 			message: 'Phone is required'
					// 		}
					// 	}
					// },

					// 'mobile': {
					// 	validators: {
					// 		notEmpty: {
					// 			message: 'Mobile is required'
					// 		}
					// 	}
					// },

					// 'user_name': {
					// 	validators: {
					// 		notEmpty: {
					// 			message: 'User name is required'
					// 		}
					// 	}
					// },

					// 'password': {
					// 	validators: {
					// 		notEmpty: {
					// 			message: 'Password is required'
					// 		}
					// 	}
					// },

					// 'password_confirmation': {
					// 	validators: {
					// 		notEmpty: {
					// 			message: 'Confirm Password is required'
					// 		}
					// 	}
					// },

					'national_id': {
						validators: {
							notEmpty: {
								message: 'National ID is required'
							}
						}
					},

					// 'address': {
					// 	validators: {
					// 		notEmpty: {
					// 			message: 'Address is required'
					// 		}
					// 	}
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
						var branch_id = $("#branch_id").val();
						var department_id = $("#department_id").val();
						var position_id = $("#position_id").val();
						var full_name_ar = $("#full_name_ar").val();
						var full_name_en = $("#full_name_en").val();
						var gender = $("#gender").val();
						var email = $("#email").val();
						var date_of_work = $("#date_of_work").val();
						var graduation_date = $("#graduation_date").val();
						var university_ar = $("#university_ar").val();
						var university_en = $("#university_en").val();
						var educational_ar = $("#educational_ar").val();
						var educational_en = $("#educational_en").val();
						var insurance_no = $("#insurance_no").val();
						var date_of_birth = $("#date_of_birth").val();
						var phone = $("#phone").val();
						var mobile = $("#mobile").val();
						var mobile = $("#mobile").val();
						var national_id = $("#national_id").val();
						var finger_print_id = $("#finger_print_id").val();
						var user_name = $("#user_name").val();
						var password = $("#password").val();
						var password_confirmation = $("#password_confirmation").val();
						var select_active = $("#select_active").val();
						var address = $("#address").val();
						var personal_image  = $('#personal_image').prop('files')[0];

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
						formData.append('graduation_date', graduation_date);
						formData.append('university_ar', university_ar);
						formData.append('university_en', university_en);
						formData.append('educational_ar', educational_ar);
						formData.append('educational_en', educational_en);
						formData.append('insurance_no', insurance_no);
						formData.append('date_of_birth', date_of_birth);
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
						
						// add as many variables you want

						$.ajax({
					        url: "/admin/staff", 
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
            form.reset(); // Reset form
            modal.hide(); // Hide modal
            return false;

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
			form.reset(); // Reset form
            modal.hide(); // Hide modal
            return false;

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
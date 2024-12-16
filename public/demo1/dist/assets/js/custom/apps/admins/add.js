"use strict";

// Class definition
var KTModalAdd = function () {
    var submitButton;
    var cancelButton;
	var closeButton;
    var validator;
    var form;
    var modal;

    var sucessful_add = $("#sucessful_add").val();

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

			        	var formData = {
			            	name: jQuery('#name').val(),
                            username: jQuery('#username').val(),
                            email: jQuery('#email').val(),
                            // department_id: $("#department_id").val(),
                            // position_id: $("#position_id").val(),
                            password: jQuery('#password').val(),
                            password_confirmation: jQuery('#password_confirmation').val(),
                            //select_is_super: jQuery('#select_is_super').val(),
                            phone: jQuery('#phone').val(),
                            address: jQuery('#address').val(),
                            registration_type: jQuery('#registration_type').val(),
                            group_classification: jQuery('#group_classification').val(),
                            group_name: jQuery('#group_name').val(),
                            // dead_line: jQuery('#dead_line').val(),
                            date_establishment: jQuery('#date_establishment').val(),
                            registration_number: jQuery('#registration_number').val(),
                            website: jQuery('#website').val(),
                            governorate: jQuery('#governorate').val(),
                            district: jQuery('#district').val(),
                            street_name: jQuery('#street_name').val(),
                            building_number: jQuery('#building_number').val(),
                            workplace: jQuery('#workplace').val(),
                            job: jQuery('#job').val(),
                            department_id: $("#department_id").val(),
                            position_id: $("#position_id").val(),
                            select_is_super: jQuery('#select_is_super').val(),
                            alhayyuh_almuqayaduh: jQuery('#alhayyuh_almuqayaduh').val(),
                            alhayyuh_almuqayaduh_number: jQuery('#alhayyuh_almuqayaduh_number').val(),
                            leaders_number: jQuery('#leaders_number').val(),
                            persons_number: jQuery('#persons_number').val(),
                            groups: jQuery('#groups').val(),
                            ashbal: jQuery('#ashbal').val(),
                            kashafa: jQuery('#kashafa').val(),
                            motakadem: jQuery('#motakadem').val(),
                            gawala: jQuery('#gawala').val(),
			        	};

			        	var type = "POST";
			        	var ajaxurl = '/admin/admins';

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
										text: sucessful_add,
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
				            	// console.log(data.responseText);
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


$( document).ready(function() {

    $("#alhayyuh_almuqayaduh_id").hide();
    $("#alhayyuh_almuqayaduh_number_id").hide();
   
});


function RegistrationType(value) {
   if(value == 'muqiaduh'){
    $("#alhayyuh_almuqayaduh_id").show();
    $("#alhayyuh_almuqayaduh_number_id").show();
    $("#labelElement").text('رقم الهيئة المقيدة/مجلس الإدارة');
   
   }else if(value == 'harah'){
    $("#alhayyuh_almuqayaduh_id").hide();
    $("#alhayyuh_almuqayaduh_number_id").show();
    $('#alhayyuh_almuqayaduh').val(null);
    $("#labelElement").text('رقم مجلس الإدارة');
   }else{
    $("#alhayyuh_almuqayaduh_id").hide();
    $("#alhayyuh_almuqayaduh_number_id").hide();
    $('#alhayyuh_almuqayaduh').val(null);
    $('#alhayyuh_almuqayaduh_number').val(null);
   }
}

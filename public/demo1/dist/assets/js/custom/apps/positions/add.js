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
					'department_id': {
						validators: {
							notEmpty: {
								message: 'القسم مطلوب'
							}
						}
					},

                    'name_ar': {
						validators: {
							notEmpty: {
								message: 'الاسم  مطلوب'
							}
						}
					},

					// 'name_en': {
					// 	validators: {
					// 		notEmpty: {
					// 			message: 'الاسم الانجليزي مطلوب'
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

						$.ajaxSetup({
				            headers: {
				                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
				            }
			        	});

			        	var formData = {
			        		department_id: jQuery('#department_id').val(),
			            	name_ar: jQuery('#name_ar').val(),
			            	name_en: jQuery('#name_en').val(),
			            	description_ar: jQuery('#description_ar').val(),
			            	description_en: jQuery('#description_en').val(),
			            	active: jQuery('#select_active').val(),
			        	};

			        	var type = "POST";
			        	var ajaxurl = '/admin/positions';

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
										text: "تم تقديم النموذج بنجاح! ",
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
			        	
						 						
					} else {
						Swal.fire({
							text: "معذرة ، يبدو أنه تم اكتشاف بعض الأخطاء ، يرجى المحاولة مرة أخرى. ",
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
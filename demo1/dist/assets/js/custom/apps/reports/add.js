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
                    'name_ar': {
						validators: {
							notEmpty: {
								message: 'Name AR is required'
							}
						}
					},

					'name_en': {
						validators: {
							notEmpty: {
								message: 'Name EN is required'
							}
						}
					},

					'code': {
						validators: {
							notEmpty: {
								message: 'Code is required'
							}
						}
					},

					'price': {
						validators: {
							notEmpty: {
								message: 'Price is required'
							}
						}
					},

					'unit': {
						validators: {
							notEmpty: {
								message: 'Unit is required'
							}
						}
					},

					'quantity': {
						validators: {
							notEmpty: {
								message: 'Quantity is required'
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
			            	name_ar: jQuery('#name_ar').val(),
			            	name_en: jQuery('#name_en').val(),
			            	code: jQuery('#code').val(),
			            	price: jQuery('#price').val(),
			            	unit: jQuery('#unit').val(),
			            	quantity: jQuery('#quantity').val(),
			            	select_active: jQuery('#select_active').val(),
			        	};

			        	var type = "POST";
			        	var ajaxurl = '/admin/products';

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

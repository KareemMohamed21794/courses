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
                    'leader_name': {
                        validators: {
                            notEmpty: {
                                message: 'هذا الحقل مطلوب'
                            }
                        }
                    },



                    'current_qualification': {
                        validators: {
                            notEmpty: {
                                message: 'هذا الحقل مطلوب'
                            }
                        }
                    }
                    
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
                        axios.post("/admin/qualification_leaders/"+update_id, new FormData(form))
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
    var ajaxurl = '/admin/qualification_leaders/'+id+'/edit';

    $.ajax({
        type: type,
        url: ajaxurl,
        dataType: 'json',
        success: function (data) {
            jQuery('#id').val(data.id);
            
            jQuery('#leader_name_update').val(data.leader_name);
            jQuery('#current_qualification_update').val(data.current_qualification);
            jQuery('#study_history_mqw_update').val(data.study_history_mqw);
            jQuery('#place_study_mqw_update').val(data.place_study_mqw);
            jQuery('#organizer_mqw_update').val(data.organizer_mqw);
            jQuery('#rent_date_mqw_update').val(data.rent_date_mqw);
            jQuery('#rent_number_mqw_update').val(data.rent_number_mqw);
            jQuery('#study_history_qw_update').val(data.study_history_qw);
            jQuery('#place_study_qw_update').val(data.place_study_qw);
            jQuery('#organizer_qw_update').val(data.organizer_qw);
            jQuery('#rent_date_qw_update').val(data.rent_date_qw);
            jQuery('#rent_number_qw_update').val(data.rent_number_qw);

            jQuery('#study_history_mqt_update').val(data.study_history_mqt);
            jQuery('#place_study_mqt_update').val(data.place_study_mqt);
            jQuery('#organizer_mqt_update').val(data.organizer_mqt);
            jQuery('#rent_date_mqt_update').val(data.rent_date_mqt);
            jQuery('#rent_number_mqt_update').val(data.rent_number_mqt);


            jQuery('#study_history_qt_update').val(data.study_history_qt);
            jQuery('#place_study_qt_update').val(data.place_study_qt);
            jQuery('#organizer_qt_update').val(data.organizer_qt);
            jQuery('#rent_date_qt_update').val(data.rent_date_qt);
            jQuery('#rent_number_qt_update').val(data.rent_number_qt);


            if(data.current_qualification == 'musaeid_qayid_wahdah'){

            $("#card_update1").show(300);
            $("#card_update2").hide(300);
            $("#card_update3").hide(300);
            $("#card_update4").hide(300);
           }else if(data.current_qualification == 'qayid_wahda'){

            $("#card_update1").show(300);
            $("#card_update2").show(300);
            $("#card_update3").hide(300);
            $("#card_update4").hide(300);

           }else if(data.current_qualification == 'musaeid_qayid_tadrib'){

            $("#card_update1").show(300);
            $("#card_update2").show(300);
            $("#card_update3").show(300);
            $("#card_update4").hide(300);

           }else if(data.current_qualification == 'qayid_tadrib'){


            $("#card_update1").show(300);
            $("#card_update2").show(300);
            $("#card_update3").show(300);
            $("#card_update4").show(300);

           }else{

            $("#card_update1").hide(300);
            $("#card_update2").hide(300);
            $("#card_update3").hide(300);
            $("#card_update4").hide(300);
           }
        

           

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




function CurrentQualificationUpdate(value) {
   $("#accordion_update").show(300);
   if(value == 'musaeid_qayid_wahdah'){
   

    $("#card_update1").show(300);
    $("#card_update2").hide(300);
    $("#card_update3").hide(300);
    $("#card_update4").hide(300);

    $("#study_history_qw_update").val(null);
    $("#place_study_qw_update").val(null);
    $("#organizer_qw_update").val(null);
    $("#rent_date_qw_update").val(null);
    $("#rent_number_qw_update").val(null);

    $("#study_history_mqt_update").val(null);
    $("#place_study_mqt_update").val(null);
    $("#organizer_mqt_update").val(null);
    $("#rent_date_mqt_update").val(null);
    $("#rent_number_mqt_update").val(null);

    $("#study_history_qt_update").val(null);
    $("#place_study_qt_update").val(null);
    $("#organizer_qt_update").val(null);
    $("#rent_date_qt_update").val(null);
    $("#rent_number_qt_update").val(null);

   }else if(value == 'qayid_wahda'){

    $("#card_update1").show(300);
    $("#card_update2").show(300);
    $("#card_update3").hide(300);
    $("#card_update4").hide(300);


    $("#study_history_mqt_update").val(null);
    $("#place_study_mqt_update").val(null);
    $("#organizer_mqt_update").val(null);
    $("#rent_date_mqt_update").val(null);
    $("#rent_number_mqt_update").val(null);

    $("#study_history_qt_update").val(null);
    $("#place_study_qt_update").val(null);
    $("#organizer_qt_update").val(null);
    $("#rent_date_qt_update").val(null);
    $("#rent_number_qt_update").val(null);


   }else if(value == 'musaeid_qayid_tadrib'){

    $("#card_update1").show(300);
    $("#card_update2").show(300);
    $("#card_update3").show(300);
    $("#card_update4").hide(300);

    $("#study_history_qt_update").val(null);
    $("#place_study_qt_update").val(null);
    $("#organizer_qt_update").val(null);
    $("#rent_date_qt_update").val(null);
    $("#rent_number_qt_update").val(null);

   }else if(value == 'qayid_tadrib'){

    $("#card_update1").show(300);
    $("#card_update2").show(300);
    $("#card_update3").show(300);
    $("#card_update4").show(300);

   }else{

    $("#card_update1").hide(300);
    $("#card_update2").hide(300);
    $("#card_update3").hide(300);
    $("#card_update4").hide(300);

    $("#study_history_mqw_update").val(null);
    $("#place_study_mqw_update").val(null);
    $("#organizer_mqw_update").val(null);
    $("#rent_date_mqw_update").val(null);
    $("#rent_number_mqw_update").val(null);

    $("#study_history_qw_update").val(null);
    $("#place_study_qw_update").val(null);
    $("#organizer_qw_update").val(null);
    $("#rent_date_qw_update").val(null);
    $("#rent_number_qw_update").val(null);

    $("#study_history_mqt_update").val(null);
    $("#place_study_mqt_update").val(null);
    $("#organizer_mqt_update").val(null);
    $("#rent_date_mqt_update").val(null);
    $("#rent_number_mqt_update").val(null);

    $("#study_history_qt_update").val(null);
    $("#place_study_qt_update").val(null);
    $("#organizer_qt_update").val(null);
    $("#rent_date_qt_update").val(null);
    $("#rent_number_qt_update").val(null);
   }
}




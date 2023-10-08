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
                text: "Sorry, looks like there are some errors detected, please try again.",
                icon: "error",
                buttonsStyling: false,
                confirmButtonText: "Ok, got it!",
                customClass: {
                    confirmButton: "btn btn-primary"
                }
            });
        }
    });
    //======= End Ajxa ========//
}


function getStaff(position_id) {
    //======= Start Ajxa ========//
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        }
    });

    var branch_id = $("#branch_id").val();
    var type = "GET";
    var ajaxurl = '/admin/staff/get_staff/'+position_id+"/"+branch_id;

    $.ajax({
        type: type,
        url: ajaxurl,
        dataType: 'json',
        success: function (data) {
            data = data.staff;
            $("#staff_id").empty();
            var $dropdown = $("#staff_id");
            $dropdown.append($("<option />").val('').text('Select Staff'));
            $.each( data, function( key, value ) {
                $dropdown.append($("<option />").val(value.id).text(value.display_name));
            });
        },
        error: function (data) {
            Swal.fire({
                text: "Sorry, looks like there are some errors detected, please try again.",
                icon: "error",
                buttonsStyling: false,
                confirmButtonText: "Ok, got it!",
                customClass: {
                    confirmButton: "btn btn-primary"
                }
            });
        }
    });
    //======= End Ajxa ========//
}
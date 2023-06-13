$(document).on('submit', '#addition', function (ev) {
    $('.error').html('');

    ev.preventDefault(); // Prevent browers default submit.
    var formData = new FormData(this);
    var error = false;

    if (error == false) {
        $.ajax({
            url: base_url + 'staff/roles/store',
            type: 'post',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            beforeSend: function () {
                $(".submitbtn").css('display', 'none');
                $(".spinner-border").css('display', 'block');
            },
            success: function (result) {
                if (result.code == 200) {
                    showsuccess(result.message);
                    reloadpage();
                } else if (result.code == 401) {
                    $.each(result.message, function (prefix, val) {
                        $("#" + prefix + "_error").html(val[0]);
                        showwarning(val[0]);
                    });
                } else {
                    showerror(result.message);
                }
            },
            error: function (xhr) {
                $(".submitbtn").css('display', 'grid');
                $(".spinner-border").css('display', 'none');
            },
            complete: function () {
                $(".submitbtn").css('display', 'grid');
                $(".spinner-border").css('display', 'none');
            },
        })
    }
})


function showeditmodulediv(id) {
    $.ajax({
        url: base_url + "staff/roles/edit",
        data: {
            id: id
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: 'POST',
        success: function (result) {
            $(".editstaffdiv").html(result);
        },
    })
}



$(document).on('submit', '#editing', function (ev) {
    $('.error').html('');

    ev.preventDefault(); // Prevent browers default submit.
    var formData = new FormData(this);
    var error = false;

    if (error == false) {
        $.ajax({
            url: base_url + 'staff/roles/update',
            type: 'post',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            beforeSend: function () {
                $(".submitbtn").css('display', 'none');
                $(".spinner-border").css('display', 'block');
            },
            success: function (result) {
                if (result.code == 200) {
                    showsuccess(result.message);
                    reloadpage();
                } else if (result.code == 401) {
                    $.each(result.message, function (prefix, val) {
                        $('#' + prefix + '_error2').text(val[0]);
                        showwarning(val[0]);
                    });
                } else {
                    showerror(result.message);
                }
            },
            error: function (xhr) {
                $(".submitbtn").css('display', 'grid');
                $(".spinner-border").css('display', 'none');
            },
            complete: function () {
                $(".submitbtn").css('display', 'grid');
                $(".spinner-border").css('display', 'none');
            },
        })
    }
})


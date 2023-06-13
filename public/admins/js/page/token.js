function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#blah').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

$("#player_image").change(function () {
    $("#uploadphoto").css('display', 'none');
    $("#blah").css('display', 'block');
    readURL(this);

});


function showoption(id) {
    if (id == 14) {
        $(".showcatoption").css('display', 'inline-table');
    } else {
        $(".showcatoption").css('display', 'none');
    }
}


let fruits = [];

$('#select_all').on('click', function () {
    if (this.checked) {
        $('.checkbox').each(function () {
            this.checked = true;
            fruits.push($(this).val());
        });

        $("#printbtn").css('display', 'block');
    } else {
        $('.checkbox').each(function () {
            this.checked = false;

            var index = fruits.indexOf($(this).val());
            if (index !== -1) {
                fruits.splice(index, 1);
            }
        });

        $("#printbtn").css('display', 'none');
    }
    
    var testdata = fruits.toString();
    sessionStorage.setItem('totalaccreds',testdata);
});

$('.checkbox').on('click', function () {
    if ($('.checkbox:checked').length == $('.checkbox').length) {
        $('#select_all').prop('checked', true);
    } else {
        $('#select_all').prop('checked', false);
    }

    if ($(this).is(':checked')) {
        fruits.push($(this).val());
        
        var testdata = fruits.toString();
        sessionStorage.setItem('totalaccreds',testdata);
    } else {
        var index = fruits.indexOf($(this).val());
        if (index !== -1) {
            fruits.splice(index, 1);
        }
        
        var testdata2 = fruits.toString();
        sessionStorage.setItem('totalaccreds',testdata2);
    }

    if ($('.checkbox:checked').length >= 1) {
        $("#printbtn").css('display', 'block');
    } else {
        $("#printbtn").css('display', 'none');
    }
});


function afterchecked(string) {
    $.ajax({
        url: base_url + 'token/store',
        type: 'post',
        data: {
            accreds: fruits,
            string: string
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (result) {
            showsuccess(result.message);
            window.open(base_url + 'token/showtokenprint/' + result.id, '_blank');
        },
    })
}


function afterchecked2(string) {
    $.ajax({
        url: base_url + 'token/generatehandover',
        type: 'post',
        data: {
            accreds: fruits,
            string: string
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (result) {
            showsuccess(result.message);
            // reloadpage();
        },
    })
}

var timer = 1500;
function updatedata(string) {
    clearTimeout(timer)
    timer = setTimeout(function () {
        $.ajax({
            url: base_url + 'token/searched',
            type: 'post',
            data: {
                string: string,
                fruits: fruits
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (result) {
                $("#showaccreddata").html(result)
            },
        })
    }, 200);
}



function showimportdiv() {
    var dis = $("#showdivpart").css('display');
    if (dis == 'none') {
        $("#showdivpart").css('display', 'block')
    } else {
        $("#showdivpart").css('display', 'none')
    }
}


function changedesignation(id) {
    $.ajax({
        url: base_url + "category/getdesignation",
        data: {
            id: id
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: 'POST',
        success: function (result) {
            $("#designation").html(result);
        }
    })


    if (id == '14') {
        $(".athletediv").css('display', 'block');
    } else {
        $(".athletediv").css('display', 'none');
    }
}



function showaddmodulediv(id) {
    $.ajax({
        url: base_url + "token/add",
        data: {
            id: id
        },
        type: 'GET',
        success: function (result) {
            $("#addstaffdiv").html(result);
        },
    })
}


function generatehandover() {
    $("#totalaccreds").val(sessionStorage.getItem('totalaccreds'));
}



$(document).on('submit', '#addition', function (ev) {
    $('.error').html('');

    ev.preventDefault(); // Prevent browers default submit.
    var formData = new FormData(this);
    var error = false;

    if (error == false) {
        $.ajax({
            url: base_url + 'token/store',
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



$(document).on('submit', '#handovertaken', function (ev) {
    $('.error').html('');

    ev.preventDefault(); // Prevent browers default submit.
    var formData = new FormData(this);
    var error = false;

    if (error == false) {
        $.ajax({
            url: base_url + 'token/handovertaken',
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
                    window.open(base_url + 'token/printhandover/' + result.id, '_blank');
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




$(document).on('submit', '#opentokenaccreds', function (ev) {
    $('.error').html('');

    ev.preventDefault(); // Prevent browers default submit.
    var formData = new FormData(this);
    var error = false;

    if (error == false) {
        $.ajax({
            url: base_url + 'token/opentokenaccreds',
            type: 'post',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function (result) {
                $("#showaccreddata").html(result)
            },
        })
    }
})



function showeditmodulediv(id) {
    $.ajax({
        url: base_url + "token/edit",
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
            url: base_url + 'token/update',
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


$(document).on('submit', '#handover', function (ev) {
    $('.error').html('');

    ev.preventDefault(); // Prevent browers default submit.
    var formData = new FormData(this);
    var error = false;

    if (error == false) {
        $.ajax({
            url: base_url + 'token/handovertaken',
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



function showdropdown(selected) {

    $("#showdiv1").html('');
    $("#showdiv2").html('');

    $.ajax({
        url: base_url + "token/selectedsearch",
        data: {
            selected: selected
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: 'POST',
        success: function (result) {
            $("#showdiv1").html(result);
        },
    })
}





$(document).on('submit', '#importexcel', function (ev) {
    $('.error').html('');

    ev.preventDefault(); // Prevent browers default submit.
    var formData = new FormData(this);
    var error = false;

    if (error == false) {
        $.ajax({
            url: base_url + 'token/importexcel',
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

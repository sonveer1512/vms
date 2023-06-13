
var RELOAD_TIME = 1000;
var base_url = window.location.origin + "/";

// page reload
function reloadpage() {
    setTimeout(function () {
        window.location.reload()
    }, RELOAD_TIME)
}


// add * to required fields 
$('form').find('input').each(function () {
    if ($(this).prop('required')) {
        var clas = $(this).attr('name');
        $('label[for="' + clas + '"]').append($("<span>", { "class": "required-indicator" }).text("*"));
    }
});


// show message on dashboard
var myDate = new Date();
var hrs = myDate.getHours();
var greet;

if (hrs < 12)
    greet = 'Good Morning';
else if (hrs >= 12 && hrs < 17)
    greet = 'Good Afternoon';
else if (hrs >= 17 && hrs < 24)
    greet = 'Good Evening';

$("#greetings").html(greet);



// redirect to 
function redirecttopage(page) {
    window.location.href = base_url + page;
}


// error remove while typing 
$(document).on('keypress', function (e) {
    var name = $(e.target).attr('name')
    $("#" + name + "_error").html('');
});


// no image found 
$('body').find('img').each(function () {
    var clas = $(this).attr('src');
    if (clas == "null") {
        $(this).attr("src", base_url + 'admin/img/noimage.jpg');
    }
});



function showsuccess(msg) {
    toastr.options =
    {
        "closeButton": true,
        "progressBar": true
    }
    toastr.success(msg);
}

function showerror(msg) {
    toastr.options =
    {
        "closeButton": true,
        "progressBar": true
    }
    toastr.error(msg);
}

function showwarning(msg) {
    toastr.options =
    {
        "closeButton": true,
        "progressBar": true
    }
    toastr.warning(msg);
}


function restrictnumber(e) {
    var x = e.which || e.keycode;
    if ((x >= 48 && x <= 57))
        return true;
    else
        return false;
}



$(document).on('change', '.file-input', function () {
    var filesCount = $(this)[0].files.length;
    var textbox = $(this).prev();

    if (filesCount === 1) {
        var fileName = $(this).val().split('\\').pop();
        textbox.text(fileName);
    } else {
        textbox.text(filesCount + ' files selected');
    }
});



// lazy loading images
function lazyLoadImages() {
    var images = document.querySelectorAll('img[data-src]');

    for (var i = 0; i < images.length; i++) {
        var image = images[i];
        var rect = image.getBoundingClientRect();

        // Check if the image is in the viewport
        if (rect.top >= 0 && rect.top <= window.innerHeight) {
            // Load the image
            image.src = image.getAttribute('data-src');
            image.removeAttribute('data-src');
        }
    }
}

window.addEventListener('scroll', lazyLoadImages);
lazyLoadImages();
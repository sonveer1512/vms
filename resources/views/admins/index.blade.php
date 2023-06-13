<!DOCTYPE html>
<html lang="en-US" dir="ltr">
<meta http-equiv="content-type" content="text/html;charset=utf-8" />

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Visit Management System</title>
    <link rel="icon" href="{{ asset('admins/img/dark-logo.png') }}" type="image/x-icon">
    <script src="{{ asset('admins/js/config.js') }}"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin="">
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600;700;800;900&amp;display=swap" rel="stylesheet">
    <link href="{{ asset('admins/vendors/simplebar/simplebar.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admins/css/theme.min.css') }}" type="text/css" rel="stylesheet" id="style-default">
    <link href="{{ asset('admins/css/user.min.css') }}" type="text/css" rel="stylesheet" id="user-style-default">

    <script src="{{ asset('admins/vendors/imagesloaded/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ asset('admins/vendors/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('admins/js/jquery-3.1.1.min.js') }}"></script>
</head>

<body>


    <main class="main" id="top">
        <div class="container-fluid px-0" data-layout="container">
            <div class="container-fluid">
                <div class="bg-holder bg-auth-card-overlay" style="background-image:url('{{ asset('admins/img/bg/30.png') }}');"></div>
                <!--/.bg-holder-->
                <div class="row flex-center position-relative min-vh-100 g-0 py-5">
                    <div class="col-11 col-sm-10 col-xl-8">
                        <div class="card border border-300 auth-card">
                            <div class="card-body pe-md-0">
                                <div class="row align-items-center gx-0 gy-7">
                                    <div class="col-auto bg-100 dark__bg-1100 rounded-3 position-relative overflow-hidden auth-title-box">
                                        <!--/.bg-holder-->
                                        <div class="position-relative px-4 px-lg-7 pt-7 pb-7 pb-sm-5 text-center text-md-start pb-lg-7 pb-md-7">
                                            <h3 class="mb-3 text-black fs-1">Visit Management System</h3>
                                        </div>
                                        <div class="position-relative z-index--1 mb-6 d-none d-md-block text-center mt-md-15">
                                            <img class="auth-title-box-img d-dark-none" src="{{ asset('admins/img/loginimg.png') }}" style="width: 100%;" />
                                        </div>
                                    </div>
                                    <div class="col mx-auto">
                                        <div class="auth-form-box">
                                            <div class="text-center mb-7"><a class="d-flex flex-center text-decoration-none mb-4" href="{{ url('/') }}">
                                                    <div class="d-flex align-items-center fw-bolder fs-1 d-inline-block">Visit Management System</div>
                                                </a>
                                                <h3 class="text-1000">Sign In</h3>
                                            </div>
                                            <form method="post" id="login">
                                                @csrf()
                                                <div class="mb-3 text-start"><label class="form-label" for="email">Email address</label>
                                                    <div class="form-icon-container">
                                                        <input class="form-control form-icon-input" name="email" id="email" type="email" placeholder="name@example.com" />
                                                        <span class="fas fa-user text-900 fs--1 form-icon"></span>
                                                    </div>
                                                </div>
                                                <div class="mb-3 text-start"><label class="form-label" for="password">Password</label>
                                                    <div class="form-icon-container">
                                                        <input class="form-control form-icon-input" id="password" name="password" type="password" placeholder="Password" />
                                                        <span class="fas fa-key text-900 fs--1 form-icon"></span>
                                                    </div>
                                                </div>
                                                <button class="btn btn-primary w-100 mb-3">Sign In</button>
                                                <span class="error text-danger" id="err_resp"></span>
                                                <span class="error text-success" id="succ_resp"></span>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="{{ asset('admins/vendors/popper/popper.min.js') }} "></script>
    <script src="{{ asset('admins/vendors/bootstrap/bootstrap.min.js') }} "></script>
    <script src="{{ asset('admins/vendors/anchorjs/anchor.min.js') }} "></script>
    <script src="{{ asset('admins/vendors/is/is.min.js') }} "></script>
    <script src="{{ asset('admins/vendors/fontawesome/all.min.js') }} "></script>
    <script src="{{ asset('admins/vendors/lodash/lodash.min.js') }} "></script>
    <script src="{{ asset('admins/vendors/list.js/list.min.js') }} "></script>
    <script src="{{ asset('admins/vendors/feather-icons/feather.min.js') }} "></script>
    <script src="{{ asset('admins/vendors/dayjs/dayjs.min.js') }} "></script>
    <script src="{{ asset('admins/js/deepali.js') }} "></script>
    <script src="{{ asset('admins/js/main.js') }}"></script>

    <script>
        $(document).on('submit', '#login', function(ev) {
            $('.error').html('');

            ev.preventDefault(); // Prevent browers default submit.
            var formData = new FormData(this);
            var error = false;

            if (error == false) {
                $.ajax({
                    url: "{{ url('admin/login') }} ",
                    type: 'post',
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    beforeSend: function() {
                        $(".submitbtn").css('display', 'none');
                    },
                    success: function(result) {
                        if (result.code == 200) {
                            $("#succ_resp").text(result.message)
                            window.location.href = "{{ url('admin/dashboard') }}";
                        } else if (result.code == 401) {
                            $.each(result.message, function(prefix, val) {
                                $('#' + prefix + '_error').text(val[0]);
                            });
                        } else {
                            $("#err_resp").text(result.message)
                        }
                    },
                    error: function(xhr) {
                        $(".submitbtn").css('display', 'block');
                    },
                    complete: function() {
                        $(".submitbtn").css('display', 'block');
                    },
                })
            }
        })
    </script>



</body>

</html>
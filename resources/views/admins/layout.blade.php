<!DOCTYPE html>
<html lang="en-US" dir="ltr">
<meta http-equiv="content-type" content="text/html;charset=utf-8" />

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Visit Management System</title>
    <link rel="icon" href="" type="image/x-icon">
    <meta name="theme-color" content="#ffffff">
    <script src="{{ asset('admins/vendors/imagesloaded/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ asset('admins/vendors/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('admins//js/config.js') }}"></script>
    <link href="{{ asset('admins/vendors/choices/choices.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admins/vendors/flatpickr/flatpickr.min.css') }}" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin="">
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600;700;800;900&amp;display=swap" rel="stylesheet">
    <link href="{{ asset('admins/vendors/simplebar/simplebar.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('admins/css/unicons.css') }}">
    <link href="{{ asset('admins//css/theme2.min.css') }}" type="text/css" rel="stylesheet" id="style-default">
    <link href="{{ asset('admins//css/user.min.css') }}" type="text/css" rel="stylesheet" id="user-style-default">
    <script src="{{ asset('admins/js/jquery-3.1.1.min.js') }}"></script>
    <script src="{{ asset('admins/js/table2excel.js') }}"></script>

    <link rel="stylesheet" type="text/css" href="{{ asset('admins/vendors/toastr/toastr.min.css') }}">
    <script src="{{ asset('admins/vendors/toastr/toastr.min.js') }}"></script>

    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
    <!-- ===============================================-->
    <!--    Main Content-->
    <!-- ===============================================-->
    <main class="main" id="top">
        <div class="container-fluid px-0" data-layout="container">
            <nav class="navbar navbar-vertical navbar-expand-lg" style="display:none;">
                <script>
                    var navbarStyle = localStorage.getItem("phoenixNavbarStyle");
                    if (navbarStyle && navbarStyle !== 'transparent') {
                        document.querySelector('body').classList.add(`navbar-${navbarStyle}`);
                    }
                </script>
                <div class="collapse navbar-collapse" id="navbarVerticalCollapse">
                    <!-- scrollbar removed-->
                    <div class="navbar-vertical-content">
                        <ul class="navbar-nav flex-column" id="navbarVerticalNav">
                            <li class="nav-item">
                                <span class="nav-item-wrapper">
                                    <a class="nav-link label-1 active" href="{{ url('admin/dashboard') }}">
                                        <div class="d-flex align-items-center"><span class="nav-link-icon"><span data-feather="compass"></span></span>
                                            <span class="nav-link-text-wrapper"><span class="nav-link-text">Dashboard</span></span>
                                        </div>
                                    </a>
                                </span>
                                <div class="nav-item-wrapper"><a class="nav-link dropdown-indicator label-1" href="#accred-management" role="button" data-bs-toggle="collapse" aria-expanded="false" aria-controls="accred-management">
                                        <div class="d-flex align-items-center">
                                            <div class="dropdown-indicator-icon"><span class="fas fa-caret-right"></span></div><span class="nav-link-icon"><span data-feather="users"></span></span><span class="nav-link-text">Registerd Data</span>
                                        </div>
                                    </a>
                                    <div class="parent-wrapper label-1">
                                        <ul class="nav collapse parent" data-b s-parent="#navbarVerticalCollapse" id="accred-management">


                                            <li class="nav-item">
                                                <a class="nav-link" href="{{ url('admin/user_list') }}" data-bs-toggle="" aria-expanded="false">
                                                    <div class="d-flex align-items-center"><span class="nav-link-text">All Data</span></div>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                        </ul>
                    </div>
                </div>
                <div class="navbar-vertical-footer"><button class="btn navbar-vertical-toggle border-0 fw-semi-bold w-100 text-start white-space-nowrap"><span class="uil uil-left-arrow-to-left fs-0"></span><span class="uil uil-arrow-from-right fs-0"></span><span class="navbar-vertical-footer-text ms-2">Collapsed View</span></button></div>
            </nav>
            <nav class="navbar navbar-top navbar-expand" id="navbarDefault" style="display:none;">
                <div class="collapse navbar-collapse justify-content-between">
                    <div class="navbar-logo">
                        <button class="btn navbar-toggler navbar-toggler-humburger-icon hover-bg-transparent" type="button" data-bs-toggle="collapse" data-bs-target="#navbarVerticalCollapse" aria-controls="navbarVerticalCollapse" aria-expanded="false" aria-label="Toggle Navigation"><span class="navbar-toggle-icon"><span class="toggle-line"></span></span></button>
                        <a class="navbar-brand me-1 me-sm-3" href="{{ url('/') }}">
                            <div class="d-flex align-items-center">
                                <div class="d-flex align-items-center">
                                    <h6>Visit Management System</h6>
                                    <!-- <img src="{{ asset('admin/img/dark-logo.png') }}" alt="Deepali" width="100" /> -->
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="search-box d-none d-lg-block" data-list='{"valueNames":["title"]}' style="width:25rem;">
                        <form class="position-relative" data-bs-toggle="search" data-bs-display="static" method="post" action="{{ url('mail/search') }}">
                            @csrf()
                            <input class="form-control form-control-sm rounded-pill search-input fuzzy-search" autocomplete="false" type="search" id="allsearch" name="search" required placeholder="Search..." aria-label="Search" />
                            <span class="fas fa-search search-box-icon"></span>
                        </form>
                    </div>
                    <ul class="navbar-nav navbar-nav-icons flex-row">
                        <li class="nav-item dropdown">
                            <a class="nav-link lh-1 pe-0" id="navbarDropdownUser" href="#!" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <div class="avatar avatar-l">
                                    <img class="rounded-circle" src="{{ asset('admins/img/team/57.png') }}" alt="" />
                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end navbar-dropdown-caret py-0 dropdown-profile shadow border border-300" aria-labelledby="navbarDropdownUser">
                                <div class="card position-relative border-0">
                                    <div class="card-body p-0">
                                        <div class="text-center pt-4 pb-3">
                                            <div class="avatar avatar-xl">
                                                <img class="rounded-circle" src="{{ asset('admins/img/team/57.png') }}" alt="" />
                                            </div>
                                            <h6 class="mt-2 text-black">Admin</h6>
                                        </div>
                                    </div>
                                    <!-- <div class="overflow-auto scrollbar">
                                        <ul class="nav d-flex flex-column mb-2 pb-1">
                                            <li class="nav-item">
                                                <a class="nav-link px-3" href="#!"> <span class="me-2 text-900" data-feather="user"></span>Profile</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link px-3" href="#!"> <span class="me-2 text-900" data-feather="settings"></span>Settings &amp; Privacy </a>
                                            </li>
                                        </ul>
                                    </div> -->
                                    <div class="card-footer p-0 border-top">
                                        <div class="px-3 my-2 ">
                                            <a class="btn btn-phoenix-secondary d-flex flex-center w-100" href="{{ url('admin/logout') }}"> <span class="me-2" data-feather="log-out"> </span>Sign out</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
            <nav class="navbar navbar-top navbar-slim navbar-expand" id="navbarSlim" style="display:none;"></nav>
            <nav class="navbar navbar-top navbar-expand-lg" id="navbarTopNew" style="display:none;"></nav>
            <nav class="navbar navbar-top navbar-slim justify-content-between navbar-expand-lg" id="navbarTopSlimNew" style="display:none;"></nav>


            @section('content')
            @show()

        </div>
        </div>
    </main>


    <link href="https://cdnjs.cloudflare.com/ajax/libs/typeahead.js-bootstrap-css/1.2.1/typeaheadjs.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>
    <script>
        var navbarTopShape = localStorage.getItem('phoenixNavbarTopShape');
        var navbarPosition = localStorage.getItem('phoenixNavbarPosition');
        var body = document.querySelector('body');
        var navbarDefault = document.querySelector('#navbarDefault');
        var navbarTopNew = document.querySelector('#navbarTopNew');
        var navbarSlim = document.querySelector('#navbarSlim');
        var navbarTopSlimNew = document.querySelector('#navbarTopSlimNew');

        var documentElement = document.documentElement;
        var navbarVertical = document.querySelector('.navbar-vertical');

        if (navbarTopShape === 'slim' && navbarPosition === 'vertical') {
            navbarDefault.remove();
            navbarTopNew.remove();
            navbarTopSlimNew.remove();
            navbarSlim.style.display = 'block';
            navbarVertical.style.display = 'inline-block';
            body.classList.add('nav-slim');
        } else if (navbarTopShape === 'slim' && navbarPosition === 'horizontal') {
            navbarDefault.remove();
            navbarVertical.remove();
            navbarTopNew.remove();
            navbarSlim.remove();
            navbarTopSlimNew.removeAttribute('style');
            body.classList.add('nav-slim');
        } else if (navbarTopShape === 'default' && navbarPosition === 'horizontal') {
            navbarDefault.remove();
            navbarSlim.remove();
            navbarVertical.remove();
            navbarTopSlimNew.remove();
            navbarTopNew.removeAttribute('style');
            documentElement.classList.add('navbar-horizontal')

        } else {
            body.classList.remove('nav-slim');
            navbarSlim.remove();
            navbarTopNew.remove();
            navbarTopSlimNew.remove();
            navbarDefault.removeAttribute('style');
            navbarVertical.removeAttribute('style');
        }

        var navbarTopStyle = 'darker';
        var navbarTop = document.querySelector('.navbar-top');
        if (navbarTopStyle === 'darker') {
            navbarTop.classList.add('navbar-darker');
        }

        var navbarVerticalStyle = 'darker';
        var navbarVertical = document.querySelector('.navbar-vertical');
        if (navbarVerticalStyle === 'darker') {
            navbarVertical.classList.add('navbar-darker');
        }


        var route2 = "{{ url('/accredsearch') }}";
        $('#allsearch').typeahead({
            source: function(query, process) {
                return $.get(route2, {
                    query: query
                }, function(data) {
                    return process(data);
                });
            }
        });

        
    </script>


    <!-- ===============================================-->
    <!--    JavaScripts-->
    <!-- ===============================================-->
    <script src="{{ asset('admins/vendors/popper/popper.min.js') }}"></script>
    <script src="{{ asset('admins/vendors/bootstrap/bootstrap.min.js') }}"></script>
    <script src="{{ asset('admins/vendors/anchorjs/anchor.min.js') }}"></script>
    <script src="{{ asset('admins/vendors/is/is.min.js') }}"></script>
    <script src="{{ asset('admins/vendors/fontawesome/all.min.js') }}"></script>
    <script src="{{ asset('admins/vendors/lodash/lodash.min.js') }}"></script>
    <script src="{{ asset('admins/vendors/list.js/list.min.js') }}"></script>
    <script src="{{ asset('admins/vendors/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('admins/vendors/dayjs/dayjs.min.js') }}"></script>
    <script src="{{ asset('admins/js/deepali.js') }}"></script>
    <script src="{{ asset('admins/js/main.js') }}"></script>
    <script src="{{ asset('admins/vendors/choices/choices.min.js') }}"></script>
</body>

</html>
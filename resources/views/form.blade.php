<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>VISITOR MANAGEMENT SYSTEM</title>

    <!-- bootstrap css -->
    <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.min.css')}}">

    <!-- Font awesome 6 -->
    <link rel="stylesheet" type="text/css" href="{{asset('css/all.css')}}">

    <!-- custom styles -->
    <link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/responsive.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/animation.css')}}">
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

    <script src="{{asset('js/custom.js')}}"></script>
    <script src="{{asset('js/webcam.min.js')}}"></script>
</head>
<style>
    .btnOtp {
        background-color: #28B6B7;
        border: 1px solid #28B6B7;
        border-radius: 2px;
        color: #ffffff;
        display: inline-block;
        margin: 5px;
        padding: 7px 10px;
        width: 100%;
    }

    .btn.focus,
    .btn:focus,
    .btn:hover {
        color: #fff;
        text-decoration: none;
    }

    .btnOtpQ {
        background-color: #3d7edb;
        border: 1px solid #3d7edb;
        border-radius: 3px;
        color: #ffffff;
        display: inline-block;
        margin: 5px;
        padding: 7px 10px;
        transition: all 0.5s ease 0s;
        width: 100%;
    }

    .btnOtpQ:hover {
        opacity: 0.9
    }

    .form-group label {
        color: #333;
    }

    .btn-new-back a {
        border-radius: 3px;
        color: #ffffff;
        display: block;
        float: right;
        font-size: 18px;
        margin-top: 2px;
        padding: 4px 23px;
        text-align: center;
        text-decoration: none;
    }

    .btn-new-back a img {
        width: 25px;
    }

    .btn-new-back a:hover {
        opacity: 0.9;
    }

    .imp {
        display: block;
        overflow: hidden;
        padding: 0 30px;
        position: relative;
        margin-bottom: 10px;
    }

    .sel {
        color: red;
        text-align: center;
    }

    .frame-image-on-click img {
        margin-top: 27px;
        width: 100%;
        box-shadow: 0px 2px 6px -1px #000;
    }

    .textcolor {
        color: #ffffff;
    }

    #img-results h2 {
        font-size: 18px;
        text-align: center;
        color: #fff;
        background: #451d04;
        margin: 0 auto -27px auto;
        padding: 10px 10px;
        border-radius: 10px 10px 0px 0px;
    }

    #img-results {
        margin-top: 30px;
    }

    .textcolor {
        color: white;
    }

    .left-1 {
        display: block;
        float: left;
        margin: 6px 5px 0px 0px;
        overflow: hidden;
        width: 100px;
    }

    .left-1 input {
        display: inline-block;
        float: left;
        width: 30px;
    }

    .left-1 span {
        float: left;
    }

    #suggesstion21 {
        background: #ffffff none repeat scroll 0 0;
        color: #000000;
        margin-top: 2px;
        padding: 0 10px;
        width: 100%;
    }

    #suggesstion12 {
        background: #ffffff none repeat scroll 0 0;
        color: #000000;
        margin-top: 2px;
        padding: 0 10px;
        width: 100%;
    }

    .video-button {
        background: #67615e;
        border: 1px solid #ffffff;
        border-radius: 3px;
        color: #ffffff;
        display: table;
        font-size: 13px;
        margin: 13px 0;
        padding: 7px 20px;
        transition: all 1s ease 0s;
    }

    .video-button:hover {
        background-color: #fff;
        border: 1px solid #67615e;
        color: #333;
    }

    .video-button:focus,
    .video-button:activ {
        background-color: #fff;
        border: 1px solid #67615e;
        color: #333;
    }

    .sel {
        color: red;
        text-align: center;
    }

    .flex-body {
        display: flex;
        width: 100%;
        justify-content: center;
        overflow: hidden;
    }

    .flex-body-left {
        width: 45%;
        margin: 10px;
    }

    .flex-body-left video {
        width: 100%;
        height: 250px;
    }

    .flex-body-right {
        width: 260px;
        overflow: hidden;
        height: 196px;
        margin-left: 6px;
        margin-top: 26px;
    }

    #canvas {
        display: inline-block;
        width: auto;
        height: 250px;
    }

    @media (max-width:678px) {
        .flex-body {
            display: block;
            width: 100%;
        }

        .flex-body-left {
            width: 100%;
        }

        .flex-body-left video {
            width: 100%;
            height: 250px;
        }

        .flex-body-right {
            width: 100%;
            margin: 10px;
        }

        #canvas {
            /*margin-top: 20px; margin-left: 100px; border: 1px solid #ccc;*/
            display: block;
            width: 100%;
            height: 250px;
        }
    }

    /*modal css */


    .terms-conditions {
        padding: 0 50px 0 20px;
        display: block;
    }

    .terms-conditions input {
        width: 12px;
        margin-right: 8px;
        display: inline-block;
        float: left;
    }

    .terms-conditions a {
        display: inline-block;
        float: left;
        font-size: 13px;
        color: #333;
    }

    .terms-conditions a:hover {
        cursor: pointer;
        text-decoration: none;
    }

    .visitor-instructions {}

    .visitor-instructions h4 {
        color: #fff;
        text-align: center;
    }

    .visitor-instructions .modal-dialog {
        margin: 66px auto;
        width: 60%;
    }

    .visitor-instructions ul li {
        list-style-type: disc;
        font-size: 14px;
        line-height: 25px;
    }

    .visitor-instructions ul {
        margin: 0;
    }

    .visitor-instructions .checkbox-area {
        padding-left: 40px;
    }

    .visitor-instructions .checkbox-area h4 {
        color: red;
    }

    .visitor-instructions .checkbox-area input {
        width: 12px;
        display: inline-block;
        float: left;
        margin-right: 8px;
    }

    .visitor-instructions .checkbox-area input[type=checkbox] {
        border-radius: none !important;
    }

    input[type=checkbox],
    input[type=radio] {

        margin-top: 1px\9;
        line-height: normal;
        -webkit-appearance: checkbox;
        height: 12px;
    }

    .button-block-b {
        display: inline-block;
        margin: 40px 0 10px;
        text-transform: none;
    }

    .dontagree {
        text-transform: none;
        background: #ff0000;
        border: 1px solid #ff0000;
        border-radius: 3px;
        color: #ffffff;
        display: inline-block;
        font-size: 14px;
        font-weight: 300;
        letter-spacing: 1px;
        margin: 8px 8px 10px;
        overflow: hidden;
        padding: 10px 20px;
        transition: all 1s ease 0s;
    }

    .footer {
        margin: 0 auto;
        text-align: center;
    }

    .visitor-instructions .agree {
        font-weight: 700;
    }

    .society-name {
        background: #0f69ae;
        color: #fff;
        height: 65px;
        margin-top: -21px;
    }



    h2 {
        font-size: 30px;
        text-align: center;
        margin-top: 20px;
        padding-top: 16px;
        font-weight: 600;
    }

    .section {
        padding: 10px;
        box-shadow: 0 2px 3px #ccc;
    }

    h1 {
        color: #333;
        line-height: 18px;
        font-weight: 600;
    }

    @media only screen and (max-device-width : 768px) and (max-device-width : 1024px) {
        h1 {
            font-size: 17px;
            font-weight: 600;
        }
    }

    p {
        font-weight: 600;
        text-align: -webkit-center;
    }

    .section {
        padding: 0;
        box-shadow: 0 2px 3px #ccc;
    }

    @media only screen and (max-device-width : 768px) and (max-device-width : 1024px) {
        h4 {
            font-size: 15px;
            font-weight: 600;
        }
    }

    @media (max-width:678px) {
        .flex-body {
            display: block;
            width: 100%;
            justify-content: center;
            overflow: hidden;
        }
    }

    .img-responsive {
        display: block;
        max-width: 100%;
        height: 315px;
        width: 100%;
    }

    [type=file] {
        display: none;
    }

    #info {
        display: none;
        margin: 5% auto;
        padding: 10px 20px;
        width: 400px;
        height: auto;
        overflow: hidden;
        background: #FFFFFF;
        border-radius: 3px;

    }
    .sel{
        color: red;
    }
</style>

<body>

    <section class="registration-form">
        <div class="row">

            <!-- sidebar -->
            <div id="sidbar" class="col-md-4 sidebar">
                <div class="sidebar-inner">
                    <div class="container">
                        <div class="wrapper">

                            <!-- sidebar-content -->
                            <div class="sidebar-content">
                                <div class="sidebar-text">
                                    <h2>
                                        Visitor Management System
                                    </h2>
                                    <p>
                                        Before proceeding you must confirm that you have read
                                        and agree to the terms od the Electronic Signature Act
                                        Disclose available at the link below.
                                    </p>
                                </div>

                                <!-- contact-info -->
                                <div class="contact-info">
                                    <div class="contact-info-inner">
                                        <div class="contact-icon">
                                            <i class="fa-solid fa-phone-volume fa-rotate-by"></i>
                                        </div>
                                        <div class="contact-details">
                                            <p>Give us a call</p>
                                            <h6>+91 8800023217</h6>
                                        </div>
                                    </div>
                                    <div class="contact-info-inner">
                                        <div class="contact-icon">
                                            <i class="fa-solid fa-envelope"></i>
                                        </div>
                                        <div class="contact-details">
                                            <p>Contact via email</p>
                                            <h6> shashank.iiieye@gmail.com</h6>
                                        </div>
                                    </div>

                                    <!-- sidebar button -->
                                    {{-- <button>Back Home</button> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- registration form -->
            <div id="reg-form" class="col-md-8 pop registration-form-inner">
                <div class="registration-inner">
                    <div class="container">
                        <div class="wrapper">

                            <!-- registration form -->
                            <form id="add_visitors" class="form-inner" method="POST" enctype="multipart/form-data" autocomplete="off">
                            @csrf()

                                <!-- form 1st part -->
                                <div class="end_border animation-delay-25ms">
                                    <h3>Your Basic Information</h3>
                                    <div class="row">
                                        <div class="tab-100 col-md-6">
                                            <div class="focus">
                                                <label for="name" class="name">Name<span class="sel">* </span></label>
                                                <div class="input-field">
                                                    <input type="text" name="name" id="name" placeholder="Annette">
                                                    <!-- <span id="name_error" class="error"></span> -->
                                                    <span></span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="tab-100 col-md-6">
                                            <div class="focus">
                                                <label for="email" class="email">Email<span class="sel">* </span></label>
                                                <div class="input-field">
                                                    <input type="email" name="email" id="email" placeholder="axepert@example.com">
                                                    <span id="email_error" class="error"></span>
                                                    <span></span>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-100 col-md-6">
                                            <div class="focus">
                                                <label for="contact" class="contact">Phone Number<span class="sel">* </span></label>
                                                <div class="input-field">
                                                    <input type="number" id="contact" name="contact" placeholder="(+91) 9999999999">
                                                    <span id="contact_error" class="error"></span>
                                                    <span></span>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-100 col-md-6">
                                            <div class="focus">
                                                <label for="uploaded_image">Image</label>
                                                <div class="input-field">
                                                    <input type="file" id="uploaded_image" name="uploaded_image">
                                                    <span></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-100 col-md-6">
                                            <div class="focus">
                                                <label for="country_id" class="country_id">Country<span class="sel">* </span></label>
                                                <div class="input-field">
                                                    <select name="country_id" id="country_id" onchange="get_state(this.value,'country');">
                                                        <option value="" selected>Select Country</option>
                                                        @php $country = App\Models\CountryModel::all(); @endphp
                                                        @foreach($country as $val)
                                                        <option value="{{ $val->id}}">{{ $val->name}}</option>
                                                        @endforeach
                                                    </select>
                                                    <span id="country_id_error" class="error"></span>
                                                    <span></span>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-100 col-md-6">
                                            <div class="focus">
                                                <label for="state"> State</label>
                                                <div class="input-field">
                                                    <select name="state" id="state" class="country" onchange="get_city(this.value,'state')">
                                                    </select>
                                                    <span></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-100 col-md-6">
                                            <div class="focus">
                                                <label for="city"> City</label>
                                                <div class="input-field">
                                                    <select name="city" id="city" class="state">
                                                    </select>
                                                    <span></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- form 2nd part -->
                                <div class="end_border animation-delay-50ms">
                                    <h3>Business details::</h3>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="focus">
                                                <label for="company_nature">What is the nature of your company business?</label>
                                                <div class="input-field">
                                                    <input type="text" id="company_nature" name="company_nature" placeholder="Enter nature of your company business">
                                                    <span></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-100 col-md-12">
                                            <div class="focus">
                                                <label for="area_intrest">What are the main areas of your interest?</label>
                                                <div class="input-field">
                                                    <input type="text" id="area_intrest" name="area_intrest" placeholder="Enter areas of your interest">
                                                    <span></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-50 col-md-12">
                                            <div class="focus">
                                                <label for="">How did you learn about the event?</label>
                                                <div class="row mt-3 mb-3">

                                                    <div class="col-md-12" style="margin-left: 28px;">
                                                        <input type="checkbox" name="event_source[]" value="Recommended by colleague/friend" style="margin-left:-20px;">&nbsp;&nbsp;Recommended by colleague/friend
                                                        <label class="" for="vehicle5"></label>
                                                    </div>
                                                    <div class="col-md-12" style="margin-left: 28px;">
                                                        <input type="checkbox" name="event_source[]" value="Google Search" style="margin-left:-20px;">&nbsp;&nbsp;Google Search
                                                        <label for="vehicle5"></label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-50 col-md-12 ">
                                            <div class="focus">
                                                <label for="">Vaccination Done</label>

                                                <div class="row mt-3 mb-3">
                                                    <div class="col-md-2" style="margin-left: 28px;">
                                                        <input type="radio" name="vaccination" value="1" style="margin-left:-20px;width: 25%;">Yes
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <input type="radio" name="vaccination" value="0" style="margin-left:-20px;width: 25%;">No
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- form 3rd part -->
                                    <div class="end_border animation-delay-75ms">
                                        <h3>Click Your Picture</h3>
                                        <div class="row">
                                            <div class="row">
                                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

                                                    <div class="form-group">
                                                        <div class="flex-body">
                                                            <div class="flex-body-left">
                                                                <div id="my_camera"></div>

                                                                <div style="clear:both; padding:20px;"></div>
                                                                <button value="Take Snapshot" class="video-button" onClick="take_snapshot()"> <i class="fa fa-picture-o" aria-hidden="true"></i> Capture Photo</button>

                                                                <input type="hidden" name="image" class="image-tag">
                                                                <div style="clear:both; padding:10px;"></div>

                                                            </div>

                                                            <div class="flex-body-right">
                                                                <div id="results_img"></div>
                                                            </div>

                                                        </div>
                                                    </div>

                                                    <!-- Configure a few settings and attach camera -->
                                                    <script language="JavaScript">
                                                        Webcam.set({
                                                            width: 260,
                                                            height: 233,
                                                            image_format: 'jpeg',
                                                            jpeg_quality: 260
                                                        });

                                                        Webcam.attach('#my_camera');

                                                        function take_snapshot() {
                                                            Webcam.snap(function(data_uri) {
                                                                $(".image-tag").val(data_uri);
                                                                document.getElementById('results_img').innerHTML = '<img src="' +
                                                                    data_uri +
                                                                    '"/>';

                                                                var sid = document.getElementById("s_id").value;
                                                                var visitor_mobile = document.getElementById("mobile").value;
                                                                $.ajax({
                                                                    url: 'image_upload.php',
                                                                    type: 'POST',
                                                                    data: {
                                                                        'data_uri': data_uri,
                                                                        'sid': sid,
                                                                        'visitor_mobile': visitor_mobile
                                                                    },
                                                                    success: function(response) {
                                                                        $("#vis_img").val(response);
                                                                    }
                                                                });

                                                            });
                                                        }
                                                    </script>

                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <!-- registration button/terms notification -->
                                    <div class="row register-field justify-content-between">
                                        <label>
                                            <span class="label-input">
                                                <input type="checkbox" name="terms" value="1">
                                            </span>
                                            <span class="label-text">
                                             I Agree
                                            </span>
                                        </label>
                                        <div class="reg-btn">
                                            <button type="submit" id="sub">save</button>
                                        </div>
                                    </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- top shape -->
                <div class="shapes-top">
                    <div class="big-shape"></div>
                    <div class="small-shape"></div>
                </div>

                <!-- bottom shape -->
                <div class="shapes-bottom">
                    <div class="small-shape"></div>
                    <div class="big-shape"></div>
                </div>
            </div>
        </div>
    </section>




    <div id="error">

    </div>

    <!-- bootstrap JS -->
    <script src="{{asset('js/bootstrap.min.js')}}"></script>

    <!-- Jquery -->
    <script src="{{asset('js/jquery-3.6.0.min.js')}}"></script>

    <!-- custom JS -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
<script>
    function get_state(id, val) {
        var base_url = window.location.origin + "/";

        $.ajax({
            url: base_url + 'get_state',
            type: 'post',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                id: id
            },
            success: function(result) {
                $('.' + val).html(result.output);
            }

        })
    }

    function get_city(id, val) {
        var base_url = window.location.origin + "/";
        $.ajax({
            url: base_url + 'get_city',
            type: 'post',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                id: id
            },
            success: function(result) {
                $('.' + val).html(result.output);
            }

        })
    }

    $(document).on('submit', '#add_visitors', function(ev) {
        $('.error').html('');

        ev.preventDefault(); // Prevent browers default submit.
        var formData = new FormData(this);
        var error = false;

        if (error == false) {
            $.ajax({
                url: "{{ url('add_visitors') }} ",
                type: 'post',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function(result) {
                    if (result.code == 200) {
                        alert(result.message);
                        setTimeout(function() {
                            window.location.href = "{{ url('thank_you/"+result.id+"') }}";
                        }, 1000);
                    } else if (result.code == 401) {
                        $.each(result.message, function(prefix, val) {
                            $('.' + prefix).css('color','red');
                        });
                        $('.error').css('color', 'red');
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
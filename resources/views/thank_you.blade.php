<!DOCTYPE html>
<html lang="en">


<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Visitor Management System</title>

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
	.square {
		height: 250px;
		width: 250px;
		border: 1px solid black;
		margin: auto;
	}

	.thanku {
		font-size: 90px;
		color: #6848d1;
	}

	.added {
		font-size: 22px;
		color: #6848d1;
		font-weight: 500;
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
											<h6>+91 9999999999</h6>
										</div>
									</div>
									<div class="contact-info-inner">
										<div class="contact-icon">
											<i class="fa-solid fa-envelope"></i>
										</div>
										<div class="contact-details">
											<p>Contact via email</p>
											<h6>mail@axepertexhibits.com</h6>
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
						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
								<div class="text-center mt-5">
									<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 contact-info">
										<button><a href="{{ url()->previous() }}">Go Back</a></button>
									</div>
									<h3 class="thanku">Thank You !</h3>
									<p class="added mt-3 mb-3"> Your Data has been added successfully</p>
									<p class="added mt-3 mb-3"> Scan QR Code For More Details..</p>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
								<div class="mt-3 ">
									<div class="square">
										{!! QrCode::size(300)->generate('5') !!}

									</div>
								</div>
							</div>

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

</body>


</html>
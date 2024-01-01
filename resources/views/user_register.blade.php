<!DOCTYPE html>

<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="description" content="Responsive HTML Admin Dashboard Template based on Bootstrap 5">
	<meta name="author" content="NobleUI">
	<meta name="keywords" content="nobleui, bootstrap, bootstrap 5, bootstrap5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

	<title>User Registration</title>
  <style type="text/css">
          .authlogin-side-wrapper{
            width: 100%;
            height: 100%;
            background-repeat: no-repeat;
            background-position: center;
            background-image: url({{ asset('upload/login.png') }});
          }
  </style>

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
  <!-- End fonts -->

	<!-- core:css -->
	<link rel="stylesheet" href="{{ asset('backend/assets/vendors/core/core.css') }}">
	<!-- endinject -->

	<!-- Plugin css for this page -->
	<!-- End plugin css for this page -->

	<!-- inject:css -->
	<link rel="stylesheet" href="{{ asset('backend/assets/fonts/feather-font/css/iconfont.css') }}">
	<link rel="stylesheet" href="{{ asset('backend/assets/vendors/flag-icon-css/css/flag-icon.min.css') }}">
	<!-- endinject -->

  <!-- Layout styles -->  
	<link rel="stylesheet" href="{{ asset('backend/assets/css/demo1/style.css') }}">
  <!-- End layout styles -->

  <link rel="shortcut icon" href="{{ asset('backend/assets/images/favicon.png') }}" />
</head>
<body>
	<div class="main-wrapper">
		<div class="page-wrapper full-page">
			<div class="page-content d-flex align-items-center justify-content-center">

				<div class="row w-100 mx-0 auth-page">
					<div class="col-md-8 col-xl-6 mx-auto">
						<div class="card">
							<div class="row">
                <div class="col-md-4 pe-md-0">
                  <div class="authlogin-side-wrapper">

                  </div>
                </div>
                <div class="col-md-8 ps-md-0">
                  <div class="auth-form-wrapper px-4 py-5">
                    <a href="#" class="noble-ui-logo d-block mb-2">Ebook<span>Maker</span></a>
                    <h5 class="text-muted fw-normal mb-4">Create a free account.</h5>
                    <form class="forms-sample" method="post" action="{{ route('register') }}">
                      @csrf
                      <div class="mb-3">
                        <label class="form-label" for="name" :value="__('Name')">Name </label>
                        <input type="text" class="form-control" id="name"  placeholder="Full Name" name="name" :value="old('name')" required autofocus autocomplete="name">
                        <x-input-error :messages="$errors->get('name')" class="text-danger" />
                      </div>
                      <div class="mb-3">
                        <label class="form-label" for="email" :value="__('Email')">Email </label>
                        <input type="email" class="form-control" id="email" placeholder="Email" name="email" :value="old('email')" required autocomplete="username">
                        <x-input-error :messages="$errors->get('email')" class="text-danger" />
                      </div>
                      <div class="mb-3">
                        <label class="form-label" for="password" :value="__('Password')">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required autocomplete="new-password" placeholder="Password">
                        <x-input-error :messages="$errors->get('password')" class="text-danger" />
                      </div>
                      <div class="mb-3">
                        <label class="form-label" for="password_confirmation" :value="__('Confirm Password')">Confirm Password</label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm Password">
                        <x-input-error :messages="$errors->get('password_confirmation')" class="text-danger" />
                      </div>
                      <div class="form-check mb-3">
                        <input type="checkbox" class="form-check-input" id="authCheck">
                        <label class="form-check-label" for="authCheck">
                          Remember me
                        </label>
                      </div>
                      <div>
                        <button type="submit" class="btn btn-outline-primary btn-icon-text mb-2 mb-md-0">
                          Register
                        </button>
                      </div>
                      <a href="{{ route('user.login') }}" class="d-block mt-3 text">Already a user? Login</a>
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

	<!-- core:js -->
	<script src="{{ asset('backend/assets/vendors/core/core.js') }}"></script>
	<!-- endinject -->

	<!-- Plugin js for this page -->
	<!-- End plugin js for this page -->

	<!-- inject:js -->
	<script src="{{ asset('backend/assets/vendors/feather-icons/feather.min.js') }}"></script>
	<script src="{{ asset('backend/assets/js/template.js') }}"></script>
	<!-- endinject -->

	<!-- Custom js for this page -->
	<!-- End custom js for this page -->

</body>
</html>
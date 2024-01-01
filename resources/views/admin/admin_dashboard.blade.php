<!DOCTYPE html>

<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="description" content="Responsive HTML Admin Dashboard Template based on Bootstrap 5">
	<meta name="author" content="NobleUI">
	<meta name="keywords" content="nobleui, bootstrap, bootstrap 5, bootstrap5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

	<title>Admin Panel - Ebook Maker</title>

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
  <!-- End fonts -->

	<!-- core:css -->
	<link rel="stylesheet" href="{{ asset('backend/assets/vendors/core/core.css') }}">
	<!-- endinject -->

	<!-- Plugin css for this page -->
  <link rel="stylesheet" href="{{ asset('backend/assets/vendors/datatables.net-bs5/dataTables.bootstrap5.css') }}">
  <link rel="stylesheet" href="{{ asset('backend/assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css') }}">
  <link rel="stylesheet" href="{{ asset('backend/assets/vendors/jquery-tags-input/jquery.tagsinput.min.css') }}">
  <link rel="stylesheet" href="{{ asset('backend/assets/vendors/sweetalert2/sweetalert2.min.css') }}">
	<!-- End plugin css for this page -->

	<!-- inject:css -->
	<link rel="stylesheet" href="{{ asset('backend/assets/fonts/feather-font/css/iconfont.css') }}">
	<link rel="stylesheet" href="{{ asset('backend/assets/vendors/flag-icon-css/css/flag-icon.min.css') }}">
	<!-- endinject -->

  <!-- Layout styles -->  
	<link rel="stylesheet" href="{{ asset('backend/assets/css/demo1/style.css') }}">
  <!-- End layout styles -->

  <link rel="shortcut icon" href="{{ asset('backend/assets/images/favicon.png') }}" />

  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" >
</head>
<body>

	@include('sweetalert::alert')
	
	<div class="main-wrapper">

		<!-- partial:partials/_sidebar.html -->
		@include('admin.body.sidebar')

		<!-- partial -->
	
		<div class="page-wrapper">
					
			<!-- partial:partials/_navbar.html -->
			@include('admin.body.header')

			<!-- partial -->

			@yield('admin')

			<!-- partial:partials/_footer.html -->
			@include('admin.body.footer')

			<!-- partial -->
		
		</div>
	</div>

	<!-- core:js -->
	<script src="{{ asset('backend/assets/vendors/core/core.js') }}"></script>
	<!-- endinject -->

	<!-- Plugin js for this page -->
	<script src="{{ asset('backend/assets/vendors/chartjs/Chart.min.js') }}"></script>
	<script src="{{ asset('backend/assets/vendors/datatables.net/jquery.dataTables.js') }}"></script>
	<script src="{{ asset('backend/assets/vendors/jquery-tags-input/jquery.tagsinput.min.js') }}"></script>
	<script src="{{ asset('backend/assets/vendors/jquery.flot/jquery.flot.js') }}"></script>
	<script src="{{ asset('backend/assets/vendors/jquery.flot/jquery.flot.resize.js') }}"></script>
	<script src="{{ asset('backend/assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
	<script src="{{ asset('backend/assets/vendors/apexcharts/apexcharts.min.js') }}"></script>
	<script src="{{ asset('backend/assets/vendors/datatables.net-bs5/dataTables.bootstrap5.js') }}"></script>
	<script src="{{ asset('backend/assets/vendors/sweetalert2/sweetalert2.min.js') }}"></script>
	<!-- End plugin js for this page -->

	<!-- inject:js -->
	<script src="{{ asset('backend/assets/vendors/feather-icons/feather.min.js') }}"></script>
	<script src="{{ asset('backend/assets/js/template.js') }}"></script>
	<!-- endinject -->

	<!-- Custom js for this page -->
	<script src="{{ asset('backend/assets/js/dashboard-light.js') }}"></script>
	<script src="{{ asset('backend/assets/js/datepicker.js') }}"></script>
	<script src="{{ asset('backend/assets/js/chat.js') }}"></script>
	<script src="{{ asset('backend/assets/js/data-table.js') }}"></script>
	<script src="{{ asset('backend/assets/js/tags-input.js') }}"></script>
	<script src="{{ asset('backend/assets/js/sweet-alert.js') }}"></script>
	<script src="{{ asset('js/tinymce/tinymce.min.js') }}"></script>
	<!-- End custom js for this page -->

	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>


	<script type="text/javascript">
		$(document).ready(function(){
		  $('#image').change(function(e){
			var reader = new FileReader();
			reader.onload = function(e){
			  $('#showImage').attr('src',e.target.result);
			}
			reader.readAsDataURL(e.target.files['0']);
		  });
		});
	  
		function confirmation(e) {
		  e.preventDefault();
		  var urlToRedirect = e.currentTarget.getAttribute('href');
		  console.log(urlToRedirect);
		  Swal.fire({
			title: 'Are you sure?',
			text: "You won't be able to revert this!",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Yes, delete it!'
		  }).then((result) => {
		   if (result.isConfirmed) {
			window.location.href=urlToRedirect;
			Swal.fire(
			'Deleted!',
			'Successfully deleted.',
			'success'
			)
		  } 
		})
	  }
	</script>
	
	<script>
	  var table = document.getElementById('dataTableExample');
	  var rows = table.getElementsByTagName('tr');
	  
	  // Start the loop from index 1 to skip the header row
	  for (var i = 1; i < rows.length; i++) {
		var row = rows[i];
		var serialNumberCell = document.createElement('td');
		serialNumberCell.textContent = i;
	  
		// Insert the S/N cell as the first cell in each row
		row.insertBefore(serialNumberCell, row.firstChild);
	  }
	  
	</script>

</body>
</html>    
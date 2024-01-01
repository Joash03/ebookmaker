<!DOCTYPE html>

<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<meta name="description" content="Responsive HTML Admin Dashboard Template based on Bootstrap 5">
	<meta name="author" content="NobleUI">
	<meta name="keywords" content="nobleui, bootstrap, bootstrap 5, bootstrap5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

	<title>Author Dashboard - Ebook Maker</title>

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
		@include('author.body.sidebar')

		<!-- partial -->
	
		<div class="page-wrapper">
					
			<!-- partial:partials/_navbar.html -->
			@include('author.body.header')

			<!-- partial -->

			@yield('author')

			<!-- partial:partials/_footer.html -->
			@include('author.body.footer')

			<!-- partial -->
		
    
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
  tinymce.init({
    selector: "#content",

    plugins: "pagebreak searchreplace visualblocks preview advlist anchor autolink autosave charmap directionality emoticons help image insertdatetime link lists media nonbreaking pagebreak searchreplace table visualblocks visualchars wordcount",
    toolbar: "undo redo | pagebreak searchreplace | blocks fontfamily fontsizeinput | bold italic underline forecolor backcolor | link image | align lineheight checklist bullist numlist | indent outdent | removeformat typography",

    quickbars_insert_toolbar: 'quicktable image media codesample',
    quickbars_selection_toolbar: 'bold italic underline searchreplace | blocks | bullist numlist | blockquote quicklink',
    contextmenu: 'undo redo | inserttable | cell row column deletetable | help',
    powerpaste_word_import: 'clean',
    powerpaste_html_import: 'clean',

    height: '900px',
    toolbar_sticky: false,
    image_title: true,
    automatic_uploads: true,
    file_picker_types: 'image',
    file_picker_callback: (cb, value, meta) => {
      const input = document.createElement('input');
      input.setAttribute('type', 'file');
      input.setAttribute('accept', 'image/*');

      input.addEventListener('change', (e) => {
        const file = e.target.files[0];

        const reader = new FileReader();
        reader.addEventListener('load', () => {
          const id = 'blobid' + (new Date()).getTime();
          const blobCache =  tinymce.activeEditor.editorUpload.blobCache;
          const base64 = reader.result.split(',')[1];
          const blobInfo = blobCache.create(id, file, base64);
          blobCache.add(blobInfo);

          /* call the callback and populate the Title field with the file name */
          cb(blobInfo.blobUri(), { title: file.name });
        });
        reader.readAsDataURL(file);
      });
      input.click();
    },

    autosave_restore_when_empty: true,
    pagebreak_split_block: true,

    spellchecker_active: true,
    spellchecker_language: 'en_US',
    spellchecker_languages: 'English (United States)=en_US,English (United Kingdom)=en_GB,Danish=da,French=fr,German=de,Italian=it,Polish=pl,Spanish=es,Swedish=sv',

    typography_langs: [ 'en-US' ],
    typography_default_lang: 'en-US',

    content_style: `
      body {
        background: #fff;
      }

      @media (min-width: 840px) {
        html {
          background: #eceef4;
          min-height: 100%;
          padding: 0.5rem;
        }

        body {
          background-color: #fff;
          box-shadow: 0 0 4px rgba(0, 0, 0, .15);
          box-sizing: border-box;
          margin: 1rem auto 0;
          max-width: 820px;
          min-height: calc(100vh - 1rem);
          padding: 4rem 6rem 6rem 6rem;
        }
      }
    `,
  });
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
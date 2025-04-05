<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="description" content="Responsive HTML Admin Dashboard Template based on Bootstrap 5">
        <meta name="author" content="NobleUI">
        <meta name="keywords" content="nobleui, bootstrap, bootstrap 5, bootstrap5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">
    
        <title>Ebook Maker</title>
    
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
    
    
    <!-- 
    - favicon
  -->
  <link rel="shortcut icon" href="./favicon.svg" type="image/svg+xml">

  <!-- 
    - custom css link
  -->
  <link rel="stylesheet" href="{{ asset('home/assets/css/style.css') }}">

  <!-- 
    - google font link
  -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&family=Source+Sans+Pro:wght@600;700&display=swap"
    rel="stylesheet">
    
    
    
    
    
    
    </head>
    <body id="top">
  <!-- 
    - #HEADER
  -->

  <header class="header" data-header>
    <div class="container">

      <div class="overlay" data-overlay></div>

      <a href="#">
        <h1 class="logo">Ebook Maker</h1>
      </a>

      <nav class="navbar" data-navbar>

        <div class="navbar-top">
          <a href="#" class="logo">Desinic</a>

          <button class="nav-close-btn" aria-label="Close Menu" data-nav-close-btn>
            <ion-icon name="close-outline"></ion-icon>
          </button>
        </div>

        <ul class="navbar-list">
{{-- 
          <li class="navbar-item">
            <a href="#home" class="navbar-link" data-navbar-link>Home</a>
          </li>

          <li class="navbar-item">
            <a href="#about" class="navbar-link" data-navbar-link>About</a>
          </li>

          <li class="navbar-item">
            <a href="#services" class="navbar-link" data-navbar-link>Services</a>
          </li>

          <li class="navbar-item">
            <a href="#features" class="navbar-link" data-navbar-link>Features</a>
          </li> --}}
        @if (Route::has('login'))
              @auth
              <li class="navbar-item">
                  <a href="{{ url('author/dashboard') }}"   class="btn">
                    <ion-icon name="chevron-forward-outline" aria-hidden="true"></ion-icon>
                    <span>Dashboard</span>
                    <button class="nav-open-btn" aria-label="Open Menu" data-nav-open-btn>
                        <ion-icon name="menu-outline"></ion-icon>
                      </button>
                  </a>
              </li>
              @else
                    <a href="{{ route('user.login') }}"  class="btn">
                        <ion-icon name="chevron-forward-outline" aria-hidden="true"></ion-icon>
                        <span>Log In</span>
                        <button class="nav-open-btn" aria-label="Open Menu" data-nav-open-btn>
                            <ion-icon name="menu-outline"></ion-icon>
                        </button>
                    </a>
                  @if (Route::has('register'))
                    <a href="{{ route('user.register') }}"class="btn">
                        <ion-icon name="chevron-forward-outline" aria-hidden="true"></ion-icon>
                        <span>Register</span>
                        <button class="nav-open-btn" aria-label="Open Menu" data-nav-open-btn>
                            <ion-icon name="menu-outline"></ion-icon>
                        </button>
                    </a>
                  @endif
              @endauth
        @endif
        </ul>

      </nav>

      

      

    </div>
  </header>





  <main>
    <article>

      <!-- 
        - #HERO
      -->

      <section class="hero" id="home">
        <div class="container">

          <div class="hero-content">

            <p class="hero-subtitle">We Are Product Designer From UK</p>

            <h2 class="h2 hero-title">We Design Ebooks That Users Love</h2>

            <p class="hero-text">
              Morbi sed lacus nec risus finibus feugiat et fermentum nibh. Pellentesque vitae ante at elit fringilla ac
              at purus.
            </p>

            <a href="{{ route('user.login') }}" class="btn">Learn More</a>

          </div>

          <figure class="hero-banner">
            <img src="{{ asset('home/assets/images/hero-banner.png') }}" width="694" height="529" loading="lazy" alt="hero-banner"
              class="w-100 banner-animation">
          </figure>

        </div>
      </section>


    </article>
  </main>





  <!-- 
    - #FOOTER
  -->

  <footer class="footer">

    <div class="footer-top section">
      <div class="container">

        <div class="footer-brand" style="margin-right: 100px; width: 400px">

          <a href="#" class="logo">Ebook</a>

          <p class="text">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Reiciendis aliquam officia, optio, harum commodi earum perspiciatis hic deserunt odio, expedita id sequi adipisci aspernatur aut illo iusto numquam ipsa vitae!
          </p>

          <ul class="social-list">

            <li>
              <a href="#" class="social-link">
                <ion-icon name="logo-facebook"></ion-icon>
              </a>
            </li>

            <li>
              <a href="#" class="social-link">
                <ion-icon name="logo-instagram"></ion-icon>
              </a>
            </li>

            <li>
              <a href="#" class="social-link">
                <ion-icon name="logo-twitter"></ion-icon>
              </a>
            </li>

          </ul>

        </div>

        <ul class="footer-brand" style="margin-left: 100px; width: 400px">

          <li>
            <p class="footer-list-title">Contact Us</p>
          </li>

          <li class="footer-item">

            <div class="footer-item-icon">
              <ion-icon name="call"></ion-icon>
            </div>

            <div>
              <a href="#" class="footer-item-link">+240-000-0000</a>
              <a href="#" class="footer-item-link">+240-000-0000</a>
            </div>

          </li>

          <li class="footer-item">

            <div class="footer-item-icon">
              <ion-icon name="mail"></ion-icon>
            </div>

            <div>
              <a href="#" class="footer-item-link">info@example.com</a>
              <a href="#" class="footer-item-link">help@example.com</a>
            </div>

          </li>

        </ul>

      </div>
    </div>



  </footer>





  <!-- 
    - #GO TO TOP
  -->

  <a href="#top" class="go-top  active" aria-label="Go To Top" data-go-top>
    <ion-icon name="arrow-up-outline"></ion-icon>
  </a>





  <!-- 
    - custom js link
  -->
  <script src="{{ asset('home/assets/js/script.js') }}"></script>

  <!-- 
    - ionicon link
  -->
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

        
	<!-- core:js -->
	<script src="{{ asset('backend/assets/vendors/core/core.js') }}"></script>
	<!-- endinject -->

	<!-- Plugin js for this page -->
  <script src="{{ asset('backend/assets/vendors/chartjs/Chart.min.js') }}"></script>
  <script src="{{ asset('backend/assets/vendors/jquery-tags-input/jquery.tagsinput.min.js') }}"></script>
  <script src="{{ asset('backend/assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
  <script src="{{ asset('backend/assets/vendors/apexcharts/apexcharts.min.js') }}"></script>
  <script src="{{ asset('backend/assets/vendors/jquery.flot/jquery.flot.js') }}"></script>
  <script src="{{ asset('backend/assets/vendors/datatables.net/jquery.dataTables.js') }}"></script>
  <script src="{{ asset('backend/assets/vendors/datatables.net-bs5/dataTables.bootstrap5.js') }}"></script>
  <script src="{{ asset('backend/assets/vendors/jquery.flot/jquery.flot.resize.js') }}"></script>
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

    </body>
</html>

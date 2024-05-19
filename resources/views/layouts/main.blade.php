<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>POS | @yield('title')</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  @vite(['resources/css/app.css', 'resources/js/app.js']) 

  <!-- Favicons -->
  <link href="{{ asset('favicon.ico') }}" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Scripts to load toastrjs -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

  <!-- Data Table https://datatables.net/examples/styling/bootstrap5.html-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0-alpha3/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">

  <!-- js and css -->
  <link rel="stylesheet" href="{{ URL::to('css/bootstrap-icons.css') }}">
  <link rel="stylesheet" href="{{ URL::to('css/customcss.css') }}">

  <!-- Awesome Complete Javascript Css -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/awesomplete/1.1.5/awesomplete.css" integrity="sha512-JcmylNmvdZJ8UcYcSDFWhvE6DwI8bKcnPKvBlwU2w/aRJ6qiZErv1Ixq99ykZgy3cCSp+QJp9su5buNLQjytng==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  @stack('styles')
  @livewireStyles

</head>

<body>

@include('includes.header')

@include('includes.sidenav')

  <main id="main" class="main">

    @yield('pageTitle')

    <section class="section dashboard">
        @yield('content')
    </section>

  </main><!-- End #main -->

  @include('includes.footer')

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  @livewireScripts

  <!-- Added these so that popup modal can work -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

   @if(Session::has('success'))
    <script>
        toastr.options = {
            'progressBar' : true,
            "showMethod": "fadeIn",
            "positionClass": "toast-top-right",
            "hideMethod": "fadeOut",
            "closeButton": true,
            "newestOnTop": false,
        }
        toastr.success("{{ Session::get('success') }}");
    </script>
   @endif

   @if(Session::has('error'))
     <script>
         toastr.options = {
          'progressBar' : true,
          "showMethod": "fadeIn",
          "positionClass": "toast-top-right",
          "hideMethod": "fadeOut",
          "closeButton": true,
          "newestOnTop": false,
      }
      toastr.error("{{ session('error') }}");
    </script>
   @endif

   @if($errors->any())
     <script>
         toastr.options = {
          'progressBar' : true,
          "showMethod": "fadeIn",
          "positionClass": "toast-top-right",
          "hideMethod": "fadeOut",
          "closeButton": true,
          "newestOnTop": false,
      }
      toastr.error("There seems to be an error with one of your inputs");
    </script>
   @endif


  <!-- Toastrjs css. Added at the bottom because the css used for the website overides it -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  @stack('scripts')

  <!-- Scripts to load DataTable https://datatables.net/examples/styling/bootstrap5.html -->
  <script src='https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js'></script>
  <script src='https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js'></script>
  <script>
      $('#example').DataTable();
  </script>

  <!-- Awesome Complete Javascript JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/awesomplete/1.1.5/awesomplete.js" integrity="sha512-t3zV/oAkSZUrvb/7p1q1+uh/i56JinQ+bmiulnHhbHZc7dq09CxJ1BByyi7A4+lF76+CcJtSVFtb7na7Oe7Cgg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

  <!-- Javascript -->
  <script src='{{ URL::to('js/customjs.js') }}"></script>


</body>

</html>



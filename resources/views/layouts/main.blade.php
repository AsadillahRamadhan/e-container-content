<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>E-Container Content | {{ $title }}</title>

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="{{ asset('/assets/plugins/fontawesome-free/css/all.min.css') }}">
  <link rel="stylesheet" href="{{ asset('/assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
  <link rel="stylesheet" href="{{ asset('/assets/dist/css/adminlte.min.css') }}">
  <link href="{{ asset('/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('fontawesome/css/fontawesome.min.css') }}">
  <link rel="stylesheet" href="{{ asset('fontawesome/css/all.min.css') }}">
  <link rel="stylesheet" href="{{ asset('fontawesome/css/brands.min.css') }}">
  <link rel="icon" type="image/x-icon" href="{{ asset('/img/yazaki.png') }}">
</head>
<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">

<div class="wrapper">

  <div class="preloader flex-column justify-content-center align-items-center">
    <svg class="animation__wobble" xmlns="http://www.w3.org/2000/svg" version="1.1" width="225px" height="225px" style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd" xmlns:xlink="http://www.w3.org/1999/xlink">
      <g><path style="opacity:1" fill="#da1312" d="M 159.5,146.5 C 159.357,148.262 159.691,149.929 160.5,151.5C 160.043,152.298 159.376,152.631 158.5,152.5C 120.9,132.033 83.8997,110.533 47.5,88C 49.2194,86.9431 51.0528,86.1097 53,85.5C 95.0957,86.3304 137.262,86.8304 179.5,87C 176.333,90.1667 173.167,93.3333 170,96.5C 169.667,104.167 169.333,111.833 169,119.5C 165.667,125.5 162.333,131.5 159,137.5C 158.699,140.507 158.865,143.507 159.5,146.5 Z"/></g>
      <g><path style="opacity:0.745" fill="#f18984" d="M 159.5,146.5 C 160.718,148.828 161.718,151.328 162.5,154C 160.86,154.348 159.527,153.848 158.5,152.5C 159.376,152.631 160.043,152.298 160.5,151.5C 159.691,149.929 159.357,148.262 159.5,146.5 Z"/></g>
      </svg>
  </div>

  @include('partials.navbar')
  @include('partials.sidebar')

  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">{{ $title }}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/"  class="text-decoration-none">Home</a></li>
              <li class="breadcrumb-item active">{{ $title }}</li>
            </ol>
          </div>
        </div>
      </div>
    </div>

    <section class="content mx-2">
        @yield('container')
    </section>
  </div>

  <aside class="control-sidebar control-sidebar-dark"></aside>

  @section('partials.footer')
</div>
<script type="text/javascript" src="{{ asset('/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<script src="{{ asset('assets/dist/js/adminlte.js') }}"></script>

<script src="{{ asset('assets/plugins/jquery-mousewheel/jquery.mousewheel.js') }}"></script>
<script src="{{ asset('assets/plugins/raphael/raphael.min.js') }}"></script>
<script src="{{ asset('assets/plugins/jquery-mapael/jquery.mapael.min.js') }}"></script>
<script src="{{ asset('assets/plugins/jquery-mapael/maps/usa_states.min.js') }}"></script>
<script src="{{ asset('assets/plugins/chart.js/Chart.min.js') }}"></script>
</body>
</html>

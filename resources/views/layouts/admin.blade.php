<!doctype html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>

    <!-- <meta charset="utf-8"> -->
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <meta name="description" content="Secure E-Payment is powerfull payment getway.">
    <meta name="keywords" content="Secure, E-Payment, Payment, Getway, powerfull">

    <!-- <meta name="viewport" content="width=device-width, initial-scale=1"> -->

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="author" content="SecureEpayment">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- <link rel="apple-touch-icon" href="{{asset('images/ico/apple-icon-120.png')}}"> -->
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('images/logo/favicon.ico')}}">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600" rel="stylesheet">
    <script type="text/javascript" src="{{ asset('/js/vue2.6.14.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/js/axios.min.js') }}"></script>
    {{-- Include core + vendor Styles --}}
    @include('panels/styles')

    {{-- Include core + vendor Styles --}}
    @include('panels/styles')
    
</head>
<body  class="pace-done vertical-layout vertical-menu-modern navbar-floating footer-static default menu-expanded" data-open="click" data-menu="vertical-menu-modern" data-col="default" data-framework="laravel" data-asset-path="{{ asset('/')}}">
  <!-- BEGIN: Header-->
  @include('panels.navbar')
  <!-- END: Header-->

  <!-- BEGIN: Main Menu-->
  @include('panels.sidebar')
  <!-- END: Main Menu-->

  <!-- BEGIN: Content-->
  <div class="app-content content">
      <!-- BEGIN: Header-->
      <div class="content-overlay"></div>
      <div class="header-navbar-shadow"></div>

      <div class="content-wrapper container-xxl p-0">
        <div class="content-body">

          {{-- Include Startkit Content --}}
          @yield('content')

        </div>
      </div>
  </div>
  <!-- End: Content-->
  <div class="sidenav-overlay"></div>
  <div class="drag-target"></div>

  {{-- include footer --}}
  @include('panels/footer')


  {{-- include default scripts --}}
  @include('panels/scripts')

  <script type="text/javascript">
    $(window).on('load', function() {
      if (feather) {
        feather.replace({
          width: 14,
          height: 14
        });
      }
    })
    Pace.stop();
  </script>
</body>
</html>
    

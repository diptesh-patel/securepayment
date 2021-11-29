<!-- BEGIN: Vendor CSS-->
<link rel="stylesheet" href="{{ asset('vendors/css/vendors.min.css') }}" />

@yield('vendor-style')
<!-- END: Vendor CSS-->

<!-- BEGIN: Theme CSS-->
<link rel="stylesheet" href="{{ asset('css/core.css') }}" />
<link rel="stylesheet" href="{{ asset('css/base/themes/dark-layout.css') }}" />
<link rel="stylesheet" href="{{ asset('css/base/themes/bordered-layout.css') }}" />
<link rel="stylesheet" href="{{ asset('css/base/themes/semi-dark-layout.css') }}" />


<!-- BEGIN: Page CSS-->
<link rel="stylesheet" href="{{ asset('css/base/core/menu/menu-types/vertical-menu.css') }}" />

{{-- Page Styles --}}
@yield('page-style')

<!-- laravel style -->
<link rel="stylesheet" href="{{ asset('css/overrides.css') }}" />

<!-- BEGIN: Custom CSS-->

{{-- user custom styles --}}
  <link rel="stylesheet" href="{{ asset('css/style.css') }}" />

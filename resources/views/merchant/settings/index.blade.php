@extends('layouts.merchant')
@section('title', 'Merchants Settings')
@section('vendor-style')
  {{-- vendor css files --}}
  <link rel="stylesheet" href="{{ asset('vendors/css/extensions/toastr.min.css') }}">
@endsection
@section('page-style')
  {{-- Page Css files --}}
  
  <link rel="stylesheet" href="{{ asset('css/base/plugins/extensions/ext-component-toastr.css') }}">
@endsection
@section('content')
<!-- Basic tabs start -->
<section id="settings_page">
   <div class="row match-height">
      <!-- Tabs with Icon starts -->
      <div class="col-xl-12 col-lg-12">
         <div class="card">
            <div class="card-header">
               <h4 class="card-title">Account Settings</h4>
            </div>
            <div class="card-body">
               <ul class="nav nav-tabs" role="tablist">
                  <li class="nav-item">
                     <a class="nav-link active" id="aboutIcon-tab" data-bs-toggle="tab" href="#aboutIcon" aria-controls="about" role="tab" aria-selected="false" ><i data-feather="user"></i> Account</a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link" id="profileIcon-tab" data-bs-toggle="tab" href="#profileIcon" aria-controls="profile" role="tab" aria-selected="false" ><i data-feather="lock"></i> security</a>
                  </li>
               </ul>
               <div class="tab-content">
                @include('merchant/settings/include/profile')
                @include('merchant/settings/include/security')
               </div>
            </div>
         </div>
         <!-- recent device -->
         @include('merchant/settings/include/device')
        
         <!-- / recent device -->
      </div>
      <!-- Tabs with Icon ends -->
      
   </div>
</section>
<!-- Basic Tabs end -->
  @include('merchant/settings/include/_modals/two-factor-auth')
@endsection
@section('vendor-script')
<script src="{{ asset('vendors/js/extensions/toastr.min.js') }}"></script>
@endsection
@section('page-script')
<script src="{{asset('js/scripts/components/settings.js')}}"></script>
<script src="{{ asset('js/scripts/pages/modal-two-factor-auth.js') }}"></script>
@endsection


@extends('layouts.admin')

@section('title', 'Merchants List')

@section('vendor-style')
  {{-- vendor css files --}}
  
  <link rel="stylesheet" href="{{ asset('vendors/css/extensions/toastr.min.css') }}">
@endsection
@section('page-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset('css/base/plugins/forms/form-validation.css') }}">
  <link rel="stylesheet" href="{{ asset('css/base/plugins/extensions/ext-component-toastr.css') }}">
@endsection

@section('content')
<!-- Basic table -->
<section id="admin_merchant">
<div class="row">
    <div class="col-12">
    <div class="card">
      <form class="add-new-record modal-content pt-0" id="addMerchantForm" name="addMerchantForm" method="POST" action="{{ route('admin.add_merchant') }}" v-on:submit="addOnSubmit">
      @csrf
        <div class="modal-header mb-1">
          <h5 class="modal-title" id="exampleModalLabel">New Merchant</h5>
        </div>
        <div class="modal-body flex-grow-1">
          <div class="mb-1">
            <label class="form-label" for="basic-icon-default-fullname">Name</label>
            <input
              type="text"
              v-model="name"  name="name"
              class="form-control dt-full-name"
              id="basic-icon-default-fullname"
              placeholder="John Doe"
              aria-label="John Doe" required
            />
          </div>
          <div class="mb-1">
            <label class="form-label" for="basic-icon-default-fullname">Notification URL</label>
            <input
              type="text"
              v-model="notification_url" name="notification_url"
              class="form-control dt-notification-url"
              id="basic-icon-default-notification-url"
              placeholder="" required
              aria-label=""
            />
          </div>
          <div class="mb-1">
            <label class="form-label" for="basic-icon-default-email">Email</label>
            <input
              type="text" v-model="email" name="email"
              id="basic-icon-default-email"
              class="form-control dt-email"
              placeholder="john.doe@example.com"
              aria-label="john.doe@example.com" required
            />
          </div>
          <!-- <div class="mb-1">
            <label class="form-label" for="basic-icon-default-password">Password</label>
            <input v-model="password" required name="password" type="password"  id="basic-icon-default-password"  class="form-control dt-password"  placeholder=""  aria-label="" />
          </div> -->
          <button v-if="!isLoader" class="btn btn-primary data-submit me-1 "  type="submit" form="addMerchantForm" value="addMerchantForm" >{{ __('Add New') }}</button>
          <button v-if="isLoader" class="btn btn-primary data-submit me-1" type="button" disabled>
              <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
              <span class="ms-25 align-middle">Loading...</span>
          </button>
          <!-- <button type="submit" class="btn btn-primary data-submit me-1">Add New</button> -->
          <a href="{{ route('admin.merchants')}}" class="btn btn-outline-secondary" >Cancel</a>
          <div v-if="errorMessage" class="mt-1">
            <div v-for="error in errorMessage" class="alert alert-danger" role="alert">
                
                <div class="alert-body">@{{ error[0] }}</div>
            </div>
          </div>
          
        </div>
      </form>
      </div>
          
        </div>
</section>
<!--/ Basic table -->
@endsection
@section('vendor-script')
  {{-- vendor files --}}
  <script src="{{asset('vendors/js/forms/validation/jquery.validate.min.js')}}"></script>
  <script src="{{ asset('vendors/js/extensions/toastr.min.js') }}"></script>
@endsection

@section('page-script')
  {{-- Page js files --}}
  <script>var merchantslistUrl = "{{ route('admin.getmerchantslist')}}";</script>
  <script src="{{ asset('js/scripts/tables/admin-merchant.js') }}"></script>
@endsection

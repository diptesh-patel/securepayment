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
<section id="admin_user">
<div class="row">
    <div class="col-12">
    <div class="card">
      <form class="add-new-record modal-content pt-0" id="addUserForm" name="addUserForm" method="POST" action="{{ route('admin.add_user') }}" v-on:submit="addOnSubmit">
      @csrf
        <div class="modal-header mb-1">
          <h5 class="modal-title" id="exampleModalLabel">New User</h5>
        </div>
        <div class="modal-body flex-grow-1">
         
          
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
          <div class="mb-1">
            <label class="form-label" for="basic-icon-default-email">First Name</label>
            <input
              type="text" v-model="first_name" name="first_name"
              id="basic-icon-default-first-name"
              class="form-control dt-first-name"
              placeholder="john"
              aria-label="john" required
            />
          </div>
          <div class="mb-1">
            <label class="form-label" for="basic-icon-default-email">Last Name</label>
            <input
              type="text" v-model="last_name" name="last_name"
              id="basic-icon-default-last-name"
              class="form-control dt-last-name"
              placeholder="doe"
              aria-label="doe" required
            />
          </div>
          <div class="mb-1">
            <label class="form-label" for="basic-icon-default-position">Position</label>
            <input type="text" v-model="position" name="position" value="" class="form-control dt-full-position" id="basic-icon-default-fullposition" placeholder="Position" aria-label="position" required/>
            
          </div>
          <div class="mb-1">
            <label class="form-label" for="basic-icon-default-address">Address</label>
            <input
              type="text" v-model="address" name="address"
              id="basic-icon-default-address"
              class="form-control dt-address"
              placeholder="Address"
              aria-label="address" required
            />
          </div>
          <div class="mb-1">
            <label class="form-label" for="basic-icon-default-phone">Phone</label>
            <input
              type="text" v-model="phone" name="phone"
              id="basic-icon-default-phone"
              class="form-control dt-phone"
              placeholder="Phone"
              aria-label="phone" required
            />
          </div>
          <div class="mb-1">
            <label class="form-label" for="basic-icon-default-password">Password</label>
            <input v-model="password" required name="password" type="password"  id="basic-icon-default-password"  class="form-control dt-password"  placeholder=""  aria-label="" />
          </div>
          <button v-if="!isLoader" class="btn btn-primary data-submit me-1 "  type="submit" form="addUserForm" value="addUserForm" >{{ __('Add New') }}</button>
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
  <script>var merchantslistUrl = "{{ route('admin.getuserslist')}}";</script>
  <script src="{{ asset('js/scripts/tables/admin-user.js') }}"></script>
@endsection

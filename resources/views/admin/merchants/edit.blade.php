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
      <div class="card-body">
      <div class="row">
      <form class="add-new-record modal-content pt-0" id="addMerchantForm" name="addMerchantForm" method="POST" action="{{ route('admin.update_merchant') }}" v-on:submit="addOnSubmit">
      @csrf
        <input type="hidden" name="id" value="{{$id}}"/>
        <div class="modal-header mb-1">
          <h5 class="modal-title" id="exampleModalLabel">Edit Merchant</h5>
        </div>
        <div class="modal-body flex-grow-1">
          <div class="mb-1">
            <label class="form-label" for="basic-icon-default-fullname">Name</label>
            <input type="text" name="name" value="{{ $merchantData->name}}" class="form-control dt-full-name" id="basic-icon-default-fullname" placeholder="John Doe" aria-label="John Doe" required/>
          </div>
          <div class="mb-1">
            <label class="form-label" for="basic-icon-default-fullname">Notification URL</label>
            <input type="text" name="notification_url" value="{{ $merchantData->notification_url}}" class="form-control dt-notification-url" id="basic-icon-default-notification-url" placeholder="" required aria-label=""/>
          </div>
          <div class="mb-1">
            <label class="form-label" for="basic-icon-default-email">Email</label>
            <input type="text"  name="email" value="{{ $merchantData->email}}" id="basic-icon-default-email" class="form-control dt-email" placeholder="john.doe@example.com" aria-label="john.doe@example.com" required/>
          </div>
          <!-- <div class="mb-1">
            <label class="form-label" for="basic-icon-default-password">Password</label>
            <input  name="password" type="password"  id="basic-icon-default-password"  class="form-control dt-password"  placeholder=""  aria-label="" />
          </div> -->
          <div class="mb-1">
            <label class="form-label" for="basicSelect">Status</label>
            <select class="form-select" id="basicSelect" name="status">
              <option value="active" <?php if($merchantData->status == "active"){echo "selected";}?>>Active</option>
              <option value="inactive" <?php if($merchantData->status == "inactive"){echo "selected";}?>>Inactive</option>
            </select>
          </div>
          <!-- display key and password -->
          <div class="col-xl-4 col-md-6 col-12">
            <div class="mb-1">
              <label class="form-label" for="disabledInput">Secret Key</label>
              <input type="text" class="form-control" id="disabledInput" disabled value="{{ $merchantData->secret_key}}"/>
            </div>
          </div>
          <div class="col-xl-4 col-md-6 col-12">
            <div class="mb-1">
              <label class="form-label" for="disabledInput">Secret Password</label>
              <input type="text" class="form-control" id="disabledInput" disabled value="{{ $merchantData->secret_password}}"/>
            </div>
          </div>
          <!-- END display key -->
          <button v-if="!isLoader" class="btn btn-primary data-submit me-1 "  type="submit" form="addMerchantForm" value="addMerchantForm" >{{ __('Update') }}</button>
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
  <!-- <script src="{{ asset('js/scripts/tables/table-datatables-basic.js') }}"></script> -->
  <script>var merchantslistUrl = "{{ route('admin.getmerchantslist')}}";</script>
  <script src="{{ asset('js/scripts/tables/admin-merchant-edit.js') }}"></script>
@endsection

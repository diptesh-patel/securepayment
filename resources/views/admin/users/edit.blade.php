@extends('layouts.admin')

@section('title', 'Users List')

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
      <div class="card-body">
      <div class="row">
      <form class="add-new-record modal-content pt-0" id="editUserForm" name="editUserForm" method="POST" action="{{ route('admin.update_user') }}" v-on:submit="editOnSubmit">
      @csrf
        <input type="hidden" name="id" value="{{$id}}"/>
        <div class="modal-header mb-1">
          <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
        </div>
        <div class="modal-body flex-grow-1">
          <div class="mb-1">
            <label class="form-label" for="basic-icon-default-fullfirst_name">First Name</label>
            <input type="text"  name="first_name" value="{{ $userData->userprofile->first_name}}" class="form-control dt-full-first_name" id="basic-icon-default-fullfirst_name" placeholder="First Name" aria-label="John" required/>
          </div>
          <div class="mb-1">
            <label class="form-label" for="basic-icon-default-fulllast_name">Last Name</label>
            <input type="text" name="last_name" value="{{ $userData->userprofile->last_name}}" class="form-control dt-full-last_name" id="basic-icon-default-fulllast_name" placeholder="Last Name" aria-label="last_name" required/>
          </div>
          
          <div class="mb-1">
            <label class="form-label" for="basic-icon-default-email">Email</label>
            <input type="text"  name="email" value="{{ $userData->email}}" id="basic-icon-default-email" class="form-control dt-email" placeholder="john.doe@example.com" aria-label="john.doe@example.com" required/>
          </div>
          <div class="mb-1">
            <label class="form-label" for="basic-icon-default-fullposition">Position</label>
            <input type="text" name="position" value="{{ $userData->userprofile->position}}" class="form-control dt-full-position" id="basic-icon-default-fullposition" placeholder="Position" aria-label="position" required/>
          </div>
          <div class="mb-1">
            <label class="form-label" for="basic-icon-default-fulladdress">Address</label>
            <input type="text" name="address" value="{{ $userData->userprofile->address}}" class="form-control dt-full-address" id="basic-icon-default-fulladdress" placeholder="Address" aria-label="last_name" required/>
          </div>
          <div class="mb-1">
            <label class="form-label" for="basic-icon-default-fullphone">Phone</label>
            <input type="text" name="phone" value="{{ $userData->userprofile->phone}}" class="form-control dt-full-phone" id="basic-icon-default-fullphone" placeholder="Phone" aria-label="last_name" required/>
          </div>
          <div class="mb-1">
            <label class="form-label" for="basic-icon-default-password">Password</label>
            <input  name="password" type="password"  id="basic-icon-default-password"  class="form-control dt-password"  placeholder=""  aria-label="" />
          </div>
          <div class="mb-1">
            <label class="form-label" for="basicSelect">Status</label>
            <select class="form-select" id="basicSelect" name="status">
              <option value="active" <?php if($userData->status == "active"){echo "selected";}?>>Active</option>
              <option value="inactive" <?php if($userData->status == "inactive"){echo "selected";}?>>Inactive</option>
            </select>
          </div>
          <button v-if="!isLoader" class="btn btn-primary data-submit me-1 "  type="submit" form="editUserForm" value="editUserForm" >{{ __('Update') }}</button>
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
  <script>var userslistUrl = "{{ route('admin.getuserslist')}}";</script>
  <script src="{{ asset('js/scripts/tables/admin-user-edit.js') }}"></script>
@endsection

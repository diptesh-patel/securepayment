@extends('layouts.admin')

@section('title', 'Mids List')

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
<section id="admin_mid">
<div class="row">
    <div class="col-12">
    <div class="card">
      <div class="card-body">
      <div class="row">
      <form class="add-new-record modal-content pt-0" id="editMidForm" name="editMidForm" method="POST" action="{{ route('admin.update_mid') }}" v-on:submit="editOnSubmit">
      @csrf
        <input type="hidden" name="id" value="{{$id}}"/>
        <div class="modal-header mb-1">
          <h5 class="modal-title" id="exampleModalLabel">Edit MID</h5>
        </div>
        <div class="modal-body flex-grow-1">
          <div class="mb-1">
            <label class="form-label" for="basic-icon-default-fullname">Name</label>
            <input type="text"  name="name" value="{{ $midData->name}}" class="form-control dt-full-name" id="basic-icon-default-fullname" placeholder="Name" aria-label="John" required/>
          </div>
          <div class="mb-1">
            <label class="form-label" for="basic-icon-default-fullname">Descriptor</label>
            <textarea  class="form-control " rows="3" name="descriptor" id="basic-icon-default-descriptor" placeholder="Descriptor" aria-label="Descriptor" required>{{ $midData->descriptor}}</textarea>
          </div>
          <div class="mb-1">
            <label class="form-label" for="basicSelect">Connector</label>
            <select  class="form-select" id="basicSelect" name="connector">
              <option value="" selected>Select option</option>
              <?php foreach($mid_connector as $key=>$connector){?>
                <option value="<?php echo $key?>" <?php if($midData->connector == $key){echo "selected";}?> ><?php echo $connector?></option>
                <?php }?>
            </select>
          </div>

          <div class="mb-1">
            <label class="form-label" for="basicSelect">Status</label>
            <select class="form-select" id="basicSelect" name="status">
              <option value="active" <?php if($midData->status == "active"){echo "selected";}?>>Active</option>
              <option value="inactive" <?php if($midData->status == "inactive"){echo "selected";}?>>Inactive</option>
            </select>
          </div>
          <button v-if="!isLoader" class="btn btn-primary data-submit me-1 "  type="submit" form="editMidForm" value="editMidForm" >{{ __('Update') }}</button>
          <button v-if="isLoader" class="btn btn-primary data-submit me-1" type="button" disabled>
              <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
              <span class="ms-25 align-middle">Loading...</span>
          </button>
          <!-- <button type="submit" class="btn btn-primary data-submit me-1">Add New</button> -->
          <a href="{{ route('admin.mids')}}" class="btn btn-outline-secondary" >Cancel</a>
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
  <script>var midlistUrl = "{{ route('admin.getmidslist')}}";</script>
  <script src="{{ asset('js/scripts/tables/admin-mid-edit.js') }}"></script>
@endsection

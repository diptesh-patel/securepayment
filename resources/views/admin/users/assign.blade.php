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
<section id="admin_user_assign">
  <div class="row">
    <div class="col-md-6 col-12">
      <div class="card">
          <div class="card-header">
              <h4 class="card-title">Merchants</h4>
          </div>
          <div class="card-body">
              <!-- Multiple Select -->
              <div class="mb-1">
                  <label class="form-label" for="normalMultiSelect">Available</label>
                  <select  class="form-select" style="height:350px" id="availableSelect" multiple="multiple" name="available_user">
                    <?php foreach($merchantData as $user){?>
                        <?php if(!in_array($user->id,$selectedmerchantDataids)){?>
                        <option value="<?php echo $user->id?>"><?php echo $user->name?></option>
                        <?php }?>
                      <?php }?>
                  </select>
              </div>
                     
              <div class="d-flex justify-content-between">
                  <span></span>
                  <button type="button" v-on:click="clickevent('add')" class="btn btn-success waves-effect waves-float waves-light">ADD <i data-feather='arrow-right'></i></button>
              </div>
          </div>
      </div>
    </div>
    
    <div class="col-md-6 col-12">
      <div class="card">
          <div class="card-header">
              <h4 class="card-title">&nbsp;</h4>
          </div>
          <div class="card-body">
              <!-- Multiple Select -->
              <form name="selectedMerchant" id="selectedMerchant" method="POST" action="{{ route('admin.assign_merchant') }}">
                @csrf
                <input type="hidden" v-model="selected_user_ids" value="" name="selected_user_ids" id="selected_user_ids" />
                <input type="hidden"  value="<?php echo $id;?>" name="user_id" id="user_id" />
                <div class="mb-1">
                    <label class="form-label" for="normalMultiSelect">Selected</label>
                    <select class="form-select"  style="height:350px"  id="selectedSelect" multiple="multiple" name="selected_user[]">
                    <?php foreach($selectedmerchantData as $user){?>
                      <option value="<?php echo $user->merchant_id?>"><?php echo $user->users->name?></option>
                      <?php }?>
                      
                    </select>
                </div>
                <div class="d-flex justify-content-between">
                  <button type="button" v-on:click="clickevent('remove')" class="btn btn-danger waves-effect waves-float waves-light"><i data-feather='arrow-left'></i> Remove</button>
                  <span></span>
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
  <script src="{{ asset('js/scripts/tables/admin-user-assign.js') }}"></script>
@endsection

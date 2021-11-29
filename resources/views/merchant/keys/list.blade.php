@extends('layouts.merchant')

@section('title', 'Merchants List')

@section('vendor-style')
  {{-- vendor css files --}}
  <link rel="stylesheet" href="{{ asset('vendors/css/extensions/toastr.min.css') }}">
@endsection
@section('page-style')
  <!-- Page css files -->
  <link rel="stylesheet" href="{{ asset('css/base/plugins/forms/form-validation.css') }}">
  <link rel="stylesheet" href="{{ asset('css/base/plugins/extensions/ext-component-toastr.css') }}">
@endsection


@section('content')
<section id="ApiKeyPage">
  <!-- create API key -->
  <div class="card">
    <div class="card-header pb-0">
      <h4 class="card-title">Create an API Key</h4>
    </div>
    <div class="row">
      <div class="col-md-5 order-md-0 order-1">
        <div class="card-body">
          <p class="card-text">
          If you want to create new Keys then previous key will remove. please attention before create new keys.
        </p>
          <!-- form -->
          <button type="button" class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#addNewKey"> Create Key </button>
          
        </div>
      </div>
      <div class="col-md-7 order-md-1 order-0">
        <div class="text-center">
          <img class="img-fluid text-center" src="{{asset('images/illustration/pricing-Illustration.svg')}}" alt="illustration" width="310"/>
        </div>
      </div>
    </div>
  </div>
  <!-- add new key modal  -->
  <div class="modal fade modal-primary" id="addNewKey" tabindex="-1" aria-labelledby="addNewKeyTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
              <div class="modal-header bg-transparent">
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body px-sm-5 mx-50 pb-5">
                  <h1 class="text-center mb-1 text-danger" id="myModalLabel160">ADD NEW KEYS</h1>
                  <!-- <h2 class="text-center mb-1 text-danger" id="addNewKeyTitle">Confirm !</h2> -->
                  <p class="text-center text-danger">Are you sure you would like to create your keys?</p>
                  <form id="createApiForm" name="createApiForm" method="POST" action="{{ route('merchant.create_key')}}" v-on:submit="createApi" >
                    @csrf
                    <button v-if="!isLoader && currentFormType=='createApiForm'" form="createApiForm" type="submit" class="btn btn-danger w-100">Create Key</button>
                    <button v-if="isLoader && currentFormType=='createApiForm'" class="btn btn-danger w-100" type="button" disabled>
                      <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                      <span class="ms-25 align-middle">Loading...</span>
                    </button>
                  </form>
              </div>
          </div>
      </div>
  </div>
  <!--/ add new key modal  -->
  @if($userKeyData->secret_password)
  <!-- api key list -->
  <div class="card">
    <div class="card-header">
      <h4 class="card-title">API Key & Access</h4>
    </div>
    <div class="card-body">
      <p class="card-text">
        An API key is a simple encrypted string that identifies an application without any principal. They are useful
        for accessing public data anonymously, and are used to associate API requests with your project for quota and
        billing.
      </p>

      <div class="row gy-2">
        
        <div class="col-12">
          <div class="bg-light-secondary position-relative rounded p-2">
            <div class="dropdown dropstart btn-pinned">
              <a class="btn btn-icon rounded-circle hide-arrow dropdown-toggle p-0" href="javascript:void(0)" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" >
                <i data-feather="more-vertical" class="font-medium-4"></i>
              </a>
              <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                <form name="removeApikeyForm" id="removeApikeyForm" action="{{ route('merchant.remove_key')}}" method="POST">
                @csrf
                </form>
                <li>
                  <a class="dropdown-item d-flex align-items-center" href="javascript:void(0)" v-on:click="removeApi">
                    <i data-feather="trash-2" class="me-50"></i><span>Delete</span>
                  </a>
                </li>
              </ul>
            </div>
            <div class="d-flex align-items-center flex-wrap">
              <h4 class="mb-1 me-1">Key Name</h4>
              
            </div>
            <span class="badge badge-light-primary mb-1">Secret Password</span>
            <h6 class="d-flex align-items-center fw-bolder">
              <span class="me-50">{{ $userKeyData->secret_password }}</span>
              <!-- <span><i data-feather="copy" class="font-medium-4 cursor-pointer"></i></span> -->
            </h6>
            <!-- <span>Created on 28 Apr 2020, 18:20 GTM+4:10</span> -->
            <div class="d-flex align-items-center flex-wrap">
              <h4 class="mb-1 me-1"></h4>
              
            </div>
            <span class="badge badge-light-primary mb-1">Secret Key</span>
            <h6 class="d-flex align-items-center fw-bolder">
              <span class="me-50">{{ $userKeyData->secret_key }}</span>
              <!-- <span><i data-feather="copy" class="font-medium-4 cursor-pointer"></i></span> -->
            </h6>
            <!-- <span>Created on 28 Apr 2020, 18:20 GTM+4:10</span> -->
          </div>
        </div>

      </div>
    </div>
  </div>
  
  @endif
</section>
@endsection
@section('vendor-script')
  <!-- vendor files -->
  <script src="{{ asset('vendors/js/forms/validation/jquery.validate.min.js') }}"></script>
  <script src="{{ asset('vendors/js/extensions/toastr.min.js') }}"></script>
@endsection

@section('page-script')
  <!-- Page js files -->
  <script src="{{ asset('js/scripts/pages/page-api-key.js') }}"></script>
@endsection

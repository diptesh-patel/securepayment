@extends('layouts.merchant')

@section('title', 'Token to money')

@section('vendor-style')
  <link rel="stylesheet" href="{{ asset('vendors/css/extensions/nouislider.min.css') }}">
@endsection
@section('page-style')
  <link rel="stylesheet" href="{{ asset('css/base/plugins/extensions/ext-component-sliders.css') }}">
  <link rel="stylesheet" href="{{ asset('css/base/core/colors/palette-noui.css') }}">
@endsection

@section('content')
<!-- Analytics card section -->
<section id="analytics-card">
 
  <div class="row match-height">
    <!--Token to Money Card -->
    <div class="col-lg-12 col-12">
      <div class="card card-revenue-budget">
        <div class="row mx-0">
          <div class="col-md-7 col-12 revenue-report-wrapper">
            <div class="d-sm-flex justify-content-between align-items-center mb-3">
              <h4 class="card-title mb-50 mb-sm-0">Token to Money</h4>
              
            </div>
            <div class="col-sm-12">
                <div class="card">
                  <div class="card-header">
                    <h4 class="card-title">AMOUNT TO TRANSFER</h4>
                  </div>
                  <div class="card-body">
                    <h5 class="my-2">Your token balance : <span class="text-success"> 56,800</span> (Token Value  <b> 1P= 1.00</b> <span class="text-danger">USD</span>)</h5>
                    <div id="default-color-slider" class=" mt-3 mb-4"></div>
                    
                  </div>
                </div>
              </div>
          </div>
          <div class="col-md-5 col-12 budget-wrapper">
            <div class="btn-group">
              <button
                type="button"
                class="btn btn-outline-primary btn-sm "
                
                aria-haspopup="true"
                aria-expanded="false"
              >
                Total
              </button>
              
            </div>
            <h2 class="mb-25 text-danger">$25,852</h2>
            <div class="d-flex justify-content-center">
              <span class="fw-bolder me-25">TOKEN BALANCE :</span>
              <span class="text-success"> 56,800</span>
            </div>
            <div id="budget-chart"></div>
            <button type="button" class="btn btn-primary">Request Transfer</button>
          </div>
        </div>
      </div>
    </div>
    <!--/ Revenue Report Card -->
    
  </div>

</section>
<!--/ Analytics Card section -->

@endsection
@section('vendor-script')
  <!-- vendor files -->
  <script src="{{ asset('vendors/js/extensions/wNumb.min.js') }}"></script>
  <script src="{{ asset('vendors/js/extensions/nouislider.min.js') }}"></script>
@endsection
@section('page-script')
  <!-- Page js files -->
  <script src="{{ asset('js/scripts/extensions/ext-component-sliders.js') }}"></script>
@endsection

@extends('layouts.admin')

@section('title', 'Dashboard')

@section('vendor-style')
  {{-- vendor css files --}}
  <link rel="stylesheet" href="{{ asset('vendors/css/charts/apexcharts.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/css/extensions/toastr.min.css') }}">
 
@endsection
@section('page-style')
  {{-- Page css files --}}
  <link rel="stylesheet" href="{{ asset('css/base/pages/dashboard-ecommerce.css') }}">
  <link rel="stylesheet" href="{{ asset('css/base/plugins/charts/chart-apex.css') }}">
  <link rel="stylesheet" href="{{ asset('css/base/plugins/extensions/ext-component-toastr.css') }}">
@endsection

@section('content')
<!-- Dashboard Analytics Start -->
<section id="dashboard-analytics">
  <div class="row match-height">
    <!-- Greetings Card starts -->
    <div class="col-lg-6 col-md-12 col-sm-12">
      <div class="card card-congratulations">
        <div class="card-body text-center">
          <img
            src="{{asset('images/elements/decore-left.png')}}"
            class="congratulations-img-left"
            alt="card-img-left"
          />
          <img
            src="{{asset('images/elements/decore-right.png')}}"
            class="congratulations-img-right"
            alt="card-img-right"
          />
          <div class="avatar avatar-xl bg-primary shadow">
            <div class="avatar-content">
              <i data-feather="award" class="font-large-1"></i>
            </div>
          </div>
          <div class="text-center">
            <h1 class="mb-1 text-white">Welcome to SecureEpayment <br/> 
                @if (Auth::check())
                {{ ucfirst(Auth::user()->name) }}
                @endif
                </h1>
            <p class="card-text m-auto w-75">
              ({{ (Auth::user()->role_id == 1) ?'Admin' : 'Merchant' }})
            </p>
          </div>
        </div>
      </div>
    </div>
    <!-- Greetings Card ends -->

    <!-- Subscribers Chart Card starts -->
    <div class="col-lg-3 col-sm-6 col-12">
      <div class="card">
        <div class="card-header flex-column align-items-start pb-0">
          <div class="avatar bg-light-primary p-50 m-0">
            <div class="avatar-content">
              <i data-feather="users" class="font-medium-5"></i>
            </div>
          </div>
          <h2 class="fw-bolder mt-1">92.6k</h2>
          <p class="card-text">Subscribers Merchant</p>
        </div>
        <div id="gained-chart"></div>
      </div>
    </div>
    <!-- Subscribers Chart Card ends -->

    <!-- Orders Chart Card starts -->
    <div class="col-lg-3 col-sm-6 col-12">
      <div class="card">
        <div class="card-header flex-column align-items-start pb-0">
          <div class="avatar bg-light-warning p-50 m-0">
            <div class="avatar-content">
              <i data-feather="package" class="font-medium-5"></i>
            </div>
          </div>
          <h2 class="fw-bolder mt-1">38.4K</h2>
          <p class="card-text">Orders Received</p>
        </div>
        <div id="order-chart"></div>
      </div>
    </div>
    <!-- Orders Chart Card ends -->
  </div>
  <div class="row match-height">
    <!-- Company Table Card -->
    <div class="col-lg-12 col-12">
      <div class="card card-company-table">
        <div class="card-header">
          <div class="d-flex align-items-center">
            <i data-feather="list" class="user-timeline-title-icon"></i>
            <h4 class="card-title"> Recent Joined Mercahnt</h4>
            
          </div>
          <a class="right" href="javascript:;">View All</a>
        </div>
        <div class="card-body p-0">
          <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th></th>
                  <th>#ID</th>
                  <th>Merchant Name</th>
                  <th>User Name</th>
                  <th>Balance</th>
                  <th>Create Date</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>
                      <div class="d-flex align-items-center">
                        <div class="avatar rounded">
                          <div class="avatar-content">
                          <img  src="{{asset('images/portrait/small/avatar-s-14.jpg')}}"  width="34"  height="34"  alt="Avatar"  />
                          </div>
                        </div>
                      </div>
                  </td>
                  <td>04f75aca-b39f-472d-9c8d-eea05c4b1e4f</td>
                  <td>
                    <div class="d-flex align-items-center">
                      <span>Neotrade FX</span>
                    </div>
                  </td>
                  <td class="text-nowrap">
                    <div class="d-flex flex-column">
                    
                      <span class="fw-bolder mb-25">paul@neotradefx.com</span>
                    </div>
                  </td>
                  <td>$891.2</td>
                  <td>
                    <div class="d-flex align-items-center">
                      <span class="fw-bolder me-1">Wed Oct 13 2021</span>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>
                      <div class="d-flex align-items-center">
                        <div class="avatar rounded">
                          <div class="avatar-content">
                          <img  src="{{asset('images/portrait/small/avatar-s-14.jpg')}}"  width="34"  height="34"  alt="Avatar"  />
                          </div>
                        </div>
                      </div>
                  </td>
                  <td>04f75aca-b39f-472d-9c8d-eea05c4b1e4f</td>
                  <td>
                    <div class="d-flex align-items-center">
                      <span>Neotrade FX</span>
                    </div>
                  </td>
                  <td class="text-nowrap">
                    <div class="d-flex flex-column">
                    
                      <span class="fw-bolder mb-25">paul@neotradefx.com</span>
                    </div>
                  </td>
                  <td>$891.2</td>
                  <td>
                    <div class="d-flex align-items-center">
                      <span class="fw-bolder me-1">Wed Oct 13 2021</span>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>
                      <div class="d-flex align-items-center">
                        <div class="avatar rounded">
                          <div class="avatar-content">
                          <img  src="{{asset('images/portrait/small/avatar-s-14.jpg')}}"  width="34"  height="34"  alt="Avatar"  />
                          </div>
                        </div>
                      </div>
                  </td>
                  <td>04f75aca-b39f-472d-9c8d-eea05c4b1e4f</td>
                  <td>
                    <div class="d-flex align-items-center">
                      <span>Neotrade FX</span>
                    </div>
                  </td>
                  <td class="text-nowrap">
                    <div class="d-flex flex-column">
                    
                      <span class="fw-bolder mb-25">paul@neotradefx.com</span>
                    </div>
                  </td>
                  <td>$891.2</td>
                  <td>
                    <div class="d-flex align-items-center">
                      <span class="fw-bolder me-1">Wed Oct 13 2021</span>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>
                      <div class="d-flex align-items-center">
                        <div class="avatar rounded">
                          <div class="avatar-content">
                          <img  src="{{asset('images/portrait/small/avatar-s-14.jpg')}}"  width="34"  height="34"  alt="Avatar"  />
                          </div>
                        </div>
                      </div>
                  </td>
                  <td>04f75aca-b39f-472d-9c8d-eea05c4b1e4f</td>
                  <td>
                    <div class="d-flex align-items-center">
                      <span>Neotrade FX</span>
                    </div>
                  </td>
                  <td class="text-nowrap">
                    <div class="d-flex flex-column">
                    
                      <span class="fw-bolder mb-25">paul@neotradefx.com</span>
                    </div>
                  </td>
                  <td>$891.2</td>
                  <td>
                    <div class="d-flex align-items-center">
                      <span class="fw-bolder me-1">Wed Oct 13 2021</span>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>
                      <div class="d-flex align-items-center">
                        <div class="avatar rounded">
                          <div class="avatar-content">
                          <img  src="{{asset('images/portrait/small/avatar-s-14.jpg')}}"  width="34"  height="34"  alt="Avatar"  />
                          </div>
                        </div>
                      </div>
                  </td>
                  <td>04f75aca-b39f-472d-9c8d-eea05c4b1e4f</td>
                  <td>
                    <div class="d-flex align-items-center">
                      <span>Neotrade FX</span>
                    </div>
                  </td>
                  <td class="text-nowrap">
                    <div class="d-flex flex-column">
                    
                      <span class="fw-bolder mb-25">paul@neotradefx.com</span>
                    </div>
                  </td>
                  <td>$891.2</td>
                  <td>
                    <div class="d-flex align-items-center">
                      <span class="fw-bolder me-1">Wed Oct 13 2021</span>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>
                      <div class="d-flex align-items-center">
                        <div class="avatar rounded">
                          <div class="avatar-content">
                          <img  src="{{asset('images/portrait/small/avatar-s-14.jpg')}}"  width="34"  height="34"  alt="Avatar"  />
                          </div>
                        </div>
                      </div>
                  </td>
                  <td>04f75aca-b39f-472d-9c8d-eea05c4b1e4f</td>
                  <td>
                    <div class="d-flex align-items-center">
                      <span>Neotrade FX</span>
                    </div>
                  </td>
                  <td class="text-nowrap">
                    <div class="d-flex flex-column">
                    
                      <span class="fw-bolder mb-25">paul@neotradefx.com</span>
                    </div>
                  </td>
                  <td>$891.2</td>
                  <td>
                    <div class="d-flex align-items-center">
                      <span class="fw-bolder me-1">Wed Oct 13 2021</span>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>
                      <div class="d-flex align-items-center">
                        <div class="avatar rounded">
                          <div class="avatar-content">
                          <img  src="{{asset('images/portrait/small/avatar-s-14.jpg')}}"  width="34"  height="34"  alt="Avatar"  />
                          </div>
                        </div>
                      </div>
                  </td>
                  <td>04f75aca-b39f-472d-9c8d-eea05c4b1e4f</td>
                  <td>
                    <div class="d-flex align-items-center">
                      <span>Neotrade FX</span>
                    </div>
                  </td>
                  <td class="text-nowrap">
                    <div class="d-flex flex-column">
                    
                      <span class="fw-bolder mb-25">paul@neotradefx.com</span>
                    </div>
                  </td>
                  <td>$891.2</td>
                  <td>
                    <div class="d-flex align-items-center">
                      <span class="fw-bolder me-1">Wed Oct 13 2021</span>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>
                      <div class="d-flex align-items-center">
                        <div class="avatar rounded">
                          <div class="avatar-content">
                          <img  src="{{asset('images/portrait/small/avatar-s-14.jpg')}}"  width="34"  height="34"  alt="Avatar"  />
                          </div>
                        </div>
                      </div>
                  </td>
                  <td>04f75aca-b39f-472d-9c8d-eea05c4b1e4f</td>
                  <td>
                    <div class="d-flex align-items-center">
                      <span>Neotrade FX</span>
                    </div>
                  </td>
                  <td class="text-nowrap">
                    <div class="d-flex flex-column">
                    
                      <span class="fw-bolder mb-25">paul@neotradefx.com</span>
                    </div>
                  </td>
                  <td>$891.2</td>
                  <td>
                    <div class="d-flex align-items-center">
                      <span class="fw-bolder me-1">Wed Oct 13 2021</span>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>
                      <div class="d-flex align-items-center">
                        <div class="avatar rounded">
                          <div class="avatar-content">
                          <img  src="{{asset('images/portrait/small/avatar-s-14.jpg')}}"  width="34"  height="34"  alt="Avatar"  />
                          </div>
                        </div>
                      </div>
                  </td>
                  <td>04f75aca-b39f-472d-9c8d-eea05c4b1e4f</td>
                  <td>
                    <div class="d-flex align-items-center">
                      <span>Neotrade FX</span>
                    </div>
                  </td>
                  <td class="text-nowrap">
                    <div class="d-flex flex-column">
                    
                      <span class="fw-bolder mb-25">paul@neotradefx.com</span>
                    </div>
                  </td>
                  <td>$891.2</td>
                  <td>
                    <div class="d-flex align-items-center">
                      <span class="fw-bolder me-1">Wed Oct 13 2021</span>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>
                      <div class="d-flex align-items-center">
                        <div class="avatar rounded">
                          <div class="avatar-content">
                          <img  src="{{asset('images/portrait/small/avatar-s-14.jpg')}}"  width="34"  height="34"  alt="Avatar"  />
                          </div>
                        </div>
                      </div>
                  </td>
                  <td>04f75aca-b39f-472d-9c8d-eea05c4b1e4f</td>
                  <td>
                    <div class="d-flex align-items-center">
                      <span>Neotrade FX</span>
                    </div>
                  </td>
                  <td class="text-nowrap">
                    <div class="d-flex flex-column">
                    
                      <span class="fw-bolder mb-25">paul@neotradefx.com</span>
                    </div>
                  </td>
                  <td>$891.2</td>
                  <td>
                    <div class="d-flex align-items-center">
                      <span class="fw-bolder me-1">Wed Oct 13 2021</span>
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
    

</section>
<!-- Dashboard Analytics end -->
@endsection

@section('vendor-script')
  <!-- vendor files -->
  <script src="{{ asset('vendors/js/extensions/toastr.min.js') }}"></script>
  
@endsection
@section('page-script')
  <!-- Page js files -->
  <script src="{{ asset('js/scripts/pages/dashboard-analytics.js') }}"></script>
@endsection

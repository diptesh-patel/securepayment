@extends('layouts.merchant')

@section('title', 'Pricing')

@section('page-style')
{{-- Page Css files --}}
<link rel="stylesheet" type="text/css" href="{{asset('css/base/pages/page-pricing.css')}}">
@endsection

@section('content')
<section id="pricing-plan">
  <!-- title text and switch button -->
  <div class="text-center">
    <h1 class="mt-5">Pricing Plans</h1>
    <p class="mb-2 pb-75">
      All plans include advanced tools and features to boost your product. Choose the best plan to fit your needs.
    </p>
    
  </div>
  <!--/ title text and switch button -->

  <!-- pricing plan cards -->
  <div class="row pricing-card">
    <div class="col-12 col-sm-offset-2 col-sm-10 col-md-12 col-lg-offset-2 col-lg-10 mx-auto">
      <div class="row">
        <!-- basic plan -->
        <div class="col-12 col-md-4">
          <div class="card basic-pricing text-center">
            <div class="card-body">
              <img src="{{asset('images/illustration/Pot1.svg')}}" class="mb-2 mt-5" alt="svg img" />
              <h3>Basic</h3>
              <p class="card-text">A simple start for everyone</p>
              <div class="annual-plan">
                <div class="plan-price mt-2">
                  <sup class="font-medium-1 fw-bold text-primary">$</sup>
                  <span class="pricing-basic-value fw-bolder text-primary">0</span>
                  <sub class="pricing-duration text-body font-medium-1 fw-bold">/month</sub>
                </div>
                <small class="annual-pricing d-none text-muted"></small>
              </div>
              <ul class="list-group list-group-circle text-start">
                <li class="list-group-item">100 responses a month</li>
                <li class="list-group-item">Unlimited forms and surveys</li>
                <li class="list-group-item">Unlimited fields</li>
                <li class="list-group-item">Basic form creation tools</li>
                <li class="list-group-item">Up to 2 subdomains</li>
              </ul>
              <button class="btn w-100 btn-outline-success mt-2">Your current plan</button>
            </div>
          </div>
        </div>
        <!--/ basic plan -->

        <!-- standard plan -->
        <div class="col-12 col-md-4">
          <div class="card standard-pricing popular text-center">
            <div class="card-body">
              <div class="pricing-badge text-end">
                <span class="badge rounded-pill badge-light-primary">Popular</span>
              </div>
              <img src="{{asset('images/illustration/Pot2.svg')}}" class="mb-1" alt="svg img" />
              <h3>Standard</h3>
              <p class="card-text">For small to medium businesses</p>
              <div class="annual-plan">
                <div class="plan-price mt-2">
                  <sup class="font-medium-1 fw-bold text-primary">$</sup>
                  <span class="pricing-standard-value fw-bolder text-primary">49</span>
                  <sub class="pricing-duration text-body font-medium-1 fw-bold">/month</sub>
                </div>
                <small class="annual-pricing d-none text-muted"></small>
              </div>
              <ul class="list-group list-group-circle text-start">
                <li class="list-group-item">Unlimited responses</li>
                <li class="list-group-item">Unlimited forms and surveys</li>
                <li class="list-group-item">Instagram profile page</li>
                <li class="list-group-item">Google Docs integration</li>
                <li class="list-group-item">Custom “Thank you” page</li>
              </ul>
              <button class="btn w-100 btn-primary mt-2">Upgrade</button>
            </div>
          </div>
        </div>
        <!--/ standard plan -->

        <!-- enterprise plan -->
        <div class="col-12 col-md-4">
          <div class="card enterprise-pricing text-center">
            <div class="card-body">
              <img src="{{asset('images/illustration/Pot3.svg')}}" class="mb-2" alt="svg img" />
              <h3>Enterprise</h3>
              <p class="card-text">Solution for big organizations</p>
              <div class="annual-plan">
                <div class="plan-price mt-2">
                  <sup class="font-medium-1 fw-bold text-primary">$</sup>
                  <span class="pricing-enterprise-value fw-bolder text-primary">99</span>
                  <sub class="pricing-duration text-body font-medium-1 fw-bold">/month</sub>
                </div>
                <small class="annual-pricing d-none text-muted"></small>
              </div>
              <ul class="list-group list-group-circle text-start">
                <li class="list-group-item">PayPal payments</li>
                <li class="list-group-item">Logic Jumps</li>
                <li class="list-group-item">File upload with 5GB storage</li>
                <li class="list-group-item">Custom domain support</li>
                <li class="list-group-item">Stripe integration</li>
              </ul>
              <button class="btn w-100 btn-outline-primary mt-2">Upgrade</button>
            </div>
          </div>
        </div>
        <!--/ enterprise plan -->
      </div>
    </div>
  </div>
  <!--/ pricing plan cards -->

</section>
@endsection
@section('page-script')
{{-- Page js files --}}
<script src="{{asset('js/scripts/pages/page-pricing.js')}}"></script>
@endsection

<!-- two factor auth modal -->
<div class="modal fade" id="twoFactorAuthModal" tabindex="-1" aria-labelledby="twoFactorAuthTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg two-factor-auth">
    <div class="modal-content">
      <div class="modal-header bg-transparent">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body pb-5 px-sm-5 mx-50">
        <h1 class="text-center mb-1" id="twoFactorAuthTitle">Select Authentication Method</h1>
        <p class="text-center mb-3">
          you also need to select a method by which the proxy
          <br />
          authenticates to the directory serve
        </p>

        <div class="custom-options-checkable">
          <input class="custom-option-item-check" type="radio" name="twoFactorAuthRadio" id="twoFactorAuthApps" value="apps-auth" checked="checked" />
          <label for="twoFactorAuthApps" class="custom-option-item d-flex align-items-center flex-column flex-sm-row px-3 py-2 mb-2">
            <span><i data-feather="settings" class="font-large-2 me-sm-2 mb-2 mb-sm-0"></i></span>
            <span>
              <span class="custom-option-item-title h3">Authenticator Apps</span>
              <span class="d-block mt-75">
                Get codes from an app like Google Authenticator, Microsoft Authenticator, Authy or 1Password.
              </span>
            </span>
          </label>
        </div>

        <button id="nextStepAuth" class="btn btn-primary float-end mt-3">
          <span class="me-50">Continue</span>
          <i data-feather="chevron-right"></i>
        </button>
      </div>
    </div>
  </div>
</div>
<!-- / two factor auth modal -->

<!-- add authentication apps modal -->
<div class="modal fade" id="twoFactorAuthAppsModal" tabindex="-1" aria-labelledby="twoFactorAuthAppsTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg two-factor-auth-apps">
    <div class="modal-content">
      <div class="modal-header bg-transparent">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body pb-5 px-sm-5 mx-50">
        @if($is_google2fa_enabled)
        <h1 class="text-center mb-2 pb-50" id="twoFactorAuthAppsTitle">Add Authenticator App</h1>
        @endif
        @if(!$is_google2fa_enabled)
        <h1 class="text-center mb-2 pb-50" id="twoFactorAuthAppsTitle">Disable  Google Authenticator App</h1>
        @endif

        <h4>Authenticator Apps</h4>
        <p>
          Using an authenticator app like Google Authenticator, Microsoft Authenticator, Authy, or 1Password, scan the
          QR code. It will generate a 6 digit code for you to enter below.
        </p>
        @if($is_google2fa_enabled)
        <div class="d-flex justify-content-center my-2 py-50">
          {!! $qr_image !!}
        </div>
       
        <div class="alert alert-warning" role="alert">
          <h4 class="alert-heading">{{ $google2fa_secret}}</h4>
          <div class="alert-body fw-normal">
            If you having trouble using the QR code, select manual entry on your app
          </div>
        </div>
        @endif  
        <form class="row gy-1" id="google2faForm" name="google2faForm" method="POST" action="{{ route('merchant.verifyGoogle2FAKey')}}" v-on:submit="google2faFormOnSubmit">
          @csrf
          <input type="hidden" name="verify_action" value="{{ $verify_action }}"/>
          <div class="col-12">
            <input class="form-control" name="one_time_password" v-model="one_time_password" id="authenticationCode" type="text" placeholder="Enter authentication code" />
            <input class="form-control" name="google2fa_secret" id="google2fa_secret"  type="hidden"  value="{{ $google2fa_secret}}"/>
          </div>
          <div class="col-12 d-flex justify-content-end">
            <button type="reset" class="btn btn-outline-secondary mt-2 me-1" data-bs-dismiss="modal" aria-label="Close">
              Cancel
            </button>
            <button v-if="!isLoader" type="submit" class="btn btn-primary mt-2" form="google2faForm">
              <span class="me-50">Continue</span>
              <i data-feather="chevron-right"></i>
            </button>
            <button v-if="isLoader" class="btn btn-primary mt-2" type="button" disabled>
              <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
              <span class="ms-25 align-middle">Loading...</span>
          </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- / add authentication apps modal-->



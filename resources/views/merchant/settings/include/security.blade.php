<div class="tab-pane" id="profileIcon" aria-labelledby="profileIcon-tab" role="tabpanel">
       <!-- two-step verification -->
       <div class="card">
       <div class="card-header border-bottom">
              <h4 class="card-title">Two-step verification</h4>
       </div>
       <div class="card-body my-2 py-25">
              @if($is_google2fa_enabled)
              <p class="fw-bolder">Two factor authentication is not enabled yet.</p>
              @endif
              @if(!$is_google2fa_enabled)
              <p class="fw-bolder">Two factor authentication is enabled.</p>
              @endif
              <p>
              Two-factor authentication adds an additional layer of security to your account by requiring <br />
              more than just a password to log in. Learn more.
              </p>
              <!-- buttons -->
              @if($is_google2fa_enabled)
              <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#twoFactorAuthModal">
              Enable two-factor authentication
              </button>
              @endif
              @if(!$is_google2fa_enabled)
              <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#twoFactorAuthModal">
              Disable two-factor authentication
              </button>
              @endif
              
       </div>
       </div>
       <!-- / two-step verification -->
</div>
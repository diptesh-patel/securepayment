<button style="display: none;;" type="button" class="btn btn-primary" data-bs-backdrop="static" data-bs-keyboard="false" data-bs-toggle="modal" data-bs-target="#verifyTwoFactorAuth">open modal</button>
<div class="modal fade" id="verifyTwoFactorAuth" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="verifyTwoFactorAuthTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-transparent">
        
      </div>
      <div class="modal-body px-sm-5 mx-50 pb-5">
        <h1 class="text-center mb-1" id="addNewCardTitle">Google Two Factor Authentication</h1>
        <p class="text-center">Add authentication code for secure login</p>

        <!-- form -->
        <form id="verifyTwoFactorAuthForm" name="verifyTwoFactorAuthForm" method="POST" action="{{ route('login') }}" class="row gy-1 gx-2 mt-75" v-on:submit="loginOnSubmit">
         @csrf
          <div class="col-12">
            <label class="form-label" for="authentication_code">Authentication code</label>
            <div class="input-group input-group-merge">
              <input id="authentication_code" name="authentication_code" v-model="authentication_code" class="form-control add-credit-card-mask" type="text" placeholder="Enter Authentication code" aria-describedby="authentication_code" data-msg="Please enter Authentication code"/>
            </div>
          </div>

          <div class="col-12 text-center">
            <button v-if="!isLoader" form="loginForm" type="submit" class="btn btn-primary me-1 mt-1">Authenticate</button>
            <button v-if="isLoader" class="btn btn-primary me-1 mt-1" type="button" disabled>
              <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
              <span class="ms-25 align-middle">Loading...</span>
          </button>
            <button v-on:click="closemodal" type="reset"  class="btn btn-outline-secondary mt-1" data-bs-dismiss="modal" aria-label="Close" >
              Cancel
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

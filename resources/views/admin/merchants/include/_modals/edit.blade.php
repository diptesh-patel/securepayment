<div class="modal modal-slide-in fade" id="modals-slide-in">
    <div class="modal-dialog sidebar-sm">
      <form class="add-new-record modal-content pt-0" id="editMerchantForm" name="editMerchantForm" method="POST" action="{{ route('admin.edit_merchant') }}" v-on:submit="addOnSubmit">
      @csrf
        <button type="button" class="btn-close" id="closebtn" data-bs-dismiss="modal" aria-label="Close">×</button>
        <div class="modal-header mb-1">
          <h5 class="modal-title" id="exampleModalLabel">Edit Merchant</h5>
        </div>
        <div class="modal-body flex-grow-1">
          <div class="mb-1">
            <label class="form-label" for="basic-icon-default-fullname">Name</label>
            <input
              type="text"
              v-model="name"  name="name"
              class="form-control dt-full-name"
              id="basic-icon-default-fullname"
              placeholder="John Doe"
              aria-label="John Doe" required
            />
          </div>
          <div class="mb-1">
            <label class="form-label" for="basic-icon-default-fullname">Notification URL</label>
            <input
              type="text"
              v-model="notification_url" name="notification_url"
              class="form-control dt-notification-url"
              id="basic-icon-default-notification-url"
              placeholder="" required
              aria-label=""
            />
          </div>
          <div class="mb-1">
            <label class="form-label" for="basic-icon-default-email">Email</label>
            <input
              type="text" v-model="email" name="email"
              id="basic-icon-default-email"
              class="form-control dt-email"
              placeholder="john.doe@example.com"
              aria-label="john.doe@example.com" required
            />
          </div>
          <div class="mb-1">
            <label class="form-label" for="basic-icon-default-password">Password</label>
            <input v-model="password" required name="password" type="password"  id="basic-icon-default-password"  class="form-control dt-password"  placeholder=""  aria-label="" />
          </div>
          <button v-if="!isLoader" class="btn btn-primary data-submit me-1 "  type="submit" form="editMerchantForm" value="editMerchantForm" >{{ __('Add New') }}</button>
          <button v-if="isLoader" class="btn btn-primary data-submit me-1" type="button" disabled>
              <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
              <span class="ms-25 align-middle">Loading...</span>
          </button>
          <!-- <button type="submit" class="btn btn-primary data-submit me-1">Add New</button> -->
          <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
          <div v-if="errorMessage" class="mt-1">
            <div v-for="error in errorMessage" class="alert alert-danger" role="alert">
                
                <div class="alert-body">@{{ error[0] }}</div>
            </div>
          </div>
          
        </div>
      </form>
    </div>
  </div>
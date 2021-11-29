<div class="tab-pane active" id="aboutIcon" aria-labelledby="aboutIcon-tab" role="tabpanel">
  <!-- profile -->
  <div class="card">
    <div class="card-header border-bottom">
      <h4 class="card-title">Profile Details</h4>
    </div>
    <div class="card-body py-2 my-25">
      

      <!-- form -->
      <form class="validate-form mt-2 pt-50">
        <div class="row">
          <div class="col-12 col-sm-6 mb-1">
            <label class="form-label" for="accountFirstName">First Name</label>
            <input
              type="text"
              class="form-control"
              id="accountFirstName"
              name="firstName"
              placeholder="John"
              value="John"
              data-msg="Please enter first name"
            />
          </div>
          <div class="col-12 col-sm-6 mb-1">
            <label class="form-label" for="accountLastName">Last Name</label>
            <input
              type="text"
              class="form-control"
              id="accountLastName"
              name="lastName"
              placeholder="Doe"
              value="Doe"
              data-msg="Please enter last name"
            />
          </div>
          <div class="col-12 col-sm-6 mb-1">
            <label class="form-label" for="accountEmail">Email</label>
            <input
              type="email"
              class="form-control"
              id="accountEmail"
              name="email"
              placeholder="Email"
              value="johndoe@gmail.com"
            />
          </div>
          
          <div class="col-12 col-sm-6 mb-1">
            <label class="form-label" for="accountPhoneNumber">Phone Number</label>
            <input
              type="text"
              class="form-control account-number-mask"
              id="accountPhoneNumber"
              name="phoneNumber"
              placeholder="Phone Number"
              value="457 657 1237"
            />
          </div>
          <div class="col-12 col-sm-6 mb-1">
            <label class="form-label" for="accountAddress">Address</label>
            <input type="text" class="form-control" id="accountAddress" name="address" placeholder="Your Address" />
          </div>
          <div class="col-12 col-sm-6 mb-1">
            <label class="form-label" for="accountState">State</label>
            <input type="text" class="form-control" id="accountState" name="state" placeholder="State" />
          </div>
          <div class="col-12 col-sm-6 mb-1">
            <label class="form-label" for="accountZipCode">Zip Code</label>
            <input
              type="text"
              class="form-control account-zip-code"
              id="accountZipCode"
              name="zipCode"
              placeholder="Code"
              maxlength="6"
            />
          </div>
          <div class="col-12 col-sm-6 mb-1">
            <label class="form-label" for="country">Country</label>
            <select id="country" class="select2 form-select">
              <option value="">Select Country</option>
              <option value="Australia">Australia</option>
              <option value="Bangladesh">Bangladesh</option>
              <option value="Belarus">Belarus</option>
              <option value="Brazil">Brazil</option>
              <option value="Canada">Canada</option>
              <option value="China">China</option>
              <option value="France">France</option>
              <option value="Germany">Germany</option>
              <option value="India">India</option>
              <option value="Indonesia">Indonesia</option>
              <option value="Israel">Israel</option>
              <option value="Italy">Italy</option>
              <option value="Japan">Japan</option>
              <option value="Korea">Korea, Republic of</option>
              <option value="Mexico">Mexico</option>
              <option value="Philippines">Philippines</option>
              <option value="Russia">Russian Federation</option>
              <option value="South Africa">South Africa</option>
              <option value="Thailand">Thailand</option>
              <option value="Turkey">Turkey</option>
              <option value="Ukraine">Ukraine</option>
              <option value="United Arab Emirates">United Arab Emirates</option>
              <option value="United Kingdom">United Kingdom</option>
              <option value="United States">United States</option>
            </select>
          </div>
          
          
          <div class="col-12">
            <button type="submit" class="btn btn-primary mt-1 me-1">Save changes</button>
            <button type="reset" class="btn btn-outline-secondary mt-1">Discard</button>
          </div>
        </div>
      </form>
      <!--/ form -->
    </div>
  </div>
</div>
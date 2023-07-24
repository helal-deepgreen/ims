     <!-- Edit User Modal -->
     <div class="modal fade" id="modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-simple modal-edit-user">
          <div class="modal-content p-3 p-md-5">
            <div class="modal-body">
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              <div class="text-center mb-4">
                <h3 class="mb-2">Customer Details</h3>

              </div>
              <form id="submit" action="{{ route('customers.store') }}" method="POST" class="row g-3">
                @csrf
              {{-- <form id="editUserForm" class="row g-3" onsubmit="return false"> --}}
                <div class="col-12 col-md-6">
                  <label class="form-label" for="modalEditUserFirstName">Name</label>
                  <input
                    type="text"
                    id="name"
                    name="name"
                    class="form-control"
                    placeholder="Name" required
                  />
                </div>

                <div class="col-12 col-md-6">
                  <label class="form-label" for="email">Email</label>
                  <input
                    type="email"
                    id="email"
                    name="email"
                    class="form-control"
                    placeholder="Email"
                  />
                </div>
                <div class="col-12 col-md-6">
                    <label class="form-label" for="phone">Phone Number</label>
                    <div class="input-group">
                      <span class="input-group-text">US (+88)</span>
                      <input
                        type="text"
                        id="phone"
                        name="phone"
                        class="form-control phone-number-mask"
                        placeholder="202 555 0111" required
                      />
                    </div>
                  </div>
                  <div class="col-12 col-md-6">
                    <label class="form-label" for="bank_name">Bank Name</label>
                    <select
                    id="bank_name"
                    name="bank_name"
                    class="select2 form-select"
                    data-allow-clear="true"
                  >
                  <option value="">Select a bank:</option>
                  <option value="BRI" selected="selected">BRI</option>
                  <option value="BNI" selected="selected">BNI</option>
                  <option value="BCA" selected="selected">BCA</option>
                  <option value="BSI" selected="selected">BSI</option>

                  </select>
                  </div>
                  <div class="col-12 col-md-6">
                    <label class="form-label" for="account_number">Account Number</label>
                    <input
                      type="text"
                      id="account_number"
                      name="account_number"
                      class="form-control"
                      placeholder="Account Number"
                    />
                  </div>
                <div class="col-12 col-md-6">
                  <label class="form-label" for="account_holder">Account holder</label>
                  <div class="input-group">
                    <input
                      type="text"
                      id="account_holder"
                      name="account_holder"
                      class="form-control phone-number-mask"
                      placeholder="Account holder"
                    />
                  </div>
                </div>

                <div class="col-12 col-md-12">
                    <label class="form-label" for="address">Account Number</label>
                    <textarea class="form-control form-control-solid" id="address" name="address" rows="3">{{ old('address') }}</textarea>
                  </div>

                <div class="col-12 text-center">
                  <button id="addBtn" type="submit" class="btn btn-primary me-sm-3 me-1">Submit</button>
                  <button
                    type="reset"
                    class="btn btn-label-secondary"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                  >
                    Cancel
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!--/ Edit User Modal -->

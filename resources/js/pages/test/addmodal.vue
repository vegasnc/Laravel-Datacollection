<template>
  <div
    class="modal fade"
    id="TestAddModal"
    tabindex="-1"
    role="dialog"
    aria-labelledby="TestAddModelLabel"
    aria-hidden="true"
  >
    <div class="modal-dialog modal-dialog-slideout modal-lg" role="document">
      <div class="modal-content">
        <form
          method="POST"
          id="addNewOccupantForm"
          @submit.prevent="processCreateUsers()"
        >
          <div class="modal-header">
            <h5 class="modal-title" id="TestAddModelLabel">
              Add Users
            </h5>
            <button
              type="button"
              class="close"
              data-dismiss="modal"
              aria-label="Close"
            >
              <span aria-hidden="true">×</span>
            </button>
          </div>

          <div class="modal-body">
            <input
              type="hidden"
              name="_token"
              value="Pg7EYC6HZnsPU6mYDpkg5VRZ8mlgbIXv3mAWHrs7"
            />
            <div class="box-body">
              <div class="form-group row">
                <div class="col-md-6">
                  <label for="Name" class="col-form-label text-md-right"
                    >Name<span class="required text-danger">*</span></label
                  >
                  <input
                    id="name"
                    type="text"
                    class="form-control"
                    name="name"
                    value=""
                    v-model="form.name"
                    autocomplete="name"
                    autofocus
                    required
                  />
                </div>

                <div class="col-md-6">
                  <label for="Name" class="col-form-label text-md-right"
                    >mobileNo<span class="required text-danger">*</span></label
                  >
                  <input
                    id="mobileNo"
                    type="text"
                    class="form-control"
                    name="mobileNo"
                    value=""
                    v-model="form.mobileNo"
                    autocomplete="mobileNo"
                    autofocus
                    required
                  />
                </div>
              </div>

              <div class="form-group row">
                <div class="col-md-6">
                  <label for="Email" class="col-form-label text-md-right"
                    >Email<span class="required text-danger">*</span></label
                  >
                  <input
                    id="email"
                    type="text"
                    class="form-control"
                    name="email"
                    value=""
                    v-model="form.email"
                    autocomplete="email"
                    autofocus
                    required
                  />
                </div>
              </div>

              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="latitude"
                      >Latitude<span class="required text-danger">*</span></label
                    >
                    <input
                      id="latitude"
                      type="text"
                      class="form-control"
                      name="latitude"
                      value=""
                      v-model="form.latitude"
                      required
                      autocomplete="latitude"
                      autofocus
                    />
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="longitude"
                      >Longitude<span class="required text-danger"
                        >*</span
                      ></label
                    >
                    <input
                      id="longitude"
                      type="text"
                      class="form-control"
                      name="longitude"
                      value=""
                      v-model="form.longitude"
                      required
                      autocomplete="longitude"
                      autofocus
                    />
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="modal-footer">
            <button type="submit" 
            class="btn btn-primary">Submit</button>
            <button
              type="button"
              class="btn btn-secondary"
              data-dismiss="modal"
            >
              Close
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      form: {
        name: "",
        mobileNo: "",
        email: "",
        latitude: "",
        longitude: "",
      },
    };
  },
  computed: {
    csrf() {
      return document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content");
    },
  },
  methods: {
    closeModal(){
      $("#TestAddModal").modal("hide");
    },
    processCreateUsers() {
      let comp = this;
      this.closeModal()
      $.ajax({
        url: "/v1/create-users",
        type: "POST",
        data: {
          _token: this.csrf,
          form: this.form,
        },
        success: function (response) {
          comp.$emit("usersAdded");
          comp.showToast("Users added successfully", "success");
        },
      });
    },
    showToast(msg, type) {
      toastr.options = {
        closeButton: true,
        progressBar: true,
        preventDuplicates: true,
        positionClass: "toast-bottom-right",
      };
      toastr[type](msg);
    },
  },
};
</script>
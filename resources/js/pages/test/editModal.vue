<template>
  <div
    class="modal fade"
    id="testEditModal"
    tabindex="-1"
    role="dialog"
    aria-labelledby="testEditModalLabel"
    aria-hidden="true"
  >
    <div class="modal-dialog modal-dialog-slideout modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="testEditModalLabel">
            Edit Users
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
          <div class="box-body">
            <div class="modal-body">
              <div class="box-body">
                <div class="form-group row">
                  <div class="col-md-6">
                    <label for="state" class="col-form-label text-md-right"
                      >Environment Name</label
                    >
                    <input
                      id="id"
                      type="text"
                      class="form-control"
                      name="id"
                      v-model="form.id"
                      autocomplete="id"
                      autofocus
                    />
                  </div>
                  <div class="col-md-6">
                    <label for="suite_unit" class="col-form-label text-md-right"
                      >Name</label
                    >
                    <input
                      id="name"
                      type="text"
                      class="form-control"
                      name="name"
                      :value="selectedUsers.name"
                      autocomplete="name"
                      autofocus
                    />
                  </div>
                </div>
          
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button @click="updateEnvironment" class="btn btn-primary">
            Update
          </button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">
            Close
          </button>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      form: {
        id: "",
        name: "",
        /*env_use: "",*/
      },
    };
  },
  methods: {
    showToast(msg, type) {
      toastr.options = {
        closeButton: true,
        progressBar: true,
        preventDuplicates: true,
        positionClass: "toast-bottom-right",
      };
      toastr[type](msg);
    },
    closeModal(){
      $("#testEditModal").modal("hide");
    },
    updateEnvironment() {
      let comp = this;
      this.closeModal()
      comp.$store.dispatch('actionSetIsLoading', true)
      $.ajax({
        url: "/v1/updateeditenv",
        type: "POST",
        data: {
          _token: this.csrf,
          form: comp.formdata,
        },
        success: function (response) {
          comp.$store.dispatch("updateEnv",comp.formdata);
          comp.$store.dispatch('actionSetIsLoading', false)
          comp.showToast("Users updated successfully", "success");
        },
      });
    },
  },
  computed: {
    formdata: function () {
      let newform = this.$store.state.selectedUsers;
      newform.id = this.form.id;
      newform.name = this.form.name;
/*      newform.env_use = this.form.env_use;
*/      return newform;
    },
    selectedUsers: function () {
      let storeusers = this.$store.state.selectedUsers;
      this.form.id = storeusers.id;
      this.form.name = storeusers.name;
      /*this.form.env_use = storeenv.env_use;*/
      return storeusers;
    },
  
  },
};
</script>
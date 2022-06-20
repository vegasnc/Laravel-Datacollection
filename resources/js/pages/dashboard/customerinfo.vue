<template>
   <!-- Custom tabs (Charts with tabs)-->
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">
        <i class="fa fa-info-circle" aria-hidden="true"></i>
        Customer Information
      </h3>
    </div><!-- /.card-header -->
    <div class="card-body">
      <div class="tab-content p-0">
        <div class="row mb-3">
            <div class="col-3">Client</div>
            <div class="col-9">
              <select class="form-control select2 select2-danger" data-dropdown-css-class="select2-danger" 
              @change="updateElectedCl"
              v-model="selectedClientList">
                  <option value="title">--Select Client--</option>
                   <option
                    v-for="(cl, index) in clientlist"
                    :value="cl.id"
                    :key="cl.id"
                    :selected="index === 0 ? 'selected' : false"
                  >
                    {{ cl.company }}
                  </option>
                    
                  </option>
                </select>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-3">Contact(Person)</div>
            <div class="col-9">
              <select class="form-control" data-dropdown-css-class="select2-danger"
              @change="updateElectedLocation" 
              v-model="selectedContactList">
                  <option value="title">--Select Contact(Person)--</option>
                  <option
                    v-for="(cl, index) in contactlist"
                    :value="cl.id"
                    :key="cl.id"
                    :selected="index === 0 ? 'selected' : false"
                  >
                    {{ cl.first }} {{ cl.last }}
                  </option>
                </select>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-3">Location</div>
            <div class="col-9">
              <select class="form-control" data-dropdown-css-class="select2-danger"
              v-model="selectedLocation">
                  <option value="title">--Select Location--</option>
                  <option
                    v-for="(cl, index) in contactlocation"
                    :value="cl.id"
                    :key="cl.id"
                    :selected="index === 0 ? 'selected' : false"
                  >
                    {{ cl.street_address }}
                  </option>
                </select>
            </div>
        </div>
      </div>
    </div><!-- /.card-body -->
  </div>
  <!-- /.card -->
</template>
<style>
.loading-parent {
  position: relative;
}
</style>
<script>
export default {
  data() {
    return {
      selectedClientList: "title",
      selectedContactList: "title",
      selectedLocation: "title",
    };
  },
  components: {
  },
  computed: {
    clientlist() {
      return this.$store.state.clientlist;
    },
    contactlist() {
      return this.$store.state.contactlist;
    },
    contactlocation() {
      return this.$store.state.contactlocation;
    },
    csrf() {
      return document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content");
    },
    select_cl_id() {
      return sessionStorage.getItem('select_cl_id')
    },
    select_contact_id() {
      return sessionStorage.getItem('select_contact_id')
    },
    select_location_id() {
      return sessionStorage.getItem('select_location_id')
    },
  },
  methods: {
    updateElectedLocation() {
      let parentComp = this;
      parentComp.$store.dispatch('actionSetIsLoading', true)
      $.ajax({
        url: "/v1/contactlocation",
        type: "POST",
        data: {
          _token: this.csrf,
          contactid: this.selectedLocation,
        },
        success: function (response) {
          parentComp.$store.dispatch('actionSetIsLoading', false)
          //parentComp.selectedLocation = response[0].id;
          sessionStorage.setItem(
            'select_location_id', response[0].id,
          )
          parentComp.$store.dispatch("setcontactlocation", response);
        },
      });
    },
     updateElectedCl() {
      let parentComp = this;
      if(this.selectedClientList == 'title'){
        parentComp.$store.dispatch("setclientlist", []);
        return true;
      }
      sessionStorage.setItem(
        'select_cl_id',
        this.selectedClientList,
      )
      parentComp.$store.dispatch('actionSetIsLoading', true)
      $.ajax({
        url: "/v1/contactlist",
        type: "POST",
        data: {
          _token: this.csrf,
          clientid: this.selectedClientList,
        },
        success: function (response) {
          parentComp.$store.dispatch('actionSetIsLoading', false)
          //parentComp.selectedContactList = response[0].id;
          sessionStorage.setItem(
            'select_contact_id', response[0].id,
          )
          parentComp.$store.dispatch("setcontactlist", response);
        },
      });
    },
  },
  mounted() {
    let parentComp = this;
    parentComp.$store.dispatch('actionSetIsLoading', true)
    $.ajax({
      url: "/v1/clientlist",
      type: "GET",
      success: function (response) {
        parentComp.$store.dispatch('actionSetIsLoading', false)
        //parentComp.selectedClientList = response[0].id;
        sessionStorage.setItem(
          'select_cl_id', response[0].id,
        )
        parentComp.$store.dispatch("setclientlist", response);
      },
    });

    /*//set session client id
    if(this.select_cl_id != null){
      this.selectedClientList = this.select_cl_id
      this.updateElectedCl()
    }*/
  },
};
</script>
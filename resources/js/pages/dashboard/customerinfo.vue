<template>
 <div> 
                
  </div>
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
};
</script>
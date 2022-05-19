<template>
  <div class="d-flex justify-content-center">
    <div class="mr-2">
      <button
        type="button"
        class="btn btn-warning modUser mt-n2"
        @click="showEditModal()"
      >
        <i class="fas fa-edit"></i>
      </button>
    </div>
    <div>
      <button
        type="button"
        class="btn btn-danger modUser mt-n2"
        @click="checkEnvDeletable()"
      >
        <i class="fas fa-trash"></i>
      </button>
    </div>
 </div>
</template>
<script>
export default {
  props: ["selTest"],
  computed: {
    selectedUsers: function () {
      let storeusers = this.$store.state.selectedUsers;
      return storeusers;
    },
  },
   methods: {
    showEditModal(env) {
      $("#testEditModal").modal("show");
      this.$store.dispatch("updateSelUsers", this.selUsers);
    },
    showDeleteModal(env) {
      $("#deleteenvModal").modal("show");
      this.$store.dispatch("updateSelUsers", this.selUsers);
    },
  },
};
</script>
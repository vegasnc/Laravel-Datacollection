<template>
  <div>
    <loading :active.sync="isLoading" 
        :can-cancel="true" 
        :is-full-page="fullPage"></loading> 
    <dashcustomerinfo />
  </div>
</template>
<style>
.loading-parent {
  position: relative;
}
</style>
<script>
import { mapGetters } from 'vuex'
import dashcustomerinfo from "../pages/dashboard/customerinfo";
export default {
  components: {
    dashcustomerinfo,
  },
  computed: {
    ...mapGetters({
      isLoading: 'getIsLoading',
      fullPage: 'getIsFullpage'
    }),
  },
  methods: {
  },
};
</script>
<template>
  <div>
   
  <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1 class="m-0 text-center">Practical Test for VueJS</h1>
          </div><!-- /.col -->
          <!-- <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v1</li>
            </ol>
          </div> --><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row mb-3">
        <div class="col-sm-12">
          <h1 class="mt-3 text-dark">Environments</h1>
          <button
            type="button"
            class="btn btn-info mt-2"
            data-toggle="modal"
            data-target="#TestAddModal"
          >
            Add Users
          </button>
          <!-- <button type="button" class="btn btn-info mt-2" id="contacttolivesecure">Contact Team Live Secure</button> -->
        </div>
        <!-- /.col -->
        <!-- /.col -->
      </div>
      <!-- /.row -->
        <div class="row">
           <div class="col-12">
              <div class="card">
                 <div class="card-header">
                    <h3 class="card-title">DataTable with minimal features &amp; hover style</h3>
                 </div>
                 <Testtable />
                 <Addtestmodal @envAdded="updateusers" />
                 <Edittestmodal />
              </div>
           </div>
        </div>
        
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
</template>

<style>
.loading-parent {
  position: relative;
}
</style>
<script>
import Testtable from "../pages/test/testtable";
import Addtestmodal from "../pages/test/addmodal";
import Edittestmodal from "../pages/test/editmodal";
export default {
  components: {
    Testtable,
    Addtestmodal,
    Edittestmodal,
  },
  data() {
    return {
      selectedOption: "title",
    };
  },
  mounted() {
    this.updateusers();
  },
  computed: {
    users() {
      return this.$store.state.users;
    },
  },
  methods: {
    updateusers() {
      let parentComp = this;
      $.ajax({
        url: "/v1/users",
        type: "GET",
        success: function (response) {
          parentComp.$store.dispatch("updateusers", response);
        },
      });
    },
  },
};
</script>
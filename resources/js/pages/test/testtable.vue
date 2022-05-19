<template>
<div class="card-body">
  <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4">
     <div class="row">
        <div class="col-sm-12 col-md-6"></div>
        <div class="col-sm-12 col-md-6"></div>
     </div>
     <div class="row">
        <div class="col-sm-12">
           <table id="example2" class="table table-bordered table-hover dataTable dtr-inline" aria-describedby="example2_info">
              <thead>
                 <tr>
                    <th class="sorting sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">id</th>
                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">Name</th>
                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">MobileNo</th>
                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">Email</th>
                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">Address</th>
                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">Latitude</th>
                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">Longitude</th>
                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">ImageUrl</th>
                    <th>Action</th>
                 </tr>
              </thead>
              <tbody>
                 <tr class="odd" v-for="env in users" :key="env.id">
                    <td class="dtr-control sorting_1" tabindex="0">{{ env.id }}</td>
                    <td>{{ env.name }}</td>
                    <td>{{ env.mobileNo }}</td>
                    <td>{{ env.email }}</td>
                    <td>{{ env.address }}</td>
                    <td>{{ env.latitude }}</td>
                    <td>{{ env.longitude }}</td>
                    <td><!-- <img :src="env.imageUrl" alt="" width="50" height="50"> --></td>
                    <td>
                      <Testaction :selTest="env" />
                    </td>
                 </tr>
              </tbody>
           </table>
        </div>
     </div>
     
  </div>
</div>
</template>
<script>
import Testaction from "./testaction";

export default {
  components: {
    Testaction,
  },
  data() {
    return {};
  },
  computed: {
    users() {
      return this.$store.state.users;
    },
  },
};
</script>
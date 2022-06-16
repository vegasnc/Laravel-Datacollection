$(function () {
    //Date range picker
    $('#reservation').daterangepicker();


   /* $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
*/
    var table = $('#example1').DataTable({
      processing: true,
      serverSide: true,
      ajax: {
        url: "v1/getEstimateProposal",
        type: "POST",
        data: function (d) {
          d.itemtype = $(".clientiteamtype option:selected").val();
          d.startdate = $("#reservation").data('daterangepicker').startDate.format('YYYY-MM-DD');
          d.enddate = $("#reservation").data('daterangepicker').endDate.format('YYYY-MM-DD');
          d.select_cl_id = sessionStorage.getItem('select_cl_id');
          d.select_location_id = sessionStorage.getItem('select_location_id');
          d.select_contact_id = sessionStorage.getItem('select_contact_id');
          d._token = $('#token').val();
        }
      },
      columns: [
        { data: 'est_no', name: 'est_no' },
        { data: 'client_id', name: 'client_id' },
        { data: 'company', name: 'company', orderable: false, searchable: false },
        { data: 'email', name: 'email', orderable: false, searchable: false }
      ],
    });

    $('.clientiteamtype').on('change', function (e) {
      /*var itemtype = this.value;
      var startdate = $("#reservation").data('daterangepicker').startDate.format('YYYY-MM-DD');
      var enddate = $("#reservation").data('daterangepicker').endDate.format('YYYY-MM-DD');
      var select_cl_id = sessionStorage.getItem('select_cl_id');
      var select_location_id = sessionStorage.getItem('select_location_id');
      var select_contact_id = sessionStorage.getItem('select_contact_id');
      var _token = $('#token').val();
      $.ajax({
          url: "v1/getEstimateProposal",
          type: "POST",
          dataType: "JSON",
          data: { 
            _token: _token, 
            itemtype: itemtype,
            startdate: startdate,
            enddate: enddate,
            select_cl_id: select_cl_id,
            select_location_id: select_location_id,
            select_contact_id: select_contact_id, 
          },
          success: function(data) {
              $( "#example1" ).empty().append( data );
          }
      });*/

      table.draw();
    });


     /*
     * BAR CHART
     * ---------
     */

    var bar_data = {
      data : [[1,200], [2,800], [3,400], [4,130], [5,170], [6,900]],
      bars: { show: true }
    }
    $.plot('#bar-chart', [bar_data], {
      grid  : {
        borderWidth: 1,
        borderColor: '#f3f3f3',
        tickColor  : '#f3f3f3'
      },
      series: {
         bars: {
          show: true, barWidth: 0.5, align: 'center',
        },
      },
      colors: ['#3c8dbc'],
      xaxis : {
        ticks: [[1,'January'], [2,'February'], [3,'March'], [4,'April'], [5,'May'], [6,'June']]
      }
    })
    /* END BAR CHART */
   
});  
function myMap() {
var mapProp= {
  center:new google.maps.LatLng(51.508742,-0.120850),
  zoom:5,
};
var map = new google.maps.Map(document.getElementById("googleMap"),mapProp);
}
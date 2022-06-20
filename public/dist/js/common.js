$(function () {
    //Date range picker
    $('#reservation').daterangepicker();
    /*START Load Estimation propsal in datatable*/
    $('#example1').DataTable().destroy();
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
          d.search = $('input[type="search"]').val();
        }
      },
      columns: [
        { data: 'est_no', name: 'No.',orderable: true, searchable: true },
        { data: 'office', name: 'Territory',orderable: true, searchable: true },
        { data: 'est_date', name: 'Date', orderable: true, searchable: true },
        { data: 'company', name: 'Client', orderable: true, searchable: true },
        { data: 'loc_street_address', name: 'Location', orderable: true, searchable: true },
        { data: 'first', name: 'Contact', orderable: true, searchable: true },
      ],
      columnDefs: [{
        "defaultContent": "-",
        "targets": "_all"
      }]
    });

    $('.clientiteamtype').on('change', function (e) {
      table.draw();
      var itemtype = this.value;
      var startdate = $("#reservation").data('daterangepicker').startDate.format('YYYY-MM-DD');
      var enddate = $("#reservation").data('daterangepicker').endDate.format('YYYY-MM-DD');
      
      myMap1(itemtype,startdate,enddate);

      barchart(itemtype,startdate,enddate);
    });
    /*END Load Estimation propsal in datatable*/

    /*START BAR CHART*/
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
/* END BAR CHART */

/* START OnLoad show default lat and lng in GoogleMap */
let curr_lat = 51.508742
let curr_lng = -0.120850
function myMap() {
  var mapProp= {
    center:new google.maps.LatLng(curr_lat,curr_lng),
    zoom:2
  };
  var map = new google.maps.Map(document.getElementById("map"),mapProp);
}
/* END OnLoad show default lat and lng in GoogleMap */

/*START On Select ItemType load map markers*/
function myMap1(itemtype,startdate,enddate) {

  var mapOptions7 = {
    center: new google.maps.LatLng(curr_lat,curr_lng),
    zoom: 3
  };

  var map7 = new google.maps.Map(document.getElementById('map'), mapOptions7);
  var lat_lng = new Array();
  var latlngbounds = new google.maps.LatLngBounds();

  var itemtype = itemtype;
  var startdate = startdate;
  var enddate = enddate;
  var select_cl_id = sessionStorage.getItem('select_cl_id');
  var select_location_id = sessionStorage.getItem('select_location_id');
  var select_contact_id = sessionStorage.getItem('select_contact_id');
  var _token = $('#token').val();
  $.ajax({
      url: "v1/getGoogleMap",
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
      success: function(markers7) {
          for (i = 0; i < markers7.length; i++) {
            var data = markers7[i]
            var myLatlng7 = new google.maps.LatLng(data.lat, data.lng);
            lat_lng.push(myLatlng7);
            var marker7 = new google.maps.Marker({
                    position: myLatlng7,
                    map: map7,
                    title: data.title,
                   animation: google.maps.Animation.DROP
            });
            latlngbounds.extend(marker7.position);
        }
      }
  });
}
/*END On Select ItemType load map markers*/

/*START on selct ItemType show data in chart*/
function barchart(itemtype,startdate,enddate){
  var itemtype = itemtype;
  var startdate = startdate;
  var enddate = enddate;
  var select_cl_id = sessionStorage.getItem('select_cl_id');
  var select_location_id = sessionStorage.getItem('select_location_id');
  var select_contact_id = sessionStorage.getItem('select_contact_id');
  var _token = $('#token').val();
  $.ajax({
      url: "v1/getBarChart",
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
        console.log(data);
        var bar_data = {
          data : [data],
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
      }
  });
}
/*END on selct ItemType show data in chart*/
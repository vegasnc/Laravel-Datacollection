$(function () {
    sessionStorage.clear();

    $("#clientterritory").select2();

    $('#clientterritory').on('select2:select', function (e) {
      $('#clientlist').val(null).trigger('change');
      $('#contactlist').val(null).trigger('change');
      $('#contactlocation').val(null).trigger('change');
      var select_territory_id = e.params.data.id;
      sessionStorage.setItem(
        'select_territory_id', select_territory_id,
      )
      $("#clientlist").select2({
      ajax: {
          url: "/v1/clientlist",
          type: "POST",
          dataType: 'json',
          delay: 250,
          data: function (params) {
             return {
                _token : $('#token').val(),
                select_territory_id:sessionStorage.getItem('select_territory_id'),
                searchTerm: params.term // search term
             };
          },
          processResults: function (response) {
             return {
                results: response
             };
          },
          cache: true
        }
     });
    });

    $("#clientlist").select2({
        minimumInputLength: 3,
        ajax: {
            url: '/v1/clientlist',
            dataType: 'json',
        },
    });

    $('#clientlist').on('select2:select', function (e) {
      $('#contactlist').val(null).trigger('change');
      $('#contactlocation').val(null).trigger('change');
      var select_cl_id = e.params.data.id;
      sessionStorage.setItem(
        'select_cl_id', select_cl_id,
      )
      $("#contactlist").select2({
      ajax: {
          url: "/v1/contactlist",
          type: "POST",
          dataType: 'json',
          delay: 250,
          data: function (params) {
             return {
                _token : $('#token').val(),
                clientid:sessionStorage.getItem('select_cl_id'),
                searchTerm: params.term // search term
             };
          },
          processResults: function (response) {
             return {
                results: response
             };
          },
          cache: true
        }
     });
    });

    $('#contactlist').on('select2:select', function (e) {
      $('#contactlocation').val(null).trigger('change');
      var select_contact_id = e.params.data.id;
      sessionStorage.setItem(
        'select_contact_id', select_contact_id,
      )
      $("#contactlocation").select2({
      ajax: {
          url: "/v1/contactlocation",
          type: "POST",
          dataType: 'json',
          delay: 250,
          data: function (params) {
             return {
                _token : $('#token').val(),
                clientid:sessionStorage.getItem('select_cl_id'),
                contactid:sessionStorage.getItem('select_contact_id'),
                searchTerm: params.term // search term
             };
          },
          processResults: function (response) {
             return {
                results: response
             };
          },
          cache: true
        }
     });
    });

    $("#contactlocation").select2({
        minimumInputLength: 3,
        ajax: {
            url: '/v1/contactlocation',
            dataType: 'json',
        },
    });

    $('#contactlocation').on('select2:select', function (e) {
      var select_location_id = e.params.data.id;
      sessionStorage.setItem(
        'select_location_id', select_location_id,
      )
    });

    $("#clientiteamtype").select2();

    $('#clientiteamtype').on('select2:select', function (e) {
      var select_item_type_id = e.params.data.id;
      sessionStorage.setItem(
        'select_item_type_id', select_item_type_id,
      )
    });

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
        async: false,
        data: function (d) {
          d.startdate = $("#reservation").data('daterangepicker').startDate.format('YYYY-MM-DD');
          d.enddate = $("#reservation").data('daterangepicker').endDate.format('YYYY-MM-DD');
          d.select_cl_id = sessionStorage.getItem('select_cl_id');
          d.select_location_id = sessionStorage.getItem('select_location_id');
          d.select_contact_id = sessionStorage.getItem('select_contact_id');
          d._token = $('#token').val();
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

    $('#reservation').on('hide.daterangepicker', function (ev, picker) {
      table.draw();
      var startdate = $("#reservation").data('daterangepicker').startDate.format('YYYY-MM-DD');
      var enddate = $("#reservation").data('daterangepicker').endDate.format('YYYY-MM-DD');
      myMap1(startdate,enddate);

      barchart(startdate,enddate);
    });
    /*END Load Estimation propsal in datatable*/

    /*START BAR CHART*/
    var areaChartData = {
      labels  : ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
      datasets: [
        {
          label               : 'Selected Asset No of Count Per Month',
          backgroundColor: '#66bd9d',
          borderColor: '#66bd9d',
          hoverBackgroundColor: '#10523a',
          hoverBorderColor: '#10523a',
          pointRadius          : false,
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(60,141,188,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data                : [5000, 10000, 15000, 20000, 25000, 30000, 35000]
        }
      ]
    }

    var barChartCanvas = $('#barChart');
  
    var barChartOptions = {
      responsive              : true,
      maintainAspectRatio     : false,
      datasetFill             : false
    }

    new Chart(barChartCanvas, {
      type: 'bar',
      data: areaChartData,
      options: barChartOptions
    })

    /* END BAR CHART */
   
});
/* END BAR CHART */

/* START OnLoad show default lat and lng in GoogleMap */
let curr_lat = 43.651070
let curr_lng = -79.347015
function myMap() {
  var mapProp= {
    center:new google.maps.LatLng(curr_lat,curr_lng),
    zoom:8
  };
  var map = new google.maps.Map(document.getElementById("map"),mapProp);
}
/* END OnLoad show default lat and lng in GoogleMap */

/*START On Select ItemType load map markers*/
function myMap1(startdate,enddate) {

  var mapOptions7 = {
    center: new google.maps.LatLng(curr_lat,curr_lng),
    zoom: 8
  };

  var map7 = new google.maps.Map(document.getElementById('map'), mapOptions7);
  var lat_lng = new Array();
  var latlngbounds = new google.maps.LatLngBounds();

  var startdate = startdate;
  var enddate = enddate;
  var select_cl_id = sessionStorage.getItem('select_cl_id');
  var select_location_id = sessionStorage.getItem('select_location_id');
  var select_contact_id = sessionStorage.getItem('select_contact_id');
  var _token = $('#token').val();
  $.ajax({
      url: "v1/getGoogleMap",
      type: "POST",
      async: false,
      dataType: "JSON",
      data: { 
        _token: _token, 
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
function barchart(startdate,enddate){
  var startdate = startdate;
  var enddate = enddate;
  var select_cl_id = sessionStorage.getItem('select_cl_id');
  var select_location_id = sessionStorage.getItem('select_location_id');
  var select_contact_id = sessionStorage.getItem('select_contact_id');
  var select_item_type_id = sessionStorage.getItem('select_item_type_id');
  var _token = $('#token').val();
  $.ajax({
      url: "v1/getBarChart",
      type: "POST",
      async: false,
      dataType: "JSON",
      data: { 
        _token: _token, 
        startdate: startdate,
        enddate: enddate,
        select_cl_id: select_cl_id,
        select_location_id: select_location_id,
        select_contact_id: select_contact_id,
        select_item_type_id: select_item_type_id, 
      },
      success: function(data) {
        $("#barChart").hide();
        $("#barChartOnAjax").show();
        /*var monthno = [];
        var countno = [];

        for (var i in data) {
            monthno.push(data[i].monthno);
            countno.push(data[i].countno);
        }

        var chartdata = {
            labels: monthno,
            datasets: [
                {
                    label               : 'Selected Asset',
                    backgroundColor     : 'rgba(60,141,188,0.9)',
                    borderColor         : 'rgba(60,141,188,0.8)',
                    pointRadius          : false,
                    pointColor          : '#3b8bba',
                    pointStrokeColor    : 'rgba(60,141,188,1)',
                    pointHighlightFill  : '#fff',
                    pointHighlightStroke: 'rgba(60,141,188,1)',
                    data: countno
                }
            ]
        };

        var graphTarget = $("#barChart");

        var barGraph = new Chart(graphTarget, {
            type: 'bar',
            data: chartdata
        });*/
        data = JSON.parse(data);
          var monthno = [];
          var countno = [];

          $.each(data, function(i, item) {
              monthno.push(data[i].monthno);
              countno.push(data[i].countno);
          });

          var chartdata = {
            labels: monthno,
            datasets : [
              {
                label: 'Selected Asset No of Count Per Month',
                backgroundColor: '#66bd9d',
                borderColor: '#66bd9d',
                hoverBackgroundColor: '#10523a',
                hoverBorderColor: '#10523a',
                data: countno
              }
            ]
          };

          var ctx = $("#barChartOnAjax");

          var barGraph = new Chart(ctx, {
            type: 'bar',
            data: chartdata
          });
      }
  });
}
/*END on selct ItemType show data in chart*/
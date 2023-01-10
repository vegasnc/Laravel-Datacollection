@extends('layouts.noref')
@section('title',"ClickMatrix | Dashboard")
@section('vuescript')
<script src="{{asset('js/dashboard.js')}}"></script>
@endsection
@section('content')
 
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-12">
        <h1 class="mb-0 text-center">Customer Service Report</h1>
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
    <!-- Main row -->
    <div class="row mt-3">
        <!-- Left col -->
        <section class="col-lg-7 connectedSortable">

          <!-- Customer Information-->
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
                    <div class="col-3">For Territory</div>
                    <div class="col-9">
                      <select class="form-control select2 select2-success" data-dropdown-css-class="select2-success" id="clientterritory" style="width: 100%;">
                        <option value="">--Select For Territory--</option>
                        @foreach($clientterritory as $val)
                        <option value="{{$val['id']}}">
                         {{$val['location']}}
                        </option>
                        @endforeach
                      </select>  
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-3">Client</div>
                    <div class="col-9">
                      <select class="form-control select2 select2-success" data-dropdown-css-class="select2-success" id="clientlist" style="width: 100%;">
                        <option value="">--Select Client--</option>
                      </select>  
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-3">Contact(Person)</div>
                    <div class="col-9">
                      <select class="form-control select2 select2-success" id="contactlist" data-dropdown-css-class="select2-success">
                          <option value="title">--Select Contact(Person)--</option>
                      </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-3">Location</div>
                    <div class="col-9">
                      <select class="form-control select2 select2-success" id="contactlocation" data-dropdown-css-class="select2-success">
                          <option value="title">--Select location--</option>
                      </select>
                    </div>
                </div> 
                <!--Customer Information-->
                <div id="appDashboard"></div>
                <!--/.Customer Information -->
              </div>
            </div><!-- /.card-body -->
          </div>
          <!-- /.Customer Information -->

          <!-- Select Type of assest and Date range-->
          <div class="row">
            <div class="col-sm-6">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">
                    <i class="fa fa-info-circle" aria-hidden="true"></i>
                     Select Types of Asset and Services
                  </h3>
                </div><!-- /.card-header -->
                <div class="card-body">
                  <div class="tab-content p-0">
                    <div class="row mb-3">
                        <div class="col-3">Asset</div>
                        <div class="col-9">
                            <input type="hidden" name="token" id="token" value="{{ csrf_token() }}">
                            <select name="type_id" class="form-control select2 select2-success" id="clientiteamtype" data-dropdown-css-class="select2-success">
                              <option value="">--Item Type--</option>
                              @foreach($clientiteamtype as $item)
                                <option value="{{$item['id']}}">{{$item['value']}}</option>
                              @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-3"></div>
                        <div class="col-9">
                          <div class="input-group">
                            <button type="button" id="WinReload" class="btn btn-success green-btn">Reset Filter</button>
                          </div>
                        </div>
                    </div>
                  </div>
                </div><!-- /.card-body -->
              </div>
            </div>
            <div class="col-sm-6">
              <!-- Select Date Range-->
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">
                    <i class="fa fa-info-circle" aria-hidden="true"></i>
                    Select Date Range
                  </h3>
                </div><!-- /.card-header -->
                <div class="card-body">
                  <div class="tab-content p-0">
                    <div class="row mb-3">
                        <div class="col-3">Date</div>
                        <div class="col-9">
                            <div class="input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text">
                                <i class="far fa-calendar-alt"></i>
                              </span>
                            </div>
                            <input type="text" class="form-control float-right" id="reservation">
                          </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-3"></div>
                        <div class="col-9">
                          <div class="input-group">
                            <button type="button" id="SearchEstimation" class="btn btn-success green-btn mr-1">Search</button>
                          </div>
                        </div>
                    </div>
                  </div>
                </div><!-- /.card-body -->
              </div>
              <!-- /. Select Date Range -->
            </div>
          </div>
          <!-- /.Select Type of assest and Date range -->         

          <!-- No of Asset -->
          <div class="card" style="display:none;" id="showassetdetails">
            <!-- /.No of Asset -->
            <!-- /.card-header -->
              <div class="card-body">
                <div class="form-group row text-center mb-0">
                  <div class="col-sm-6">
                  <h5>Number of Selected Assets</h5><h4><span id="assets_btm"></span></h4>
                  </div>
                  <div class="col-sm-6">
                  <h5>Revenue of Selected Assets</h5><h4><span id="revenue_btm"></span></h4>
                  </div>
                </div>
              </div>
              <!-- /.card-body -->
          </div>
          <!-- /.No of Asset -->

          <!-- Display Selection of Asset -->
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">
                <i aria-hidden="true" class="fa fa-info-circle"></i> 
                Display Estimates
              </h3>
            </div>
            <!-- /.Display Selection of Asset -->
            <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped yajra-datatable">
                  <thead>
                  <tr>
                    <th>No.</th>
                    <th>Territory</th>
                    <th>Date</th>
                    <th>Client</th>
                    <th>Location</th>
                    <th>Contact</th>
                    <th>ec_rate</th>
                   
                  </tr>
                  </thead>
                </table>
              </div>
              <!-- /.card-body -->
          </div>
          <!-- /.Display Selection of Asset -->

          <!-- Remove A - meter -->
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">
                <i class="fa fa-info-circle" aria-hidden="true"></i>
                Remove - A - Meter
              </h3>
            </div><!-- /.card-header -->
            <div class="card-body">
              <div class="form-group row text-center" id="livenumer" style="display:none;">
                <div class="col-sm-12">
                  <span class="col-sm-2">Live Number Data</span>
                </div>
              </div>
              <div id="livenocount">
                <div class="form-group row text-center">
                  <div class="col-sm-12">
                    <label class="col-sm-8 col-form-label col-form-label-lg btn btn-success green-btn font-weight-normal">No record found</label>
                  </div>
                </div>
              </div>
              <div class="form-group row text-center" id="recentphoto" style="display:none;">
                <div class="col-sm-12">
                  <span class="col-sm-2">Recent Service Photos</span>
                </div>
              </div>
              <div id="imagesdata" style="display:none;">
                <div class="row">
                    <div class="col-md-3">
                      <div class="thumbnail">
                        <img src="{{ asset('dist/img/default-150x150.png') }}" alt="Lights" style="width:100%">
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="thumbnail">
                        <img src="{{ asset('dist/img/default-150x150.png') }}" alt="Nature" style="width:100%">
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="thumbnail">
                        <img src="{{ asset('dist/img/default-150x150.png') }}" alt="Fjords" style="width:100%">
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="thumbnail">
                        <img src="{{ asset('dist/img/default-150x150.png') }}" alt="Fjords" style="width:100%">
                      </div>
                    </div>
                </div>
              </div>
            </div><!-- /.card-body -->
          </div>
          <!-- /.Remove A - meter -->
        </section>
        <!-- /.Left col -->
        <section class="col-lg-5 connectedSortable">
            <!-- Total Assets -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-wallet"></i>
                  Total Assets For client
                </h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <div class="form-group row text-center mb-0">
                  <div class="col-sm-12">
                  <h4 id="assets"></h4>
                  </div>
                </div>
              </div>
              <!-- /.card-body-->
            </div>
            <!-- /.Total Assets -->
            <!-- Total Revenue -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-comment-dollar"></i>
                  Total Revenue For client
                </h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <div class="form-group row text-center mb-0">
                  <div class="col-sm-12">
                  <h4 id="revenue"></h4>
                  </div>
                </div>
              </div>
              <!-- /.card-body-->
            </div>
            <!-- /.Total Revenue -->
            
            <!-- Google Map -->
            <div class="card">
              <div class="card-header border-0">
                <h3 class="card-title">
                  <i class="fas fa-map-marker-alt mr-1"></i>
                  Map
                </h3>
                <!-- card tools -->
                <div class="card-tools">
                  <button type="button" class="btn btn-primary btn-sm green-btn" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
                <!-- /.card-tools -->
              </div>
              <div class="card-body">
                <div id="map" style="height: 400px; width: 100%;"></div>
              </div>
            </div>
            <!-- /.Google Map -->
            <!-- Bar Graph No of total asset per month-->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="far fa-chart-bar"></i>
                  Number of Assets per Month
                </h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <canvas id="barChartOnAjax" style="display: none;min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;">No Record Found</canvas>
              </div>
              <!-- /.card-body-->
            </div>
            <!-- /.Bar Graph no of total asset per month-->

            <!-- Bar Graph total revenue per client per month-->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="far fa-chart-bar"></i>
                  Total Revenue per Client per Month
                </h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <canvas id="clientrevenuepermonthAjax" style="display: none;min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;">No Record Found</canvas>
              </div>
              <!-- /.card-body-->
            </div>
            <!-- /.Bar Graph total revenue per client per month-->
        </section>
        <!-- right col -->
    </div>
    <!-- /.row (main row) -->
  </div><!-- /.container-fluid -->
</section>
<!-- /.content -->

@endsection

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
          <!--Customer Information-->
          <div id="appDashboard"></div>
          <!--/.Customer Information -->

          <!-- Types of Asset and services -->
          <div class="card">
            <div class="card-header">
              <h3 class="card-title"><i aria-hidden="true" class="fa fa-info-circle"></i> Select Types of Asset and Services</h3>
            </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group row" style="margin:10px 0px 10px 15px">
                    <label for="inputPassword" class="col-sm-4 col-form-label">Item Type</label>
                    <input type="hidden" name="token" id="token" value="{{ csrf_token() }}">
                    <div class="col-sm-8">
                      <select class="form-control clientiteamtype">
                        <option value="">--Item Type--</option>
                        @foreach($clientiteamtype as $item)
                        <option value="{{$item['id']}}">{{$item['name']}}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group row" style="margin:10px 15px 10px 0px">
                    <label for="inputPassword" class="col-sm-4 col-form-label">Date Range</label>
                    <div class="col-sm-8">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text">
                            <i class="far fa-calendar-alt"></i>
                          </span>
                        </div>
                        <input type="text" class="form-control float-right" id="reservation">
                      </div>
                      <!-- /.input group -->
                    </div>
                  </div>
                </div>
              </div>
          </div>
          <!--/.Types of Assest and services -->

          <!-- Display Selection of Asset -->
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">
                <i aria-hidden="true" class="fa fa-info-circle"></i> 
                Display Selection of Asset
              </h3>
            </div>
            <!-- /.Display Selection of Asset -->
            <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>No.</th>
                    <th>Territory</th>
                    <th>Date</th>
                    <th>Client</th>
                    <th>Location</th>
                    <th>Contact</th>
                    <th>Status</th>
                  </tr>
                  </thead>
                  <tbody>
                  <tr>
                    <td>78158905</td>
                    <td>Burnaby</td>
                    <td>13-Jun-2022</td>
                    <td>1548071 Alberta Ltd.</td>
                    <td>514 - 11th Ave. S.W.</td>
                    <td>Doreen Leguerrier1 (403) 229-3046</td>
                    <td>ACCEPTED</td>
                  </tr>
                  <tr>
                    <td>78158905</td>
                    <td>Burnaby</td>
                    <td>13-Jun-2022</td>
                    <td>1548071 Alberta Ltd.</td>
                    <td>514 - 11th Ave. S.W.</td>
                    <td>Doreen Leguerrier1 (403) 229-3046</td>
                    <td>ACCEPTED</td>
                  </tr>
                  <tr>
                    <td>78158905</td>
                    <td>Burnaby</td>
                    <td>13-Jun-2022</td>
                    <td>1548071 Alberta Ltd.</td>
                    <td>514 - 11th Ave. S.W.</td>
                    <td>Doreen Leguerrier1 (403) 229-3046</td>
                    <td>ACCEPTED</td>
                  </tr>
                  <tr>
                    <td>78158905</td>
                    <td>Burnaby</td>
                    <td>13-Jun-2022</td>
                    <td>1548071 Alberta Ltd.</td>
                    <td>514 - 11th Ave. S.W.</td>
                    <td>Doreen Leguerrier1 (403) 229-3046</td>
                    <td>ACCEPTED</td>
                  </tr>
                  <tr>
                    <td>78158905</td>
                    <td>Burnaby</td>
                    <td>13-Jun-2022</td>
                    <td>1548071 Alberta Ltd.</td>
                    <td>514 - 11th Ave. S.W.</td>
                    <td>Doreen Leguerrier1 (403) 229-3046</td>
                    <td>ACCEPTED</td>
                  </tr>
                  <tr>
                    <td>78158905</td>
                    <td>Burnaby</td>
                    <td>13-Jun-2022</td>
                    <td>1548071 Alberta Ltd.</td>
                    <td>514 - 11th Ave. S.W.</td>
                    <td>Doreen Leguerrier1 (403) 229-3046</td>
                    <td>ACCEPTED</td>
                  </tr>
                  <tr>
                    <td>78158905</td>
                    <td>Burnaby</td>
                    <td>13-Jun-2022</td>
                    <td>1548071 Alberta Ltd.</td>
                    <td>514 - 11th Ave. S.W.</td>
                    <td>Doreen Leguerrier1 (403) 229-3046</td>
                    <td>ACCEPTED</td>
                  </tr>
                  <tr>
                    <td>78158905</td>
                    <td>Burnaby</td>
                    <td>13-Jun-2022</td>
                    <td>1548071 Alberta Ltd.</td>
                    <td>514 - 11th Ave. S.W.</td>
                    <td>Doreen Leguerrier1 (403) 229-3046</td>
                    <td>ACCEPTED</td>
                  </tr>
                  <tr>
                    <td>78158905</td>
                    <td>Burnaby</td>
                    <td>13-Jun-2022</td>
                    <td>1548071 Alberta Ltd.</td>
                    <td>514 - 11th Ave. S.W.</td>
                    <td>Doreen Leguerrier1 (403) 229-3046</td>
                    <td>ACCEPTED</td>
                  </tr>
                  <tr>
                    <td>78158905</td>
                    <td>Burnaby</td>
                    <td>13-Jun-2022</td>
                    <td>1548071 Alberta Ltd.</td>
                    <td>514 - 11th Ave. S.W.</td>
                    <td>Doreen Leguerrier1 (403) 229-3046</td>
                    <td>ACCEPTED</td>
                  </tr>
                  <tr>
                    <td>78158905</td>
                    <td>Burnaby</td>
                    <td>13-Jun-2022</td>
                    <td>1548071 Alberta Ltd.</td>
                    <td>514 - 11th Ave. S.W.</td>
                    <td>Doreen Leguerrier1 (403) 229-3046</td>
                    <td>ACCEPTED</td>
                  </tr>
                  <tr>
                    <td>78158905</td>
                    <td>Burnaby</td>
                    <td>13-Jun-2022</td>
                    <td>1548071 Alberta Ltd.</td>
                    <td>514 - 11th Ave. S.W.</td>
                    <td>Doreen Leguerrier1 (403) 229-3046</td>
                    <td>ACCEPTED</td>
                  </tr>
                  <tr>
                    <td>78158905</td>
                    <td>Burnaby</td>
                    <td>13-Jun-2022</td>
                    <td>1548071 Alberta Ltd.</td>
                    <td>514 - 11th Ave. S.W.</td>
                    <td>Doreen Leguerrier1 (403) 229-3046</td>
                    <td>ACCEPTED</td>
                  </tr>
                  <tr>
                    <td>78158905</td>
                    <td>Burnaby</td>
                    <td>13-Jun-2022</td>
                    <td>1548071 Alberta Ltd.</td>
                    <td>514 - 11th Ave. S.W.</td>
                    <td>Doreen Leguerrier1 (403) 229-3046</td>
                    <td>ACCEPTED</td>
                  </tr>
                  <tr>
                    <td>78158905</td>
                    <td>Burnaby</td>
                    <td>13-Jun-2022</td>
                    <td>1548071 Alberta Ltd.</td>
                    <td>514 - 11th Ave. S.W.</td>
                    <td>Doreen Leguerrier1 (403) 229-3046</td>
                    <td>ACCEPTED</td>
                  </tr>
                  <tr>
                    <td>78158905</td>
                    <td>Burnaby</td>
                    <td>13-Jun-2022</td>
                    <td>1548071 Alberta Ltd.</td>
                    <td>514 - 11th Ave. S.W.</td>
                    <td>Doreen Leguerrier1 (403) 229-3046</td>
                    <td>ACCEPTED</td>
                  </tr>
                  <tr>
                    <td>78158905</td>
                    <td>Burnaby</td>
                    <td>13-Jun-2022</td>
                    <td>1548071 Alberta Ltd.</td>
                    <td>514 - 11th Ave. S.W.</td>
                    <td>Doreen Leguerrier1 (403) 229-3046</td>
                    <td>ACCEPTED</td>
                  </tr>
                  <tr>
                    <td>78158905</td>
                    <td>Burnaby</td>
                    <td>13-Jun-2022</td>
                    <td>1548071 Alberta Ltd.</td>
                    <td>514 - 11th Ave. S.W.</td>
                    <td>Doreen Leguerrier1 (403) 229-3046</td>
                    <td>ACCEPTED</td>
                  </tr>
                  <tr>
                    <td>78158905</td>
                    <td>Burnaby</td>
                    <td>13-Jun-2022</td>
                    <td>1548071 Alberta Ltd.</td>
                    <td>514 - 11th Ave. S.W.</td>
                    <td>Doreen Leguerrier1 (403) 229-3046</td>
                    <td>ACCEPTED</td>
                  </tr>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </section>
        <!-- /.Left col -->
        <section class="col-lg-5 connectedSortable">
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
                <div id="googleMap" style="height: 400px; width: 100%;"></div>
              </div>
            </div>
            <!-- /.Google Map -->
            <!-- Bar Graph -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="far fa-chart-bar"></i>
                  Graph Based on Selected Asset
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
                <div id="bar-chart" style="height: 300px;"></div>
              </div>
              <!-- /.card-body-->
            </div>
            <!-- /.Bar Graph -->
        </section>
        <!-- right col -->
    </div>
    <!-- /.row (main row) -->
  </div><!-- /.container-fluid -->
</section>
<!-- /.content -->

@endsection

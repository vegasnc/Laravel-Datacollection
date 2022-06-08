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
        <h1 class="m-0 text-center">Customer Service Report</h1>
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
    <div class="row">
        <!-- Left col -->
        <section class="col-lg-7 connectedSortable">
          <!--Customer Information-->
          <div id="appDashboard"></div>
          <!--/.Customer Information -->

          <!-- Types of Assest and services -->
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Select Types of Assest and Services</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              Types of Assest and services
            </div>
          </div>
          <!--/.Types of Assest and services -->

          <!-- Display Selection of Asset -->
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">
                Display Selection of Assets
              </h3>
            </div>
            <!-- /.Display Selection of Asset -->
            <div class="card-body">
             Display Selection of Assets
            </div>
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
                  <button type="button" class="btn btn-primary btn-sm" data-card-widget="collapse" title="Collapse">
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
        </section>
        <!-- right col -->
    </div>
    <!-- /.row (main row) -->
  </div><!-- /.container-fluid -->
</section>
<!-- /.content -->

@endsection

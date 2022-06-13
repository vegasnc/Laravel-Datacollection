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

          <!-- Types of Asset and services -->
          <div class="card">
            <div class="card-header">
              <h3 class="card-title"><i aria-hidden="true" class="fa fa-info-circle"></i> Select Types of Asset and Services</h3>
            </div>
              <div class="row">
                <div class="col-md-5">
                  <div class="form-group row" style="margin:10px 20px;">
                    <label for="inputPassword" class="col-sm-4 col-form-label">Item Type</label>
                    <div class="col-sm-8">
                      <select class="form-control">
                        <option value="">--Item Type--</option>
                        <option value="162">1/8 Truck</option>
                        <option value="156">15% Discount</option>
                        <option value="128">25% Discount for Existing EC Clients</option>
                        <option value="44">Additional Graffiti</option>
                        <option value="125">Additional Service</option>
                        <option value="110">After Pictures</option>
                        <option value="120">BC HYDRO - Painting - Corrosion, External Repair</option>
                        <option value="121">BC HYDRO - Painting - Total Repair</option>
                        <option value="122">BC HYDRO - Painting - Touch Up Repair</option>
                        <option value="114">BC HYDRO-Painting Entire Unit - Bollards</option>
                        <option value="117">BC HYDRO-Vegetation Removal - All Equipment</option>
                        <option value="142">Before Picture</option>
                        <option value="135">Before Pictures</option>
                        <option value="145">Bio-Hazard Removal</option>
                        <option value="146">Bio-Wash services</option>
                        <option value="91">By-law Enforcement, Graffiti Removal</option>
                        <option value="144">Clean-up</option>
                        <option value="10">Coating - GP 1000</option>
                        <option value="141">Coating - GP 1500</option>
                        <option value="99">Coating - GP 2000</option>
                        <option value="140">Corrosion/Rust, external cabinet repair.</option>
                        <option value="38">Damage</option>
                        <option value="3">Door Restoration</option>
                        <option value="39">Emergency Call Out</option>
                        <option value="155">Environmental Waste Collection and Disposal</option>
                        <option value="77">Equipment rental charge</option>
                        <option value="159">Ever-Clean Add On - No Touch Sanitization</option>
                        <option value="136">Ever-Clean Rate Increase</option>
                        <option value="157">Ever-Clean™ Curb-in Program</option>
                        <option value="9">Ever-Clean™ Entry level Program</option>
                        <option value="147">Ever-Safe™</option>
                        <option value="123">FM Facilities- Material</option>
                        <option value="160">Garbage</option>
                        <option value="13">Glass Repair - Etchiti</option>
                        <option value="126">Glass Repair - Scratchiti</option>
                        <option value="138">Graffiti Removal from GP 1000Coated Surface</option>
                        <option value="134">GraffWrap™ Basic Custom</option>
                        <option value="133">GraffWrap™ Basic Stock</option>
                        <option value="131">GraffWrap™ Premium Custom</option>
                        <option value="132">GraffWrap™ Premium Stock</option>
                        <option value="127">GTA- 15% Discount for New Clients</option>
                        <option value="43">High Level removal requiring WA-OSHA compliancy</option>
                        <option value="22">High Level removal requiring WCB compliancy</option>
                        <option value="61">High level removal requiring WSIB compliancy</option>
                        <option value="68">High level restoration requiring WCB compliancy.</option>
                        <option value="69">High level restoration requiring WSIB compliancy</option>
                        <option value="139">Hourly Rate</option>
                        <option value="108">HST</option>
                        <option value="149">Lift Vehicle Required:</option>
                        <option value="151">Masking:</option>
                        <option value="152">Materials</option>
                        <option value="161">Minimum Call Out</option>
                        <option value="56">Minimum Call-Out Rate</option>
                        <option value="137">Monthly Special</option>
                        <option value="154">Needle Pickup</option>
                        <option value="158">No Touch Sanitization</option>
                        <option value="148">Please Note:</option>
                        <option value="25">Poster</option>
                        <option value="41">Power Wash: Blow Off - Hot Water</option>
                        <option value="23">Power Wash: Detail - Hot Water</option>
                        <option value="116">Power Washing - All Equipment</option>
                        <option value="5">Powerwash: Cold Water</option>
                        <option value="89">Previously Failed Removals</option>
                        <option value="150">Priming:</option>
                        <option value="62">Racial or Hate Graffiti</option>
                        <option value="143">Refuse Removal</option>
                        <option value="28">Removal - Large Spray Bomb from Porous</option>
                        <option value="30">Removal -by Square Foot Spray Bomb from Non Porous</option>
                        <option value="102">Removal Extra Large Ink Marker Tag from Porous</option>
                        <option value="94">Removal – by Square Foot Spray Bomb from Porous</option>
                        <option value="106">Removal – Extra Large Ink Marker Tag, Non-Porous</option>
                        <option value="98">Removal – Extra Large Spray Bomb from Non-Porous</option>
                        <option value="29">Removal – Extra Large Spray Bomb from Porous</option>
                        <option value="105">Removal – Large Ink Marker Tag from Non-Porous</option>
                        <option value="101">Removal – Large Ink Marker Tag from Porous</option>
                        <option value="97">Removal – Large Spray Bomb from Non-Porous</option>
                        <option value="124">Removal – Large Spray Bomb from Porous</option>
                        <option value="104">Removal – Medium Ink Marker Tag from Non-Porous</option>
                        <option value="100">Removal – Medium Ink Marker Tag from Porous</option>
                        <option value="96">Removal – Medium Spray Bomb from Non-Porous</option>
                        <option value="27">Removal – Medium Spray Bomb from Porous</option>
                        <option value="103">Removal – Small Ink Marker Tag from Non-Porous</option>
                        <option value="1">Removal – Small Ink Marker Tag from Porous</option>
                        <option value="95">Removal – Small Spray Bomb from Non-Porous</option>
                        <option value="26">Removal – Small Spray Bomb from Porous</option>
                        <option value="33">Removal –by Sq Foot Ink Marker Tag from Non-Porous</option>
                        <option value="93">Removal –by Square Foot Ink Marker Tag from Porous</option>
                        <option value="130">RENTAL- Licensed Waste Disposal Vehicle with ECA</option>
                        <option value="2">Restoration</option>
                        <option value="11">Scratchiti Stop Security Film</option>
                        <option value="115">Spot Touch Painting - All Equipment</option>
                        <option value="92">Spring Special -March 1st-April 15 2014</option>
                        <option value="6">Sticker Removal</option>
                        <option value="153">Test Patch Required</option>
                        <option value="12">Time and Travel</option>
                        <option value="107">Total Cost for Clean-Up</option>
                        <option value="129">Weather Delay</option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-md-7">
                  <div class="form-group row" style="margin:10px 20px;">
                    <label for="inputPassword" class="col-sm-4 col-form-label">Date Range</label>
                    <div class="col-sm-7">
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
              <div class="row">
                <div class="col-md-8">
                  <div class="form-group row" style="margin:10px 20px;">
                    <label for="inputPassword" class="col-sm-4 col-form-label">Select An Asset</label>
                    <div class="col-sm-8">
                      <select class="form-control">
                        <option value="">--Select Asset--</option>
                        <option value="162">ClickOff Graff</option>
                        <option value="156">Ever-Safe</option>
                        <option value="128">Ever-Clean</option>
                        <option value="44">Clickoff Trash</option>
                        <option value="44">Ever-Getter</option>
                      </select>
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
            <div class="card-body">
             Display Selection of Asset
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
            <!-- Bar Graph -->
            <div class="card">
              <!-- Bar chart -->
            <div class="card card-primary card-outline">
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
            <!-- /.card -->
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

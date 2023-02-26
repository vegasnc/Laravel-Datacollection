@extends('layouts.noref')
@section('title',"ClickMetrix | DataCollection")

@section('content')
 
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-12">
        <h1 class="mb-0 text-center">ClickMetrix</h1>
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
    <div class="row mt-3 h-100 justify-content-center align-items-center">
        <!-- Left col -->
        <section class="col-lg-6">

          <!-- Customer Information-->
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">
                <i class="fa fa-info-circle" aria-hidden="true"></i>
                Add Data
              </h3>
            </div><!-- /.card-header -->
            <div class="card-body">
              <div class="tab-content p-0">
              <form action="{{ route('data-add') }}" method="POST">
                  @csrf
                
                  <div class="row">
                      <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="row">
                            <div class="col-sm-6">
                              <div class="form-group">
                                <strong>Please Select Asset Types</strong>
                                <select class="form-control select2 select2-success" data-dropdown-css-class="select2-success" id="asset" name="asset" style="width: 100%;">
                                  <option value="">Please Select</option>
                                  <option value="1">Add New Asset</option>
                                  @foreach($asset as $key=>$val)
                                  <option value="{{$val['name']}}">{{$val['name']}}</option>
                                  @endforeach
                                </select>  
                              </div>
                            </div>
                            <div class="col-sm-6" style="display:none;" id="addnewasset">
                              <div class="form-group">
                                <strong>Or Add New Asset Type</strong>
                                <input type="text" id="addnewasset" name="addnewasset" class="form-control" placeholder="Enter Asset Name">
                              </div>
                            </div>
                        </div>
                      </div>

                      <div class="col-xs-12 col-sm-12 col-md-12">
                          <div class="form-group">
                              <strong>Live Location</strong>
                              <button type="button" class="btn btn-success green-btn mb-1" onclick="getLocation()">Click here</button>
                              <input type="text" id="latitude" name="latitude" class="form-control mb-1" placeholder="Latitude">
                              <input type="text" id="longitude" name="longitude" class="form-control" placeholder="Longitude">
                              <p id="demo"></p>
                          </div>
                      </div>
                      <div class="col-xs-12 col-sm-12 col-md-12">
                          <div class="form-group">
                              <strong>Add Address Manually (optional)</strong>
                              <textarea class="form-control" name="address" placeholder="Address" row="2"></textarea>
                          </div>
                      </div>
                      <div class="col-xs-12 col-sm-12 col-md-12">
                          <div class="form-group">
                              <strong>Quantity<span class="red">*</span></strong>
                              <input type="number" id="quantity" name="quantity" class="form-control" placeholder="Asset" required >
                          </div>
                      </div>
                      <div class="col-xs-12 col-sm-12 col-md-12">
                          <div class="form-group">
                              <strong>Condition</strong>
                              <select class="form-control select2 select2-success" data-dropdown-css-class="select2-success" id="condition" name="condition" style="width: 100%;">
                                <option value="">Please Select</option>
                                <option value="Like New">Like New</option>
                                <option value="Fair">Fair</option>
                                <option value="Used">Used</option>
                                <option value="Damaged">Damaged</option>
                              </select>  
                          </div>
                      </div>

                      <div class="col-xs-12 col-sm-12 col-md-12">
                          <div class="form-group">
                            <strong>Tagged</strong>
                            <div class="form-check">
                              <input class="form-check-input" type="radio" name="tagged" value="1">
                              <label class="form-check-label">Yes</label>
                            </div>
                            <div class="form-check">
                              <input class="form-check-input" type="radio" name="tagged" value="0">
                              <label class="form-check-label">No</label>
                            </div>
                          </div>
                      </div>
                      <div class="col-xs-12 col-sm-12 col-md-12">
                          <div class="form-group">
                              <strong>Description</strong>
                              <textarea class="form-control" name="description" placeholder="Description" row="3"></textarea>
                          </div>
                      </div>
                      <div class="col-xs-12 col-sm-12 col-md-12">
                          <div class="form-group">
                              <strong>Color (optional)</strong>
                              <input type="text" id="color" name="color" class="form-control" placeholder="Color">
                          </div>
                      </div>
                      <div class="col-xs-12 col-sm-12 col-md-12">
                          <div class="form-group">
                              <strong>Photo</strong>
                              <button type="button" id="imgCapture" class="btn btn-success green-btn">Click here capture your photo</button>  
                              
                          </div>
                      </div>
                      <div class="col-xs-12 col-sm-12 col-md-12">
                          <div class="form-group">
                              <img id="imgCaptureImg" style="display:none;" width="300" height="270"/>
                              <input id="photoData" type="hidden" name="photo"/>
                              <div id="webcam" class="mt-2" style="width:400px; height:400px;display:none;"></div>
                              <button type="button" style="display:none;" id="btnCapture" class="btn btn-success green-btn">capture photo</button>  
                          </div>
                      </div>
                      <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                              <button type="submit" class="btn btn-success green-btn">Save Data</button>
                              <a class="btn btn-success green-btn" href="{{ route('datacollection') }}"> Cancel</a>
                      </div>
                  </div>
                
              </form>
              </div>
              
            </div><!-- /.card-body -->
          </div>
          <!-- /.Customer Information -->

        </section>
    </div>

    <!-- /.row (main row) -->
  </div><!-- /.container-fluid -->
</section>
<!-- /.content -->

@endsection

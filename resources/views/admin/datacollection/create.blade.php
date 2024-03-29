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
              <form id="data_add" action="{{ route('data-add') }}" method="POST">
                  @csrf
                
                  <div class="row">
                      <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="row">
                            <div class="col-sm-6">
                              <div class="form-group">
                                <strong>Please Select Asset Types<span class="red">*</span></strong>
                                <select class="form-control select2 select2-success" data-dropdown-css-class="select2-success" id="asset" name="asset" style="width: 100%;" required>
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
                              <strong>Live Location<span class="red">*</span></strong>
                              <button type="button" class="btn btn-success green-btn mb-1" onclick="getLocation()">Click here</button>
                              <input type="hidden" id="latitude" name="latitude" class="form-control mb-1" placeholder="Latitude">
                              <input type="hidden" id="longitude" name="longitude" class="form-control" placeholder="Longitude">
                              <p id="demo"></p>
                          </div>
                      </div>
                      <div class="col-xs-12 col-sm-12 col-md-12">
                          <div class="form-group">
                              <strong>Address</strong>
                              <textarea class="form-control" name="autoaddress" id="autoaddress" placeholder="Address" row="2"></textarea>
                          </div>
                      </div>
                      
                      <div class="col-xs-12 col-sm-12 col-md-12">
                          <div class="form-group">
                              <strong>Add Address Manually (optional)</strong>
                              <textarea class="form-control" name="address" placeholder="Address" row="2"></textarea>
                          </div>
                      </div>

                      
                      <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="row">
                            <div class="col-sm-6">
                              <div class="form-group">
                                <strong>Please Select Status Types<span class="red">*</span></strong>
                                <select class="form-control select3 select2-success" data-dropdown-css-class="select2-success" id="status" name="status" style="width: 100%;" required>
                                  <option value="">Please Select</option>
                                  <option value="1">Add New Status</option>
                                  @foreach($status as $key=>$val)
                                  <option value="{{$val['name']}}">{{$val['name']}}</option>
                                  @endforeach
                                </select>  
                              </div>
                            </div>
                            <div class="col-sm-6" style="display:none;" id="addnewstatus">
                              <div class="form-group">
                                <strong>Or Add New Status Type</strong>
                                <input type="text" id="addnewstatus" name="addnewstatus" class="form-control" placeholder="Enter Status Name">
                              </div>
                            </div>
                        </div>
                      </div>

                      <div class="col-xs-12 col-sm-12 col-md-12">
                          <div class="form-group">
                              <strong>Quantity<span class="red">*</span></strong>
                              <input type="number" id="quantity" name="quantity" class="form-control" placeholder="Quantity" required >
                          </div>
                      </div>

                         
                      <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="row">
                            <div class="col-sm-6">
                              <div class="form-group">
                                <strong>Please Select Action Types<span class="red">*</span></strong>
                                <select class="form-control select4 select2-success" data-dropdown-css-class="select2-success" id="action" name="action" style="width: 100%;" required>
                                  <option value="">Please Select</option>
                                  <option value="1">Add New Action</option>
                                  @foreach($action as $key=>$val)
                                  <option value="{{$val['name']}}">{{$val['name']}}</option>
                                  @endforeach
                                </select>  
                              </div>
                            </div>
                            <div class="col-sm-6" style="display:none;" id="addnewaction">
                              <div class="form-group">
                                <strong>Or Add New Action Type</strong>
                                <input type="text" id="addnewaction" name="addnewaction" class="form-control" placeholder="Enter Action Name">
                              </div>
                            </div>
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
                      <div class="col-xs-12 col-sm-6 col-md-3">
                          <div class="form-group">
                              <strong>Color (optional)</strong>
                              <input type="color" id="color" name="color" class="form-control" placeholder="Color">
                          </div>
                      </div>
                      <div class="col-xs-12 col-sm-12 col-md-12">
                          <div class="form-group">
                              <strong>Photo</strong>
                              <button type="button" id="btn_capture" class="btn btn-success green-btn ml-5">Click here capture your photo</button>  
                              <input id="btn_ios_capture" type="file" accept="image/*" onchange="handleImageSelect(event)" hidden multiple>
                          </div>
                      </div>
                      <div class="col-xs-12 col-sm-12 col-md-12">
                          <div class="form-group">
                            <div class="display-cover" id="photosection" style="display:none;"> 
                                <video autoplay></video>
                                <canvas class="d-none"></canvas> 
                                <div class="controls">
                                    <input type="button" id="btn_screenshot" class="btn btn-outline-success screenshot d-none" value="ScreenShot"/>
                                </div>
                            </div>
                            <input type="hidden" id="photo_num" name="photo_num" value="0"/>
                            <div class="display-cover" id="iosphotosection" style="display:none;">
                            
                            </div>
                          </div>
                      </div>
                      <div class="col-xs-12 col-sm-12 col-md-12">
                          <div class="form-group">
                              <div class="row" id="gallery">

                              </div>
                          </div>
                      </div>

                      <div class="col-xs-12 col-sm-6 col-md-3" id="image_template">
                      </div>

                      <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                          <button type="submit" id="btn_submit" class="btn btn-success green-btn">Save Data</button>
                          <a class="btn btn-success green-btn" href="{{ route('datacollection') }}"> Cancel</a>
                      </div>
                  </div>
                
              </form>
              </div>
              <div id="temp_gallery" class="d-none">
                <div class="col-xs-12 col-sm-6 col-md-3 image-item" style="margin-bottom: 2px; padding:2px !important;">
                    <img class="image-template" alt="" style="width: 100%; height: auto">
                    <input class="photoData" type="hidden" name="photo"/>
                </div>
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

@extends('layouts.noref')
@section('title',"ClickMatrix | DataCollection")

@section('content')
 
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-12">
        <h1 class="mb-0 text-center">ClickMatrix</h1>
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
                Edit Data
              </h3>
            </div><!-- /.card-header -->
            <div class="card-body">
              <div class="tab-content p-0">
              <form action="{{ route('data-update',$user->id) }}" method="POST">
                  @csrf
                  <div class="row">
                      <div class="col-xs-12 col-sm-12 col-md-12">
                          <div class="form-group">
                              <strong>Asset</strong>
                              <input type="text" name="asset" value="{{ $user->asset }}" class="form-control" placeholder="Asset" require>
                          </div>
                      </div>
                      <div class="col-xs-12 col-sm-12 col-md-12">
                          <div class="form-group">
                              <strong>Address</strong>
                              <textarea class="form-control" style="height:150px" name="address" placeholder="Address" require>{{ $user->address }}</textarea>
                          </div>
                      </div>
                      <div class="col-xs-12 col-sm-12 col-md-12">
                          <div class="form-group">
                              <strong>Quantity</strong>
                              <input type="text" id="quantity" name="quantity" class="form-control" placeholder="Asset" value="{{ $user->quantity }}" required >
                          </div>
                      </div>
                      <div class="col-xs-12 col-sm-12 col-md-12">
                          <div class="form-group">
                              <strong>Condition</strong>
                              <select class="form-control select2 select2-success" data-dropdown-css-class="select2-success" id="condition" name="condition" style="width: 100%;">
                                <option value="New Like" {{ $user->condition=="New Like" ? 'Selected' : '' }}>New Like</option>
                                <option value="Fair" {{ $user->condition=="Fair" ? 'Selected' : '' }}>Fair</option>
                                <option value="Used" {{ $user->condition=="Used" ? 'Selected' : '' }}>Used</option>
                                <option value="Dameged" {{ $user->condition=="Dameged" ? 'Selected' : '' }}>Dameged</option>
                              </select>  
                          </div>
                      </div>
                      <div class="col-xs-12 col-sm-12 col-md-12">
                          <div class="form-group">
                            <strong>Tagged</strong>
                            <div class="form-check">
                              <input class="form-check-input" type="radio" name="tagged" value="1" {{ $user->tagged=="1" ? 'checked' : '' }}>
                              <label class="form-check-label">Yes</label>
                            </div>
                            <div class="form-check">
                              <input class="form-check-input" type="radio" name="tagged" value="0" {{ $user->tagged=="0" ? 'checked' : '' }}>
                              <label class="form-check-label">No</label>
                            </div>
                          </div>
                      </div>
                      <div class="col-xs-12 col-sm-12 col-md-12">
                          <div class="form-group">
                              <strong>Color</strong>
                              <input type="text" id="color" name="color" class="form-control" placeholder="Color" value="{{ $user->color }}" required >
                          </div>
                      </div>

                      <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                        <button type="submit" class="btn btn-success green-btn">Submit</button>
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

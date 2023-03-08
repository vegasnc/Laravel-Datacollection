@extends('layouts.noref')
@section('title',"ClickMatrix | Dashboard")
@section('vuescript')
<script src="{{asset('js/dashboard.js')}}"></script>
@endsection
@section('content')
<h1>Hello</h1>
<section class="content">
    <div class="container-fluid">
        <!-- Main row -->
        <div class="row mt-3">
            <div class="col-xs-12 col-sm-12 col-md-3">
                <a class="btn btn-success" href="{{ route('datacollection') }}"> Collect Data</a>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-3">
                <a class="btn btn-success" href="{{ route('datacollection') }}"> Sorting</a>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-3">
                <a class="btn btn-success" href="{{ route('datacollection') }}"> Reports</a>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-3">
                <a class="btn btn-success" href="{{ route('datacollection') }}"> Hello</a>
            </div>
        </div>
    </div>
</section>
@endsection

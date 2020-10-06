@extends('admin/home')
@section('title')
    Live Rate - Admin
@endsection
@section('header')
    Live Rate
@endsection
@section('content')
    <div class="panel-header panel-header-sm">
    </div>
    <div class="content">
        <div class="row">
            <div class="col-md-8 mr-5">
                <div class="card">
                    <div class="card-header">
                        <h5 class="title">Rate </h5>
                    </div>
                    @if(session('error'))
                        <div class="alert alert-danger">

                            <i class="fas fa-exclamation-triangle"></i>  {{session('error')}}

                        </div>
                    @endif
                    <div class="card-body">
                        <form method="post" action="{{route('rate.update')}}">
                            @csrf
                            <div class="row">
                                <div class="col-md-5 pr-1">
                                    <div class="form-group">
                                        <label>Current Rate - 1 PST = {{$rate->rate}} ₹ </label>
                                        <input type="text" name="rate" class="form-control" placeholder="₹" value="{{$rate->rate}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <button class="btn btn-large btn-success" type="submit">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

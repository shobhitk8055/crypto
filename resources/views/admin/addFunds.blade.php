@extends('admin/home')
@section('title')
    Add Funds - Admin
@endsection
@section('header')
    Add Funds
@endsection
@section('content')
    <div class="panel-header panel-header-sm">
    </div>
    <div class="content">
        <div class="row">
            <div class="col-md-8 mr-5">
                <div class="card">
                    <div class="card-header">
                        <h5 class="title">Add Funds - PST</h5>
                    </div>
                    @if(session('error'))
                        <div class="alert alert-danger">
                            <i class="fas fa-exclamation-triangle"></i>  {{session('error')}}
                        </div>
                    @endif
                    <div class="card-body">
                        <form method="post" action="{{route('admin.funds.create')}}">
                            @csrf
                            <div class="row">
                                <div class="col-md-5 pr-1">
                                    <div class="form-group">
                                        <label>Amount</label>
                                        <input type="number" name="amount"
                                                id="amount"
                                                class="form-control"
                                                required
                                                placeholder="PST">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-5 pr-1">
                                    <div class="form-group">
                                        <label>Username</label>
                                        <input type="text" name="username" class="form-control" placeholder="Username" value="">
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
        <div class="row">
            <div class="col-md-8 mr-5">
                <div class="card">
                    <div class="card-header">
                        <h5 class="title">Add Funds- USDT</h5>
                    </div>
                    @if(session('error'))
                        <div class="alert alert-danger">
                            <i class="fas fa-exclamation-triangle"></i>  {{session('error')}}
                        </div>
                    @endif
                    <div class="card-body">
                        <form method="post" action="{{route('admin.funds.usdt')}}">
                            @csrf
                            <div class="row">
                                <div class="col-md-5 pr-1">
                                    <div class="form-group">
                                        <label>Amount</label>
                                        <input type="number" name="amount"
                                                id="amount"
                                                class="form-control"
                                                required
                                                placeholder="USDT">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-5 pr-1">
                                    <div class="form-group">
                                        <label>Username</label>
                                        <input type="text" name="username" class="form-control" placeholder="Username" value="">
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

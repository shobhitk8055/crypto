@extends('admin/home')
@section('title')
        Admin- dashboard
    @endsection
@section('content')
        <div class="content" style="margin-top:70px">
            <h2 class="text-white mt-2" >Users</h2>
            <div class="row">
                <div class="col-lg-3">
                    <div class="card card-chart">
                        <div class="card-header">
                            <h5 class="card-category">Total Users</h5>
                            <h4 class="card-title">{{$usersCount}}</h4>
                            <div class="dropdown">
                                <button type="button" class="btn btn-round btn-outline-default dropdown-toggle btn-simple btn-icon no-caret" data-toggle="dropdown">
                                    <i class="now-ui-icons users_single-02"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="stats">
                                <i class="now-ui-icons arrows-1_refresh-69"></i>Just Updated
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="card card-chart">
                        <div class="card-header">
                            <h5 class="card-category">Active Users</h5>
                            <h4 class="card-title">{{$usersCount}}</h4>
                            <div class="dropdown">
                                <button type="button" class="btn btn-round btn-outline-default dropdown-toggle btn-simple btn-icon no-caret" data-toggle="dropdown">
                                    <i class="now-ui-icons users_single-02"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="stats">
                                <i class="now-ui-icons arrows-1_refresh-69"></i> Just Updated
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="card card-chart">
                        <div class="card-header">
                            <h5 class="card-category">Total users join today</h5>
                            <h4 class="card-title">{{$usersToday}}</h4>
                            <div class="dropdown">
                                <button type="button" class="btn btn-round btn-outline-default dropdown-toggle btn-simple btn-icon no-caret" data-toggle="dropdown">
                                    <i class="now-ui-icons users_single-02"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="stats">
                                <i class="now-ui-icons arrows-1_refresh-69"></i> Just Updated
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="card card-chart">
                        <div class="card-header">
                            <h5 class="card-category">Active users join today</h5>
                            <h4 class="card-title">{{$usersToday}}</h4>
                            <div class="dropdown">
                                <button type="button" class="btn btn-round btn-outline-default dropdown-toggle btn-simple btn-icon no-caret" data-toggle="dropdown">
                                    <i class="now-ui-icons users_single-02"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="stats">
                                <i class="now-ui-icons arrows-1_refresh-69"></i> Just Updated
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <h2 class="text-white">Withdrawals</h2>

            <div class="row">
                <div class="col-lg-3">
                    <div class="card card-chart">
                        <div class="card-header">
                            <h5 class="card-category">Approved withdrawals</h5>
                            <h4 class="card-title">{{$approvedWithdrawals}}</h4>
                            <div class="dropdown">
                                <button type="button" class="btn btn-round btn-outline-default dropdown-toggle btn-simple btn-icon no-caret" data-toggle="dropdown">
                                    <i class="now-ui-icons business_bank"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="stats">
                                <i class="now-ui-icons arrows-1_refresh-69"></i>Just Updated
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="card card-chart">
                        <div class="card-header">
                            <h5 class="card-category"> Pending withdrawals</h5>
                            <h4 class="card-title">{{ $pendingWithdrawals }}</h4>
                            <div class="dropdown">
                                <button type="button" class="btn btn-round btn-outline-default dropdown-toggle btn-simple btn-icon no-caret" data-toggle="dropdown">
                                    <i class="now-ui-icons business_bank"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="stats">
                                <i class="now-ui-icons arrows-1_refresh-69"></i> Just Updated
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="card card-chart">
                        <div class="card-header">
                            <h5 class="card-category">Today Approved withdrawals</h5>
                            <h4 class="card-title">{{$approvedWithdrawalsToday}}</h4>
                            <div class="dropdown">
                                <button type="button" class="btn btn-round btn-outline-default dropdown-toggle btn-simple btn-icon no-caret" data-toggle="dropdown">
                                    <i class="now-ui-icons business_bank"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="stats">
                                <i class="now-ui-icons arrows-1_refresh-69"></i> Just Updated
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="card card-chart">
                        <div class="card-header">
                            <h5 class="card-category">Today Pending withdrawals</h5>
                            <h4 class="card-title">{{$pendingWithdrawalsToday}}</h4>
                            <div class="dropdown">
                                <button type="button" class="btn btn-round btn-outline-default dropdown-toggle btn-simple btn-icon no-caret" data-toggle="dropdown">
                                    <i class="now-ui-icons business_bank"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="stats">
                                <i class="now-ui-icons arrows-1_refresh-69"></i> Just Updated
                            </div>
                        </div>
                    </div>
                </div>
            </div>
       <h2 class="text-white ">Funds Transfer</h2>

            <div class="row">
                <div class="col-lg-6">
                    <div class="card card-chart">
                        <div class="card-header">
                            <h5 class="card-category">Total Fund Transfer</h5>
                            <h4 class="card-title">{{$fundTransfer}}</h4>
                            <div class="dropdown">
                                <button type="button" class="btn btn-round btn-outline-default dropdown-toggle btn-simple btn-icon no-caret" data-toggle="dropdown">
                                    <i class="now-ui-icons ui-1_send"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="stats">
                                <i class="now-ui-icons arrows-1_refresh-69"></i>Just Updated
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card card-chart">
                        <div class="card-header">
                            <h5 class="card-category">User Fund Transfer</h5>
                            <h4 class="card-title">{{$fundTransfer}}</h4>
                            <div class="dropdown">
                                <button type="button" class="btn btn-round btn-outline-default dropdown-toggle btn-simple btn-icon no-caret" data-toggle="dropdown">
                                    <i class="now-ui-icons ui-1_send"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="stats">
                                <i class="now-ui-icons arrows-1_refresh-69"></i> Just Updated
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endsection

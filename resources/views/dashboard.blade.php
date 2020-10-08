@extends('home')

@section('content')
    <script src="{{ asset('js/app.js') }}"></script>
    <style>
    .complete-btn{
        border: none;
        color:green;
        cursor:pointer;
    }
    .cell{
        text-align:left;
    }
    .table td, .table th{
        padding: 8px 24px 8px 30px; //top right bottom left
    }
    .table{
        margin-top:5px;
    }
    </style>

    <div id="app">

    <dashboard-notification notification="{{ $user->notifications->not1 }}"></dashboard-notification>

    <!-- Page content -->
    <div class="container-fluid mt--6" style="background-color: #5E72E4;">
        <div class="row">
            <div class="col-xl-5" style="padding-top:64px">
                <div class="card card-profile">
                    <div class="row justify-content-center">
                        <div class="col-lg-3 order-lg-2">
                            <div class="card-profile-image">
                                <a href="/profile">
                                    <img src="../assets/img/theme/team-5.jpg" class="rounded-circle">
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
                    </div>
                    <div class="card-body pt-0">
                        <div class="row">
                            <div class="col">
                                <div class="card-profile-stats d-flex justify-content-center">
                                    <div>
                                        <span class="heading">{{$user->profile->pst?? "0"}}</span>
                                        <span class="description">PST</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <h5 class="h3">
                                {{$user->name}}
                            </h5>
                            <div>
                            <table class="table table-borderless">
                                <tbody>
                                <tr>
                                    <th class="cell ">Username</th>
                                    <td class="cell"> {{$user->username}}</td>

                                </tr>
                                <tr>
                                    <th scope="row" class="cell">Sponsor</th>
                                    <td class="cell">{{ $user->referral_username === ""? "No sponsor":$user->referral_username }}</td>
                                </tr>
                                <tr>
                                    <th scope="row" class="cell">Email</th>
                                    <td class="cell" colspan="2">{{$user->email}}</td>
                                </tr>
                                <tr>
                                    <th scope="row" class="cell">Join Date</th>
                                    <td class="cell" colspan="2">{{$user->created_at}}</td>
                                </tr>

                                <tr>
                                    <th scope="row" class="cell">Activation Date</th>
                                    <td class="cell" colspan="2">{{$package->created_at ??"Not Activated"}}</td>
                                </tr>
                                <tr>
                                    <th scope="row" class="cell">Direct Members</th>
                                    <td class="cell" colspan="2">{{$personallyEnrolled}}</td>
                                </tr>
                                <tr>
                                    <th scope="row" class="cell">Club Members</th>
                                    <td class="cell" colspan="2">0</td>
                                </tr>
                                <tr>
                                    <th scope="row" class="cell">Account Activated</th>
                                    <td class="cell" colspan="2">
                                        @if($profile->activated=="0")
                                            <i class="fas fa-exclamation-triangle text-danger"></i>
                                        @endif
                                            @if($profile->activated=="1")
                                            <i class="fas fa-check-circle text-success"></i>
                                        @endif
                                        {{$profile->activated=="0"?"No":"Yes"}}</td>
                                </tr>
                                </tbody>
                            </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-7" style="padding-top:64px;">
                <div class="row">
                    <div class="col-xl-4 col-md-6">
                        <div class="card card-stats">
                            <!-- Card body -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">Current Package</h5>
                                        <span class="h2 font-weight-bold mb-0">{{$package->name ?? "No package yet"}}</span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-gradient-orange text-white rounded-circle shadow">
                                            <i class="fas fa-coins"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-6">
                        <div class="card card-stats">
                            <!-- Card body -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">Main Wallet</h5>
                                        <span class="h2 font-weight-bold mb-0">{{$profile->pst }} PST </span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-gradient-info text-white rounded-circle shadow">
                                            <i class="ni ni-chart-bar-32"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-6">
                        <div class="card card-stats">
                            <!-- Card body -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">Total Income</h5>
                                        <span class="h2 font-weight-bold mb-0">{{$profile->income }} PST </span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-gradient-info text-white rounded-circle shadow">
                                            <i class="ni ni-chart-bar-32"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-4">
                        <div class="card card-stats">
                            <!-- Card body -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">Direct Income</h5>
                                        <span class="h2 font-weight-bold mb-0">{{ $user->profile->directIncome }} PST </span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-gradient-orange text-white rounded-circle shadow">
                                            <i class="fas fa-users"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-4">
                        <div class="card card-stats">
                            <!-- Card body -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">Level Income</h5>
                                        <span class="h2 font-weight-bold mb-0">{{ $user->profile->levelIncome }} PST </span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-gradient-green text-white rounded-circle shadow">
                                            <i class="fas fa-ruble-sign"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-4">
                        <div class="card card-stats">
                            <!-- Card body -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">Active Users</h5>
                                        <span class="h2 font-weight-bold mb-0">{{ $activeUsers}}</span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-gradient-green text-white rounded-circle shadow">
                                            <i class="fas fa-rupee-sign"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-4">
                        <div class="card card-stats">
                            <!-- Card body -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">Personally Enrolled</h5>
                                        <span class="h2 font-weight-bold mb-0">{{ $personallyEnrolled }}</span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
                                            <i class="fas fa-money-check-alt"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-4">
                        <div class="card card-stats">
                            <!-- Card body -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">Active Directs</h5>
                                        <span class="h2 font-weight-bold mb-0">{{$activeDirects }}</span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-gradient-orange text-white rounded-circle shadow">
                                            <i class="fas fa-users"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-4">
                        <div class="card card-stats">
                            <!-- Card body -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">Today Actives </h5>
                                        <span class="h2 font-weight-bold mb-0">{{$todayActives }}</span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
                                            <i class="fas fa-money-check-alt"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row p-5">
            <div class="table-responsive">
                <table class="table table-dark align-items-center table-flush">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col" class="sort" data-sort="name">Level</th>
                        <th scope="col" class="sort" data-sort="budget">Required Single Leg</th>
                        <th scope="col" class="sort" data-sort="status">Required Directs</th>
                        <th scope="col">Closing Club Members</th>
                        <th scope="col">Status</th>
                        <th scope="col">Profit Share</th>

                    </tr>
                    </thead>
                    <tbody class="list">
                        <tr>
                            <th scope="row">
                                LEVEL 1
                            </th>
                            <td class="budget">
                                {{$levelTeamCount}}/1
                            </td>
                            <td>
                                {{$personallyEnrolled}}/1
                            </td>
                            <td>
                                {{$userCount}}
                            </td>
                            <td>
                                {{ $levelTeamCount >= 1 && $personallyEnrolled >= 1 ? "Achieved" : "Pending" }}
                            </td>
                            <td>
                                5%
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                LEVEL 2
                            </th>
                            <td class="budget">
                                {{$levelTeamCount}}/50
                            </td>
                            <td>
                                {{$personallyEnrolled}}/2
                            </td>
                            <td>
                                {{$userCount}}
                            </td>
                            <td>
                                {{ $levelTeamCount >= 50 && $personallyEnrolled >= 2 ? "Achieved" : "Pending" }}
                            </td>
                            <td>
                                10%
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                LEVEL 3
                            </th>
                            <td class="budget">
                                {{$levelTeamCount}}/200
                            </td>
                            <td>
                                {{$personallyEnrolled}}/3
                            </td>
                            </td>
                            <td>
                                {{$userCount}}
                            </td>
                            <td>
                                {{ $levelTeamCount >= 200 && $personallyEnrolled >= 3 ? "Achieved" : "Pending" }}
                            </td>
                            <td>
                                10%
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                LEVEL 4
                            </th>
                            <td class="budget">
                                {{$levelTeamCount}}/500
                            </td>
                            <td>
                                {{$personallyEnrolled}}/4
                            </td>
                            <td>
                                {{$userCount}}
                            </td>
                            <td>
                                {{ $levelTeamCount >= 500 && $personallyEnrolled >= 4 ? "Achieved" : "Pending" }}
                            </td>
                            <td>
                                15%
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                LEVEL 5
                            </th>
                            <td class="budget">
                                {{$levelTeamCount}}/1000
                            </td>
                            <td>
                                {{$personallyEnrolled}}/5
                            </td>
                            <td>
                                {{$userCount}}
                            </td>
                            <td>
                                {{ $levelTeamCount >= 1000 && $personallyEnrolled >= 5 ? "Achieved" : "Pending" }}
                            </td>
                            <td>
                                20%
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                LEVEL 6
                            </th>
                            <td class="budget">
                                {{$levelTeamCount}}/2500
                            </td>
                            <td>
                                {{$personallyEnrolled}}/6
                            </td>
                            <td>
                                {{$userCount}}
                            </td>
                            <td>
                                {{ $levelTeamCount >= 2500 && $personallyEnrolled >= 6 ? "Achieved" : "Pending" }}
                            </td>
                            <td>
                                30%
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                LEVEL 7
                            </th>
                            <td class="budget">
                                {{$levelTeamCount}}/5000
                            </td>
                            <td>
                                {{$personallyEnrolled}}/7
                            </td>
                            <td>
                                {{$userCount}}
                            </td>
                            <td>
                                {{ $levelTeamCount >= 5000 && $personallyEnrolled >= 7 ? "Achieved" : "Pending" }}
                            </td>
                            <td>
                                35%
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                LEVEL 8
                            </th>
                            <td class="budget">
                                {{$levelTeamCount}}/10000
                            </td>
                            <td>
                                {{$personallyEnrolled}}/8
                            </td>
                            <td>
                                {{$userCount}}
                            </td>
                            <td>
                                {{ $levelTeamCount >= 10000 && $personallyEnrolled >= 8 ? "Achieved" : "Pending" }}
                            </td>
                            <td>
                                40%
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                LEVEL 9
                            </th>
                            <td class="budget">
                                {{$levelTeamCount}}/25000
                            </td>
                            <td>
                                {{$personallyEnrolled}}/9
                            </td>
                            <td>
                                {{$userCount}}
                            </td>
                            <td>
                                {{ $levelTeamCount >= 25000 && $personallyEnrolled >= 9 ? "Achieved" : "Pending" }}
                            </td>
                            <td>
                                45%
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                LEVEL 10
                            </th>
                            <td class="budget">
                                {{$levelTeamCount}}/50000
                            </td>
                            <td>
                                {{$personallyEnrolled}}/10
                            </td>
                            <td>
                                {{$userCount}}
                            </td>
                            <td>
                                {{ $levelTeamCount >= 50000 && $personallyEnrolled >= 10 ? "Achieved" : "Pending" }}
                            </td>
                            <td>
                                50%
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

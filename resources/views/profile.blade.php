@extends('home')
@section('title')
    <title>Profile - Cryptovests</title>
    @endsection
@section('content')
<style>
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
    <!-- Header -->
        <!-- Header -->
        <div class="header pb-6 d-flex align-items-center" style="min-height: 500px; background-image: url(../assets/img/theme/profile-cover.jpg); background-size: cover; background-position: center top;">
            <!-- Mask -->
            <span class="mask bg-gradient-default opacity-8"></span>
            <!-- Header container -->
            <div class="container-fluid d-flex align-items-center">
                <div class="row">
                    <div class="col-lg-7 col-md-10">
                        <h1 class="display-2 text-white" style="width: max-content;">Hello {{$user->name}}</h1>
                        <p class="text-white mt-0 mb-5"> {{$user->profile->description ?? "Welcome to Cryptovests world! You can buy or sell currencies here." }}</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page content -->
        <div class="container-fluid mt--8">
            <div class="row">
                <div class="col-xl-4 order-xl-2">
                    <div class="card card-profile">
                        <img src="../assets/img/theme/img-1-1000x600.jpg" alt="Image placeholder" class="card-img-top">
                        <div class="row justify-content-center">
                            <div class="col-lg-3 order-lg-2">
                                <div class="card-profile-image">
                                    <a href="#">
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
                                        <div>
                                            <span class="heading">{{$user->profile->usdt?? "0"}}</span>
                                            <span class="description">USDT</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center">
                                <h5 class="h3">
                                    {{$user->name}}
                                </h5>
                                <table class="table table-borderless">
                                    <tbody>
                                    <tr>
                                        <th class="cell ">Username</th>
                                        <td class="cell"> {{$user->username}}</td>

                                    </tr>
                                    <tr>
                                        <th scope="row" class="cell">Sponsor</th>
                                        <td class="cell">{{$user->referral_username}}</td>

                                    </tr>
                                    <tr>
                                        <th scope="row" class="cell">Join Date</th>
                                        <td class="cell" colspan="2">{{$user->created_at}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row" class="cell">Direct Members</th>
                                        <td class="cell" colspan="2">{{$user->team->count()}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row" class="cell">Club Members</th>
                                        <td class="cell" colspan="2">{{$clubCount}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row" class="cell">Account Activated</th>
                                        <td class="cell" colspan="2">{{$profile->activated=="0"?"No":"Yes"}}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-8 order-xl-1">
                    <form action="profile/edit" method="POST">
                        @csrf
                        @method('PATCH')
                    <div class="card">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col-8">
                                    <h3 class="mb-0">Edit profile </h3>
                                </div>

                                <div class="col-4 text-right">
                                    <button type="submit" class="btn btn-sm btn-primary">Save</button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            @if($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                                <h6 class="heading-small text-muted mb-4">User information</h6>
                                <div class="pl-lg-4">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Name</label>
                                                <input type="text" name="name"
                                                       id="input-username"
                                                       class="form-control"
                                                       placeholder="Username"
                                                       value="{{$user->name}}">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-email">Email address</label>
                                                <input type="email"
                                                       name="email"
                                                       id="input-email"
                                                       class="form-control"
                                                       value="{{$user->email}}"
                                                       placeholder="jesse@example.com">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-first-name">Username</label>
                                                <input type="username"
                                                       name="username"
                                                       id="input-first-name"
                                                       class="form-control"
                                                       placeholder="john.doe"
                                                       value="{{$user->username}}">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-last-name">Phone number 1</label>
                                                <input type="tel"
                                                       id="input-first-name"
                                                       name="number1"
                                                       class="form-control"
                                                       placeholder="+91"
                                                       value="{{$user->profile->number1??""}}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr class="my-4" />
                                <!-- Address -->
                                <h6 class="heading-small text-muted mb-4">Contact information</h6>
                                <div class="pl-lg-4">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-address">Address</label>
                                                <input id="input-address"
                                                       name="address"
                                                       class="form-control"
                                                       placeholder="Home Address"
                                                       value="{{$user->profile->address??""}}" type="text">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-city">City</label>
                                                <input type="text"
                                                       name="city"
                                                       id="input-city"
                                                       class="form-control"
                                                       placeholder="City"
                                                       value="{{$user->profile->city??""}}">
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-country">Country</label>
                                                <input type="text"
                                                       name="country"
                                                       id="input-country"
                                                       class="form-control"
                                                       placeholder="Country"
                                                       value="{{$user->profile->Country??""}}">
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-country">Postal code</label>
                                                <input type="number"
                                                       name="postcode"
                                                       id="input-postal-code"
                                                       class="form-control"
                                                       value="{{$user->profile->postcode??""}}"
                                                       placeholder="Postal code">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr class="my-4" />
                                <!-- Description -->
                                <h6 class="heading-small text-muted mb-4">About me</h6>
                                <div class="pl-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label">About Me</label>
                                        <textarea rows="4" class="form-control" name="description" placeholder="A few words about you ...">{{$user->profile->description??""}}</textarea>
                                    </div>
                                </div>


                        </div>

                    </div>
                    </form>
                    <form method="POST" action="changepassword">
                        @csrf
                        @method('PATCH')
                        <div class="card">
                            <div class="card-header">
                                <div class="row align-items-center">
                                    <div class="col-8">
                                        <h3 class="mb-0">Change Password</h3>
                                    </div>
                                    <div class="col-4 text-right">
                                        <button type="submit" class="btn btn-sm btn-primary">Save</button>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="pl-lg-4">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">New Password</label>
                                                <input type="password" name="password"
                                                       id="input-username"
                                                       class="form-control"
                                                       placeholder="Enter your new password">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
@endsection

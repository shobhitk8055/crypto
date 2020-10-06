@extends('admin/home')
@section('title')
    Profile - Admin
@endsection
@section('header')
    Profile
@endsection
@section('content')
    <div class="panel-header panel-header-sm">
    </div>
    <div class="content">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h5 class="title">Edit Profile</h5>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{route('admin.profile.update',['id'=>$user->id])}}">
                            @csrf
                            <div class="row">
                                <div class="col-md-5 pr-1">
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" name="name" class="form-control" placeholder="Company" value="{{$user->name}}">
                                    </div>
                                </div>
                                <div class="col-md-3 px-1">
                                    <div class="form-group">
                                        <label>Username</label>
                                        <input type="text" name="username" class="form-control" placeholder="Username" value="{{$user->username}}">
                                    </div>
                                </div>
                                <div class="col-md-4 pl-1">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Email address</label>
                                        <input type="email" name="email" class="form-control" placeholder="Email" value="{{$user->email}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 pr-1">
                                    <div class="form-group">
                                        <label>Number</label>
                                        <input type="tel" name="number1" class="form-control" placeholder="+91" value="{{$user->profile->number1}}">
                                    </div>
                                </div>
                                <div class="col-md-6 pl-1">
                                    <div class="form-group">
                                        <label>Sponser</label>
                                        <input type="text" disabled="" class="form-control" placeholder="sponser" value="{{$user->referral_username}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Address</label>
                                        <input type="text" class="form-control" name="address" placeholder="Home Address" value="{{$user->address}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 pr-1">
                                    <div class="form-group">
                                        <label>City</label>
                                        <input type="text" class="form-control" name="city" placeholder="City" value="{{$user->profile->city}}">
                                    </div>
                                </div>
                                <div class="col-md-4 px-1">
                                    <div class="form-group">
                                        <label>Country</label>
                                        <input type="text" class="form-control" name="country" placeholder="Country" value="{{$user->profile->country}}">
                                    </div>
                                </div>
                                <div class="col-md-4 pl-1">
                                    <div class="form-group">
                                        <label>Postal Code</label>
                                        <input type="number" name="postcode" class="form-control" placeholder="{{$user->profile->postcode}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>About Me</label>
                                        <textarea rows="4" cols="80" class="form-control" placeholder="Here can be your description" value="Mike">{{$user->profile->description}}</textarea>
                                    </div>
                                    <button class="btn btn-large btn-success" type="submit">Submit</button>

                                    <a class="btn btn-large btn-danger text-white" href="{{route('admin.profile.destroy',['id'=>$user->id])}}">Delete</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-user">
                    <div class="image">
                    </div>
                    <div class="card-body">
                        <div class="author">
                            <a href="#">
                                <br>
                                <h5 class="title">{{$user->name}}</h5>
                            </a>
                            <p class="description">
                                {{$user->username}}
                            </p>
                        </div>

                        <table class="table table-striped">
                            <tbody>
                            <tr>
                                <th scope="row" class="pl-5">Sponsor</th>
                                <td>{{$user->referral_username}}</td>
                            </tr>
                            <tr>
                                <th scope="row" class="pl-5">Join Date</th>
                                <td>{{$user->created_at}}</td>
                            </tr>
                            <tr>
                                <th scope="row" class="pl-5">Direct members</th>
                                <td>{{$user->team->count()}}</td>
                            </tr>
                            <tr>
                                <th scope="row" class="pl-5">Club members</th>
                                <td>{{$clubCount}}</td>
                            </tr>

                            </tbody>
                        </table>
                    </div>
                    <hr>
                    <div class="button-container">
                        <button href="#" class="btn btn-neutral btn-icon btn-round btn-lg">
                            <i class="fab fa-facebook-f"></i>
                        </button>
                        <button href="#" class="btn btn-neutral btn-icon btn-round btn-lg">
                            <i class="fab fa-twitter"></i>
                        </button>
                        <button href="#" class="btn btn-neutral btn-icon btn-round btn-lg">
                            <i class="fab fa-google-plus-g"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h5 class="title">Change Password</h5>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{route('admin.password.update',['id'=>$user->id])}}">
                            @csrf
                            @method('PATCH')
                            <div class="row">
                                <div class="col-md-5 pr-1">
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="password" name="password" class="form-control" placeholder="Enter new password" >
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                    </div>
                                    <button class="btn btn-large btn-success" type="submit">Change</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection

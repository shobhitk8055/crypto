@extends('admin/home')
@section('title')
    Users
@endsection
@section('header')
    Users
    @endsection
@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col">
                <form method="get" action="{{route('admin.users.search')}}">
                    <div class="input-group no-border mt-5" style="font-size: 30px">
                        <input type="search" value="" name="search" class="form-control" placeholder="Search by username...">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <button type="submit" style="background-color: transparent; border:none;">
                                    <i class="now-ui-icons ui-1_zoom-bold"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row mt-3">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead class=" text-primary">
                                <th>
                                    Action
                                </th>
                                <th>
                                    Serial No.
                                </th>
                                <th>
                                    Name
                                </th>
                                <th>
                                    Username
                                </th>
                                <th>
                                    Sponsor
                                </th>
                                <th>
                                    Email
                                </th>

                                <th>
                                    Join Date
                                </th>
                                </thead>
                                <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td>
                                            <a href="/admin/users/{{$user->id}}">Edit</a>
                                        </td>
                                        <td>
                                            {{ $user->id }}
                                        </td>
                                        <td>
                                            {{ $user->name }}
                                        </td>
                                        <td>
                                            {{ $user->username }}
                                        </td>
                                        <td>
                                            {{ $user->referral_username }}
                                        </td>
                                        <td>
                                            {{ $user->email }}
                                        </td>

                                        <td>
                                            {{$user->created_at}}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

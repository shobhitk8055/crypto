@extends('admin/home')
@section('title')
    Pending Withdrawal - Admin
@endsection
@section('header')
    Withdrawals
@endsection
@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col">
                <div class="input-group no-border mt-5" style="font-size: 30px">
                    <a class="btn btn-light" href="{{route('approvedWithdrawal')}}">Approved</a>
                    <a class="btn ml-4 btn-success" href="{{route('pendingWithdrawal')}}">Pending</a>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row mt-3">
            <div class="col-md-12">
                <div class="card">
                    <h4 class="ml-4">Pending</h4>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead class=" text-primary">
                                <th>
                                    Serial No
                                </th>
                                <th>
                                    Amount
                                </th>
                                <th>
                                    Name
                                </th>
                                <th>
                                    Username
                                </th>
                                <th>
                                    Address
                                </th>
                                <th>
                                    At
                                </th>
                                <th>
                                    Action
                                </th>
                                </thead>
                                <tbody>
                                @foreach($entries as $entry)
                                    <tr>
                                        <td>
                                            {{ $entry->id }}
                                        </td>
                                        <td>
                                            {{ $entry->amount }} {{$entry->currency}}
                                        </td>
                                        <td>
                                            {{ $entry->user->name }}
                                        </td>
                                        <td>
                                            {{ $entry->user->username }}
                                        </td>
                                        <td>
                                            {{ $entry->address }}
                                        </td>
                                        <td>
                                            {{ $entry->created_at }}
                                        </td>
                                        <td>
                                            <a href="{{route('approve',['id'=>$entry->id])}}">Approve now</a>
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

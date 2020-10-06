@extends('admin/home')
@section('title')
    Fund Requests - Admin
@endsection
@section('header')
    Fund Requests
@endsection
@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col">
                <div class="input-group no-border mt-5" style="font-size: 30px">
                    <a class="btn btn-light active" href="{{route('admin.approvedDeposit')}}">Approved</a>
                    <a class="btn ml-4 btn-success" href="{{route('admin.pendingDeposit')}}">Pending</a>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row mt-3">
            <div class="col-md-12">
                <div class="card">
                    <h4 class="ml-4">Pending Requests</h4>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead class=" text-primary">
                                <th>
                                    S No
                                </th>
                                <th>
                                    Username
                                </th>
                                <th>
                                    Name
                                </th>
                                <th>
                                    Volume
                                </th>
                                <th>
                                    Currency
                                </th>
                                <th>
                                    Rate
                                </th>
                                <th>
                                    Payable amount
                                </th>
                                <th>
                                    TID
                                </th>
                                <th>
                                    Action
                                </th>
                                </thead>
                                <tbody>
                                @foreach($deposits as $deposit)
                                    <tr>
                                        <td>
                                            {{ $count++ }}
                                        </td>
                                        <td>
                                            {{\App\User::find($deposit->user_id)->username}}
                                        </td>
                                        <td>
                                            {{\App\User::find($deposit->user_id)->name}}
                                        </td>
                                        <td>
                                            {{ $deposit->volume }}
                                        </td>
                                        <td>
                                            {{ $deposit->currency }}
                                        </td>
                                        @if($deposit->currency==="pst")
                                            <td>
                                                {{$deposit->pstRate}} ₹
                                            </td>
                                        @endif
                                        @if($deposit->currency==="usdt")
                                            <td>
                                                {{$deposit->usdtRate}} ₹
                                            </td>
                                        @endif
                                        <td>
                                            {{ $deposit->payableAmount }} ₹
                                        </td>
                                        <td>
                                            {{ $deposit->tid }}
                                        </td>
                                        <td>
                                            <form method="post" action="{{route('admin.deposit.update')}}">
                                                @csrf

                                                <input type="hidden" name="userID" value="{{$deposit->user_id}}">
                                                <input type="hidden" name="depositID" value="{{$deposit->id}}">
                                                <input type="hidden" name="currency" value="{{$deposit->currency}}">
                                                <button type="submit" class="btn btn-primary">
                                                    mark as approved
                                                </button>
                                            </form>
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

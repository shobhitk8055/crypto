@extends('home')
@section('title')
    <title>Withdraw Funds - Cryptovests</title>
@endsection
@section('content')

    <div class="container mt-5 add-funds-form">

        <div class="row">
            <div class="col-xl-8">
                @if(session('error'))
                    <div class="alert alert-danger">

                        <i class="fas fa-exclamation-triangle"></i>  {{session('error')}}

                    </div>
                @endif
                <form method="POST" action="withdraw/create">
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col-8">
                                    <h3 class="mb-0">Withdraw Money</h3>
                                </div>
                                <div class="col-4 text-right">
                                    <button type="submit" class="btn btn-sm btn-primary">Withdraw</button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="pl-lg-4">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="amount">Currency</label>
                                            <select type="number" name="currency"
                                                   id="amount"
                                                   class="form-control"
                                                   required
                                                   placeholder="PST">
                                                <option value="pst">PST</option>
                                                <option value="usdt">USDT</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="amount">Amount</label>
                                            <input type="number" name="amount"
                                                   id="amount"
                                                   class="form-control"
                                                   required
                                                   placeholder="00">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
{{--                                    <div class="col-lg-6">--}}
{{--                                        <div class="form-group">--}}
{{--                                            <label class="form-control-label" for="account">Account</label>--}}
{{--                                            <select type="account" name="bank_id"--}}
{{--                                                   id="account"--}}
{{--                                                   class="form-control"--}}
{{--                                                   required--}}
{{--                                                    placeholder="Accounts">--}}
{{--                                                @foreach($accounts as $account)--}}
{{--                                                    <option value="{{$account->id}}">{{$account->bank_name}} - {{$account->account_holder_name}}</option>--}}
{{--                                                @endforeach--}}
{{--                                            </select>--}}
{{--                                    <input type="hidden" name="approved" value="0">--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="account">Address</label>
                                            <input type="account" name="address"
                                                   id="account"
                                                   class="form-control"
                                                   required
                                                    placeholder="0x**">
                                    <input type="hidden" name="approved" value="0">
                                        </div>
                                    </div>
                                </div>
                                <h2 class="badge badge-primary">Current Balance - {{auth()->user()->profile->pst??"0"}} PST, {{auth()->user()->profile->usdt}} USDT </h2>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
                <div class="col-xl-6">
                    <div class="alert alert-danger" role="alert"><ul> <li>WITHDRAWAL AMOUNT SHOULD BE MINIMUM PST 1000</li>
                            <li>2% WILL BE CHARGED EXTRA ON BANK WITHDRAWAL.</li></ul></div>
                </div>
        </div>
        <div class="row mt-2">

                <div class="col-xl-9 mt-3">
                <div class="card bg-default">
                    <!-- Card header -->
                    <div class="card-header bg-transparent border-0">
                        <h3 class="mb-0 text-white">
                            Withdrawal History
                        </h3>
                    </div>
                    <!-- Light table -->
                    <div class="table-responsive">
                        <table class="table table-dark align-items-center table-flush">
                            <thead class="thead-dark">
                            <tr>
                                <th scope="col" class="sort" data-sort="name">Amount</th>
                                <th scope="col" class="sort" data-sort="budget">Account</th>
                                <th scope="col" class="sort" data-sort="status">At</th>
                                <th scope="col">Status</th>
                            </tr>
                            </thead>
                            <tbody class="list">
                            @foreach($withdrawls as $withdrawl)
                                <tr>
                                    <th scope="row">
                                        {{$withdrawl->amount}}
                                    </th>
                                    <td>
                                        {{$withdrawl->created_at}}
                                    </td>
                                    <td>
                                        {{$withdrawl->approved == "0"?"Pending":"Approved"}}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- Card footer -->
                    <div class="card-footer bg-transparent py-4">
                        <nav aria-label="...">

                            <ul class="pagination justify-content-end mb-0">
{{--                                {{ $transfers->links() }}--}}
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

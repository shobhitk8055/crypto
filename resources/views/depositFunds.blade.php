@extends('home')
@section('title')
    <title>Deposit Funds - Cryptovests</title>
@endsection
@section('content')
    <script src="{{ asset('js/app.js') }}"></script>
    <div class="container mt-5 add-funds-form" id="app">
{{--        <deposit-form--}}
{{--            pst="{{$pstRate}}"--}}
{{--            usdt={{$usdtRate}}--}}
{{--            csrf="{{csrf_token()}}"--}}
{{--            address="{{auth()->user()->wallet->address}}"--}}
{{--                ></deposit-form>--}}
        <div class="row">
            <div class="col-xl-8">
                <form method="POST" action="deposit/create">
                    @csrf
                    <div class="card">
                        <div class="card-body">
                            <div class="pl-lg-4">

                                <div class="row">
                                    <div class="col-lg-10">
                                        <p>Your address - {{ auth()->user()->wallet->address }}</p>
                                    </div>
                                    <div class="col-lg-10">
                                        <p>Available PST - {{ auth()->user()->profile->pst }}</p>
                                    </div>
                                    <div class="col-lg-10">
                                        <p>Available USDT - {{ auth()->user()->profile->usdt }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card bg-default">
                    <!-- Card header -->
                    <div class="card-header bg-transparent border-0">
                        <h3 class="mb-0 text-white">Deposit History</h3>
                    </div>
                    <!-- Light table -->
                    <div class="table-responsive">
                        <table class="table table-dark align-items-center table-flush">
                            <thead class="thead-dark">
                            <tr>
                                <th scope="col" class="sort" data-sort="name">Serial No.</th>
                                <th scope="col" class="sort" data-sort="name">Currency</th>
                                <th scope="col" class="sort" data-sort="budget">Rate</th>
                                <th scope="col" class="sort" data-sort="status">Volume</th>
                                <th scope="col">Payable Amount</th>
                                <th scope="col">TID</th>
                                <th scope="col">Status</th>
                            </tr>
                            </thead>
                            <tbody class="list">
                            @foreach($allDeposits as $deposit)
                                <tr>
                                <th scope="row">
                                    {{$count++}}
                                </th>
                                <td class="budget">
                                    {{$deposit->currency === "pst"?"PST":"USDT"}}
                                </td>
                                    @if($deposit->currency==="pst")
                                <td>
                                    {{$deposit->pstRate}} ₹/pst
                                </td>
                                    @endif
                                    @if($deposit->currency==="usdt")
                                <td>
                                    {{$deposit->usdtRate}} ₹/usdt
                                </td>
                                    @endif
                                <td>
                                    {{$deposit->volume}}
                                </td>
                                <td>
                                    {{$deposit->payableAmount}} ₹
                                </td>
                                <td>
                                    {{$deposit->tid ?? "" }}
                                </td>
                                <td>
                                    {{$deposit->validated === "1"?"Credited":"Pending"}}
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
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
</div>

@endsection

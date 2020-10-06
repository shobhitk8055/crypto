@extends('home')
@section('title')
    <title>Buy/Sell Funds - Trading Cryptovests</title>
@endsection
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
        <!-- Page content -->
        <div class="container-fluid py-5" style="background-color: #5E72E4;">
            <div class="row">
                <div class="col-xl-3">
                    <div class="card">
                        <div class="card-header border-0">
                            <div class="row align-items-center">
                                <div class="col">
                                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#buy" role="tab" aria-controls="home"
                                               aria-selected="true">Buy PST</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#sell" role="tab" aria-controls="profile"
                                               aria-selected="false">Sell PST</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="buy" role="tabpanel" aria-labelledby="home-tab">
                                <buy-form pst="{{$rate}}"
                                          balance="{{$user->profile->availableUSDT}}"
                                          usdt={{$usdtRate}}
                                              csrf="{{csrf_token()}}">
                                </buy-form>
                            </div>
                            <div class="tab-pane fade" id="sell" role="tabpanel" aria-labelledby="profile-tab">
                                <sell-form pst="{{$rate}}"
                                           usdt={{$usdtRate}}
                                               csrf="{{csrf_token()}}"
                                           bal="{{$user->profile->availablePST}}"
                                >
                                </sell-form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 order-2">
                    <div class="card bg-default shadow">
                        <div class="card-header border-0 bg-transparent">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h3 class="mb-0 text-white">Buy orders</h3>
                                </div>
                                {{--                            <div class="col text-right">--}}
                                {{--                                <a href="/orderbook" class="btn btn-sm btn-primary">See all</a>--}}
                                {{--                            </div>--}}
                            </div>
                        </div>
                        <div class="table-responsive">
                            <!-- Projects table -->
                            <table class="table align-items-center table-dark table-flush">
                                <thead class="thead-dark">
                                <tr>
                                    <th scope="col">Buy Price</th>
                                    <th scope="col">Volume</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($openBuyOrdersAll as $openBuyOrderAll)
                                    <tr>
                                        <td>
                                            {{$openBuyOrderAll['price']}}
                                        </td>
                                        <td>
                                            {{$openBuyOrderAll['amount']}}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 order-2">
                    <div class="card bg-default shadow">
                        <div class="card-header border-0 bg-transparent">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h3 class="mb-0 text-white">Sell Orders</h3>
                                </div>
                                {{--                            <div class="col text-right">--}}
                                {{--                                <a href="/orderbook" class="btn btn-sm btn-primary">See all</a>--}}
                                {{--                            </div>--}}
                            </div>
                        </div>
                        <div class="table-responsive">
                            <!-- Projects table -->
                            <table class="table align-items-center table-dark table-flush">
                                <thead class="thead-dark">
                                <tr>
                                    <th scope="col">Buy Price</th>
                                    <th scope="col">Volume</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($openSellOrdersAll as $openSellOrderAll)
                                    <tr>
                                        <td>
                                            {{$openSellOrderAll['price']}}
                                        </td>
                                        <td>
                                            {{$openSellOrderAll['amount']}}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 order-2">
                    <div class="card bg-default">
                        <div class="card-header bg-transparent border-0">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h3 class="mb-0 text-white">Trade History</h3>
                                </div>
                                {{--                            <div class="col text-right">--}}
                                {{--                                <a href="tradehistory" class="btn btn-sm btn-primary">all</a>--}}
                                {{--                            </div>--}}
                            </div>
                        </div>
                        <div class="table-responsive">
                            <!-- Projects table -->
                            <table class="table table-dark align-items-center table-flush">
                                <thead class="thead-dark">
                                <tr>
                                    <th scope="col">Type</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Volume</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($orders as $order)

                                    <tr>
                                        <th scope="row">
                                            {{ $order->type}}
                                        </th>
                                        <td>
                                            {{ $order->price  }}
                                        </td>
                                        <td>
                                            {{$order->initialAmount}}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-7">
                    <div class="card">
                        <div class="card-header border-0">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h3 class="mb-0">My open orders</h3>
                                </div>
                                <div class="col text-right">
                                    <a href="/myorders" class="btn btn-sm btn-primary">See all</a>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <!-- Projects table -->
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                <tr>
                                    <th scope="col">Type</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Volume</th>
                                    <th scope="col"></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($openOrders as $authorder)
                                    <tr>
                                        <th scope="row">
                                            {{$authorder->type}}
                                        </th>
                                        <td>
                                            {{$authorder->price}}
                                        </td>
                                        <td>
                                            {{$authorder->amount}}
                                        </td>
                                        <td>
                                            <form method="POST" action="/orders/edit">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="order_id" value="{{ $authorder->id }}">
                                                <button class="complete-btn text-danger pr-2" type="submit" style="background-color: transparent;"> <i class="fas fa-check mx-1"></i> DELETE ORDER</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-xl-5">
                    <div class="card">
                        <div class="card-header border-0">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h3 class="mb-0">My completed orders</h3>
                                </div>
                                <div class="col text-right">
                                    <a href="/myorders" class="btn btn-sm btn-primary">See all</a>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <!-- Projects table -->
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                <tr>
                                    <th scope="col">Type</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Volume</th>

                                </tr>
                                </thead>
                                <tbody>
                                @foreach($completedOrders as $completedOrder)
                                    <tr>
                                        <th scope="row">
                                            {{$completedOrder->type}}
                                        </th>
                                        <td>
                                            {{$completedOrder->price}}
                                        </td>
                                        <td>
                                            {{$completedOrder->amount}}
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

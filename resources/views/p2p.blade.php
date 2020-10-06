@extends('home')
@section('title')
    <title>P2P Funds - Cryptovests</title>
@endsection
@section('content')
    <script src="{{ asset('js/app.js') }}"></script>
    <div class="container-fluid mt-2">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#pst" role="tab" aria-controls="pst"
                                           aria-selected="true">PST</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="home-tab" data-toggle="tab" href="#usdt" role="tab" aria-controls="home"
                                           aria-selected="false">USDT</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="tab-content" id="app">
                        <div class="tab-pane fade show active" id="pst" role="tabpanel" aria-labelledby="pst-tab">
                            <div class="container">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#buypst" role="tab" aria-controls="buypst"
                                                   aria-selected="true">Buy</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="home-tab" data-toggle="tab" href="#sellpst" role="tab" aria-controls="home"
                                                   aria-selected="false">Sell</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-content" id="app">
                                <div class="tab-pane fade show active" id="buypst" role="tabpanel" aria-labelledby="buypst-tab">
                                    <p2p-place-form
                                        :bank="{{json_encode($accounts)}}"
                                        csrf="{{csrf_token()}}"
                                        price="2.50"
                                        type="Sell"
                                        balance="{{auth()->user()->profile->pst}}"
                                        currency="pst"
                                    ></p2p-place-form>
                                </div>
                                <div class="tab-pane fade" id="sellpst" role="tabpanel" aria-labelledby="sellpst-tab">
                                    <p2p-place-form
                                        :bank="{{json_encode($accounts)}}"
                                        csrf="{{csrf_token()}}"
                                        type="Buy"
                                        price="2.50"
                                        balance="{{auth()->user()->profile->availablePST}}"
                                        currency="pst"
                                    ></p2p-place-form>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="usdt" role="tabpanel" aria-labelledby="usdt-tab">
                            <div class="container">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#buyusdt" role="tab" aria-controls="buyusdt"
                                                   aria-selected="true">Buy</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="home-tab" data-toggle="tab" href="#sellusdt" role="tab" aria-controls="home"
                                                   aria-selected="false">Sell</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-content" id="app">
                                <div class="tab-pane fade" id="buyusdt" role="tabpanel" aria-labelledby="buyusdt-tab">
                                    <p2p-place-form
                                        :bank="{{json_encode($accounts)}}"
                                        csrf="{{csrf_token()}}"
                                        type="Sell"
                                        balance="{{auth()->user()->profile->usdt}}"
                                        price="73.50"
                                        currency="usdt"
                                    ></p2p-place-form>
                                </div>
                                <div class="tab-pane fade" id="sellusdt" role="tabpanel" aria-labelledby="sellusdt-tab">
                                    <p2p-place-form
                                        :bank="{{json_encode($accounts)}}"
                                        csrf="{{csrf_token()}}"
                                        type="Buy"
                                        balance="{{auth()->user()->profile->availableUSDT}}"
                                        price="73.50"
                                        currency="usdt"
                                    ></p2p-place-form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid mt-2">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#buypst" role="tab" aria-controls="buypst"
                                           aria-selected="true" style="font-size:20px; padding:15px;">PST</a>
                                    </li>
{{--                                    <li class="nav-item">--}}
{{--                                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#sellpst" role="tab" aria-controls="sellpst"--}}
{{--                                           aria-selected="false" style="font-size:20px; padding:15px;">PST</a>--}}
{{--                                    </li>--}}
                                    <li class="nav-item">
                                        <a class="nav-link" id="home-tab" data-toggle="tab" href="#buyusdt" role="tab" aria-controls="home"
                                           aria-selected="false" style="font-size:20px; padding:15px;">USDT</a>
                                    </li>
{{--                                    <li class="nav-item">--}}
{{--                                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#sellusdt" role="tab" aria-controls="profile"--}}
{{--                                           aria-selected="false" style="font-size:20px; padding:15px;">Sell USDT</a>--}}
{{--                                    </li>--}}
{{--                                    <li class="nav-item offset-4 float-right">--}}
{{--                                        <a href="{{route('p2p.showCreateForm')}}" class="w-100 btn btn-lg btn-primary">Place my order</a>--}}
{{--                                    </li>--}}
                                    <li class="nav-item ml-3 float-right">
                                        <a href="/p2p/transactions" class="w-100 btn btn-lg btn-primary">Transactions</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="tab-content" id="app">
                        <div class="tab-pane fade show active" id="buypst" role="tabpanel" aria-labelledby="buypst-tab">
                            <div class="container">
{{--                                <div class="row">--}}
{{--                                    <div class="col-xl-3">--}}
{{--                                        <label for="amount" style="font-size:13px;">Amount</label>--}}
{{--                                        <div class="input-group input-group-alternative input-group-merge">--}}
{{--                                            <div class="input-group-prepend">--}}
{{--                                                <span class="input-group-text"><i class="fas fa-search"></i></span>--}}
{{--                                            </div>--}}
{{--                                            <input class="form-control" id="amount" placeholder="amount" type="text">--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="col-xl-3">--}}
{{--                                        <label for="paymentMethod" style="font-size:13px;">Payment Method</label>--}}
{{--                                        <select class="form-control" name="paymentMethod" id="paymentMethod">--}}
{{--                                            <option value="bank">Bank</option>--}}
{{--                                            <option value="upi">UPI</option>--}}
{{--                                            <option value="paytm">Paytm</option>--}}
{{--                                        </select>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
                                <div class="row mt-4">
                                    <div class="col-6">
                                        <div class="card">
                                            <div class="table-responsive shadow-none" id="app">
                                                <table class="table shadow-none align-items-center table-flush">
                                                    <thead class="thead-light shadow-none">
                                                    <tr>
                                                        <th scope="col" class="sort" data-sort="name">Volume</th>
                                                        <th scope="col" class="sort" data-sort="budget">Buy Price</th>
                                                        <th scope="col" class="sort" data-sort="budget">Action</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($buyPstOrders as $buyPstOrder)
                                                    <tr>
                                                        <th class="pt-4" scope="row"><h3>{{$buyPstOrder['amount']}}</h3></th>
                                                        <td class="pt-4"><h3>{{$buyPstOrder['price']}} <span style="font-size:10px;">₹/PST</span></h3>

                                                        </td>

                                                            @if($buyPstOrder->user->username === auth()->user()->username)
                                                            <td>
                                                            <form action="{{route('ordersCompleter',['id'=>$buyPstOrder->id])}}" method="post">
                                                                @csrf
                                                                    <button class="btn btn-danger btn-sm" type="submit">Cancel order</button>
                                                                </form>
                                                            </td>
                                                        @endif
                                                    </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="card">
                                            <div class="table-responsive shadow-none" id="app">
                                            <table class="table shadow-none align-items-center table-flush">
                                                    <thead class="thead-light shadow-none">
                                                    <tr>
                                                        <th scope="col" class="sort" data-sort="name">Volume</th>
                                                        <th scope="col" class="sort" data-sort="budget">Sell Price</th>
                                                        <th scope="col" class="sort" data-sort="budget">Action</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($sellPstOrders as $sellPstOrder)
                                                    <tr>
                                                        <th class="pt-4" scope="row"><h3>{{$sellPstOrder['amount']}}</h3></th>
                                                        <td class="pt-4"><h3>{{$sellPstOrder['price']}} <span style="font-size:10px;">₹/PST</span></h3></td>

                                                         @if($sellPstOrder->user->username === auth()->user()->username)
                                                            <td>
                                                                <form action="{{route('ordersCompleter',['id'=>$sellPstOrder->id])}}" method="post">
                                                                    @csrf
                                                                    <button class="btn btn-danger btn-sm" type="submit">Cancel order</button>
                                                                </form>
                                                            </td>
                                                         @endif
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
                        <div class="tab-pane fade" id="sellpst" role="tabpanel" aria-labelledby="sellpst-tab">
                            <div class="container">
{{--                                <div class="row">--}}
{{--                                    <div class="col-xl-3">--}}
{{--                                        <label for="amount" style="font-size:13px;">Amount</label>--}}
{{--                                        <div class="input-group input-group-alternative input-group-merge">--}}
{{--                                            <div class="input-group-prepend">--}}
{{--                                                <span class="input-group-text"><i class="fas fa-search"></i></span>--}}
{{--                                            </div>--}}
{{--                                            <input class="form-control" id="amount" placeholder="amount" type="text">--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="col-xl-3">--}}
{{--                                        <label for="paymentMethod" style="font-size:13px;">Payment Method</label>--}}
{{--                                        <select class="form-control" name="paymentMethod" id="paymentMethod">--}}
{{--                                            <option value="bank">Bank</option>--}}
{{--                                        </select>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
                                <div class="row mt-4">
                                    <div class="col">
                                        <div class="card">
                                            <div class="table-responsive shadow-none" id="app">
                                                <table class="table shadow-none align-items-center table-flush">
                                                    <thead class="thead-light shadow-none">
                                                    <tr>
                                                        <th scope="col" class="sort" data-sort="name">Username</th>
                                                        <th scope="col" class="sort" data-sort="budget">Price</th>
                                                        <th scope="col" class="sort" data-sort="status">Amount</th>
                                                        <th scope="col">Limit</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($sellPstOrders as $sellPstOrder)
                                                        <tr>
                                                            <th class="pt-4" scope="row"><h3>cryptouser</h3></th>
                                                            <td class="pt-4"><h3>{{$sellPstOrder['price']}} <span style="font-size:10px;">₹/PST</span></h3></td>
                                                            <td class="pt-4"><h3>{{$sellPstOrder['amount']}}<span style="font-size:10px;"> PST</span></h3></td>
                                                            <td class="pt-4"><h3>{{$sellPstOrder['payableAmount']}}<span style="font-size:10px;"> PST</span></h3></td>
{{--                                                            <td>--}}
{{--                                                                @if($sellPstOrder->user->username !== auth()->user()->username)--}}
{{--                                                                    <a class="btn text-white btn-md btn-success" href="{{route('p2p.showOrder',['order_id'=>$sellPstOrder->id])}}" id="buyButton">--}}
{{--                                                                        Sell Pst--}}
{{--                                                                    </a>--}}
{{--                                                                @endif--}}
{{--                                                            </td>--}}
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
                        <div class="tab-pane fade" id="buyusdt" role="tabpanel" aria-labelledby="buyusdt-tab">
                            <div class="container">
{{--                                <div class="row">--}}
{{--                                    <div class="col-xl-3">--}}
{{--                                        <label for="amount" style="font-size:13px;">Amount</label>--}}
{{--                                        <div class="input-group input-group-alternative input-group-merge">--}}
{{--                                            <div class="input-group-prepend">--}}
{{--                                                <span class="input-group-text"><i class="fas fa-search"></i></span>--}}
{{--                                            </div>--}}
{{--                                            <input class="form-control" id="amount" placeholder="amount" type="text">--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="col-xl-3">--}}
{{--                                        <label for="paymentMethod" style="font-size:13px;">Payment Method</label>--}}
{{--                                        <select class="form-control" name="paymentMethod" id="paymentMethod">--}}
{{--                                            <option value="bank">Bank</option>--}}
{{--                                            --}}{{--                                            <option value="upi">UPI</option>--}}
{{--                                            --}}{{--                                            <option value="paytm">Paytm</option>--}}
{{--                                        </select>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
                                <div class="row mt-4">
                                    <div class="col-6">
                                        <div class="card">
                                            <div class="table-responsive shadow-none" id="app">
                                                <table class="table shadow-none align-items-center table-flush">
                                                    <thead class="thead-light shadow-none">
                                                    <tr>
                                                        <th scope="col" class="sort" data-sort="name">Volume</th>
                                                        <th scope="col" class="sort" data-sort="budget">Buy Price</th>
                                                        <th scope="col" class="sort" data-sort="budget">Action</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($buyUsdtOrders as $buyUsdtOrder)
                                                        <tr>
                                                            <th class="pt-4" scope="row"><h3>{{$buyUsdtOrder['amount']}}</h3></th>
                                                            <td class="pt-4"><h3>{{$buyUsdtOrder['price']}} <span style="font-size:10px;">₹/USDT</span></h3></td>

{{--                                                            @if($buyUsdtOrder->user->username === auth()->user()->username)--}}
                                                                <td>
                                                                    <form action="{{route('ordersCompleter', ['id'=>$buyUsdtOrder->id])}}" method="post">
                                                                        @csrf
                                                                        <button class="btn btn-danger btn-sm" type="submit">Cancel order</button>
                                                                    </form>
                                                                </td>
{{--                                                            @endif--}}

                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="card">
                                            <div class="table-responsive shadow-none" id="app">
                                                <table class="table shadow-none align-items-center table-flush">
                                                    <thead class="thead-light shadow-none">
                                                    <tr>
                                                        <th scope="col" class="sort" data-sort="name">Volume</th>
                                                        <th scope="col" class="sort" data-sort="budget">Sell Price</th>
                                                        <th scope="col" class="sort" data-sort="budget">Action</th>

                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($sellUsdtOrders as $sellUsdtOrder)
                                                        <tr>
                                                            <th class="pt-4" scope="row"><h3>{{$sellUsdtOrder['amount']}}</h3></th>
                                                            <td class="pt-4"><h3>{{$sellUsdtOrder['price']}} <span style="font-size:10px;">₹/USDT</span></h3></td>

{{--                                                            @if($sellUsdtOrder->user->username === auth()->user()->username)--}}
                                                                <td>
                                                                    <form action="{{route('ordersCompleter',['id'=>$sellUsdtOrder->id])}}" method="post">
                                                                        @csrf
                                                                        <button class="btn btn-danger btn-sm" type="submit">Cancel order</button>
                                                                    </form>
                                                                </td>
{{--                                                            @endif--}}
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
                        <div class="tab-pane fade" id="sellusdt" role="tabpanel" aria-labelledby="sellusdt-tab">
                            <div class="container">
                                <div class="row">
                                    <div class="col-xl-3">
                                        <label for="amount" style="font-size:13px;">Amount</label>
                                        <div class="input-group input-group-alternative input-group-merge">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-search"></i></span>
                                            </div>
                                            <input class="form-control" id="amount" placeholder="amount" type="text">
                                        </div>
                                    </div>
                                    <div class="col-xl-3">
                                        <label for="paymentMethod" style="font-size:13px;">Payment Method</label>
                                        <select class="form-control" name="paymentMethod" id="paymentMethod">
                                            <option value="bank">Bank</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col">
                                        <div class="card">
                                            <div class="table-responsive shadow-none" id="app">
                                                <table class="table shadow-none align-items-center table-flush">
                                                    <thead class="thead-light shadow-none">
                                                    <tr>
                                                        <th scope="col" class="sort" data-sort="name">Username</th>
                                                        <th scope="col" class="sort" data-sort="budget">Price</th>
                                                        <th scope="col" class="sort" data-sort="status">Amount</th>
                                                        <th scope="col">Limit</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($sellUsdtOrders as $sellUsdtOrder)
                                                        <tr>
                                                            <th class="pt-4" scope="row"><h3>cryptouser</h3></th>
                                                            <td class="pt-4"><h3>{{$sellUsdtOrder['price']}} <span style="font-size:10px;">₹/{{$sellUsdtOrder['currency']}}</span></h3></td>
                                                            <td class="pt-4"><h3>{{$sellUsdtOrder['amount']}}<span style="font-size:10px;"> {{$sellUsdtOrder['currency']}}</span></h3></td>
                                                            <td class="pt-4"><h3>{{$sellUsdtOrder['payableAmount']}}<span style="font-size:10px;"> {{$sellUsdtOrder['currency']}}</span></h3></td>
                                                            <td>
{{--                                                                @if($sellUsdtOrder->user->username !== auth()->user()->username)--}}
                                                                    <a class="btn text-white btn-md btn-success" href="{{route('p2p.showOrder',['order_id'=>$sellUsdtOrder->id])}}" id="buyButton">
                                                                        Sell USDT
                                                                    </a>
{{--                                                                @endif--}}
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
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

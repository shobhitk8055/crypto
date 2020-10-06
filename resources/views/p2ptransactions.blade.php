@extends('home')
@section('title')
    <title>P2P Funds - Cryptovests</title>
@endsection
@section('content')

    <script src="{{ asset('js/app.js') }}"></script>

    <div class="container-fluid mt-2">
        <div class="row">
            <div class="col-12 mt-4">
                <a href="{{route('p2p.transactions')}}" class="btn text-white btn-md btn-primary">Pending</a>
                <a href="{{route('p2p.approved')}}" class="btn text-white btn-md btn-light">Approved</a>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col">
                <div class="card">
                    <div class="table-responsive shadow-none" id="app">
                        <table class="table shadow-none align-items-center table-flush">
                            <thead class="thead-light shadow-none">
                            <tr>
                                <th scope="col" class="sort" data-sort="name">Receiver</th>
                                <th scope="col" class="sort" data-sort="name">price</th>
                                <th scope="col" class="sort" data-sort="status">Sent Amount</th>
                                <th scope="col" class="sort" data-sort="status">Receive Amount</th>
                                <th scope="col" class="sort" data-sort="status">Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($transactions as $transaction)
                                <tr>
                                    <th class="pt-4" scope="row">
                                        <h2>
                                            <a
                                               style="cursor:pointer; background-color: transparent; border: none;"
                                                href="{{route('user.profile',['id'=>$transaction->user->id])}}">
                                            cryptouser
                                            </a>
                                        </h2>
                                    </th>
                                    <th class="pt-4" scope="row"><h2>{{$transaction->order->price}} ₹<span style="font-size:10px;"></span></h2></th>
                                    <td class="pt-4"><h2>{{$transaction->sendAmount}}<span style="font-size:10px;"> {{$transaction->sendCurrency=='inr'?"₹":$transaction->sendCurrency}}</span></h2></td>
                                    <td class="pt-4"><h2>{{$transaction->receiveAmount}}<span style="font-size:10px;"> {{$transaction->receiveCurrency}}</span></h2></td>
                                    <td class="pt-4">

                                        <h2>
                                            @if($transaction->sendCurrency ==="inr")
                                                @if($transaction->sent == '1')
                                                <i class="fas fa-check-circle text-success"></i> SENT
                                                @endif
                                                @if($transaction->sent == '0')
                                                    <form method="post" action="{{route('p2p.sent')}}">
                                                        @csrf
                                                        <input type="hidden" name="tnx_id" value="{{$transaction->id}}">
                                                        <input type="hidden" name="order_id" value="{{$transaction->order->id}}">
                                                        <button class="btn text-white btn-md btn-danger"
                                                                id="buyButton" type="submit">
                                                            Mark as <br>sent
                                                        </button>
                                                    </form>
                                                @endif
                                            @endif
                                            @if($transaction->sendCurrency ==="pst"|| $transaction->sendCurrency ==="usdt")
                                                @if(\App\P2ptransaction::find($transaction->crossTnx_id)->sent===0)
                                                    Pending
                                                @endif
                                                @if(\App\P2ptransaction::find($transaction->crossTnx_id)->sent===1)
                                                        @if($transaction->received == '1')
                                                            <i class="fas fa-check-circle text-success"></i> Received
                                                        @endif
                                                        @if($transaction->received == '0')
                                                            <form method="post" action="{{route('p2p.received')}}">
                                                                @csrf
                                                                <input type="hidden" name="tnx_id" value="{{$transaction->id}}">                                                        <input type="hidden" name="order_id" value="{{$transaction->order->id}}">
                                                                <input type="hidden" name="order_id" value="{{$transaction->order->id}}">
                                                                <button class="btn text-white btn-md btn-primary"
                                                                        id="buyButton" type="submit">
                                                                    Mark as <br>received
                                                                </button>
                                                            </form>
                                                        @endif
                                                @endif
                                            @endif
                                        </h2></td>
{{--                                    <td class="pt-4"><h2>--}}

{{--                                            @if($transaction->received == '1')--}}
{{--                                                <i class="fas fa-check-circle text-success"></i> Received--}}
{{--                                            @endif--}}
{{--                                            @if($transaction->received == '0')--}}
{{--                                                    <form method="post" action="{{route('p2p.received')}}">--}}
{{--                                                        @csrf--}}
{{--                                                        <input type="hidden" name="tnx_id" value="{{$transaction->id}}">                                                        <input type="hidden" name="order_id" value="{{$transaction->order->id}}">--}}
{{--                                                        <input type="hidden" name="order_id" value="{{$transaction->order->id}}">--}}
{{--                                                        <button class="btn text-white btn-md btn-primary"--}}
{{--                                                                id="buyButton" type="submit">--}}
{{--                                                            Mark as <br>received--}}
{{--                                                        </button>--}}
{{--                                                    </form>--}}
{{--                                            @endif--}}
{{--                                        </h2>--}}

{{--                                    </td>--}}
                                </tr>
                                <tr>
                                    <th class="border-0">
                                        @if($transaction->sendCurrency == "inr")
                                            Bank Name: {{\App\P2ptransaction::find($transaction->crossTnx_id)->user->accounts[0]['bank_name']}} <br>
                                            Bank account number = {{\App\P2ptransaction::find($transaction->crossTnx_id)->user->accounts[0]['account_number']}}<br>
                                            Account holder name = {{\App\P2ptransaction::find($transaction->crossTnx_id)->user->accounts[0]['account_holder_name']}}<br>
                                            IFSC = {{\App\P2ptransaction::find($transaction->crossTnx_id)->user->accounts[0]['ifsc']}}<br>
                                            Bank Branch = {{\App\P2ptransaction::find($transaction->crossTnx_id)->user->accounts[0]['bank_branch']}}<br>
                                            Bank Type = {{\App\P2ptransaction::find($transaction->crossTnx_id)->user->accounts[0]['bank_account_type']}}
                                            @endif
                                    </th>
                                    <td class="border-0">
                                    </td>
                                    <td class="border-0">
                                    </td>
                                    <td class="border-0">
                                        Receiver's Action
                                    </td>
                                    <td class="border-0">

                                        @if(\App\P2ptransaction::find($transaction->crossTnx_id)->sent===0)
                                            not sent
                                        @endif
                                        @if(\App\P2ptransaction::find($transaction->crossTnx_id)->sent===1)
                                        sent
                                        @endif
                                    </td>
{{--                                    <td class="border-0">--}}
{{--                                        @if(\App\P2ptransaction::find($transaction->crossTnx_id)->received===0)--}}
{{--                                            not received--}}
{{--                                        @endif--}}
{{--                                        @if(\App\P2ptransaction::find($transaction->crossTnx_id)->received===1)--}}
{{--                                            received--}}
{{--                                        @endif--}}
{{--                                    </td>--}}
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

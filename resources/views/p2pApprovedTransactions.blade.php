@extends('home')
@section('title')
    <title>Approved Transactions - Cryptovests</title>
@endsection
@section('content')

    <script src="{{ asset('js/app.js') }}"></script>

    <div class="container-fluid mt-2">
        <div class="row">
            <div class="col-12 mt-4">
                <a href="{{route('p2p.transactions')}}" class="btn text-white btn-md btn-light">Pending</a>
                <a href="{{route('p2p.approved')}}" class="btn text-white btn-md btn-primary">Approved</a>
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
                                <th scope="col" class="sort" data-sort="status">At</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($transactions as $transaction)
                                <tr>
                                    <th class="pt-4" scope="row"><h2>{{$transaction->user->username}}</h2></th>
                                    <th class="pt-4" scope="row"><h2>{{$transaction->order->price}} ₹<span style="font-size:10px;"></span></h2></th>
                                    <td class="pt-4"><h2>{{$transaction->sendAmount}}<span style="font-size:10px;"> {{$transaction->sendCurrency=='inr'?"₹":$transaction->sendCurrency}}</span></h2></td>
                                    <td class="pt-4"><h2>{{$transaction->receiveAmount}}<span style="font-size:10px;"> {{$transaction->receiveCurrency}}</span></h2></td>
                                    <td class="pt-4"><h2>{{$transaction->created_at}}</h2></td>
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

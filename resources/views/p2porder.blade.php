@extends('home')
@section('title')
    <title>Place P2P order -  Buy PST Cryptovests</title>
@endsection
@section('content')
    <script src="{{ asset('js/app.js') }}"></script>
    <div id="app">
                <p2p-order
                    :order="{{json_encode($order)}}"
                    :user="{{json_encode($user)}}"
                    :bank="{{json_encode($bank)}}"
                    csrf="{{csrf_token()}}"
                ></p2p-order>
    </div>
@endsection

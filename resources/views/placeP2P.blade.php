@extends('home')
@section('title')
    <title>Place P2P order -  Buy PST Cryptovests</title>
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
@endsection

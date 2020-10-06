@extends('home')

@section('content')
    <script src="{{ asset('js/app.js') }}"></script>

    <style>
        .complete-btn{
            border: solid;
            border-radius:7px;
            padding:5px;
            color:green;
            cursor:pointer;
        }
    </style>
     <!-- Page content -->
    <div class="container-fluid mt-4 mb-5">
        <div class="row">
            <div class="col-xl-7">
                <div class="card">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="mb-0">My open orders</h3>
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
                                            <button class="complete-btn text-success pr-2" type="submit" style="background-color: transparent;"> <i class="fas fa-check mx-1"></i> MARK AS COMPLETE</button>
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
@endsection

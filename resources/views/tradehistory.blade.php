@extends('home')
@section('title')
    <title>Completed Orders - Cryptovests</title>
@endsection
@section('content')
    <style>
        .add-funds-form{
            margin-bottom:250px;
        }
    </style>

    <div class="container mt-5 add-funds-form">
        <div class="row">
            <div class="col-7">
                <div class="card bg-default">
                    <!-- Card header -->
                    <div class="card-header bg-transparent border-0">
                        <h3 class="mb-0 text-white">Trade History</h3>
                    </div>
                    <!-- Light table -->
                    <div class="table-responsive">
                        <table class="table table-dark align-items-center table-flush">
                            <thead class="thead-dark">
                            <tr>
                                <th scope="col" class="sort" data-sort="budget">Type</th>
                                <th scope="col" class="sort" data-sort="status">Price</th>
                                <th scope="col">Volume</th>

                            </tr>
                            </thead>
                            <tbody class="list">
                            @foreach($orders as $order)
                                <tr>
                                    <td class="budget">
                                        {{$order->type}}
                                    </td>
                                    <td>
                                        {{$order->price}}
                                    </td>
                                    <td>
                                        {{$order->amount}}
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
                                {{--                                {{ $funds->links() }}--}}
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

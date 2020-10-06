@extends('home')
@section('title')
    <title>Add Funds - Cryptovests</title>
@endsection
@section('content')

    <div class="container mt-5 add-funds-form">
        <div class="row">
            <div class="col-xl-8">
                <form method="POST" action="add-funds/add">
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col-8">
                                    <h3 class="mb-0">Request Package</h3>
                                </div>

                                <div class="col-4 text-right">
                                    <button type="submit" class="btn btn-sm btn-primary">Add</button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="pl-lg-4">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="amount">Amount (PST)</label>
                                            <input type="number" name="amount"
                                                   id="amount"
                                                   class="form-control"
                                                   placeholder="PST">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="tid">Transaction ID</label>
                                            <input type="text" name="tid"
                                                   id="tid"
                                                   class="form-control"
                                                   placeholder="xx">
                                        </div>
                                    </div>
                                </div>
                                <input name="validated" type="hidden" value="0">
                                <input name="new_money" type="hidden" value="0">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-xl-9">
                <div class="card bg-default">
                    <!-- Card header -->
                    <div class="card-header bg-transparent border-0">
                        <h3 class="mb-0 text-white">Fund Requests</h3>
                    </div>
                    <!-- Light table -->
                    <div class="table-responsive">
                        <table class="table table-dark align-items-center table-flush">
                            <thead class="thead-dark">
                            <tr>
                                <th scope="col" class="sort" data-sort="name">Transaction ID</th>
                                <th scope="col" class="sort" data-sort="budget">Amount</th>
                                <th scope="col">Validated</th>
                                <th scope="col" class="sort" data-sort="budget">At</th>

                            </tr>
                            </thead>
                            <tbody class="list">
                            @foreach($funds as $fund)
                            <tr>
                                <th scope="row">
                                    {{$fund->tid}}
                                </th>
                                <td class="budget">
                                    {{$fund->amount}} PST
                                </td>
                                <td>
                                   {{$fund->validated==1?"Yes":"No"}}
                                </td>
                                <td>
                                   {{$fund->created_at}}
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
                                {{ $funds->links() }}
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection

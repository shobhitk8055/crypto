@extends('home')
@section('title')
    <title>Transfer Funds - Cryptovests</title>
@endsection
@section('content')

    <div class="container mt-5 add-funds-form">
        <div class="row">
            <div class="col-xl-8">
                @if(session('error'))
                    <div class="alert alert-danger">

                        <i class="fas fa-exclamation-triangle"></i>  {{session('error')}}

                    </div>
                @endif
                <form method="POST" action="tranferfunds">
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col-8">
                                    <h3 class="mb-0">Transfer Funds</h3>
                                </div>

                                <div class="col-4 text-right">
                                    <button type="submit" class="btn btn-sm btn-primary">Transfer</button>
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
                                                   required
                                                   placeholder="PST">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="username">Username</label>
                                            <input type="username" name="username"
                                                   id="username"
                                                   class="form-control"
                                                   required
                                                   placeholder="">
                                        </div>
                                    </div>
                                </div>
                    <input type="hidden" name="type" value="sent">
                                <h2 class="badge badge-primary">Current Balance - {{auth()->user()->profile->pst??"0"}}  PST </h2>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-xl-9 mt-3">
                <div class="card bg-default">
                    <!-- Card header -->
                    <div class="card-header bg-transparent border-0">
                        <h3 class="mb-0 text-white">Transfer History</h3>
                    </div>
                    <!-- Light table -->
                    <div class="table-responsive">
                        <table class="table table-dark align-items-center table-flush">
                            <thead class="thead-dark">
                            <tr>
                                <th scope="col" class="sort" data-sort="name">User</th>
                                <th scope="col" class="sort" data-sort="budget">Type</th>
                                <th scope="col" class="sort" data-sort="status">Amount</th>
                                <th scope="col">At</th>

                            </tr>
                            </thead>
                            <tbody class="list">
                            @foreach($transfers as $transfer)
                                <tr>
                                    <th scope="row">
                                        {{$transfer->username}}
                                    </th>
                                    <td class="budget">
                                        {{$transfer->type}}

                                    </td>
                                    <td>
                                        {{$transfer->amount}} PST
                                    </td>
                                    <td>
                                        {{$transfer->created_at}}
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
                                {{ $transfers->links() }}
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

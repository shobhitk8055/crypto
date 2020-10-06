@extends('home')
@section('title')
    <title>Topup - Cryptovests</title>
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
                <form method="POST" action="{{route('topup.store')}}">
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col-8">
                                    <h3 class="mb-0">Topup</h3>
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
                                            <select type="number" name="amount"
                                                   id="amount"
                                                   class="form-control"
                                                   required
                                                    placeholder="PST">
                                                <option value="10000">10000 PST</option>
                                            </select>
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
        </div>
    </div>
@endsection

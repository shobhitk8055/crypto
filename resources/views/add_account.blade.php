@extends('home')
@section('title')
    <title>Add Account - Cryptovests</title>
@endsection
@section('content')

    <div class="container mt-5 add-funds-form">
        <div class="row">
            <div class="col-8">
                <form method="POST" action="/add_account/create">
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col-8">
                                    <h3 class="mb-0">Add Funds</h3>
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
                                            <label class="form-control-label" for="bank_name">Bank Name</label>
                                            <input type="text" name="bank_name"
                                                   id="bank_name" required
                                                   class="form-control"
                                                   placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="account_holder_name">Account Holder Name</label>
                                            <input type="text" name="account_holder_name"
                                                   id="account_holder_name" required
                                                   class="form-control"
                                                   placeholder="">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="account_number">Account Number</label>
                                            <input type="number" name="account_number"
                                                   id="account_number" required
                                                   class="form-control"
                                                   placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="ifsc">IFSC Code</label>
                                            <input type="text" name="ifsc"
                                                   id="ifsc" required
                                                   class="form-control"
                                                   placeholder="">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="bank_account_type">Bank Account Type</label>
                                            <select type="text" name="bank_account_type"
                                                   id="bank_account_type"
                                                   class="form-control"
                                                    placeholder="">
                                                <option class="form-control" value="Current">Current</option>
                                                <option class="form-control" value="Saving">Saving</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="bank_branch">Bank Branch</label>
                                            <input type="text" name="bank_branch"
                                                   id="bank_branch" required
                                                   class="form-control"
                                                   placeholder="">
                                        </div>
                                    </div>
                                </div>
                                <input name="primary" type="hidden" value="0">
                                <input name="user_id" type="hidden" value="{{auth()->user()->getAuthIdentifier()}}">
                                <button type="submit" class="btn btn-md btn-primary">Add</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-12">
                <div class="card bg-default">
                    <!-- Card header -->
                    <div class="card-header bg-transparent border-0">
                        <h3 class="mb-0 text-white">Bank Accounts</h3>
                    </div>
                    <!-- Light table -->
                    <div class="table-responsive">
                        <table class="table table-dark align-items-center table-flush">
                            <thead class="thead-dark">
                            <tr>
                                <th scope="col" class="sort" data-sort="name">Bank name</th>
                                <th scope="col" class="sort" data-sort="budget">Bank holder name</th>
                                <th scope="col">Account number</th>
                                <th scope="col" class="sort" data-sort="budget">IFSC</th>
                                <th scope="col" class="sort" data-sort="budget">Bank Account type</th>
                                <th scope="col" class="sort" data-sort="budget">Branch</th>

                            </tr>
                            </thead>
                            <tbody class="list">
                            @foreach($accounts as $account)
                                <tr>
                                    <th scope="row">
                                        {{$account->bank_name}}
                                    </th>
                                    <td class="budget">
                                        {{$account->account_holder_name}}
                                    </td>
                                    <td>
                                        {{$account->account_number}}
                                    </td>
                                    <td>
                                        {{$account->ifsc}}
                                    </td>
                                    <td>
                                        {{$account->bank_account_type}}
                                    </td>
                                    <td>
                                        {{$account->bank_branch}}
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

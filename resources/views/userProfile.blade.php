@extends('home')
@section('title')
    <title>P2P Funds - Cryptovests</title>
@endsection
@section('content')
<div class="container mt-4 add-funds-form">
    <div class="row">
        <div class="col-xl-6">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-0">Bank Details</h3>
                        </div>
                        <div class="col-4 text-right">
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tbody>
                        <tr>
                            <th scope="row">Email</th>
                            <td>{{ $user->email }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Username</th>
                            <td>{{ $user->username }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Bank Name</th>
                            <td>{{$bank['bank_name']}}</td>
                        </tr>
                        <tr>
                            <th scope="row">Account Holder Name</th>
                            <td>{{$bank['account_holder_name']}}</td>
                        </tr>
                        <tr>
                            <th scope="row">Account Number</th>
                            <td>{{$bank['account_number']}}</td>
                        </tr>
                        <tr>
                            <th scope="row">IFSC</th>
                            <td>{{$bank['ifsc']}}</td>
                        </tr>
                        <tr>
                            <th scope="row">Type</th>
                            <td>{{$bank['bank_account_type']}}</td>
                        </tr>
                        <tr>
                            <th scope="row">Branch</th>
                            <td>{{$bank['bank_branch']}}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection

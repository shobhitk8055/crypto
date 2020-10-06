@extends('admin/home')
@section('title')
    Daily pst - Admin
@endsection
@section('header')
    Daily pst
@endsection
@section('content')
    <div class="panel-header panel-header-sm">
    </div>
    <div class="content">
        <div class="row">
            <div class="col-md-8 mr-5">
                <div class="card">
                    <div class="card-header">
                        <h5 class="title">Daily Coin</h5>
                    </div>
                    @if(session('error'))
                        <div class="alert alert-danger">
                            <i class="fas fa-exclamation-triangle"></i>  {{session('error')}}
                        </div>
                    @endif
                    <div class="card-body">
                        <form method="post" action="{{route('admin.dailypst.update')}}">
                            @csrf
                            <div class="row">
                                <div class="col-md-5 pr-1">
                                    <div class="form-group">
                                        <label>Date</label>
                                        <select name="date"
                                               id="date"
                                               class="form-control">
                                            @foreach($dateOptions as $date)
                                            <option value="{{$date->date}}">{{$date->date}}</option>
                                                @endforeach
                                        </select>
                                        <input type="hidden" value="done" name="status">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <button class="btn btn-large btn-success" type="submit">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8 mr-5">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead class=" text-primary">
                                <th>
                                    Serial No.
                                </th>
                                <th>
                                    Date
                                </th>
                                <th>
                                    Status
                                </th>
                                </thead>
                                <tbody>
                                @foreach($dates as $date)
                                    <tr>
                                        <td>
                                            {{ $date->id }}
                                        </td>
                                        <td>
                                            {{ $date->date }}
                                        </td>
                                        <td
                                                @if($date->status==="pending")
                                        style="background-color:red; color:white"
                                                @endif
                                        >
                                            {{ $date->status }}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

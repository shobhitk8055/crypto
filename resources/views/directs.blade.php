@extends('home')
@section('title')
    <title>Active Directs - Cryptovests</title>
@endsection
@section('content')
    <script src="{{ asset('js/app.js') }}"></script>
    <div id="app">
    <div class="container">
        <div class="row mt-4">
            <div class="col-lg-6">
                <a class="btn btn-light" href="{{route('team')}}">
                    My team
                </a>
                <a class="btn btn-light" href="{{route('levelTeam')}}">
                    Level Team
                </a>
                <a class="btn btn-primary text-white" href="{{route('directs')}}">
                    Active directs
                </a>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-xl-12 mt-3">
                <div class="card bg-default">
                    <!-- Card header -->
                    <div class="card-header bg-transparent border-0">
                        <h3 class="mb-0 text-white">My Team</h3>
                    </div>
                    <!-- Light table -->
                    <div class="table-responsive">
                        <table class="table table-dark align-items-center table-flush">
                            <thead class="thead-dark">
                            <tr>
                                <th scope="col" class="sort" data-sort="name">Serial No</th>
                                <th scope="col" class="sort" data-sort="budget">Name</th>
                                <th scope="col" class="sort" data-sort="status">Username</th>
                                <th scope="col" class="sort" data-sort="status">Email</th>
                                <th scope="col" class="sort" data-sort="status">Join date</th>
                                <th scope="col" class="sort" data-sort="status">Activation Date</th>
                            </tr>
                            </thead>
                            <tbody class="list">
                            @foreach($activeMembers as $activeMember)
                                <tr>
                                    <th scope="row">
                                        {{$count++}}
                                    </th>
                                    <td class="budget">
                                        {{$activeMember->name}}
                                    </td>
                                    <td>
                                        {{$activeMember->username}}
                                    </td>
                                    <td>
                                        {{$activeMember->email}}
                                    </td>
                                    <td>
                                        {{ $activeMember->created_at }}
                                    </td>
                                    @foreach(App\Package::all()->where('user_id',$activeMember->id) as $package)
                                    <td>
                                        {{ $package->created_at }}
                                    </td>
                                        @endforeach
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- Card footer -->
                    <div class="card-footer bg-transparent py-4">
                        <nav aria-label="...">
                            <ul class="pagination justify-content-end mb-0">
                                {{ $activeMembers->links() }}
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>

        </div>
    </div>
    </div>
@endsection

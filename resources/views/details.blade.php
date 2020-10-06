<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
    <meta name="author" content="Creative Tim">
@yield('title')
<!-- Favicon -->
    <link rel="icon" href="../assets/img/brand/favicon.png" type="image/png">
    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
    <!-- Icons -->
    <link rel="stylesheet" href="../assets/vendor/nucleo/css/nucleo.css" type="text/css">
    <link rel="stylesheet" href="../assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" type="text/css">
    <!-- Page plugins -->
    <!-- Argon CSS -->
    <link rel="stylesheet" href="../assets/css/argon.css?v=1.2.0" type="text/css">
    <style>
        .logo-img{
            padding: 19px 60px 15px 60px; //Top Right Bottom Left
        }
    </style>
</head>
<body>
        <div class="container mt-5">
            <div class="row d-flex flex-column align-items-center ">
                <div class="col-xl-6" style="border: dotted">
                    <p class="mt-3 ml-2">
                        Congrats! You have successfully registered with us.
                    </p>
                    <h2 class="text-center">
                        Your login details
                    </h2>

                    <table class="table table-dark mt-3">
                        <tbody>
                        <tr>
                            <th>Name</th>
                            <td>{{auth()->user()->name}}</td>
                        </tr>
                        <tr>
                            <th>Username</th>
                            <td>{{auth()->user()->username}}</td>
                        </tr>
                        <tr>
                            <th>Address</th>
                            <td>{{auth()->user()->wallet->address}}</td>
                        </tr>
                        <tr>
                            <th>Password</th>
                            <td>{{ auth()->user()->notifications->not2 }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="mt-4">
                    <a href="{{route('dashboard')}}" class="btn btn-primary"> Go to dashboard </a>
                </div>
            </div>
        </div>
</body>
</html>


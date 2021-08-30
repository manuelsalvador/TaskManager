
<!DOCTYPE html>
<html>
<head>
    <title>Task Manager</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

     <!-- Fonts -->
     <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha512-MoRNloxbStBcD8z3M/2BmnT+rg4IsMxPkXaGh2zD6LGNNFE80W3onsAhRcMAMrSoyWL9xD7Ert0men7vR8LUZg==" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

   
</head>
<body>
@include('layouts.navigation')
<div class="container">
    <div class="row mt-5 mb-5 justify-content-center">
        <div class="col-md-12 mt-5">
            <div class="card">
                <div class="card-header bg-info">
                <a href="javascript:history.back()"><i class="bi bi-arrow-left-circle" style="color:white"></i></a>
                    <h3 class="text-white">User list</h3>
                </div>
                <div class="card-body">
                    <a href="/users/create">
                        <button class="btn btn-success btn-submit" style="margin-bottom: 20px;">Add User</button>
                    </a>
                    <ul class="list-group">
                        @foreach($users as $user)
                        <a href="/users/{{$user->id}}">
                        <li class="list-group-item">
                            <div class="row">
                            <div class="col-md-6">{{$user->name}}</div>
                            <div class="col-md-6">{{$user->email}}</div>
                            </div>
                            <!-- {{$user->name}} - {{$user->email}} -->
                        </li>
                    </a>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>

</div>
</body>
</html>
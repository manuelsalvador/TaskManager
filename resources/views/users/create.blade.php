<!DOCTYPE html>
<html>
<head>
    <title>Task Manager</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha512-MoRNloxbStBcD8z3M/2BmnT+rg4IsMxPkXaGh2zD6LGNNFE80W3onsAhRcMAMrSoyWL9xD7Ert0men7vR8LUZg==" crossorigin="anonymous" />

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>
<body>
@include('layouts.navigation')
    <div class="container">
        <div class="row mt-5 mb-5">
            <div class="col-8 offset-2 mt-5">
                <div class="card">
                    <div class="card-header bg-info">
                    <a href="javascript:history.back()"><i class="bi bi-arrow-left-circle" style="color:white"></i></a>
                        <h3 class="text-white">Create new user</h3>
                    </div>
                    <div class="card-body">
                        
                        @if(Session::has('success'))
                        <div class="alert alert-success">
                            {{ Session::get('success') }}
                            @php
                                Session::forget('success');
                            @endphp
                        </div>
                        @endif
                   
                        <form method="POST" action="{{ route('users.create.store') }}">
                  
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <strong>Name *:</strong>
                                        <input type="text" name="name" class="form-control" required placeholder="Name" value="{{ old('name') }}">
                                        @if ($errors->has('name'))
                                            <span class="text-danger">{{ $errors->first('name') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <strong>Email *:</strong>
                                        <input type="text" name="email" class="form-control" required placeholder="Email" value="{{ old('email') }}">
                                        @if ($errors->has('email'))
                                            <span class="text-danger">{{ $errors->first('email') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                    <strong>Password *:</strong>
                                    <input type="password" name="password" class="form-control" required placeholder="Password" value="{{ old('password') }}">
                                        @if ($errors->has('email'))
                                            <span class="text-danger">{{ $errors->first('email') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                    <strong>Role *:</strong>
                                    <select class="form-control" name="role_id">
                                            @foreach ($roles as $key)
                                                <option value="{{ $key->id }}"> 
                                                    {{ $key->role }} 
                                                </option>
                                            @endforeach    
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group text-center">
                                <button class="btn btn-success btn-submit">Create</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
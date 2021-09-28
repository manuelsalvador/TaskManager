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
                        <h3 class="text-white">Edit task</h3>
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
                   
                        @if (session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif

                        <form method="POST" action="{{ route('tasks.edit.update', $task->id) }}">
                  
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <strong>Title *:</strong>
                                        @if (Auth::user()->role == 1)
                                        <input type="text" name="title" class="form-control" placeholder="Title" value="{{ $task->title }}">
                                        @else
                                        <p>{{ $task->title }}</p>
                                        @endif
                                        @if ($errors->has('title'))
                                            <span class="text-danger">{{ $errors->first('title') }}</span>
                                        @endif
                                        
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <strong>Description:</strong>
                                        @if (Auth::user()->role == 1)
                                        <input type="text" name="description" class="form-control" placeholder="Description" value="{{ $task->description }}">
                                        @else
                                        <p>{{ $task->description }}</p>
                                        @endif
                                        @if ($errors->has('description'))
                                            <span class="text-danger">{{ $errors->first('description') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                    <strong>Priority *:</strong>
                                    @if (Auth::user()->role == 1)
                                    <select name="priority" id="priority" class="form-control">
                                    @foreach ($priority as $key)
                                        <option value="{{ $key->id }}" {{$task->priority == $key->id ? 'selected' : ''}}> 
                                            {{ $key->priority }} 
                                        </option>
                                    @endforeach 
                                    </select>
                                    @else
                                    <p>{{$prioritySelected[0]->priority}}</p>
                                    @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <strong>State *:</strong>
                                        <select name="state" id="state" class="form-control">
                                            @foreach ($state as $key)
                                                <option value="{{ $key->id }}" {{$task->state == $key->id ? 'selected' : ''}}> 
                                                    {{ $key->state }} 
                                                </option>
                                            @endforeach 
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                    <strong>Project *:</strong>
                                    @if (Auth::user()->role == 1)
                                        <select class="form-control" name="project_id">
                                            @foreach ($project as $key)
                                                <option value="{{ $key->id }}" {{$task->project_id == $key->id ? 'selected' : ''}}> 
                                                    {{ $key->title  }} 
                                                </option>
                                            @endforeach    
                                        </select>
                                        @else
                                        <p>{{$projectSelected[0]->title}}</p>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                    <strong>Developer:</strong>
                                    @if (Auth::user()->role == 1)
                                        <select class="form-control" name="user_id">
                                            <option></option>
                                            @foreach ($developer as $key)                    
                                                <option value="{{ $key->id }}" {{ !empty($developerSelected[0]) ? ($developerSelected[0]->id == $key->id ? 'selected' : '') : ''}}> 
                                                    {{ $key->name }} 
                                                </option>
                                            @endforeach
                                        </select>
                                        @else
                                        <p>{{$developerSelected[0]->name}}</p>
                                        @endif
                                    </div>
                                </div>

                            </div>
                            <div class="form-group">
                                <button class="btn btn-success btn-submit">Save</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
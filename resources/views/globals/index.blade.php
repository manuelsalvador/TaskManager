
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
        <div class="col-md-9 mt-5">
            <div class="card">
                <div class="card-header bg-info">
                <a href="javascript:history.back()"><i class="bi bi-arrow-left-circle" style="color:white"></i></a>
                    <h3 class="text-white">Task recap</h3>
                </div>
                <div class="card-body">
                        @foreach($users as $user)
                        <div class="row" style="margin-top: 30px;">
                            <div class="offset-1 text-white customTableTitle">
                                {{$user->name}}
                            </div>
                        </div>
                        
                        <table class="customTable margin_bottom">
                            <tr>
                            <th>Task</th>
                            <th>State</th>
                            <th>Priority</th>
                            <th>Project</th>
                            <th>Customer</th>
                            </tr>

                            @if (Auth::user()->role == 1)
                            @foreach($tasks as $task)
                                @if($task->user_id == $user->id)
                                <tr>
                                    <td><a href="/tasks/{{$task->id}}">{{$task->title}}</a></td>
                                    <td>{{$states->where('id', $task->state)->pluck('state')[0]}}</td>
                                    <td>{{$priorities->where('id', $task->priority)->pluck('priority')[0]}}</td>
                                    <td><a href="/projects/{{$projects->where('id', $task->project_id)->pluck('id')[0]}}">{{$projects->where('id', $task->project_id)->pluck('title')[0]}}</a></td>
                                    <td><a href="/customers/{{$customers->where('id', $projects->where('id', $task->project_id)->pluck('customer_id')[0])->pluck('name')[0]}}">{{$customers->where('id', $projects->where('id', $task->project_id)->pluck('customer_id')[0])->pluck('name')[0]}} {{$customers->where('id', $projects->where('id', $task->project_id)->pluck('customer_id')[0])->pluck('surname')[0]}}</a></td>
                                </tr>
                                @endif
                            @endforeach
                            @endif

                            @if (Auth::user()->role == 2)
                            @foreach($tasks as $task)
                                @if($task->user_id == $user->id)
                                <tr>
                                    <td>{{$task->title}}</td>
                                    <td>{{$states->where('id', $task->state)->pluck('state')[0]}}</td>
                                    <td>{{$priorities->where('id', $task->priority)->pluck('priority')[0]}}</td>
                                    <td>{{$projects->where('id', $task->project_id)->pluck('title')[0]}}</td>
                                    <td>{{$customers->where('id', $projects->where('id', $task->project_id)->pluck('customer_id')[0])->pluck('name')[0]}} {{$customers->where('id', $projects->where('id', $task->project_id)->pluck('customer_id')[0])->pluck('surname')[0]}}</td>
                                </tr>
                                @endif
                            @endforeach
                            @endif

                            </table>
                            <p></p>
                        @endforeach
                </div>
            </div>
        </div>



        <div class="col-md-3 mt-5">
            <div class="card">
                <div class="card-header bg-info" style="height: 73px; padding-top:20px;">
                    <h3 class="text-white">Not assigned</h3>
                </div>
                <div class="card-body">
                        <table class="customTable">
                            <tr>
                            <th>Task</th>
                            </tr>
                            @foreach($tasks as $task)
                                @if($task->user_id == NULL)
                                    @if (Auth::user()->role == 1)
                                        <tr>
                                            <td><a href="/tasks/{{$task->id}}">{{$task->title}}</a></td>
                                        </tr>
                                        @else
                                        <tr>
                                            <td>{{$task->title}}</td>
                                        </tr>
                                    @endif
                                @endif
                            @endforeach
                            </table>
                </div>
            </div>
        </div>
    </div>

</div>
</body>
</html>
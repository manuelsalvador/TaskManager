
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
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.6.0.js"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>

    <script type="text/javascript">

        function closeModal(){
            $('#delete-modal').hide();
        }

        var id;
        function showTask(idTask){
            $('#delete-modal').show();
            id = idTask;
        }

        function deleteTask(){
            let url = "{{ route('customers.destroy', ':id') }}";
            url = url.replace(':id', id);

            $.ajax({
                url: url,
                type: 'POST',
                data: {
                '_method': 'DELETE',
                '_token': "{{ csrf_token() }}"},
                success: function(){
                    document.location.href = "{{route('customers')}}"}
                });
            }
    </script>
   
</head>
<body>
@include('layouts.navigation')
<div class="container">
    <div class="row mt-5 mb-5 justify-content-center">
        <div class="col-md-12 mt-5">
            <div class="card">
                <div class="card-header bg-info">
                <a href="javascript:history.back()"><i class="bi bi-arrow-left-circle" style="color:white"></i></a>
                    <h3 class="text-white">Customer list</h3>
                </div>
                <div class="card-body">
                    @if (Auth::user()->role == 1)
                    <a href="/customers/create">
                        <button class="btn btn-success btn-submit" style="margin-bottom: 20px;">Add Customer</button>
                    </a>
                    @endif
                    <ul class="list-group">
                        @foreach($customers as $customer)
                        <div class="row">
                            <div class="col-md-11">
                            <a href="/customers/{{$customer->id}}">
                                <li class="list-group-item">
                                    {{$customer->name}} {{$customer->surname}}
                                </li>
                            </a>
                            </div>
                            <div class="col-md-1">
                                <button onclick="showTask({{$customer->id}})" class="btn btn-danger btn-submit" style="border-radius:20px">X</button>
                            </div>
                        </div>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="delete-modal" tabindex="-1" role="dialog" aria-labelledby="titleLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="titleLabel">Attention</h5>
      </div>
      <div class="modal-body">
        Are you sure you want to delete this customer?</br>
        All related projects and tasks will be removed.
      </div>
      <div class="modal-footer">
        <button type="button" onclick="closeModal()" class="btn btn-secondary" data-dismiss="modal">No</button>
        <button type="button" onclick="deleteTask()" class="btn btn-success" data-dismiss="modal">Yes</button>
      </div>
    </div>
  </div>
</div>
</body>
</html>
@extends('app')


@section('content')

<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">WebSiteName</a>
    </div>
    <ul class="nav navbar-nav">     
      <li class="active"><a href="{{ action('AdminController@questions') }}">Список опросов</a></li>
      <li><a href="{{ action('AdminController@create') }}">Добавление опросов</a></li> 
      <li><a href="{{ action('UserController@users') }}">Список пользователей</a></li> 
      <li><a href="{{ action('Auth\AuthController@getLogout') }}">Logout</a></li>    
    </ul>
  </div>
</nav>

    <h1>List of Quizzes</h1>
    <hr/>

    @foreach($questions as $question)
        <question>
            <h2>{{ $question->quiz_name }}</h2></br>

            <form class="form-horizontal" method="post" action="/admin/{{ $question->id }}">
                {{method_field('DELETE')}} {!! csrf_field() !!}  
                <button id="submit" name="submit" class="btn btn-warning">Удалить опрос</button></br></br> 
            </form>

            <form class="form-horizontal" method="post" action="">
                {!! csrf_field() !!}

                <div class="form-group">                
                  <div class="col-md-4">
                     <button id = "modal_{{ $question->id }}" type="button" action="{{ action('ResultController@data') }}"  class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Результаты</button>                        
                  </div>
                </div> 

                <div class="modal fade" id="myModal" role="dialog">
                  <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Результаты опроса</h4>
                      </div>

                      <div id = "modal-body_{{ $question->id }}" class="modal-body">
                      </div>

                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      </div>
                    </div>

                  </div>
                </div>
            </form>
        </question>
@endforeach
@stop

@section('footer')
@foreach($questions as $question)
      <script>        
        $(document).ready(function(){
          $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
          })
          $("#modal_{{ $question->id }}").click(function(){
                $.ajax({
                url: "admin/result",
                type:'POST',
                data: { id : "{{$question->id}}"},
                success: function(result){
                     $("#modal-body_{{ $question->id }}").append(result);
                     console.log(result);
                }
              }); 
          });                    
        });
      </script>
@endforeach
@endsection
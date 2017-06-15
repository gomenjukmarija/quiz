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

    <h1>Создать новый опрос</h1>

    <hr/>

    <form class="form-horizontal" method="POST" action="{{ action('AdminController@store') }}">
        {!! csrf_field() !!}

        <div class="form-group">
            <label class="col-md-4 control-label" for="quiz_name">Name of Quiz</label>
            <div class="col-md-4">
                <input id="quiz_name" name="quiz_name" type="text"  class="form-control input-md" required="">
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-4 control-label" for="question">Question</label>
            <div class="col-md-4">
                <input id="question" name="question" type="text"  class="form-control input-md" required="">
            </div>
        </div>

        <div class="form-group input_fields_wrap">
            <button class="btn btn-primary add_field_button">Добавить вариант ответа</button>
        </div>

        <div class="form-group">
            <label class="col-md-4 control-label" for="submit"></label>
            <div class="col-md-4">
                <button id="submit" name="submit" class="btn btn-primary">Создать опрос</button>
            </div>
        </div>
    </form>
@stop

@section('footer')
    <script>
        $(document).ready(function() {
            var max_fields      = 9; //maximum input boxes allowed
            var wrapper         = $(".input_fields_wrap"); //Fields wrapper
            var add_button      = $(".add_field_button"); //Add button ID
            var x = 1; //initlal text box count
            $(add_button).click(function(e){ //on add input button click
                e.preventDefault();
                if(x < max_fields){ //max input box allowed
                    x++; //text box increment
                    $(wrapper).append('<div class="form-group"> ' +
                        '<label class="col-md-4 control-label" for="answer">Answer</label><a href="#" class="remove_field">Remove</a>' +
                        '<div class="col-md-4">  ' +
                        '<input  name="answer[]" type="text"  class="form-control input-md" ' +
                        'required="">' +
                        '</div></div>'); //add input box
                }
            });
            $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
                e.preventDefault(); $(this).parent('div').remove(); x--;
            })
        });
    </script>

@endsection
@extends('app')


@section('content')

<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">WebSiteName</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="{{ action('QuestionController@index') }}">Home</a></li>
      <li><a href="{{ action('Auth\AuthController@getLogout') }}">Logout</a></li>
      <li><a href="{{ action('UserController@profile') }}">Profile</a></li>            
    </ul>
  </div>
</nav>

    <h1>Список опросов</h1>

    <hr/>

    @if (Session::has('flash_message'))
    <div class="alert alert-success">{{ Session::get('flash_message') }}</div>
    @endif 

@foreach($questions as $question)
  <div class="container">
    <div class="panel-group" id="accordion">
      <div class="panel panel-default">
        <div class="panel-heading" >
          <h4 class="panel-title">             
            <a id="question_{{ $question->id }}"><h2>{{ $question->quiz_name }}</h2></a>
            <div id="question_body_{{ $question->id }}">
            <form id="form_{{ $question->id }}" method="POST" action="{{ action('QuestionController@store') }}">
            {!! csrf_field() !!}

            </form>           
            </div>
            <div id="gif_{{ $question->id }}" style="display: none"><img src='/uploads/loader.gif'></div>               
          </h4>
        </div>         
      </div>     
    </div> 
  </div>
@endforeach

@stop

@section('footer')
@foreach($questions as $question)
      <script>
        let flag{{ $question->id}} = true
        $(document).ready(function(){
          $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
          })           
          $("#question_{{ $question->id }}").click(function(){
            if(flag{{ $question->id}}){
              $("#gif_{{ $question->id }}").append("").show();                       
              setTimeout(function () {
                $.ajax({
                url: "question",
                type:'POST',
                data: { id : "{{$question->id}}"},
                success: function(result){
                  $("#gif_{{ $question->id }}").hide();

                  console.log(result); 

                  flag{{ $question->id}} = false                   

                  for(var key in result) {
                    $("#form_{{ $question->id }}").append(
                      `<input type='radio' name='answer' value='${result[key]['id']}' > ${result[key]['answer']} <br/>
                       <input type='hidden' name='question' value='${result[key]['question_id']}'>`                      
                      );
                  }                  
                 $("#form_{{ $question->id }}").append("<input id='submit' name='submit' type='submit' class='btn btn-primary' value='Сохранить'>");
                }

              });
            }, 1000)
          } else {
           flag{{ $question->id}} = true
           // $("#question_body_{{ $question->id}}").html(''); 
           $("#form_{{ $question->id }}").html('');  
          }
          });
          $('.alert').delay(3000).slideUp(300);          
        });
      </script>

@endforeach
@endsection
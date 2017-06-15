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

    <h1>Список пользователей</h1>

    <hr/>

    @foreach($users as $user)
        <question>
            <h2>{{ $user->name }}</h2>
             <p><strong>Email: </strong> {{ $user->email }} </p>
             <p><strong>Telephone: </strong> {{ $user->telephone }} </p>
             <p><strong>Sex: </strong> {{ $user->sex }} </p>
             <p><strong>Date OF Birth: </strong> {{ $user->date_of_birth }} </p>                          
        </question>
    @endforeach
@stop
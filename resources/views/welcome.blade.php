@extends('app')

@section('content')

<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">WebSiteName</a>
    </div>
    <ul class="nav navbar-nav">
      <li ><a href="{{ action('QuestionController@index') }}">Home</a></li>
      <li ><a href="{{ action('AdminController@questions') }}">Admin</a></li>           
    </ul>
  </div>
</nav>

@endsection


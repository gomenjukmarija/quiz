@extends('app')

@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="container">

<form class="form-horizontal" action="/auth/register" method="POST">
   {!! csrf_field() !!}


  <fieldset>
    <div id="legend">
      <legend class="">Register</legend>
    </div>
    <div class="control-group">
      <!-- Username -->
      <label class="control-label"  for="name">Username</label>
      <div class="controls">
        <input type="text" name="name" placeholder="" class="input-xlarge" value="{{ old('name') }}">
       </div>
    </div>

 
    <div class="control-group">
      <!-- E-mail -->
      <label class="control-label" for="email">E-mail</label>
      <div class="controls">
        <input type="email" name="email"  class="input-xlarge" value="{{ old('email') }}">
      </div>
    </div>

 
    <div class="control-group">
      <!-- Password-->
      <label class="control-label" for="password">Password</label>
      <div class="controls">
        <input type="password" name="password" class="input-xlarge">
      </div>
    </div>
 
    <div class="control-group">
      <!-- Password -->
      <label class="control-label"  for="password_confirm">Password (Confirm)</label>
      <div class="controls">
        <input type="password" name="password_confirmation" class="input-xlarge">
      </div>
    </div>

    <div class="control-group">
      <label class="control-label"  for="telephone">Telephone</label>
      <div class="controls">
        <input type="text" name="telephone" placeholder="" class="input-xlarge">
       </div>
    </div>

    <div class="control-group">
      <label class="control-label"  for="sex">Sex</label>
      <div class="controls">
        <input type="radio" name="sex" value="male"> Male<br>
        <input type="radio" name="sex" value="female"> Female<br>
       </div>
    </div>


    <div class="control-group">
      <label class="control-label"  for="date_of_birth">Date Of Birth</label>
      <div class="controls">
        <input type="date" name="date_of_birth" placeholder="" class="input-xlarge">
       </div>
    </div><br>
    
    <div class="control-group">
      <!-- Button -->
      <div class="controls">
        <button type="submit" class="btn btn-success">Register</button>
      </div>

    </div>
  </fieldset>
</form>

</div>

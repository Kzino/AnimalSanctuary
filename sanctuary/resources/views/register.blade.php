@extends('navbar')
@extends('master')
@section('title', 'Register') 
   
    <h2>Register</h2>
    <form method="POST" action="/register" class="form-register">
        <!-- {{ csrf_field() }} -->
        <div class="form-group py-3">
            <label for="name">Name:</label>
            <input type="text" class="form-control" id="name" name="name">
        </div>

        <div class="form-group py-3">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email">
        </div>

        <div class="form-group py-3">
            <label for="password">Password:</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>

        <div class="checkbox mb-3">
        <label>
          <input type="checkbox" value="remember-me"> Tick box if staff
        </label>
        </div>

        <div class="form-group py-3">
            <button style="cursor:pointer" type="submit" class="btn btn-lg btn-primary btn-block">Submit</button>
        </div>
    </form>
 
 

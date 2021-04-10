@extends('master')
@section('title', 'Login')
@section('content')
@include('navbar')
<form class="form-signin mt-3" method="POST" action="{{ route('login') }}">
        @csrf
      <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
      <div class="form-group py-3">
      <label for="inputEmail" class="sr-only">Username</label>
      <input type="text" id="inputEmail" class="form-control" placeholder="Username" name="username" required="" autofocus="">
              @error('username')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
            @enderror
    </div>
    <div class="form-group py-3">
      <label for="inputPassword" class="sr-only">Password</label>
      <input type="password" id="inputPassword" class="form-control" placeholder="Password" name="password" required="">
                      @error('password')
                            <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                            </span>
                      @enderror
    </div>
      <div class="checkbox mb-3">
        <label>
          <input type="checkbox" value="remember-me"> Remember me
        </label>
      </div>
      <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
      <p class="mt-5 mb-3 text-muted">© Animal Sanctuary 2021</p>
    
</form>



@endsection
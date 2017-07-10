@extends('layouts.app')

@section('content')
<div class="container">
  <div class="section">
    <div class="row">
      <div class="col s6 offset-s3">
        <form class="form-horizontal" role="form" method="POST" action="{{ route('login') }}">
          {{ csrf_field() }}

          <div class="row">
            <div class="input-field col s12">
              <input id="email" type="email" class="{{ $errors->has('email') ? ' invalid' : 'validate' }}" name="email" value="{{ old('email') }}" required autofocus>
              <label for="email" data-error="{{ $errors->has('email') ? $errors->first('email') : '' }}" class="col s12">E-Mail Address</label>
            </div>
          </div>

          <div class="row">
            <div class="input-field col s12">
              <input id="password" type="password" class="{{ $errors->has('password') ? ' invalid' : '' }}" name="password" required>
              <label for="password" {{ $errors->has('password') ? ' data-error="' . $errors->first('password') . '"' : '' }} class="col s12">Password</label>
            </div>
          </div>

          <div class="row">
            <div class="input-field col s12">
              <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
              <label for="remember">Remember Me</label>
            </div>
          </div>

          <div class="row">
            <div class="col s12">
              <button type="submit" class="btn">
                Login
              </button>

              <a class="btn-flat" href="{{ route('password.request') }}">
                Forgot Your Password?
              </a>
            </div>
          </div>

        </form>
      </div>
    </div>
  </div>
</div>
@stop

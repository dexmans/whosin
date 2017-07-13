@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="section">

      <form method="POST" action="{{ route('users.update', $user->id) }}">
        {{ method_field('PATCH') }}
        {{ csrf_field() }}

        <div class="row">
          <div class="input-field col s12">
            <input id="name" type="text" class="{{ $errors->has('name') ? ' invalid' : 'validate' }}" name="name" value="{{ old('name', $user->name) }}" required autofocus>
            <label for="name" data-error="{{ $errors->has('name') ? $errors->first('name') : '' }}" class="col s12">Username</label>
          </div>
        </div>

        <div class="row">
          <div class="input-field col s12">
            <input id="email" type="email" class="{{ $errors->has('email') ? ' invalid' : 'validate' }}" name="email" value="{{ old('email', $user->email) }}" required>
            <label for="email" data-error="{{ $errors->has('email') ? $errors->first('email') : '' }}" class="col s12">E-Mail Address</label>
          </div>
        </div>

        <div class="row">
          <div class="input-field col s12">
            <input id="first_name" type="text" class="{{ $errors->has('first_name') ? ' invalid' : 'validate' }}" name="first_name" value="{{ old('first_name', $user->first_name) }}" required autofocus>
            <label for="first_name" data-error="{{ $errors->has('first_name') ? $errors->first('first_name') : '' }}" class="col s12">First name</label>
          </div>
        </div>

        <div class="row">
          <div class="input-field col s12">
            <input id="last_name" type="text" class="{{ $errors->has('last_name') ? ' invalid' : 'validate' }}" name="last_name" value="{{ old('last_name', $user->last_name) }}" required autofocus>
            <label for="last_name" data-error="{{ $errors->has('last_name') ? $errors->first('last_name') : '' }}" class="col s12">Last name</label>
          </div>
        </div>

        <div class="row">
          <div class="col s12">
            <button type="submit" class="btn">
              Update profile
            </button>

            <a class="btn-flat" href="{{ route('dashboard') }}">
              Cancel
            </a>
          </div>
        </div>

      </form>


      <form method="POST" action="{{ route('users.update', $user->id) }}">
        {{ method_field('PATCH') }}
        {{ csrf_field() }}

        <div class="row">
          <div class="input-field col s12">
            <input id="password" type="password" class="{{ $errors->has('password') ? ' invalid' : '' }}" name="password">
            <label for="password" {{ $errors->has('password') ? ' data-error="' . $errors->first('password') . '"' : '' }} class="col s12">Password</label>
          </div>
        </div>

        <div class="row">
          <div class="input-field col s12">
            <input id="password_confirmation" type="password" class="{{ $errors->has('password_confirmation') ? ' invalid' : '' }}" name="password_confirmation">
            <label for="password_confirmation" {{ $errors->has('password_confirmation') ? ' data-error="' . $errors->first('password_confirmation') . '"' : '' }} class="col s12">Confirm password</label>
          </div>
        </div>

        <div class="row">
          <div class="col s12">
            <button type="submit" class="btn">
              Update password
            </button>

            <a class="btn-flat" href="{{ route('dashboard') }}">
              Cancel
            </a>
          </div>
        </div>

      </form>

    </div>
  </div>
@endsection

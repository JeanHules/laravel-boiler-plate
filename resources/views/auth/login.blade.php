@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card border-0 shadow-sm">
                <div class="card-body px-5">
                    <h4 class="text-center py-3 font-weight-bold">Welcome back, Login Here!</h4>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group">
                            <label for="email" class="text-md-right">Email</label>
                            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="password" class="text-md-right">{{ __('Password') }}</label>
                            <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                            @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-block btn-primary font-weight-bold">
                                {{ __('Login') }}
                            </button>
                        </div>
                        @if (Route::has('password.request'))
                            <p class="text-center my-0">
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                   {{ __('Forgot Your Password?') }}
                                </a> 
                            </p>
                        @endif

                        <p class="text-center my-0">
                            <b>Don't have an account?</b>
                            <a class="btn btn-link" href="/register">
                               Sign up in seconds
                            </a> 
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@extends('layouts.auth')

@section('content')
<div class="col-lg-6 d-flex align-items-center justify-content-center">
  <div class="auth-form-transparent text-left p-3">
    <div class="brand-logo">
      <img src="{{ asset('images/umyu_logo-300x300.png') }}" alt="logo">
    </div>
    <h4>{{ __('Reset Password') }}</h4>
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div class="form-group">
            <label for="exampleInputEmail">{{ __('Email Address') }}</label>
            <div class="input-group">
              <div class="input-group-prepend bg-transparent">
                <span class="input-group-text bg-transparent border-right-0">
                  <i class="mdi mdi-account-outline text-primary"></i>
                </span>
              </div>
              <input type="email" class="form-control form-control-lg border-left-0 @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" autocomplete="false" placeholder="Email Address">
              @error('email')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
            </div>
        </div>

        <div class="my-3">
            <button class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" type="submit">{{ __('Send Password Reset Link') }}</button>
        </div>
    </form>
  </div>
</div>
@endsection
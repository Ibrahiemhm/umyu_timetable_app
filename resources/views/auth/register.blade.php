@extends('layouts.auth')

@section('content')
<div class="col-lg-6 d-flex align-items-center justify-content-center">
  <div class="auth-form-transparent text-left p-3">
    <div class="brand-logo">
      <img src="images/umyu_logo-300x300.png" alt="logo">
    </div>
    <h4>Welcome to UMYUK Timetable Management System!</h4>
    <h6 class="font-weight-light">Create an account to proceed</h6>
    <form method="POST" action="{{ route('register') }}">
      @csrf

      <div class="form-group">
        <label for="exampleInputEmail">Full Name</label>
        <div class="input-group">
          <div class="input-group-prepend bg-transparent">
            <span class="input-group-text bg-transparent border-right-0">
              <i class="mdi mdi-account-outline text-primary"></i>
            </span>
          </div>
          <input type="text" class="form-control form-control-lg border-left-0 @error('email') is-invalid @enderror" id="name" name="name" placeholder="Full Name">
          @error('name')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
          @enderror
        </div>
      </div>

      <div class="form-group">
        <label for="exampleInputEmail">Email Address</label>
        <div class="input-group">
          <div class="input-group-prepend bg-transparent">
            <span class="input-group-text bg-transparent border-right-0">
              <i class="mdi mdi-account-outline text-primary"></i>
            </span>
          </div>
          <input type="email" class="form-control form-control-lg border-left-0 @error('email') is-invalid @enderror" id="email" name="email" placeholder="Email Address">
          @error('email')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
          @enderror
        </div>
      </div>

      <div class="form-group">
        <label for="exampleInputPassword">Password</label>
        <div class="input-group">
          <div class="input-group-prepend bg-transparent">
            <span class="input-group-text bg-transparent border-right-0">
              <i class="mdi mdi-lock-outline text-primary"></i>
            </span>
          </div>
          <input type="password" class="form-control form-control-lg border-left-0 @error('password') is-invalid @enderror" id="password" name="password" placeholder="Password">
          @error('password')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
          @enderror
        </div>
      </div>

      <div class="form-group">
        <label for="exampleInputPassword">Confirm Password</label>
        <div class="input-group">
          <div class="input-group-prepend bg-transparent">
            <span class="input-group-text bg-transparent border-right-0">
              <i class="mdi mdi-lock-outline text-primary"></i>
            </span>
          </div>
          <input type="password" class="form-control form-control-lg border-left-0 @error('password') is-invalid @enderror" id="password-confirm" name="password_confirmation" placeholder="Password">
        </div>
      </div>

      
      <div class="my-3">
        <button class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" type="submit">SIGN-UP</button>
      </div>
      <div class="text-center mt-4 font-weight-light">
        Already have an account? <a href="{{ route('login') }}" class="text-primary">Login</a>
      </div>
    </form>
  </div>
</div>
@endsection

@extends('layout.main')

@section('content')
<div id="auth">
    <div class="row h-100">
      <div class="col-lg-5 col-12">
        <div id="auth-left">
          <div class="auth-logo">
            <a href="index.html"><img src="assets/images/logo/logo.svg" alt="Logo" /></a>
          </div>
          <h1 class="auth-title">Log in.</h1>
          <p class="auth-subtitle mb-5">
            Log in with your data that you entered during registration.
          </p>

          <form action="{{route('auth.authenticate')}}" method="post">
            @csrf
            <div class="form-group position-relative has-icon-left mb-4">
              <input type="text"  name="email" class="form-control form-control-xl" placeholder="Email / Username" />
              @FieldError('email')
              <div class="form-control-icon">
                <i class="bi bi-person"></i>
              </div>
            </div>
            <div class="form-group position-relative has-icon-left mb-4">
              <input type="password" name="password" class="form-control form-control-xl" placeholder="Password" />
              @FieldError('password')
              <div class="form-control-icon">
                <i class="bi bi-shield-lock"></i>
              </div>
            </div>
            <div class="form-check form-check-lg d-flex align-items-end">
              <input class="form-check-input me-2" type="checkbox" value="" id="flexCheckDefault" />
              <label class="form-check-label text-gray-600" for="flexCheckDefault">
                Keep me logged in
              </label>
            </div>
            <button class="btn btn-primary btn-block btn-lg shadow-lg mt-5">
              Log in
            </button>
          </form>
          <div class="text-center mt-5 text-lg fs-4">
            <p class="text-gray-600">
              Don't have an account?
              <a href="{{route('register')}}" class="font-bold">Sign up</a>.
            </p>
            <p>
              <a class="font-bold" href="{{route('forgot-password')}}">Forgot password?</a>.
            </p>
          </div>
        </div>
      </div>
      <div class="col-lg-7 d-none d-lg-block">
        <div id="auth-right"></div>
      </div>
    </div>
  </div>
@endsection
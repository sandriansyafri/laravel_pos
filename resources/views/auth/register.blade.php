@extends('layouts.auth.main')

@section('title')
    Register
@endsection

@section('content')
<div class="register-box">
  <div class="register-logo">
    <a href=""><b>POS</b>PROJECT</a>
  </div>
  <div class="card">
    <div class="card-body register-card-body">
      @if ($errors->any())
      <div class="alert p-0  ">
          <ul class="list-group ">
              @foreach ($errors->all() as $error)
              <li class="list-group-item list-group-flush d-flex justify-content-between align-items-center bg-danger p-2 border-0 rounded-0">
              <small> {{$error}}</small>
                <span class="badge badge-danger badge-pill">
                  <i class="fa fa-exclamation-circle"></i>
                </span>
              </li>
              @endforeach
          </ul>
      </div>
  @endif
      

      <form action="{{ route('register') }}" method="post">
        @csrf
        <div class="mb-3">
          <div class="input-group ">
            <input type="text" class="form-control" value="{{ old('name') }}" placeholder="Full name" name="name">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user"></span>
              </div>
            </div>
          </div>
       
        </div>
        <div class="input-group mb-3">
          <input type="text" class="form-control"  value="{{ old('username') }}" placeholder="Username" name="username">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="email" class="form-control"  value="{{ old('email') }}" placeholder="Email" name="email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control"   placeholder="Password" name="password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control"   placeholder="Retype password" name="password_confirmation">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col">
            <button type="submit" class="btn btn-primary btn-block">Register</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <a href="{{ route('login') }}" class="text-center mt-3 text-center d-inline-block w-100">Login</a>
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- /.register-box -->
@endsection
@extends('layouts.auth.main')

@section('title')
    Login
@endsection

@section('content')
<div class="login-box">
      <div class="login-logo">
        <a href=""><b>POS</b>PROJECT</a>
      </div>
      <!-- /.login-logo -->
      <div class="card">
        <div class="card-body login-card-body">
          @if (session('status'))
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <small><strong>{{ session('status') }}</strong></small>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          @elseif(session('status_register'))
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            <small><strong>{{ session('status_register') }}</strong></small>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          @endif

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
    
          <form action="{{ route('login') }}" method="post">
            @csrf
            <div class="input-group mb-3">
              <input type="email" class="form-control" name="email" placeholder="Email" value="{{ session('email') }}">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-envelope"></span>
                </div>
              </div>
            </div>
            <div class="input-group mb-3">
              <input type="password" class="form-control" name="password" placeholder="Password" value="{{ session('password') }}">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-lock"></span>
                </div>
              </div>
            </div>
            <div class="row ">
              <div class="col">
                <button type="submit" class="btn btn-primary btn-block">Login</button>
              </div>
              <!-- /.col -->
            </div>
          </form>

          <p class="mb-0">
            <a href="{{ route('register') }}" class="text-center d-inline-block w-100 mt-3">Register</a>
          </p>
        </div>
        <!-- /.login-card-body -->
      </div>
    </div>
@endsection
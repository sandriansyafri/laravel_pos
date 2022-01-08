@extends('layouts.backend.main')

@section('title')
    Edit User
@endsection

@section('content')
      @if (session('status_fail'))
      <div class="row">
            <div class="col">
                  <div class="card">
                        <div class="card-body pb-0 ">
                              <div class="alert alert-danger border-0">
                                          <span class="font-weight-bold">{{ session('status_fail') }}</span>
                                    </div>
                              
                        </div>
                  </div>
            </div>
      </div>
      @endif
      @if (session('status_success'))
      <div class="row">
            <div class="col">
                  <div class="card">
                        <div class="card-body pb-0 ">
                              <div class="alert alert-success border-0">
                                          <span class="font-weight-bold">{{ session('status_success') }}</span>
                                    </div>
                              
                        </div>
                  </div>
            </div>
      </div>
      @endif
    <div class="row">
          <div class="col-md-12">
                <div class="card">
                      <div class="card-header">
                            Form
                      </div>
                      <form action="{{ route('user.update',$user->id) }}" method="post">
                            @csrf
                            @method('put')
                            <div class="card-body">
                              <div class="row">
                                    <div class="col">
                                          <div class="form-group ">
                                                <label for="">Role </label> 
                                                <select name="role" id="" class="form-control">
                                                    <option value="">SELECT ROLE</option>
                                                    <option value="1" {{ $user->role === 1 ? "selected" : "" }} >ADMIN</option>
                                                    <option value="0" {{ $user->role === 0 ? "selected" : "" }}>KASIR</option>
                                                </select>
                                            </div>
                                              <div class="form-group">
                                                  <label for="">Nama User</label>
                                                  <input type="text" class="form-control rounded-0 @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}"  />
                                                  @error('name') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                              </div>
                                              <div class="form-group">
                                                  <label for="">Username</label>
                                                  <input type="text" class="form-control rounded-0 @error('username') is-invalid @enderror" name="username" value="{{ $user->username }}"  />
                                                  @error('username') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                              </div>
                                              <div class="form-group">
                                                  <label for="">Email</label>
                                                  <input type="text" class="form-control rounded-0" name="email" value="{{ $user->email }}" readonly  />
                                                  
                                              </div>
                                    </div>
                                      <div class="col">
                                          <div class="form-group">
                                                <label for="">Current Password</label>
                                                <input type="password" class="form-control rounded-0  @error('current_password') is-invalid @enderror" name="current_password"  />
                                                @error('current_password') <span class="invalid-feedback ">{{ $message }}</span> @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="">New Password</label>
                                                <input type="password" class="form-control rounded-0  @error('new_password') is-invalid @enderror" name="new_password"  />
                                                @error('new_password') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                            </div>
                                            <div class="form-group ">
                                                <label for="">Confirm Password Confirm</label>
                                                <input type="password" class="form-control rounded-0  @error('new_password_confirmation') is-invalid @enderror" name="new_password_confirmation"  />
                                                @error('new_password') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                            </div>
                                            
                                      </div>
                              </div>
                            </div>
                            <div class="card-footer">
                              <div class="form-group">
                                    <button class="btn btn-primary rounded-0 w-100" type="submit">Update</button>
                              </div>
                            </div>
                      </form>
                </div>
          </div>
    </div>
@endsection
<div class="row">
      <div class="col">
          <!-- Modal -->
          <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                  <div class="modal-content">
                      <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">
                              Modal title
                          </h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                          </button>
                      </div>
                      <form id="form-user" action="" method="post">
                          @csrf
                          <input  name="_method" value="post" type="hidden">
                          <div class="modal-body">
                              <div class="container-fluid">
                                  <div class="row">
                                      <div class="col">
                                        <div class="form-group mb-0">
                                            <label for="">Role</label>
                                            <select name="role" id="" class="form-control">
                                                <option value="">SELECT ROLE</option>
                                                <option value="1">ADMIN</option>
                                                <option value="0">KASIR</option>
                                            </select>
                                        </div>
                                          <div class="form-group mb-0">
                                              <label for="">Nama User</label>
                                              <input type="text" class="form-control rounded-0" name="name"  />
                                          </div>
                                          <div class="form-group mb-0">
                                              <label for="">Username</label>
                                              <input type="text" class="form-control rounded-0" name="username"  />
                                          </div>
                                          <div class="form-group mb-0">
                                              <label for="">Email</label>
                                              <input type="text" class="form-control rounded-0" name="email"  />
                                          </div>
                                          <div class="form-group mb-0">
                                              <label for="">Password</label>
                                              <input type="password" class="form-control rounded-0" name="password"  />
                                          </div>
                                          <div class="form-group mb-0">
                                              <label for="">Password Confirm</label>
                                              <input type="password" class="form-control rounded-0" name="password_confirmation"  />
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <div class="modal-footer">
                              {{-- <button onclick="submitForm(event)" id="btn-submit" type="button" class="btn btn-primary btn-block">
                                  Save changes
                              </button> --}}
                              <button type="submit" id="btn-submit" type="button" class="btn btn-primary btn-block">
                                  Save changes
                              </button>
                          </div>
                      </form>
                  </div>
              </div>
          </div>
      </div>
  </div>
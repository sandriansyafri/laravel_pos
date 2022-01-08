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
                      <form id="form-pengeluaran" action="" method="post">
                          @csrf
                          <input  name="_method" value="post" type="hidden">
                          <div class="modal-body">
                              <div class="container-fluid">
                                  <div class="row">
                                      <div class="col">
                                          <div class="form-group mb-0">
                                              <label for="">Deskripsi</label>
                                                <textarea name="deskripsi" class="form-control"  rows="5"></textarea> 
                                          </div>
                                          <div class="form-group mb-0">
                                              <label for="">Nominal</label>
                                              <input type="number" class="form-control rounded-0" name="nominal"  />
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
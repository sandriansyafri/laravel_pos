<div class="row">
      <div class="col">
          <!-- Modal -->
          <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                      <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">
                              Modal title
                          </h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                          </button>
                      </div>
                      <form id="form-pembelian" action="" method="post">
                          @csrf
                          <input  name="_method" value="post" type="hidden">
                          <div class="modal-body">
                              <div class="container-fluid">
                                  <div class="row">
                                      <div class="col">
                                        <table id="table-supplier"  class="table tabel-sm table-striped w-100">
                                            <thead>
                                                <tr>
                                                    <th class="text-center" style="width: 10px">#</th>
                                                    <th class="text-center">Supplier</th>
                                                    <th class="text-center">Alamat</th>
                                                    <th class="text-center">Action</th>
                                            
                                                </tr>
                                            </thead>
                                        </table>
                                      </div>
                                  </div>
                              </div>
                          </div>
                  
                      </form>
                  </div>
              </div>
          </div>
      </div>
  </div>
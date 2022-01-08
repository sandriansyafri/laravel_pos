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
                      <form id="form-detail-pembelian" action="" method="post">
                          @csrf
                          <input  name="_method" value="post" type="hidden">
                          <div class="modal-body">
                              <div class="container-fluid">
                                  <div class="row">
                                      <div class="col">
                                            <table id="table-produk"  class="table tabel-sm table-striped w-100">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center" style="width: 10px">#</th>
                                                        <th class="text-center">Nama Produk</th>
                                                        <th class="text-center">Harga Beli</th>
                                                        <th class="text-center">Harga Jual</th>
                                                        <th class="text-center">Stok</th>
                                                        <th class="text-center">Pilih</th>
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
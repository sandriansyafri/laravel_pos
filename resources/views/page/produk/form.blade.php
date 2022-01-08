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
                      <form id="form-produk" action="" method="post">
                          @csrf
                          <input  name="_method" value="post" type="hidden">
                          <div class="modal-body">
                              <div class="container-fluid">
                                  <div class="row">
                                      <div class="col">
                                          <div class="form-group mb-0">
                                             <div class="row">
                                                <label for="" class="col-12 p-0">Nama Produk</label>
                                                <input type="text" class="form-control form-control-sm rounded-0" name="nama_produk" />
                                             </div>
                                          </div>
                                          <div class="form-group mb-0">
                                            <div class="row">
                                               <label for="" class="col-12 p-0">Kategori Produk</label>
                                               <select name="kategori_id" id="" class="form-control form-control-sm">
                                                   <option value="" selected>Open to select kategori</option>
                                                   @foreach ($kategoris as $kategori)
                                                   <option value="{{ $kategori->id }}" >{{ $kategori->nama_kategori }}</option>
                                                  @endforeach
                                               </select>
                                            </div>
                                         </div>
                                          <div class="form-group mb-0">
                                             <div class="row">
                                                <label for="" class="col-12 p-0">Merek</label>
                                                <input type="text" class="form-control form-control-sm rounded-0" name="merek" />
                                             </div>
                                          </div>
                                          <div class="form-group mb-0">
                                            <div class="row">
                                                <label for="" class="col-12">Harga Beli</label>
                                                <input type="number" class="form-control form-control-sm rounded-0" name="harga_beli" />
                                            </div>
                                          </div>
                                          <div class="form-group mb-0">
                                             <div class="row">
                                                <label for="" class="col-12">Harga Jual</label>
                                                <input type="number" class="form-control form-control-sm rounded-0" name="harga_jual" />
                                             </div>
                                          </div>
                                          <div class="form-group mb-0">
                                             <div class="row">
                                                <label for="" class="col-12">Diskon</label>
                                                <input type="number" class="form-control form-control-sm rounded-0" name="diskon" />
                                             </div>
                                          </div>
                                          <div class="form-group mb-0 ">
                                                <div class="row">
                                                      <label for="" class="col-12">Stok</label>
                                                     <input type="number" class="form-control form-control-sm rounded-0"   name="stok" />
                                                </div>
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
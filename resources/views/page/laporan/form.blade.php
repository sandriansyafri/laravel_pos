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
                      <form id="form-periode" action="" method="get">
                          <div class="modal-body">
                              <div class="container-fluid">
                                  <div class="row">
                                      <div class="col">
                                                <div class="form-group">
                                                      <label for="">Tanggal Awal</label>
                                                      <input type="date" class="form-control" name="tanggal_awal">
                                                </div>
                                                <div class="form-group">
                                                      <label for="">Tanggal Akhir</label>
                                                      <input type="date" class="form-control" name="tanggal_akhir">
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


  @push('css')
     <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('/') }}plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="{{ asset('/') }}plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="{{ asset('/') }}plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
@endpush

@push('js')
    <!-- DataTables  & Plugins -->
<script src="{{ asset('/') }}plugins/datatables/jquery.dataTables.min.js"></script>
<script src="{{ asset('/') }}plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="{{ asset('/') }}plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="{{ asset('/') }}plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="{{ asset('/') }}plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="{{ asset('/') }}plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
@endpush
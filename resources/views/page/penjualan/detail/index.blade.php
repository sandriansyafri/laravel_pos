@extends('layouts.backend.main')

@section('title')
    Detail Penjualan
@endsection

@push('css')
    <style>
          .kembalian{
                font-size: 70px;
                font-weight: bold
          }
          .nominal_kembalian{
                font-size: 30px;
                letter-spacing: 1px
          }
    </style>
@endpush

@section('content')
    <div class="row mb-3">
          <div class="col-5">
                <div class="input-group">
                      <input type="text" class="form-control form-control-sm rounded-0" placeholder="Cari Produk">
                      <button onclick="showModalProduk(`{{ route('data.produk') }}`)" class="btn btn-primary btn-sm rounded-0">
                              <i class="fa fa-arrow-right"></i>
                      </button>
                </div>
          </div>
    </div>
    <div class="row">
          <div class="col">
                <div class="card">
                      <div class="card-body">
                        <table id="table-penjualan-detail" class="table table-sm table-stripped w-100">
                              <thead>
                                    <tr>
                                          <th class="text-center">#</th>
                                          <th class="text-center">Nama Produk</th>
                                          <th class="text-center" style="width: 70px">Qty</th>
                                          <th class="text-center">Harga</th>
                                          <th class="text-center">Sub Total</th>
                                          <th class="text-center">Action</th>
                                    </tr>
                              </thead>
                        </table>

                        <div class="row">
                              <div class="col-8 bg-success p-5 text-white">
                                    <div class="h1">Kembalian</div>
                                    <div class="kembalian"></div>
                                    <div class="nominal_kembalian"></div>
                              </div>
                              <div class="col-4">
                                    <form action="" method="post">
                                          @csrf
                                          <div class="form-group">
                                                <label for="">Total Harga</label>
                                                <input type="hidden" name="total_harga" class="form-control form-control-sm  rounded-0">
                                                <input type="hidden" name="total_item" class="form-control form-control-sm  rounded-0">
                                                <input type="text" name="rp_total_harga" readonly class="form-control form-control-sm  rounded-0">
                                          </div>
                                          <div class="form-group">
                                                <label for="">Diskon</label>
                                                <input type="text" name="diskon" value="0" class="form-control form-control-sm  rounded-0">
                                          </div>
                                          <div class="form-group">
                                                <label for="">Total Bayar</label>
                                                <input type="hidden" name="total_bayar" class="form-control form-control-sm  rounded-0">
                                                <input type="text" name="rp_total_bayar" class="form-control form-control-sm  rounded-0">
                                          </div>
                                          <div class="form-group">
                                                <label for="">Diterima</label>
                                                <input type="hidden" name="diterima" value="0"  class="form-control form-control-sm  rounded-0">
                                                <input type="text" name="rp_diterima" value="0" class="form-control form-control-sm  rounded-0">
                                          </div>

                                          <button onclick="submitFormPenjualan()" id="btn-simpan-penjualan" type="button" class="btn btn-primary rounded-0 btn-sm w-100">
                                                <i class=" fa fa-save mr-2"></i> Simpan Penjualan
                                          </button>
                                    </form>
                              </div>
                        </div>

                      </div>
                </div>
          </div>
    </div>
    <div class="row">
          <div class="col">
                @include('page.penjualan.detail.form-tabel-produk')
          </div>
    </div>
@endsection

@push('css')
     <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('/') }}plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="{{ asset('/') }}plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="{{ asset('/') }}plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

  <style>
        table#table-penjualan-detail tbody tr:last-child{
              display: none
        }
  </style>

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


@push('js')

    <script>

          let tabel_penjualan_detail;

          $(document).ready(function(){
                let penjualan_id = "{{ $penjualan_id }}";
                tabel_penjualan_detail = $('#table-penjualan-detail').DataTable({
                      bPaginate : false,
                      bInfo: false,
                      ajax : `{{ url('data/detail-penjualan/${penjualan_id}') }}`,
                      columns : [
                            {class: 'text-center', data: 'DT_RowIndex', orderable: false, searchable: false},
                            {class: 'text-center', data: 'produk.nama_produk'},
                            {class: 'text-center', data: 'qty'},
                            {class: 'text-center', data: 'harga_jual'},
                            {class: 'text-center', data: 'subtotal'},
                            {class: 'text-center', data: 'action'},
                      ]
                })
                .on('draw.dt',function(){
                      loadFormData();
                })
          })

          $(document).on('input','input[name=diskon]',function(){
                let diskon = $(this).val()
                let diterima = $('input[name=rp_diterima]').val()
                loadFormData(diskon, diterima)
          })

          $(document).on('input','input[name=rp_diterima]',function(){
                let diterima = $(this).val()
                let diskon = $('input[name=diskon]').val()

                loadFormData(diskon, diterima)
          })

          function submitFormPenjualan(){
                let total_item = $('div.total-item').text();
                let total_harga = $('div.total-harga').text();
                let diskon = $('input[name=diskon]').val();
                let diterima = $('input[name=rp_diterima]').val();
                let bayar = $('input[name=total_bayar]').val();
                let penjualan_id = "{{ $penjualan_id }}";
                let data = { total_item,total_harga,diskon,diterima,bayar, penjualan_id };

               if(confirm('simpan transaksi?')){
                  $.ajax({
                      url : "{{ route('penjualan.store') }}",
                      data,
                      headers :  {
                            'X_CSRF_TOKEN' : "{{ csrf_token() }}"
                      },
                      type : 'POST',
                })
                .done((res) => {
                      if(res.ok){
                            alert('ok');
                            window.location.href= `{{ route('penjualan.index') }}`
                      }
                })
                .fail((e) => console.log(e))
               }


          }

          function loadFormData(diskon = 0, bayar = 0){
                let total_harga = $('div.total-harga').text();
                let total_item = $('div.total-item').text();

                $('input[name="total_harga"]').val(total_harga );
                $('input[name="total_item"]').val(total_item);

                
                $.ajax({
                      url : `{{ url('penjualan/load-form-data/${total_harga}/${diskon}/${bayar}') }}`
                  })
                  .done((res) => {
                        if(res.ok){
                              $('input[name="rp_total_harga"]').val(res.rp_total_harga );
                              $('input[name=rp_total_bayar]').val(res.rp_total_bayar);
                              $('input[name="total_bayar"]').val(res.total_bayar );
                              $('div.kembalian').text(res.rp_kembalian)
                              $('div.nominal_kembalian').text(res.nominal_kembalian)
                      }
                })
                .fail((e) => console.log(e))

                
          }

          function updateItem(e,url,id){
                let qty = $(`input[name="item_${id}"]`).val();
                $.ajax({
                      url,
                      type : 'put',
                      headers : {
                            'X_CSRF_TOKEN' : "{{ csrf_token() }}",
                      },
                      data : { qty }
                })
                .done((res) => {
                      if(res.ok){
                        tabel_penjualan_detail.ajax.reload();
                      }
                })
                .fail((e) => console.log(e))
          }

          function deleteItem(url){
                  if(confirm('delete item?')){
                        $.ajax({
                              headers : {
                                    'X_CSRF_TOKEN' : "{{ csrf_token() }}"
                              },
                              url,
                              type : 'delete'
                        })
                        .done((res) => {
                              if(res.ok){
                                    alert(res.message);
                                    tabel_penjualan_detail.ajax.reload()
                              }
                        })
                        .fail((e) => console.log(e))
                        }
          }

         function  showModalProduk(url){
            $('.modal').modal()               
            $('.modal-title').text('Produk')
          }



    </script>

@endpush
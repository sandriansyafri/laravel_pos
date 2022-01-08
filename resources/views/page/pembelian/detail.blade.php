@extends('layouts.backend.main')
@section('title')
    Detail Pembelian
@endsection

@section('breadcrumb') @parent
<li class="breadcrumb-item active">Pembelian</li>
<li class="breadcrumb-item active">Detail</li>
@endsection

@push('css')
    <style>
          .bayar{
                font-size: 60px;
                font-weight: bold
          }
          .terbilang{
                font-size: 30px;
                letter-spacing: 1px
          }
    </style>
@endpush

@section('content')
    <div class="row">
          <div class="col-md-4">
                <div class="card">
                      <div class="card-body ">
                           <table>
                                 <thead>
                                       <tr>
                                             <th class="text-sm" style="width: 120px">Nama Supplier</th>
                                             <td class="text-sm" style="width: ">: {{ $supplier->nama_supplier }}</td>
                                       </tr>
                                       <tr>
                                             <th class="text-sm" style="width: 120px">Alamat</th>
                                             <td class="text-sm" style="width: ">: {{ $supplier->alamat }}</td>
                                       </tr>
                                 </thead>
                           </table>
                      </div>
                </div>
          </div>
    </div>
    <div class="row my-2">
          <div class="col-4 mb-4">
                <div class="input-group">
                      <input class="form-control form-control-sm rounded-0" placeholder="Pilih Produk" type="text">
                      <button onclick="selectProduk()" class="btn btn-primary btn-sm rounded-0">
                            <i class="fa fa-arrow-right"></i>
                      </button>
                </div>
          </div>
          <div class="col-12 ">
                  <div class="card">
                        <div class="card-body">
                                    @csrf
                                    <table id="table-detail-pembelian"  class="table table-sm table-striped">
                                          <thead>
                                              <tr>
                                                  <th class="text-center" style="width: 10px">#</th>
                                                  <th class="text-center">Nama Produk</th>
                                                  <th class="text-center" style="width: 100px">Qty</th>
                                                  <th class="text-center">Harga Beli</th>
                                                  <th class="text-center">Sub Total</th>
                                                  <th class="text-center">Action</th>
                                              </tr>
                                          </thead>
                                      </table>
                                      <div class="row">
                                            <div class="col-md-8 ">
                                                  <div class="w-100 bg-success py-2 px-5 mb-3">
                                                        <h1 class="h1 mb-0">Bayar</h1>
                                                      <p class="bayar"></p>
                                                      <p class="terbilang"></p>
                                                  </div>
                                                  <button type="button"   class="btn btn-lg btn-primary simpan-transaksi">
                                                        <i class="fa fa-save mr-3"></i> Simpan Traksaksi Pembelian
                                                  </button>
                                            </div>
                                            <div class="col-4">
                                               <form  action="{{ route('pembelian.store') }}" class="form-pembelian" method="post">
                                                     @csrf
                                                <div class="form-group">
                                                      <label for="">Total</label>
                                                      <input name="rp_total_harga" value="" type="text" readonly class="form-control form-control-sm rounded-0">
                                                      <input name="total_harga" value="" type="hidden" readonly class="form-control form-control-sm rounded-0">
                                                      <input name="total_item" value="" type="hidden" class="form-control form-control-sm rounded-0">
                                                </div>
                                                <div class="form-group">
                                                      <label for="">Diskon</label>
                                                      <input name="diskon" value="{{ $pembelian->diskon }}" type="number" class="form-control form-control-sm rounded-0">
                                                </div>
                                                <div class="form-group">
                                                      <label for="">Bayar</label>
                                                      <input name="rp_bayar" value="0" type="text" class="form-control form-control-sm rounded-0">
                                                      <input name="bayar" value="0" type="hidden" class="form-control form-control-sm rounded-0">
                                                </div>
                                               </form>
                                            </div>
                                      </div>
                        </div>
                  </div>
          </div>
    </div>

    

    @include('page.pembelian.form-produk')
@endsection

@push('css')
     <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('/') }}plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="{{ asset('/') }}plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="{{ asset('/') }}plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

  <style>
        #table-detail-pembelian tbody tr:last-child{
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

          let table ;
          let table_detail_pembelian;

      $(document).ready(function(){
                  table = $('#table-produk').DataTable({
                  ajax: {
                        url : "{{ route('data.produk') }}",
                        type : 'get'
                  },
                  columns: [
                        {class: 'text-center', data: 'DT_RowIndex', orderable: false, searchable: false},
                        {class: 'text-center', data: 'nama_produk'},
                        {class: 'text-center', data: 'harga_beli'},
                        {class: 'text-center', data: 'harga_jual'},
                        {class: 'text-center', data: 'stok'},
                        {class: 'text-center', data: 'pilih', orderable: false, searchable: false},
                  ]
                  });
                  let pembelian_id = "{{ $pembelian->id }}";
                  let url = "{{ url('data/detail-pembelian/30') }}";
                  console.log(url)
                  table_detail_pembelian = $('#table-detail-pembelian').DataTable({
                        ajax: {
                        url : `{{ url('data/detail-pembelian/${pembelian_id}') }}`,
                        type : 'get'
                  },
                  "bPaginate": false, //hide pagination
                  "bFilter": false, //hide Search bar
                  "bInfo": false, // hide showing entries
                  columns: [
                        {class: 'text-center', data: 'DT_RowIndex', orderable: false, searchable: false},
                        {class: 'text-center', data: 'nama_produk'},
                        {class: 'text-center', data: 'jumlah'},
                        {class: 'text-center', data: 'harga_beli'},
                        {class: 'text-center', data: 'subtotal'},
                        {class: 'text-center', data: 'delete', orderable: false, searchable: false},
                  ],
                  }).on('draw.dt',function(){
                        let diskon = $('#input[name=diskon]').val();
                        loadFormData(diskon);
                  })
      })

      $(document).on('change','input[name=diskon]',function(){
         
            if($(this).val() === ""){
                  $(this).val(0).selected()
            } else if($(this).val() >101){
                  alert('cannot set diskon');
                  $(this).val(0).selected()
            } else {
                  loadFormData($(this).val())
            }
      })

      $(document).on('click','.simpan-transaksi',function(){
            let total_harga = $('[name=total_harga]').val()
            let total_item = $('[name=total_item]').val()
            let diskon = $('[name=diskon]').val()
            let bayar = $('[name=bayar]').val()
            let supplier_id = "{{ $supplier->id }}"
            let pembelian_id = "{{ $pembelian->id }}"

            let data = {total_harga, total_item, diskon, bayar, supplier_id, pembelian_id};
            if(confirm('simpan transaksi')){
                  $.ajax({
                  headers : {
                        'X_CSRF_TOKEN' : "{{ csrf_token() }}"
                  },
                  url : `{{ url('pembelian/${pembelian_id}') }}`,
                  data,
                  type : 'put'
            })
            .done((res) => {
                  alert('ok');
                  window.location.href = "{{ route('pembelian.index') }}"
            })
            .fail((e) => console.log(e))
            }
            
   
      })



    function submitDetailPembelian(e,url,id){
          e.preventDefault();

            $.ajax({
                  url,
                  headers : {
                        'X_CSRF_TOKEN' : "{{ csrf_token() }}"
                  },
                  data: {
                        'produk_id' : id,
                        'pembelian_id' : "{{ $pembelian->id }}"
                  },
                  type: 'post'
            })
            .done((res) => {
                  $('.modal').modal('hide');
                  table_detail_pembelian.ajax.reload()
            })
            .fail((e) => console.log(e))


    }

    function updateDetailPembelian(url,detail_pembelian_id){
          let qty = $(`input[name=qty_${detail_pembelian_id}]`).val();
          let data = { qty, detail_pembelian_id}

          $.ajax({
                url,
                data,
                headers : {
                      'X_CSRF_TOKEN' : "{{ csrf_token() }}"
                },
                type : 'put',
          })
          .done((res) => table_detail_pembelian.ajax.reload())
          .fail((e) => console.log(e))

    }

    function deleteDetailPembelian(url){
          $.ajax({
                url,
                headers : {
                      'X_CSRF_TOKEN' : "{{ csrf_token() }}"
                },
                type: 'delete',
          })
          .done((res) => table_detail_pembelian.ajax.reload())
          .fail((e) => console.log(e))
    }
      function selectProduk(){
            $('.modal').modal();
            $('.modal-title').text('Produk')
      }

      function loadFormData(diskon = 0){
            let total_harga = $('div#total_harga').text()
            let total_item = $('div#total_item').text()

            $('input[name=total_item]').val(total_item);

            $.get(`{{ url('pembelian/load-form-data') }}/${diskon}/${total_harga}`)
                  .done((res) => {
                        $('input[name=rp_total_harga]').val(res.rp_total_harga);
                        $('input[name=total_harga]').val(res.total_harga);
                        $('input[name=rp_bayar]').val(res.rp_total_bayar);
                        $('input[name=bayar]').val(res.bayar);

                        $('p.bayar').text(res.rp_total_bayar);
                        $('p.terbilang').text(res.terbilang);
                        

                  })
                  .fail((e) => console.log(e))
      }

    </script>
@endpush
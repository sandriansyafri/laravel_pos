@extends('layouts.backend.main') @section('title') Produk @endsection
@section('breadcrumb') @parent
<li class="breadcrumb-item active">Produk</li>
@endsection @section('content')
<div class="row">
    <div class="col">
        <button onclick="addProduk(`{{ route('produk.index') }}`)" type="button" class="btn btn-primary mb-3">
            <i class="fa fa-plus-circle mr-1"></i> Tambah Produk
        </button>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Table</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="table-produk"  class="table table-sm table-striped">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 10px">#</th>
                            <th class="text-center">Kategori</th>
                            <th class="text-center">Nama Produk</th>
                            <th class="text-center">Harga Beli</th>
                            <th class="text-center">Harga Jual</th>
                            <th class="text-center">Stok</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
</div>

@include('page.produk.form')
@endsection

@push('css')
     <!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
@endpush

@push('js')
    <!-- DataTables  & Plugins -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
@endpush

@push('js')
    <script>
        let table;

        $('#form-produk').submit(function(e){
            e.preventDefault();

            const form = $('#form-produk')
            let url = form.attr('action');
            let data = form.serialize();

            $.post(url,data)
                .done((res) => {
                    if(res.ok){
                        $('.modal').modal('hide')
                        alert(res.message)
                        table.ajax.reload();
                    }
                })
                .fail((res) =>{
                    alert('tidak dapat menyimpan data')
                })

        })

        $(document).ready(function(){
            table = $('#table-produk').DataTable({
            ajax: {
                url : "{{ route('data.produk') }}",
                type : 'get'
            },
            columns: [
                {class: 'text-center', data: 'DT_RowIndex', orderable: false, searchable: false},
                {class: 'text-center', data: 'kategori.nama_kategori'},
                {class: 'text-center', data: 'nama_produk'},
                {class: 'text-center', data: 'harga_beli'},
                {class: 'text-center', data: 'harga_jual'},
                {class: 'text-center', data: 'stok'},
                {class: 'text-center', data: 'action'},
           
            ]
        });
        })

        function addProduk(url){
            $('.modal').modal();
            $('.modal').on('shown.bs.modal', function () {
                $('input[name=nama_produk]').focus()
            })
            $('#form-produk').attr('action',url)
            $('#form-produk')[0].reset();
            $('input[name=_method]').val('post')
            $('.modal-title').text('Tambah Produk')
            $('#btn-submit').text('Submit')
        }

        function editProduk(e,url){
            e.preventDefault();

            $.get(url)
                .done(res => {
                    console.log(res)
                    let produk = res.produk
                    $('input[name=nama_produk]').val(produk.nama_produk)
                    $('select[name=kategori_id]').val(produk.kategori_id)
                    $('input[name=merek]').val(produk.merek)
                    $('input[name=harga_beli]').val(produk.harga_beli)
                    $('input[name=harga_jual]').val(produk.harga_jual)
                    $('input[name=diskon]').val(produk.diskon)
                    $('input[name=stok]').val(produk.stok)
                })

            $('.modal').modal();
            $('#form-produk').attr('action',url)
            $('input[name=_method]').val('put')
            $('.modal').on('shown.bs.modal', function () {
                $('input[name=nama_produk]').focus()
            })
            $('.modal-title').text('Edit Produk')
            $('#btn-submit').text('Update')
            $('#btn-submit').removeClass('btn-primary').addClass('btn-warning')
        }

        function deleteProduk(e,url){
            e.preventDefault();
            if(confirm('delete?')){
                $.ajax({
                    url,
                    headers : {
                        'X_CSRF_TOKEN' : "{{ csrf_token() }}"
                    },
                    type : 'delete',
                })
                .done((res) => {
                    if(res.ok){
                        alert(res.message)
                        table.ajax.reload();
                    }
                })
            }
        }
    </script>
@endpush


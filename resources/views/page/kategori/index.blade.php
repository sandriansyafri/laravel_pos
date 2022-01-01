@extends('layouts.backend.main') @section('title') Kategori @endsection
@section('breadcrumb') @parent
<li class="breadcrumb-item active">Kategori</li>
@endsection @section('content')
<div class="row">
    <div class="col">
        <button onclick="addKategori(`{{ route('kategori.index') }}`)" type="button" class="btn btn-primary mb-3">
            <i class="fa fa-plus-circle mr-1"></i> Tambah Kategori
        </button>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Table</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="table"  class="table table-striped">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 10px">#</th>
                            <th class="text-center">Nama Kategori</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
</div>

@include('page.kategori.form')
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
        $(document).ready(function(){
            table = $('#table').DataTable({
            ajax: {
                url : "{{ route('data.kategori') }}",
                type : 'get'
            },
            columns: [
                {class: 'text-center', data: 'DT_RowIndex', orderable: false, searchable: false},
                {class: 'text-center', data: 'nama_kategori'},
                {class: 'text-center', data: 'action'},
            ]
        });
        })

       function submitForm(e){
            e.preventDefault();
            $.ajax({
                url : $('form').attr('action'),
                data: $('form').serialize(),
                type : 'post'
            })
            .done((res) => {
                if(res.ok){
                    $('.modal').modal('hide')
                    alert(res.message)
                    table.ajax.reload();
                }
            })
            .fail((res) =>{
                let errors = res.responseJSON.errors;
                if(errors){
                    $('input[name=nama_kategori]').after(`<small class="text-danger">${errors.nama_kategori[0]}</small>`)
                }
            })
       }




        function addKategori(url){
            $('.modal').modal();
            $('.modal').on('shown.bs.modal', function () {
                $('input[name=nama_kategori]').focus()
            })
            $('form').attr('action',url)
            $('small.text-danger').detach();
            $('input[name=_method]').val('post')
            $('input[name=nama_kategori]').val('')
            $('.modal-title').text('Tambah Kategori')
            $('#btn-submit').text('Submit')
        }

        function editKategori(e,url){
            e.preventDefault();

            $.get(url)
                .done(res => {
                    let kategori = res.kategori
                    $('input[name=nama_kategori]').val(kategori.nama_kategori)
                })

            $('.modal').modal();
            $('form').attr('action',url)
            $('input[name=_method]').val('put')
            $('.modal').on('shown.bs.modal', function () {
                $('input[name=nama_kategori]').focus()
            })
            $('small.text-danger').detach();
            $('.modal-title').text('Edit Kategori')
            $('#btn-action').text('Update')
            $('#btn-action').removeClass('btn-primary').addClass('btn-danger')
        }

        function deleteKategori(e,url){
            e.preventDefault();
            if(confirm('delete?')){
                $.ajax({
                    headers : {
                        'X_CSRF_TOKEN' : "{{ csrf_token() }}"
                    },
                    url : url,
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


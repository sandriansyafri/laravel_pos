@extends('layouts.backend.main') @section('title') Kategori @endsection
@section('breadcrumb') @parent
<li class="breadcrumb-item active">Kategori</li>
@endsection @section('content')
<div class="row">
    <div class="col">
        <div>
            <button onclick="addKategori(`{{ route('kategori.index') }}`)" type="button" class="btn btn-primary mb-3">
                <i class="fa fa-plus-circle mr-1"></i> Tambah Kategori
            </button>
            
            <button onclick="deleteAll(event,`{{ route('kategori.deleteAll') }}`)" type="button" class="btn btn-danger mb-3">
                <i class="fa fa-trash mr-1"></i> Delete All
            </button>

        </div>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Table</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              
                <form id="form-checklistAll" action="" method="post">
                    @csrf
                    <table id="table-kategori"  class="table tabel-sm table-striped">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 10px">
                                    <input type="checkbox" name="checklistAll" id="">
                                </th>
                                <th class="text-center" style="width: 10px">#</th>
                                <th class="text-center">Nama Kategori</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                    </table>
                </form>
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

        $('#form-kategori').submit(function(e){
            e.preventDefault();

            const form = $('#form-kategori')
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
            table = $('#table-kategori').DataTable({
            ajax: {
                url : "{{ route('data.kategori') }}",
                type : 'get'
            },
            columns: [
                {class: 'text-center', data: 'checklist',orderable: false, searchable: false},
                {class: 'text-center', data: 'DT_RowIndex', orderable: false, searchable: false},
                {class: 'text-center', data: 'nama_kategori'},
                {class: 'text-center', data: 'action'},
            ]
        });
        })

        function addKategori(url){
            $('.modal').modal();
            $('.modal').on('shown.bs.modal', function () {
                $('input[name=nama_kategori]').focus()
            })
            $('#form-kategori').attr('action',url)
            $('#form-kategori')[0].reset()
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
            $('#form-kategori').attr('action',url)
            $('input[name=_method]').val('put')
            $('.modal').on('shown.bs.modal', function () {
                $('input[name=nama_kategori]').focus()
            })
            $('.modal-title').text('Edit Kategori')
            $('#btn-action').text('Update')
            $('#btn-action').removeClass('btn-primary').addClass('btn-danger')
        }

        $('[name=checklistAll]').change(function(e){
            $(':checkbox').attr('checked',this.checked)
        })

        function deleteAll(e,url){
            e.preventDefault();
            let checklist =  $('input.form-check-input:checked').length;
            if(checklist < 1){
                alert('no item selected')
                return;
            }
            if(confirm('delete selected item?')){
                $.ajax({
                    url,
                    headers : {
                        'X_CSRF_TOKEN' : "{{ csrf_token() }}"
                    },
                    type : 'delete',
                    data: $('#form-checklistAll').serialize()
                })
                .done((res) => {
                    if(res.ok){
                        alert(res.message)
                        table.ajax.reload();
                    }
                })
            }
        }

        function deleteKategori(e,url){
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


@extends('layouts.backend.main') @section('title') Pengeluaran @endsection
@section('breadcrumb') @parent
<li class="breadcrumb-item active">Pengeluaran</li>
@endsection @section('content')
<div class="row">
    <div class="col">
        <div>
            <button onclick="addPengeluaran(`{{ route('pengeluaran.index') }}`)" type="button" class="btn btn-primary mb-3">
                <i class="fa fa-plus-circle mr-1"></i> Tambah Pengeluaran
            </button>
            
            <button onclick="deleteAll(event,`{{ route('pengeluaran.deleteAll') }}`)" type="button" class="btn btn-danger mb-3">
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
                    <table id="table-pengeluaran"  class="table tabel-sm table-striped">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 10px">
                                    <input type="checkbox" name="checklistAll" id="">
                                </th>
                                <th class="text-center" style="width: 10px">#</th>
                                <th class="text-center">Deskripsi</th>
                                <th class="text-center">Nominal</th>
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

@include('page.pengeluaran.form')
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

        $('#form-pengeluaran').submit(function(e){
            e.preventDefault();

            const form = $('#form-pengeluaran')
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
            table = $('#table-pengeluaran').DataTable({
            ajax: {
                url : "{{ route('data.pengeluaran') }}",
                type : 'get'
            },
            columns: [
                {class: 'text-center', data: 'checklist',orderable: false, searchable: false},
                {class: 'text-center', data: 'DT_RowIndex', orderable: false, searchable: false},
                {class: 'text-center', data: 'deskripsi'},
                {class: 'text-center', data: 'nominal'},
                {class: 'text-center', data: 'action'},
            ]
        });
        })

        function addPengeluaran(url){
            $('.modal').modal();
            $('.modal').on('shown.bs.modal', function () {
                $('input[name=nama_pengeluaran]').focus()
            })
            $('#form-pengeluaran').attr('action',url)
            $('#form-pengeluaran')[0].reset()
            $('input[name=_method]').val('post')
            $('input[name=nama_pengeluaran]').val('')
            $('.modal-title').text('Tambah Pengeluaran')
            $('#btn-submit').text('Submit')
            $('#btn-submit').removeClass('btn-warning').addClass('btn-primary')

        }

        function editPengeluaran(e,url){
            e.preventDefault();

            $.get(url)
                .done(res => {
                    let pengeluaran = res.pengeluaran
                    $('[name=deskripsi]').val(pengeluaran.deskripsi)
                    $('[name=nominal]').val(pengeluaran.nominal)
                })

            $('.modal').modal();
            $('#form-pengeluaran').attr('action',url)
            $('input[name=_method]').val('put')
            $('.modal').on('shown.bs.modal', function () {
                $('input[name=nama_pengeluaran]').focus()
            })
            $('.modal-title').text('Edit Pengeluaran')
            $('#btn-submit').text('Update')
            $('#btn-submit').removeClass('btn-primary').addClass('btn-warning')
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

        function deletePengeluaran(e,url){
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


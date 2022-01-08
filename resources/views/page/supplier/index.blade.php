@extends('layouts.backend.main') @section('title') Supplier @endsection
@section('breadcrumb') @parent
<li class="breadcrumb-item active">Supplier</li>
@endsection @section('content')
<div class="row">
    <div class="col">
        <div>
            <button onclick="addSupplier(`{{ route('supplier.index') }}`)" type="button" class="btn btn-primary mb-3">
                <i class="fa fa-plus-circle mr-1"></i> Tambah Supplier
            </button>
            
            <button onclick="deleteAll(event,`{{ route('supplier.deleteAll') }}`)" type="button" class="btn btn-danger mb-3">
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
                    <table id="table-supplier"  class="table tabel-sm table-striped">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 10px">
                                    <input type="checkbox" name="checklistAll" id="">
                                </th>
                                <th class="text-center" style="width: 10px">#</th>
                                <th class="text-center">Nama Supplier</th>
                                <th class="text-center">Alamat</th>
                                <th class="text-center">Telp</th>
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

@include('page.supplier.form')
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

        $('#form-supplier').submit(function(e){
            e.preventDefault();

            const form = $('#form-supplier')
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
            table = $('#table-supplier').DataTable({
            ajax: {
                url : "{{ route('data.supplier') }}",
                type : 'get'
            },
            columns: [
                {class: 'text-center', data: 'checklist',orderable: false, searchable: false},
                {class: 'text-center', data: 'DT_RowIndex', orderable: false, searchable: false},
                {class: 'text-center', data: 'nama_supplier'},
                {class: 'text-center', data: 'alamat'},
                {class: 'text-center', data: 'no_telp'},
                {class: 'text-center', data: 'action'},
            ]
        });
        })

        function addSupplier(url){
            $('.modal').modal();
            $('.modal').on('shown.bs.modal', function () {
                $('input[name=nama_supplier]').focus()
            })
            $('#form-supplier').attr('action',url)
            $('#form-supplier')[0].reset()
            $('input[name=_method]').val('post')
            $('input[name=nama_supplier]').val('')
            $('.modal-title').text('Tambah Supplier')
            $('#btn-submit').text('Submit')
            $('#btn-submit').removeClass('btn-warning').addClass('btn-primary')

        }

        function editSupplier(e,url){
            e.preventDefault();

            $.get(url)
                .done(res => {
                    let supplier = res.supplier
                    $('input[name=nama_supplier]').val(supplier.nama_supplier)
                    $('input[name=alamat]').val(supplier.alamat)
                    $('input[name=no_telp]').val(supplier.no_telp)
                    $('input[name=no_hp]').val(supplier.no_hp)
                })

            $('.modal').modal();
            $('#form-supplier').attr('action',url)
            $('input[name=_method]').val('put')
            $('.modal').on('shown.bs.modal', function () {
                $('input[name=nama_supplier]').focus()
            })
            $('.modal-title').text('Edit Supplier')
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

        function deleteSupplier(e,url){
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


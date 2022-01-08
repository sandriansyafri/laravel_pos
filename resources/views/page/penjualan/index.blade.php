@extends('layouts.backend.main') @section('title') Penjualan @endsection
@section('breadcrumb') @parent
<li class="breadcrumb-item active">Penjualan</li>
@endsection @section('content')
<div class="row">
    <div class="col">
        <div class="d-flex justify-content-between">
            <div>
                <button onclick="addPenjualan(`{{ route('penjualan.create') }}`)" type="button" class="btn btn-primary mb-3">
                    <i class="fa fa-plus-circle mr-1"></i> Transaksi Baru
                </button>
                
                <button onclick="deleteAll(event,`{{ route('penjualan.deleteAll') }}`)" type="button" class="btn btn-danger mb-3">
                    <i class="fa fa-trash mr-1"></i> Delete All
                </button>
            </div>

            <div>
                <button onclick="reloadTable()" class="btn btn-primary " >
                    Reload Table
                </button>
            </div>

        </div>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Table</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              
                <form id="form-checklistAll" action="" method="post">
                    @csrf
                    <table id="table-penjualan"  class="table tabel-sm table-striped">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 10px">
                                    <input type="checkbox" name="checklistAll" id="">
                                </th>
                                <th class="text-center" style="width: 10px">#</th>
                                <th class="text-center">Total Item</th>
                                <th class="text-center">Total Harga</th>
                                <th class="text-center">Diskon</th>
                                <th class="text-center">Total Bayar</th>
                                <th class="text-center">Di Terima</th>
                            </tr>
                        </thead>
                    </table>
                </form>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
</div>

@include('page.penjualan.form')
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
        let table_supplier;

        $('#form-penjualan').submit(function(e){
            e.preventDefault();

            const form = $('#form-penjualan')
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
            table = $('#table-penjualan').DataTable({
                ajax: {
                    url : "{{ route('data.penjualan') }}",
                    type : 'get'
                },
                columns: [
                    {class: 'text-center', data: 'checklist',orderable: false, searchable: false},
                    {class: 'text-center', data: 'DT_RowIndex', orderable: false, searchable: false},
                    {class: 'text-center', data: 'total_item'},
                    {class: 'text-center', data: 'total_harga'},
                    {class: 'text-center', data: 'diskon'},
                    {class: 'text-center', data: 'bayar'},
                    {class: 'text-center', data: 'action'},
                ]
            });

            table_supplier = $('#table-supplier').DataTable({
                    ajax: {
                    url : "{{ route('data.supplier') }}",
                    type : 'get'
                },
                columns: [
                    {class: 'text-center', data: 'DT_RowIndex', orderable: false, searchable: false},
                    {class: 'text-center', data: 'nama_supplier'},
                    {class: 'text-center', data: 'alamat'},
                    {class: 'text-center', data: 'pilih'},
                ]
                });

        })

        function reloadTable(){
            table.ajax.reload();
        }

        function addPenjualan(url){
            if(confirm('create new transaction?')){
                window.location.href = url;
            }
        }

        function editPenjualan(url){
            if(confirm('edit ?')){
                window.location.href = url;
            }
        }

        function deletePenjualan(url){
           if(confirm('delete?')){
            $.ajax({
                url,
                type : 'DELETE',
                header: {
                    'X_CSRF_TOKEN' : "{{ csrf_token() }}",
                }
            })
            .done(res => {
                if(res.ok){
                    alert(res.message)
                    reloadTable();
                }
            })
           }
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

        function deletePenjualan(e,url){
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


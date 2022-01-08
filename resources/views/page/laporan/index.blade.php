@extends('layouts.backend.main')

@section('title')
    Laporan
@endsection

@section('content')
    <div class="row">
          <div class="col">
                <div class="card">
                     <div class="card-body">
                        <div class="row mb-5     align-items-center">
                              <div class="col">
                                    <h4>Periode {{ format_tanggal_indo($awal) }} - {{ format_tanggal_indo($akhir) }} </h4>
                              </div>
                              <div class="col text-right">
                                    <button type="button" class="btn btn-rounded-0 btn-warning" onclick="showModalTable()">
                                          <i class="fa fa-save  mr-2"></i> Ubah Periobde
                                    </button>
                              </div>
                        </div>
                        <div class="row">
                              <div class="col">
                                    <table id="table-laporan" class="table table-sm table-stripped">
                                          <thead>
                                                <tr>
                                                      <th class="text-center" style="width: 10px">#</th>
                                                      <th class="text-center" >Tanggal</th>
                                                      <th class="text-center" >Penjualan</th>
                                                      <th class="text-center" >Pembelian</th>
                                                      <th class="text-center" >Pengeluaran</th>
                                                      <th class="text-center" >Pendapatan</th>
                                                </tr>
                                          </thead>
                                    </table>
                              </div>
                        </div>
                     </div>
                </div>
          </div>
    </div>
    @include('page.laporan.form')
@endsection

@push('js')
    <script>

          let table_laporan;

          $(document).ready(function(){
                table_laporan = $('#table-laporan').DataTable({
                      bInfo : false,
                      bPaginate: false,
                      ajax : "{{ route('data.laporan',[$awal,$akhir]) }}",
                      columns : [
                            { data : 'DT_RowIndex', orderable: false, searchable: false },
                            { data : 'tanggal', class : 'text-center'},
                            { data : 'penjualan', class : 'text-center',  orderable: false, searchable: false},
                            { data : 'pembelian', class : 'text-center',  orderable: false, searchable: false},
                            { data : 'pengeluaran', class : 'text-center',  orderable: false, searchable: false},
                            { data : 'pendapatan', class : 'text-center',  orderable: false, searchable: false},
                      ]
                })
          })

          function showModalTable(){
                $('.modal-title').text('Periode')
                $('.modal').modal();
                $('#btn-submit').text('Change')
          }
    </script>
@endpush

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="container-fluid">
                  <div class="row">
                        <div class="col">
                              <table id="table-produk" class="table table-sm table-stripped w-100">
                                    <thead>
                                          <tr>
                                                <td class="text-center" style="width: 10px">#</td>
                                                <td class="text-center">Produk</td>
                                                <td class="text-center">Harga</td>
                                                <td class="text-center">Diskon</td>
                                                <td class="text-center">Stok</td>
                                                <td class="text-center">Action</td>
                                          </tr>
                                    </thead>
                              </table>
                        </div>
                  </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    @push('js')

      <script>
            $(document).ready(function(){
                  

                  let table_produk;

                  table_produk = $('table#table-produk').DataTable({
                        ajax : {
                              url : 'http://127.0.0.1:8000/data/produk',
                              type : 'get'
                        },
                        bPaginate: false,
                        columns : [
                              {class: 'text-center', data: 'DT_RowIndex', orderable: false, searchable: false},
                              {class: 'text-center', data: 'nama_produk'},
                              {class: 'text-center', data: 'harga_jual', searchable: false},
                              {class: 'text-center', data: 'diskon', searchable: false},
                              {class: 'text-center', data: 'stok', searchable: false},
                              {class: 'text-center', data: 'pilih_penjuan_produk', searchable: false},
                        ]
                  })
            })

            function submitDetailPenjualan(e,url,produk_id){
                  $.ajax({
                        type: 'POST',
                        url,
                        headers : {
                              'X_CSRF_TOKEN' : "{{ csrf_token() }}",
                        },
                        data : {
                              produk_id : produk_id,
                              penjualan_id : "{{ $penjualan_id }}"
                        }
                  })
                  .done((res) => {
                        if(res.ok){
                              $('.modal').modal('hide');
                              tabel_penjualan_detail.ajax.reload()
                        }
                  })
                  .fail((e) => console.log(e))
            }

      </script>

    @endpush
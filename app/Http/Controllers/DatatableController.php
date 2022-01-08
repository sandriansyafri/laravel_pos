<?php

namespace App\Http\Controllers;

use App\Models\DetailPembelian;
use App\Models\DetailPenjualan;
use App\Models\Kategori;
use App\Models\Member;
use App\Models\Pembelian;
use App\Models\Pengeluaran;
use App\Models\Penjualan;
use App\Models\Produk;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

use function PHPUnit\Framework\returnSelf;

class DatatableController extends Controller
{
    public function kategori()
    {
        $kategori = Kategori::all();
        return DataTables::of($kategori)
            ->addIndexColumn()
            ->addColumn('checklist', function ($kategori) {
                return '  <div class="form-check">
                <input class="form-check-input" type="checkbox" name="checklist[]" value="' . $kategori->id . '">
              </div>';
            })
            ->addColumn('action', function ($kategori) {
                return '
                    <a href="" onclick="editKategori(event,`' . route('kategori.update', $kategori->id) . '`)" class="badge badge-success p-2 mx-2">
                        <i class="fa fa-pen mr-2"></i> Edit
                    </a>
                    <a href="" onclick="deleteKategori(event,`' . route('kategori.destroy', $kategori->id) . '`)" class="badge badge-danger p-2">
                        <i class="fa fa-trash mr-2"></i> Delete
                    </a>
                ';
            })
            ->rawColumns(['action', 'checklist'])
            ->make();
    }
    public function user()
    {
        $user = User::all();
        return DataTables::of($user)
            ->addIndexColumn()
            ->addColumn('checklist', function ($user) {
                return '  <div class="form-check">
                <input class="form-check-input" type="checkbox" name="checklist[]" value="' . $user->id . '">
              </div>';
            })
            ->addColumn('action', function ($user) {
                return '
                    <button type="click" onclick="editUser(event,`' . route('user.edit', $user->id) . '`)" class="badge badge-success p-2 mx-2">
                        <i class="fa fa-pen mr-2"></i> Edit
                    </button>
                    <a href="" onclick="deleteUser(event,`' . route('user.destroy', $user->id) . '`)" class="badge badge-danger p-2">
                        <i class="fa fa-trash mr-2"></i> Delete
                    </a>
                ';
            })
            ->rawColumns(['action', 'checklist'])
            ->make();
    }
    public function produk()
    {
        $produk = Produk::with(['kategori'])->get();
        return DataTables::of($produk)
            ->addIndexColumn()
            ->addColumn('pilih_penjuan_produk', function ($produk) {
                return '<button class="btn btn-primary rounded-0" type="button" onclick="submitDetailPenjualan(event,`' . route('penjualan.detail.store') . '`, ' . $produk->id . ')">Add</button>';
            })
            ->addColumn('pilih', function ($produk) {
                return '<button class="btn btn-primary rounded-0" type="button" onclick="submitDetailPembelian(event,`' . route('pembelian-detail.store') . '`, ' . $produk->id . ')">Add</button>';
            })
            ->addColumn('action', function ($produk) {
                return '
                    <a href="" onclick="editProduk(event,`' . route('produk.update', $produk->id) . '`)" class="badge badge-success p-2 mx-2">
                        <i class="fa fa-pen mr-2"></i> Edit
                    </a>
                    <a href="" onclick="deleteProduk(event,`' . route('produk.destroy', $produk->id) . '`)" class="badge badge-danger p-2">
                        <i class="fa fa-trash mr-2"></i> Delete
                    </a>
                ';
            })
            ->editColumn('harga_beli', function ($produk) {
                return format_idr($produk->harga_beli);
            })
            ->editColumn('harga_jual', function ($produk) {
                return format_idr($produk->harga_jual);
            })
            ->rawColumns(['action', 'pilih', 'pilih_penjuan_produk'])
            ->make();
    }

    public function member()
    {
        $member = Member::all();
        return DataTables::of($member)
            ->addIndexColumn()
            ->addColumn('checklist', function ($member) {
                return '  <div class="form-check">
                <input class="form-check-input" type="checkbox" name="checklist[]" value="' . $member->id . '">
              </div>';
            })
            ->addColumn('action', function ($member) {
                return '
                    <a href="" onclick="editMember(event,`' . route('member.update', $member->id) . '`)" class="badge badge-success p-2 mx-2">
                        <i class="fa fa-pen mr-2"></i> Edit
                    </a>
                    <a href="" onclick="deleteMember(event,`' . route('member.destroy', $member->id) . '`)" class="badge badge-danger p-2">
                        <i class="fa fa-trash mr-2"></i> Delete
                    </a>
                ';
            })
            ->rawColumns(['action', 'checklist'])
            ->make();
    }
    public function supplier()
    {
        $supplier = Supplier::all();
        return DataTables::of($supplier)
            ->addIndexColumn()
            ->addColumn('checklist', function ($supplier) {
                return '  <div class="form-check">
                <input class="form-check-input" type="checkbox" name="checklist[]" value="' . $supplier->id . '">
              </div>';
            })
            ->addColumn('pilih', function ($supplier) {
                return '<a href="' . route('pembelian.create', $supplier->id) . '" class="btn btn-sm btn-primary">
                <i class="fa fa-check mr-1"></i> Pilih
            </a>';
            })
            ->addColumn('action', function ($supplier) {
                return '
                    <a href="" onclick="editSupplier(event,`' . route('supplier.update', $supplier->id) . '`)" class="badge badge-success p-2 mx-2">
                        <i class="fa fa-pen mr-2"></i> Edit
                    </a>
                    <a href="" onclick="deleteSupplier(event,`' . route('supplier.destroy', $supplier->id) . '`)" class="badge badge-danger p-2">
                        <i class="fa fa-trash mr-2"></i> Delete
                    </a>
                ';
            })
            ->rawColumns(['action', 'checklist', 'pilih'])
            ->make();
    }

    public function pengeluaran()
    {
        $pengeluaran = Pengeluaran::all();
        return DataTables::of($pengeluaran)
            ->addIndexColumn()
            ->addColumn('checklist', function ($pengeluaran) {
                return '  <div class="form-check">
                <input class="form-check-input" type="checkbox" name="checklist[]" value="' . $pengeluaran->id . '">
              </div>';
            })
            ->addColumn('action', function ($pengeluaran) {
                return '
                    <a href="" onclick="editPengeluaran(event,`' . route('pengeluaran.update', $pengeluaran->id) . '`)" class="badge badge-success p-2 mx-2">
                        <i class="fa fa-pen mr-2"></i> Edit
                    </a>
                    <a href="" onclick="deletePengeluaran(event,`' . route('pengeluaran.destroy', $pengeluaran->id) . '`)" class="badge badge-danger p-2">
                        <i class="fa fa-trash mr-2"></i> Delete
                    </a>
                ';
            })
            ->editColumn('nominal', function ($pengeluaran) {
                return format_idr($pengeluaran->nominal);
            })
            ->rawColumns(['action', 'checklist'])
            ->make();
    }

    public function pembelian()
    {
        $pembelian = Pembelian::with(['supplier'])->get();
        return DataTables::of($pembelian)
            ->addIndexColumn()
            ->addColumn('checklist', function ($pembelian) {
                return '  <div class="form-check">
                <input class="form-check-input" type="checkbox" name="checklist[]" value="' . $pembelian->id . '">
              </div>';
            })
            ->addColumn('tanggal', function ($pembelian) {
                return $pembelian->updated_at->format('d F Y');
            })
            ->addColumn('action', function ($pembelian) {
                return '
                    <a href="" onclick="editPembelian(event,`' . route('pembelian.detail', ['supplier_id' => $pembelian->supplier_id, 'pembelian_id' => $pembelian->id]) . '`)" class="badge badge-success p-2 mx-2">
                        <i class="fa fa-pen mr-2"></i> Edit
                    </a>
                    <a href="" onclick="deletePembelian(event,`' . route('pembelian.destroy', $pembelian->id) . '`)" class="badge badge-danger p-2">
                        <i class="fa fa-trash mr-2"></i> Delete
                    </a>
                ';
            })

            ->editColumn('diskon', function ($pembelian) {
                return $pembelian->diskon . '%';
            })
            ->editColumn('total_harga', function ($pembelian) {
                return format_idr($pembelian->total_harga);
            })
            ->editColumn('bayar', function ($pembelian) {
                return format_idr($pembelian->bayar);
            })
            ->editColumn('nominal', function ($pembelian) {
                return format_idr($pembelian->nominal);
            })
            ->rawColumns(['action', 'checklist'])
            ->make();
    }

    public function penjualan()
    {
        $penjualan = Penjualan::all();
        return DataTables::of($penjualan)
            ->addIndexColumn()
            ->addColumn('checklist', function ($penjualan) {
                return '  <div class="form-check">
                <input class="form-check-input" type="checkbox" name="checklist[]" value="' . $penjualan->id . '">
              </div>';
            })
            ->addColumn('tanggal', function ($penjualan) {
                return $penjualan->updated_at->format('d F Y');
            })
            ->addColumn('kembalian', function ($penjualan) {
                return format_idr($penjualan->diterima - $penjualan->bayar);
            })
            ->addColumn('action', function ($penjualan) {
                return '
                    <button 
                        type="button"
                        onclick="editPenjualan(`' . route('penjualan.detail', $penjualan->id) . '`)"
                        class="badge badge-success p-2 mx-2">
                        <i class="fa fa-pen mr-2"></i> Edit
                    </button>
                    <a href="" onclick="deletePenjualan(event,`' . route('penjualan.destroy', $penjualan->id) . '`)" class="badge badge-danger p-2">
                        <i class="fa fa-trash mr-2"></i> Delete
                    </a>
                ';
            })

            ->editColumn('diskon', function ($penjualan) {
                return $penjualan->diskon . '%';
            })
            ->editColumn('total_harga', function ($penjualan) {
                return format_idr($penjualan->total_harga);
            })
            ->editColumn('bayar', function ($penjualan) {
                return format_idr($penjualan->bayar);
            })
            ->editColumn('nominal', function ($penjualan) {
                return format_idr($penjualan->nominal);
            })
            ->rawColumns(['action', 'checklist'])
            ->make();
    }

    public function detail_pembelian($pembelian_id)
    {
        $detail_pembelian = DetailPembelian::with(['produk'])->where('pembelian_id', $pembelian_id)->get();

        $data = [];
        $total_harga = 0;
        $total_item = 0;

        foreach ($detail_pembelian as $index => $detail) :
            $rows = [];

            $rows['nama_produk'] = $detail->produk->nama_produk;
            $rows['jumlah'] = $detail->jumlah;
            $rows['harga_beli'] = format_idr($detail->harga_beli);
            $rows['harga_jual'] = format_idr($detail->harga_jual);
            $rows['subtotal'] = format_idr($detail->subtotal);
            $rows['delete'] = '<button type="button" onclick="deleteDetailPembelian(`' . route('pembelian-detail.destroy', $detail->id) . '`)" class="btn btn-xs btn-danger">
                                            <i class="fa fa-trash"></i> Delete
                                        </button>';
            $rows['jumlah'] = '<input name="qty_' . $detail->id . '"
                                            type="number" 
                                            onchange="updateDetailPembelian(`' . route('pembelian-detail.update', $detail->id) . '`, ' . $detail->id . ')"
                                            class="qty form-control form-control-sm text-center border border-warning bg-transparent" 
                                            value="' . $detail->jumlah . '" />';

            $data[] = $rows;
            $total_harga += $detail->subtotal;
            $total_item += $detail->jumlah;
        endforeach;

        $data[] = [
            'nama_produk' => '<div id="total_harga" class="d-none">' . $total_harga . '</div>',
            'jumlah' => '<div id="total_item" class="d-none">' . $total_item . '</div>',
            'harga_beli' => '',
            'harga_jual' => '',
            'subtotal' => '',
            'delete' => '',
        ];


        return DataTables::of($data)
            ->addIndexColumn()
            ->rawColumns(['delete', 'jumlah', 'nama_produk'])
            ->make(true);
    }


    public function detail_penjualan($penjualan_id)
    {
        $detail_penjualan = DetailPenjualan::where('penjualan_id', $penjualan_id)->get();

        $data = [];
        $total_harga = 0;
        $total_item = 0;


        foreach ($detail_penjualan as $item) :

            $item['action'] =   '<button 
                                            class="btn btn-sm btn-danger"
                                            onclick="deleteItem(`' . route('penjualan.detail.item.destroy', $item->id) . '`)">
                                                <i class="fa fa-trash"></i>
                                        </button>';

            $item['qty'] = '
                                    <div class="text-center">
                                            <input  
                                                value="' . $item->jumlah . '"
                                                type="number" 
                                                name="item_' . $item->id . '"
                                                onchange="updateItem(event, `' . route('penjulan.detail.item.update', $item->id) . '`, ' . $item->id . ')"
                                                class="form-control form-control-sm rounded-0 text-sm text-center" 
                                                >
                                    </div>';
            $total_harga += $item->subtotal;
            $total_item += $item->jumlah;
            $data[] = $item;
        endforeach;



        $data[] = [
            'DT_RowIndex' => '',
            'produk.nama_produk' => '<div  class="d-none total-harga">' . $total_harga . '</div>',
            'qty' => '<div class="d-none total-item">' . $total_item . '</div>',
            'harga_jual' => '',
            'subtotal' => '',
            'action' => '',
        ];



        return DataTables::of($data)
            ->addIndexColumn()
            ->rawColumns(['qty', 'action', 'produk.nama_produk'])
            ->make(true);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class DatatableController extends Controller
{
    public function kategori()
    {
        $kategori = Kategori::all();
        return DataTables::of($kategori)
            ->addIndexColumn()
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
            ->rawColumns(['action'])
            ->make();
    }
}

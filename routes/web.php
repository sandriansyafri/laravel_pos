<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DatatableController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\PembelianController;
use App\Http\Controllers\PembelianDetailController;
use App\Http\Controllers\PengeluaranController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\PenjualanDetailController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['auth'])->group(function () {
      Route::get('/', [DashboardController::class, 'index'])->name('dashboard')->middleware(['can:admin']);
      Route::get('/home', [DashboardController::class, 'dashboardKasir'])->name('dashboard.kasir');
      Route::post('logout', LogoutController::class)->name('logout');

      Route::middleware(['can:admin'])->group(function () {
            Route::delete('kategori/deleteAll', [KategoriController::class, 'deleteAll'])->name('kategori.deleteAll');
            Route::resource('kategori', KategoriController::class);

            Route::delete('member/deleteAll', [MemberController::class, 'deleteAll'])->name('member.deleteAll');
            Route::resource('member', MemberController::class);

            Route::delete('supplier/deleteAll', [SupplierController::class, 'deleteAll'])->name('supplier.deleteAll');
            Route::resource('supplier', SupplierController::class);

            Route::resource('produk', ProdukController::class);

            Route::delete('pengeluaran/deleteAll', [PengeluaranController::class, 'deleteAll'])->name('pengeluaran.deleteAll');
            Route::resource('pengeluaran', PengeluaranController::class);

            Route::get('pembelian/{id}/create', [PembelianController::class, 'create'])->name('pembelian.create');
            Route::get('pembelian/detail/{supplier_id}/{pembelian_id}', [PembelianController::class, 'detail'])->name('pembelian.detail');
            Route::get('pembelian/load-form-data/{diskon}/{total_harga}', [PembelianDetailController::class, 'loadFormData'])->name('pembelian-detail.load-form-data');

            Route::post('pembelian/detail', [PembelianDetailController::class, 'store'])->name('pembelian-detail.store');
            Route::put('pembelian/{pembelian:id}', [PembelianController::class, 'store'])->name('pembelian.update');
            Route::put('pembelian/update/{pembelian_id}', [PembelianDetailController::class, 'update'])->name('pembelian-detail.update');
            Route::delete('pembelian/deleteAll', [PembelianController::class, 'deleteAll'])->name('pembelian.deleteAll');
            Route::delete('pembelian/{pembelian_id}/delete', [PembelianDetailController::class, 'destroy'])->name('pembelian-detail.destroy');
            Route::resource('pembelian', PembelianController::class)->except('create');

            Route::get('laporan', [LaporanController::class, 'index'])->name('laporan.index');
            Route::get('data/laporan/{awal}/{akhir}', [LaporanController::class, 'data'])->name('data.laporan');

            Route::delete('user/deleteAll', [UserController::class, 'deleteAll'])->name('user.deleteAll');
            Route::get('user', [UserController::class, 'index'])->name('user.index');
            Route::post('user', [UserController::class, 'store']);
            Route::get('user/{user:id}', [UserController::class, 'show'])->name('user.show');
            Route::get('user/{user:id}', [UserController::class, 'edit'])->name('user.edit');
            Route::put('user/{user:id}', [UserController::class, 'update'])->name('user.update');
            Route::delete('user/{user:id}', [UserController::class, 'destroy'])->name('user.destroy');
      });



      Route::get('penjualan/detail/{penjualan_id}', [PenjualanDetailController::class, 'index'])->name('penjualan.detail');
      Route::get('penjualan/load-form-data/{total_harga}/{diskon}/{bayar}', [PenjualanDetailController::class, 'loadFormData'])->name('penjualan.loadFormData');
      Route::post('penjualan/detail', [PenjualanDetailController::class, 'store'])->name('penjualan.detail.store');
      Route::put('penjualan/{penjualan:id}', [PenjualanController::class, 'store'])->name('penjualan.update');
      Route::put('penjualan/update/{penjualan_id}', [PenjualanDetailController::class, 'update'])->name('penjulan.detail.item.update');
      Route::delete('penjualan/deleteAll', [PenjualanController::class, 'deleteAll'])->name('penjualan.deleteAll');
      Route::delete('penjualan/detail/{penjualan_id}/delete', [PenjualanDetailController::class, 'destroy'])->name('penjualan.detail.item.destroy');
      Route::resource('penjualan', PenjualanController::class);


      Route::prefix('data')->group(function () {
            Route::get('kategori', [DatatableController::class, 'kategori'])->name('data.kategori');
            Route::get('user', [DatatableController::class, 'user'])->name('data.user');
            Route::get('produk', [DatatableController::class, 'produk'])->name('data.produk');
            Route::get('member', [DatatableController::class, 'member'])->name('data.member');
            Route::get('supplier', [DatatableController::class, 'supplier'])->name('data.supplier');
            Route::get('pengeluaran', [DatatableController::class, 'pengeluaran'])->name('data.pengeluaran');
            Route::get('pembelian', [DatatableController::class, 'pembelian'])->name('data.pembelian');
            Route::get('detail-pembelian/{pembelian_id}', [DatatableController::class, 'detail_pembelian'])->name('data.detail-pembelian');
            Route::get('penjualan', [DatatableController::class, 'penjualan'])->name('data.penjualan');
            Route::get('detail-penjualan/{penjualan_id}', [DatatableController::class, 'detail_penjualan'])->name('data.penjualan.detail');
      });
});

Route::middleware(['guest'])->group(function () {
      Route::get('register', [RegisterController::class, 'index'])->name('register');
      Route::post('register', RegisterController::class);
      Route::get('login', [LoginController::class, 'index'])->name('login');
      Route::post('login', LoginController::class)->name('login');
});

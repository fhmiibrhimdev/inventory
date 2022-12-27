<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Dashboard\Dashboard;
use App\Http\Livewire\Inventory\BarangMasuk;
use App\Http\Livewire\Inventory\BarangKeluar;
use App\Http\Livewire\Inventory\BarangOpname;
use App\Http\Livewire\Inventory\SaldoAwalItem;
use App\Http\Livewire\KartuStock\KartuStock;
use App\Http\Livewire\Laporan\BarangKeluar as LaporanBarangKeluar;
use App\Http\Livewire\Laporan\BarangMasuk as LaporanBarangMasuk;
use App\Http\Livewire\Laporan\SaldoAwalItem as LaporanSaldoAwalItem;
use App\Http\Livewire\Master\DataBarang;
use App\Http\Livewire\Master\Jenis;
use App\Http\Livewire\Master\Kategori;
use App\Http\Livewire\Master\Merek;
use App\Http\Livewire\Master\Rak;
use App\Http\Livewire\Master\Satuan;
use App\Http\Livewire\SettingUser\SettingUser;

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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => ['auth']], function () {
    Route::get('dashboard', Dashboard::class)->name('dashboard');
    Route::get('laporan-pdf/saldo-awal/tes', LaporanSaldoAwalItem::class)->name('laporan-pdf.saldo-awal.tes');

    Route::get('laporan-excel/saldo-awal/{id_barang}/{dari_tanggal}/{sampai_tanggal}', [LaporanSaldoAwalItem::class, 'exportExcel'])->name('laporan-excel.saldo-awal');
    Route::get('laporan-pdf/saldo-awal/{id_barang}/{dari_tanggal}/{sampai_tanggal}', [LaporanSaldoAwalItem::class, 'exportPDF'])->name('laporan-pdf.saldo-awal');

    Route::get('laporan-excel/barang-masuk/{id_barang}/{dari_tanggal}/{sampai_tanggal}', [LaporanBarangMasuk::class, 'exportExcel'])->name('laporan-excel.barang-masuk');
    Route::get('laporan-pdf/barang-masuk/{id_barang}/{dari_tanggal}/{sampai_tanggal}', [LaporanBarangMasuk::class, 'exportPDF'])->name('laporan-pdf.barang-masuk');

    Route::get('laporan-excel/barang-keluar/{id_barang}/{dari_tanggal}/{sampai_tanggal}', [LaporanBarangKeluar::class, 'exportExcel'])->name('laporan-excel.barang-keluar');
    Route::get('laporan-pdf/barang-keluar/{id_barang}/{dari_tanggal}/{sampai_tanggal}', [LaporanBarangKeluar::class, 'exportPDF'])->name('laporan-pdf.barang-keluar');
});

Route::group(['middleware' => ['auth', 'role:admin']], function () {
    Route::get('admin/master-kategori', Kategori::class)->name('admin.master-kategori');
    Route::get('admin/master-jenis', Jenis::class)->name('admin.master-jenis');
    Route::get('admin/master-merek', Merek::class)->name('admin.master-merek');
    Route::get('admin/master-satuan', Satuan::class)->name('admin.master-satuan');
    Route::get('admin/master-rak', Rak::class)->name('admin.master-rak');
    Route::get('admin/master-barang', DataBarang::class)->name('admin.master-barang');

    Route::get('admin/saldo-awal-item', SaldoAwalItem::class)->name('admin.saldo-awal-item');
    Route::get('admin/barang-masuk', BarangMasuk::class)->name('admin.barang-masuk');
    Route::get('admin/barang-keluar', BarangKeluar::class)->name('admin.barang-keluar');
    Route::get('admin/barang-opname', BarangOpname::class)->name('admin.barang-opname');

    Route::get('admin/kartu-stock', KartuStock::class)->name('admin.kartu-stock');
    Route::get('setting-user/', SettingUser::class)->name('setting-user.index');
});

Route::group(['middleware' => ['auth', 'role:user']], function () {
    Route::get('hahaha/', Dashboard::class)->name('');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';

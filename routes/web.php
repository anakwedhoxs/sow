<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use App\Models\Dokumentasi;

Route::get('/', function () {
    return view('welcome');
});

// Route untuk mendownload file dokumentasi (memberikan header attachment)
Route::get('/dokumentasi/{dokumentasi}/download', function (Dokumentasi $dokumentasi) {
    if (! $dokumentasi->foto) {
        abort(404);
    }

    return Storage::disk('public')->download($dokumentasi->foto, $dokumentasi->nama_barang . '.' . pathinfo($dokumentasi->foto, PATHINFO_EXTENSION));
})->name('dokumentasi.download');

use App\Models\DokumentasiArsipItem;

Route::get('/dokumentasi-arsip-item/{item}/download', function (DokumentasiArsipItem $item) {
    if (! $item->foto) {
        abort(404);
    }

    return Storage::disk('public')->download($item->foto, $item->nama_barang . '.' . pathinfo($item->foto, PATHINFO_EXTENSION));
})->name('dokumentasi-arsip-item.download');

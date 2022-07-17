<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    if (!Auth::check()) {
        return view('auth.login');
    }
    return redirect(url('/dashboard'));
});

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::prefix('dashboard')->group(function () {
        Route::get('/', 'dashboardController@index')->name('dashboard');
        // Data Pasangan
        Route::get('/data/pasangan', 'backend\dataPasanganController@index')->name('data-pasangan');
        Route::get('/data/create-pasangan', 'backend\dataPasanganController@create')->name('data-pasangan-create');
        Route::post('data/store-pasangan', 'backend\dataPasanganController@store')->name('data-pasangan-store');
        Route::delete('data/delete-pasangan/{id}', 'backend\dataPasanganController@delete')->name('data-pasangan-delete');
        Route::get('/data/pasangan-edit/{id}', 'backend\dataPasanganController@edit')->name('data-pasangan-edit');
        Route::post('/data/pasangan-edit/{id}', 'backend\dataPasanganController@update')->name('data-pasangan-update');
        // Data Jadwal Pasangan
        Route::get('/data/jadwal-pasangan', 'Backend\dataJadwalPernikahanController@index')->name('data-jadwal-pasangan');
        Route::get('/data/create-jadwal-pernikahan', 'Backend\dataJadwalPernikahanController@create')->name('data-create-jadwal-pasangan');
        Route::post('/data/store-jadwal-pernikahan', 'Backend\dataJadwalPernikahanController@store')->name('data-store-jadwal-pernikahan');
        Route::post('/data/approve-jadwal-pernikahan/{id}', 'Backend\dataJadwalPernikahanController@approved')->name('data-approved-jadwal-pernikahan');
        Route::delete('/data/delete-jadwal-pernikahan/{id}', 'Backend\dataJadwalPernikahanController@delete')->name('data-delete-jadwal-pernikahan');
        // Data Pernikahan
        Route::get('data/pernikahan', 'Backend\dataPernikahanController@index')->name('data-pernikahan');
        // Data Arsip Pernikahan
        Route::get('data/arsip-pernikahan', 'Backend\dataArsipPernikahanController@index')->name('data-arsip-pernikahan');
        // Register Pegawai
        Route::get('register-pegawai', 'Backend\registerPegawaiController@index')->name('register-pegawai');
        Route::delete('register-pegawai-delete/{id}', 'Backend\registerPegawaiController@delete')->name('register-pegawai-delete');
        Route::post('register-pegawai-store', 'Backend\registerPegawaiController@store')->name('register-pegawai-store');
        // Laporan Pernikahan
        Route::get('/data-laporan-pernikahan', 'Backend\laporanDataPernikahanController@index')->name('laporan-pernikahan');
        Route::get('/data-laporan-pernikahan/approved', 'Backend\laporanDataPernikahanController@approved')->name('status-pernikahan-approved');
        Route::get('/data-laporan-pernikahan/rejected', 'Backend\laporanDataPernikahanController@rejected')->name('status-pernikahan-rejected');
        // Kelola Arsip Baru
        Route::get('/data-kelola-arsip-baru', 'Backend\kelolaArsipDataBaruController@index')->name('KelolaArsipDataBaru');
        Route::get('/data-kelola-arsip-baru/{id}', 'Backend\kelolaArsipDataBaruController@arsip')->name('KelolaArsipDataBaruCreate');
        Route::post('/data-kelola-arsip-store', 'Backend\kelolaArsipDataBaruController@createKelolaArsip')->name('KelolaArsipDataBaruStore');
    });
});

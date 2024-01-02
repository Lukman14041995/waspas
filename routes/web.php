<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlternatifController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\DecisionMatrixController;
use App\Http\Controllers\NormalisasiController;
use App\Http\Controllers\ResultController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::resource('/data-kriteria', KriteriaController::class);
Route::resource('/data-alternatif', AlternatifController::class);
Route::resource('/decision-matrix', DecisionMatrixController::class);
Route::get('/normalisasi', [NormalisasiController::class, 'index'])->name('normalisasi.index');
Route::get('/score', [ResultController::class, 'index'])->name('score.index');
Route::delete('/hapus/{id}', [KriteriaController::class, 'hapus'])->name('child-hapus');
Route::post('/opsi', [KriteriaController::class, 'opsi'])->name('opsi');
Route::post('/updateopsi', [KriteriaController::class, 'updateopsi'])->name('updateopsi');
Route::post('/deleteopsi', [KriteriaController::class, 'deleteopsi'])->name('deleteopsi');
Route::post('/Inputopsi', [KriteriaController::class, 'Inputopsi'])->name('Inputopsi');
Route::get('/data-kelompok', [AlternatifController::class, 'getdata'])->name('getdata');

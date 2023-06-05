<?php

use App\Http\Controllers\DatasetController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [DatasetController::class,'index'])->name('datasets.index');

Route::prefix('datasets')->controller(DatasetController::class)->group(function () {
    Route::post('/import', 'import')->name('datasets.import');
    Route::get('/export', 'export')->name('datasets.export');
    Route::get('/import', 'showImportView');
});

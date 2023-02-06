<?php

use App\Models\User;
use App\Models\Export;
use App\Jobs\StoreExportDataJob;
use Illuminate\Support\Facades\Route;

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


Route::get('/teste-job', function () {

    StoreExportDataJob::dispatch();

    return 'Oi';
});

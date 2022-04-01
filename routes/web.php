<?php

use App\Http\Controllers\CsvController;
use App\Http\Controllers\HomeController;
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
    return redirect('/login');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/servers', [HomeController::class, 'servers'])->name('servers');
Route::get('/import', [CsvController::class, 'import'])->name('import');
Route::post('/import/servers', [CsvController::class, 'importServers'])->name('import.servers');
Route::post('/import/packages_installed', [CsvController::class, 'importPackagesInstalled'])->name('import.packages_installed');
Route::post('/import/timeline', [CsvController::class, 'importTimeline'])->name('import.timeline');

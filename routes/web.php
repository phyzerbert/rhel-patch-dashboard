<?php

use App\Http\Controllers\CsvController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SiteController;
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
Route::any('/servers', [HomeController::class, 'servers'])->name('servers');
Route::post('/servers/change_site', [HomeController::class, 'changeServerSite'])->name('servers.change_site');

Route::get('/import', [CsvController::class, 'import'])->name('import');
Route::post('/import/servers', [CsvController::class, 'importServers'])->name('import.servers');
Route::post('/import/packages_installed', [CsvController::class, 'importPackagesInstalled'])->name('import.packages_installed');
Route::post('/import/timeline', [CsvController::class, 'importTimeline'])->name('import.timeline');

Route::get('/sites', [SiteController::class, 'index'])->name('sites');
Route::post('/sites/save', [SiteController::class, 'save'])->name('sites.save');
Route::post('/sites/update', [SiteController::class, 'update'])->name('sites.update');
Route::get('/sites/delete/{id}', [SiteController::class, 'delete'])->name('sites.delete');

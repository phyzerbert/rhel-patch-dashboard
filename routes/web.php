<?php

use App\Http\Controllers\CsvController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PatchController;
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
Route::post('/import/sites', [CsvController::class, 'importSites'])->name('import.sites');

Route::get('/sites', [SiteController::class, 'index'])->name('sites');

Route::group(['prefix' => 'events'], function($router) {
    $router->get('/', [EventController::class, 'index'])->name('events');
    $router->get('/create', [EventController::class, 'create'])->name('events.create');
    $router->post('/store', [EventController::class, 'store'])->name('events.store');
    $router->get('/edit/{id}', [EventController::class, 'edit'])->name('events.edit');
    $router->post('/update', [EventController::class, 'update'])->name('events.update');
    $router->get('/delete/{id}', [EventController::class, 'delete'])->name('events.delete');
});

Route::group(['prefix' => 'patches'], function($router) {
    $router->get('/', [PatchController::class, 'index'])->name('patches');
    $router->get('/create', [PatchController::class, 'create'])->name('patches.create');
    $router->post('/store', [PatchController::class, 'store'])->name('patches.store');
    $router->get('/edit/{id}', [PatchController::class, 'edit'])->name('patches.edit');
    $router->post('/update', [PatchController::class, 'update'])->name('patches.update');
    $router->get('/delete/{id}', [PatchController::class, 'delete'])->name('patches.delete');
});

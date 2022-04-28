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
Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');
Route::any('/servers', [HomeController::class, 'servers'])->name('servers');
Route::post('/servers/change_site', [HomeController::class, 'changeServerSite'])->name('servers.change_site');
Route::get('/capsule_servers', [HomeController::class, 'capsuleServers'])->name('capsule_servers');
Route::get('/site_code_subnets', [HomeController::class, 'siteCodeSubnets'])->name('site_code_subnets');
Route::get('/cve', [HomeController::class, 'cveList'])->name('cve');
Route::get('/cve/patch_installed_dates', [HomeController::class, 'cvePatchInstalledDates'])->name('cve.patch_installed_dates');
Route::get('/cve/rpm', [HomeController::class, 'cveRPM'])->name('cve.rpm');

Route::get('/import', [CsvController::class, 'import'])->name('import');
Route::post('/import/servers', [CsvController::class, 'importServers'])->name('import.servers');
Route::post('/import/packages_installed', [CsvController::class, 'importPackagesInstalled'])->name('import.packages_installed');
Route::post('/import/timeline', [CsvController::class, 'importTimeline'])->name('import.timeline');
Route::post('/import/sites', [CsvController::class, 'importSites'])->name('import.sites');
Route::post('/import/capsule_servers', [CsvController::class, 'importCapsuleServers'])->name('import.capsule_servers');
Route::post('/import/site_code_subnets', [CsvController::class, 'importSiteCodeSubnets'])->name('import.site_code_subnets');
Route::post('/import/cve_data', [CsvController::class, 'importCveData'])->name('import.cve_data');

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
    $router->get('/date_view', [PatchController::class, 'dateView'])->name('patches.date_view');
    $router->get('/create', [PatchController::class, 'create'])->name('patches.create');
    $router->post('/store', [PatchController::class, 'store'])->name('patches.store');
    $router->get('/edit/{id}', [PatchController::class, 'edit'])->name('patches.edit');
    $router->post('/update', [PatchController::class, 'update'])->name('patches.update');
    $router->get('/delete/{id}', [PatchController::class, 'delete'])->name('patches.delete');
});

Route::get('/get_sites', [HomeController::class, 'getSites']);
Route::post('/get_server_patches_calendar_data', [HomeController::class, 'getServerPatchesCalendarData']);
Route::post('/get_group_patch_status', [HomeController::class, 'getGroupPatchStatus']);

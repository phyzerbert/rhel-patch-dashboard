<?php

namespace App\Http\Controllers;

use App\Imports\CapsuleServerImport;
use App\Imports\PackagesInstalledImport;
use App\Imports\ServerImport;
use App\Imports\SiteCodeSubnetImport;
use App\Imports\SiteImport;
use App\Imports\TimelineImport;
use App\Models\Cve;
use App\Models\PatchInstallDate;
use App\Models\Rpm;
use App\Models\Server;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Excel;
use Illuminate\Support\Facades\Storage;
use Zip;

class CsvController extends Controller
{
    public function import() {
        return view('import');
    }

    public function importServers(Request $request) {
        $request->validate([
            'file' => 'file',
        ]);
        Excel::import(new ServerImport(), request()->file('file'));
        return back()->with('success', 'Uploaded successfully');
    }

    public function importTimeline(Request $request) {
        $request->validate([
            'file' => 'file',
        ]);
        Excel::import(new TimelineImport(), request()->file('file'));
        return back()->with('success', 'Uploaded successfully');
    }

    public function importPackagesInstalled(Request $request) {
        $request->validate([
            'file' => 'file',
        ]);
        Excel::import(new PackagesInstalledImport(), request()->file('file'));
        return back()->with('success', 'Uploaded successfully');
    }

    public function importSites(Request $request) {
        $request->validate([
            'file' => 'file',
        ]);
        Excel::import(new SiteImport(), request()->file('file'));
        return back()->with('success', 'Uploaded successfully');
    }

    public function importCapsuleServers(Request $request) {
        $request->validate([
            'file' => 'file',
        ]);
        Excel::import(new CapsuleServerImport(), request()->file('file'));
        return back()->with('success', 'Uploaded successfully');
    }

    public function importSiteCodeSubnets(Request $request) {
        $request->validate([
            'file' => 'file',
        ]);
        Excel::import(new SiteCodeSubnetImport(), request()->file('file'));
        return back()->with('success', 'Uploaded successfully');
    }

    public function importCveData(Request $request) {
        ini_set('max_execution_time', 0);
        $files = Storage::disk('public')->allFiles('cve');
        Storage::disk('public')->delete($files);
        $zip = Zip::open($request->file('file'));
        $zip->extract(storage_path('app/public/cve'));
        $files = Storage::disk('public')->allFiles('cve');
        foreach ($files as $file) {
            $filename = basename($file);
            $filename_array = explode('.', $filename);

            $server_name = $filename_array[0];
            $server = Server::where('name', $server_name)->first();

            $file_date = $filename_array[2];
            $file_date = explode('-', $file_date)[0];
            $file_date = Carbon::createFromFormat('dMY', $file_date)->format('Y-m-d');

            $file_type = $filename_array[3];

            $file_content = file(storage_path('app/public/'.$file), FILE_IGNORE_NEW_LINES);

            switch ($file_type) {
                case 'rpm':
                    foreach ($file_content as $value) {
                        Rpm::create([
                            'server_id' => $server ? $server->id : null,
                            'server_name' => $server_name,
                            'file_date' => $file_date,
                            'value' => $value,
                        ]);
                    }

                    break;

                case 'patchinstalldates':
                    foreach ($file_content as $value) {
                        PatchInstallDate::create([
                            'server_id' => $server ? $server->id : null,
                            'server_name' => $server_name,
                            'file_date' => $file_date,
                            'patch_installed_date' => Carbon::createFromFormat('d M Y', $value)->format('Y-m-d'),
                        ]);
                    }

                    break;

                case 'cve':
                    foreach ($file_content as $value) {
                        Cve::create([
                            'server_id' => $server ? $server->id : null,
                            'server_name' => $server_name,
                            'file_date' => $file_date,
                            'value' => $value,
                        ]);
                    }

                    break;

                default:
                    # code...
                    break;
            }
        }

        return back()->with('success', 'Uploaded successfully');
    }
}

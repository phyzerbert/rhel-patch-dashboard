<?php

namespace App\Http\Controllers;

use App\Imports\PackagesInstalledImport;
use App\Imports\ServerImport;
use App\Imports\TimelineImport;
use Illuminate\Http\Request;
use Excel;

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
}

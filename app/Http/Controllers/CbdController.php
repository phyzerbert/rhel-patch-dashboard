<?php

namespace App\Http\Controllers;

use App\Imports\CbdApplicationContactInfoImport;
use App\Imports\CbdCbpImport;
use App\Imports\CbdImportantNoteImport;
use App\Imports\CbdQdImport;
use Illuminate\Http\Request;

use Excel;

class CbdController extends Controller
{
    public function index() {
        return view('cbd');
    }

    public function import(Request $request) {
        if ($request->file('cbd_application_contact_info')) {
            Excel::import(new CbdApplicationContactInfoImport(), request()->file('cbd_application_contact_info'));
        }
        if ($request->file('cbd_cbp')) {
            Excel::import(new CbdCbpImport(), request()->file('cbd_cbp'));
        }
        if ($request->file('cbd_important_note')) {
            Excel::import(new CbdImportantNoteImport(), request()->file('cbd_important_note'));
        }
        if ($request->file('cbd_qd')) {
            Excel::import(new CbdQdImport(), request()->file('cbd_qd'));
        }

        return back()->with('success', 'Uploaded successfully');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Site;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request) {
        $data = Site::all();
        return view('sites', compact('data'));
    }

    public function save(Request $request) {
        $model = Site::create(['name' => $request->get('name')]);
        return back()->with('success', 'Created successfully');
    }

    public function update(Request $request) {
        $model = Site::find($request->get('id'));
        $model->update(['name' => $request->get('name')]);
        return back()->with('success', 'Updated successfully');
    }

    public function delete($id) {
        Site::destroy($id);
        return back()->with('success', 'Deleted successfully');
    }
}

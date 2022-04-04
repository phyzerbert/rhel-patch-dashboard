<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Patch;
use App\Models\Server;
use App\Models\Site;

class PatchController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // public function index(Request $request) {
    //     $sites = Site::all();
    //     $servers = Server::all();
    //     $site_id = $server_id = '';
    //     $mod = new Patch();
    //     if ($request->get('site_id') != '') {
    //         $site_id = $request->get('site_id');
    //         $mod = $mod->where('site_id', $site_id);
    //     }
    //     if ($request->get('server_id') != '') {
    //         $site_id = $request->get('server_id');
    //         $mod = $mod->where('server_id', $server_id);
    //     }
    //     $data = $mod->orderBy('created_at', 'desc')->paginate(10);
    //     return view('patches.index', compact('data', 'sites', 'servers', 'site_id', 'server_id'));
    // }

    public function index() {
        $patches = [];
        $initialDate = date('Y-m-d');
        foreach (Patch::all() as $item) {
            $patches[] = [
                'title' => $item->title,
                'start' => $item->date,
                'end' => $item->date,
            ];
        }
        return view('patches.calendar', compact('patches', 'initialDate'));
    }

    public function create() {
        $sites = Site::all();
        $servers = Server::all();
        return view('patches.create', compact('sites', 'servers'));
    }

    public function store(Request $request) {
        $request->validate([
            'title' => 'required',
            'date' => 'required',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i',
        ]);
        Patch::create([
            'site_id' => $request->get('site_id'),
            'server_id' => $request->get('server_id'),
            'title' => $request->get('title'),
            'detail' => $request->get('detail'),
            'date' => $request->get('date'),
            'start_time' => $request->get('start_time'),
            'end_time' => $request->get('end_time'),
            'authorization' => $request->get('authorization'),
            'status' => $request->get('status'),
        ]);
        return back()->with('success', 'Created successfully');
    }

    public function edit($id) {
        $model = Patch::find($id);
        $sites = Site::all();
        $servers = Server::all();
        return view('patches.edit', compact('model', 'sites', 'servers'));
    }

    public function update(Request $request) {
        $request->validate([
            'title' => 'required',
        ]);
        $model = Patch::find($request->get('id'));
        $model->update([
            'site_id' => $request->get('site_id'),
            'server_id' => $request->get('server_id'),
            'title' => $request->get('title'),
            'detail' => $request->get('detail'),
            'date' => $request->get('date'),
            'start_time' => $request->get('start_time'),
            'end_time' => $request->get('end_time'),
            'authorization' => $request->get('authorization'),
            'status' => $request->get('status'),
        ]);
        return back()->with('success', 'Updated successfully');
    }

    public function delete($id) {
        Patch::destroy($id);
        return back()->with('success', 'Deleted successfully');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Server;
use App\Models\Site;
use App\Models\Timeline;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // OS
        $os_array = Server::whereNotNull('os')->distinct()->orderBy('os')->pluck('os')->toArray();
        $inventory_count = $inventory_servers = $application_count = [];
        foreach ($os_array as $item) {
            $inventory_count[] = Server::where('os', $item)->count();
            $inventory_servers[] = Server::where('os', $item)->pluck('name')->toArray();
        }

        $server_array = Application::distinct('server_name')->pluck('server_name')->toArray();
        foreach ($server_array as $item) {
            $application_count[] = Application::where('server_name', $item)->first()->packages_installed;
        }

        $timelines = Timeline::all();
        $servers = Server::all();

        return view('home', compact('servers', 'inventory_servers', 'os_array', 'inventory_count', 'server_array', 'application_count', 'timelines'));
    }

    public function servers(Request $request) {
        $site_id = $request->get('site_id');
        $os = $request->get('os');
        $mod = new Server();
        if ($os != '') {
            $mod = $mod->where('os', $os);
        }
        if ($site_id != '') {
            $mod = $mod->where('site_id', $site_id);
        }
        $data = $mod->paginate(10);
        $sites = Site::all();
        return view('servers', compact('data', 'sites', 'os', 'site_id'));
    }

    public function changeServerSite(Request $request) {
        $server = Server::find($request->get('server_id'));
        $server->update(['site_id' => $request->get('site_id')]);
        return response()->json($server);
    }
}

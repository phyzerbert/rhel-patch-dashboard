<?php

namespace App\Http\Controllers;

use App\Models\App;
use App\Models\Application;
use App\Models\CapsuleServer;
use App\Models\Cve;
use App\Models\Patch;
use App\Models\PatchInstallDate;
use App\Models\Rpm;
use App\Models\Server;
use App\Models\Site;
use App\Models\SiteCodeSubnet;
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

    public function dashboard() {
        return view('dashboard');
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

    public function capsuleServers(Request $request) {
        $data = CapsuleServer::all();
        return view('capsule_servers', compact('data'));
    }

    public function siteCodeSubnets(Request $request) {
        $data = SiteCodeSubnet::all();
        return view('site_code_subnets', compact('data'));
    }

    public function cveList(Request $request) {
        $data = Cve::all();
        return view('cve', compact('data'));
    }

    public function cvePatchInstalledDates(Request $request) {
        $data = PatchInstallDate::all();
        return view('patch_installed_dates', compact('data'));
    }

    public function cveRpm(Request $request) {
        $data = Rpm::all();
        return view('rpm', compact('data'));
    }

    public function getSites(Request $request) {
        $sites = Site::all();
        $apps = App::all();
        $servers = Server::all();
        return response()->json(compact('sites', 'apps', 'servers'));
    }

    public function getServerPatchesCalendarData(Request $request) {
        $server_id = $request->get('server_id');
        $patches = [];
        foreach (Patch::where('server_id', $server_id)->get() as $item) {
            $className = 'bg-primary';
            $backgroundColor = '#2643e9';
            if ($item->status == 'Successful' || $item->status == 'Successful with Issues') {
                $className = 'bg-success';
                $backgroundColor = '#1aae6f';
            } else if ($item->status == 'Failed') {
                $className = 'bg-danger';
                $backgroundColor = '#f80031';
            }

            $patches[] = [
                'title' => $item->title,
                'start' => $item->date,
                'end' => $item->date,
                'className' => $className,
                'backgroundColor' => $backgroundColor,
            ];
        }
        return response()->json($patches);
    }

    public function getGroupPatchStatus(Request $request) {
        $site_id = $request->get('site_id');
        $servers = Patch::where('site_id', $site_id)->distinct()->pluck('server_id');
        $data = [];
        foreach ($servers as $server_id) {
            $server = Server::find($server_id);
            if (!$server) continue;
            $data[] = [
                'server_name' => $server->name,
                'installable' => Patch::where('server_id', $server_id)->whereNotIn('status', ['Successful', 'Successful with Issues', 'Failed'])->count(),
                'installed' => Patch::where('server_id', $server_id)->whereIn('status', ['Successful', 'Successful with Issues'])->count(),
                'failed' => Patch::where('server_id', $server_id)->whereIn('status', ['Failed'])->count(),
            ];
        }

        return response()->json($data);
    }
}

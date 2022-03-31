<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Server;
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
        $inventory_count = $application_count = [];
        foreach ($os_array as $item) {
            $inventory_count[] = Server::where('os', $item)->count();
        }

        $server_array = Application::distinct('server_name')->orderBy('server_name')->pluck('server_name')->toArray();
        foreach ($server_array as $item) {
            $application_count[] = Application::where('server_name', $item)->first()->packages_installed;
        }

        $timelines = Timeline::all();

        return view('home', compact('os_array', 'inventory_count', 'server_array', 'application_count', 'timelines'));
    }
}
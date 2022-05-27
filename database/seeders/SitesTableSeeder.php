<?php

namespace Database\Seeders;

use App\Models\App;
use App\Models\Server;
use App\Models\Site;
use Illuminate\Database\Seeder;

class SitesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $apps = ['Splunk', 'CCard', 'ESP', 'Konami', 'Mobile App', 'Openshift', 'Streaming', 'Tower', 'VendorPay', 'Capsule'];

        foreach ($apps as $item) {
            App::create(['name' => $item]);
        }
        // $server_index = 1;
        // for ($i = 1; $i <= 30; $i++) {
        //     $site = Site::create(['name' => "Site$i"]);
        //     $j = 1;
        //     foreach (App::all() as $app) {
        //         for ($k=1; $k <= 5; $k++) {
        //             $server = Server::create([
        //                 'name' => "Server".$server_index,
        //                 'app_id' => $app->id,
        //                 'site_id' => $site->id,
        //             ]);
        //             $server_index++;
        //         }
        //         $j++;
        //     }
        // }
    }
}

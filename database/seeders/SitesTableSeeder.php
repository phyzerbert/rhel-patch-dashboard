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
    }
}

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
        for ($i = 1; $i <= 30; $i++) {
            $site = Site::create(['name' => "Site$i"]);
            for ($j = 1; $j <= 10; $j++) {
                $app_index = ($i - 1) * 10 + $j;
                $app = App::create(['name' => "App$app_index", 'site_id' => $site->id]);
                for ($k=1; $k <= 5; $k++) {
                    $server_index = ($i - 1) * 10 + ($j - 1) * 5 + $k;
                    $server = Server::create([
                        'name' => "Server$server_index",
                        'app_id' => $app->id,
                    ]);
                }
            }
        }
    }
}

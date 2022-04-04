<?php

namespace App\Imports;

use App\Models\Server;
use App\Models\Site;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Row;

class SiteImport implements OnEachRow
{
    /**
    * @param Row $row
    */
    public function onRow(Row $row)
    {
        $server_name = $row[0];
        $server = Server::where('name', $server_name)->first();
        if ($server) {
            $site = Site::where('name', $row[1])->first();
            if (!$site)  $site = Site::create(['name' => $row[1]]);
            $server->update(['site_id' => $site->id]);
        }

    }
}

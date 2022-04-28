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
        $site = Site::firstOrCreate(['name' => $row[0]]);
        $site->save();
    }
}

<?php

namespace App\Imports;

use App\Models\Server;
use App\Models\Site;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Row;

class ServerImport implements OnEachRow
{
    /**
    * @param Row $row
    */
    public function onRow(Row $row)
    {
        $site_name = $row[0];
        $site = Site::firstOrCreate(['name' => $site_name]);
        $site->save();

        $name = $row[1];
        $model = Server::firstOrCreate(['name' => $name]);

        $model->subscription_status = $row[2];
        $model->installable_updates_security = $row[3];
        $model->installable_updates_bug_fixes = $row[4];
        $model->installable_updates_enhancements = $row[5];
        $model->installable_updates_package_count = $row[6];
        $model->os = $row[7];
        $model->environment = $row[8];
        $model->content_view = $row[9];
        $model->value1 = $row[10];
        $model->value2 = $row[11];
        $model->value3 = $row[12];
        $model->value4 = $row[13];
        $model->registered = Carbon::parse($row[14]);
        $model->last_checkin = Carbon::parse($row[15]);
        $model->site_id = $site->id ?? null;

        $model->save();
    }
}

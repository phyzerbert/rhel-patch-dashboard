<?php

namespace App\Imports;

use App\Models\Server;
use App\Models\Site;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Row;

class ServerImport implements OnEachRow, WithStartRow
{
    /**
    * @param Row $row
    */
    public function onRow(Row $row)
    {
        $name = $row[0];
        $model = Server::where('name', $name)->first();
        if (!$model) $model = Server::create(['name' => $name]);

        $model->subscription_status = $row[1];
        $model->installable_updates_security = $row[2];
        $model->installable_updates_bug_fixes = $row[3];
        $model->installable_updates_enhancements = $row[4];
        $model->installable_updates_package_count = $row[5];
        $model->os = $row[6];
        $model->environment = $row[7];
        $model->content_view = $row[8];
        $model->registered = Carbon::createFromFormat('Y-m-d H:i:s e', $row[9]);
        $model->last_checkin = Carbon::createFromFormat('Y-m-d H:i:s e', $row[10]);

        $model->save();
    }

    public function startRow(): int
    {
        return 2;
    }
}

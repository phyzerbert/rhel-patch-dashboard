<?php

namespace App\Imports;

use App\Models\Server;
use App\Models\Timeline;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Row;

class TimelineImport implements OnEachRow, WithStartRow
{
    /**
    * @param Row $row
    */
    public function onRow(Row $row)
    {
        $server_name = $row[0];
        $server = Server::where('name', $server_name)->first();
        $model = Timeline::where('server_name', $server_name)->first();
        if (!$model) $model = Timeline::create(['server_name' => $server_name]);
        $model->server_id = $server ? $server->id : null;
        $model->patch_timeline = Carbon::createFromFormat('d-M-y', $row[1])->format('Y-m-d');
        $model->save();
    }

    public function startRow(): int
    {
        return 2;
    }
}

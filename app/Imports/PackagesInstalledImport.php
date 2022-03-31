<?php

namespace App\Imports;

use App\Models\Server;
use App\Models\Application;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Row;

class PackagesInstalledImport implements OnEachRow, WithStartRow
{
    /**
    * @param Row $row
    */
    public function onRow(Row $row)
    {
        $server_name = $row[0];
        $server = Server::where('name', $server_name)->first();
        $model = Application::where('server_name', $server_name)->first();
        if (!$model) $model = Application::create(['server_name' => $server_name]);
        $model->server_id = $server ? $server->id : null;
        $model->packages_installed = $row[1];
        $model->save();
    }

    public function startRow(): int
    {
        return 2;
    }
}

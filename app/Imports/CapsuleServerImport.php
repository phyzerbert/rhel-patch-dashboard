<?php

namespace App\Imports;

use App\Models\CapsuleServer;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Row;

class CapsuleServerImport implements OnEachRow, WithStartRow
{
    /**
    * @param Row $row
    */
    public function onRow(Row $row)
    {
        $data = [
            'capsule' => $row[0],
            'fully_qualified_domain_name' => $row[1],
            'operating_system' => $row[2],
            'optional_status' => $row[3],
            'os_version' => $row[4],
            'kernel_release' => $row[5],
            'ip_address' => $row[6],
            'hosted_application' => $row[7],
            'support_group' => $row[8],
            'environment' => $row[9],
            'patching_schedule' => $row[10],
            'location' => $row[11],
        ];
        $model = CapsuleServer::findOrCreate($data);
        $model->save();

    }

    public function startRow(): int
    {
        return 2;
    }
}

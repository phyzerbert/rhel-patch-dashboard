<?php

namespace App\Imports;

use App\Models\SiteCodeSubnet;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Row;

class SiteCodeSubnetImport implements OnEachRow, WithStartRow
{
    /**
    * @param Row $row
    */
    public function onRow(Row $row)
    {
        $data = [
            'number' => $row[0],
            'site' => $row[1],
            'site_code' => $row[2],
            'business_unit_site_id' => $row[3],
            'domain' => $row[4],
            'new_code' => $row[5],
            'sub_net' => $row[6],
            'vlan_tag' => $row[7],
        ];
        $model = SiteCodeSubnet::findOrCreate($data);
        $model->save();

    }

    public function startRow(): int
    {
        return 2;
    }
}

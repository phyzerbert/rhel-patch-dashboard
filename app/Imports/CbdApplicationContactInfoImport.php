<?php

namespace App\Imports;

use App\Models\CbdApplicationContactInfo;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Row;

class CbdApplicationContactInfoImport implements OnEachRow, WithStartRow
{
    /**
    * @param Row $row
    */
    public function onRow(Row $row)
    {
        $internal_name = $row[0];
        $model = CbdApplicationContactInfo::firstOrCreate(['internal_name' => $internal_name]);

        $model->hostname = $row[1];
        $model->company = $row[1];
        $model->customer_mail_ids = $row[1];
        $model->account_dl = $row[1];

        $model->save();

    }

    public function startRow(): int
    {
        return 3;
    }
}

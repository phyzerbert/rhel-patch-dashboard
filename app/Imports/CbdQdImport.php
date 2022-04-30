<?php

namespace App\Imports;

use App\Models\CbdQd;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Row;

class CbdQdImport implements OnEachRow, WithStartRow
{
    /**
    * @param Row $row
    */
    public function onRow(Row $row)
    {
        CbdQd::create([
            'queue_name' => $row[0],
            'mail_dls' => $row[1],
        ]);
    }

    public function startRow(): int
    {
        return 4;
    }
}

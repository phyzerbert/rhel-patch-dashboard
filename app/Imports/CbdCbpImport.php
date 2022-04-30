<?php

namespace App\Imports;

use App\Models\CbdCbp;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Row;

class CbdCbpImport implements OnEachRow, WithStartRow
{
    /**
    * @param Row $row
    */
    public function onRow(Row $row)
    {
        CbdCbp::create([
            'ticket_description' => $row[0],
            'mail_ids' => $row[1],
        ]);
    }

    public function startRow(): int
    {
        return 2;
    }
}

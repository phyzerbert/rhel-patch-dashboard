<?php

namespace App\Imports;

use App\Models\CbdImportantNote;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Row;

class CbdImportantNoteImport implements OnEachRow, WithStartRow
{
    /**
    * @param Row $row
    */
    public function onRow(Row $row)
    {
        CbdImportantNote::create([
            'department' => $row[0],
            'phone_number' => $row[1],
            'on_call_engineer' => $row[2],
        ]);
    }

    public function startRow(): int
    {
        return 2;
    }
}

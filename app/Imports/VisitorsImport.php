<?php

namespace App\Imports;

use App\Models\Visitor;
use Maatwebsite\Excel\Concerns\ToModel;

class VisitorsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Visitor([
            'id'     => $row['0'],
            'full_name'     => $row['1'],
            'email'     => $row['2'],
            'phone_number'     => $row['3'],
            'book_id'     => $row['4'],
            'type'     => $row['5'],
            'bag_style'     => $row['6'],
            'bag_content'     => $row['7'],
            'status'     => $row['8'],
            'created_at'     => $row['9'],
            'updated_at'     => $row['10'],
        ]);
    }
}

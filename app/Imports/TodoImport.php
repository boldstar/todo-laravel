<?php

namespace App\Imports;

use App\Todo;
use Maatwebsite\Excel\Concerns\ToModel;

class TodoImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Todo([
            'user_id'  => $row[0],
            'todo'     => $row[1],
        ]);
    }
}

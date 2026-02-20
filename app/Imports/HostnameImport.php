<?php

namespace App\Imports;

use App\Models\Hostname;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class HostnameImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Hostname([
            'nama' => $row['nama'], // header excel harus: nama
        ]);
    }
}
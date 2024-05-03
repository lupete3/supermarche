<?php

namespace App\Imports;

use App\Models\Article;
use Maatwebsite\Excel\Concerns\ToModel;

class ArticlessImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Article([
            'designation' => $row[0],
            'prix_achat' => $row[1],
            'prix' => $row[2],
            'solde' => $row[3],
            'category_id' => $row[4],
        ]);
    }
}

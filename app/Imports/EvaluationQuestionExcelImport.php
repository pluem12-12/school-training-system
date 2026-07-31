<?php

namespace App\Imports;

use App\Models\EvaluationQuestion;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class EvaluationQuestionExcelImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // Skip empty rows
        if (empty($row['question_text'])) {
            return null;
        }

        return new EvaluationQuestion([
            'question_text' => $row['question_text'],
            'is_active' => isset($row['is_active']) ? (bool) $row['is_active'] : true,
            'sort_order' => isset($row['sort_order']) ? (int) $row['sort_order'] : 0,
        ]);
    }
}

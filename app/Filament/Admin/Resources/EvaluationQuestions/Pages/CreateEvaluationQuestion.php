<?php

namespace App\Filament\Admin\Resources\EvaluationQuestions\Pages;

use App\Filament\Admin\Resources\EvaluationQuestions\EvaluationQuestionResource;
use Filament\Resources\Pages\CreateRecord;

class CreateEvaluationQuestion extends CreateRecord
{
    protected static string $resource = EvaluationQuestionResource::class;
}

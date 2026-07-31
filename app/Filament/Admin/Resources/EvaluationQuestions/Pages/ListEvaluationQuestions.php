<?php

namespace App\Filament\Admin\Resources\EvaluationQuestions\Pages;

use App\Filament\Admin\Resources\EvaluationQuestions\EvaluationQuestionResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListEvaluationQuestions extends ListRecords
{
    protected static string $resource = EvaluationQuestionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}

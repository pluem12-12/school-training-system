<?php

namespace App\Filament\Admin\Resources\EvaluationQuestions\Pages;

use App\Filament\Admin\Resources\EvaluationQuestions\EvaluationQuestionResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditEvaluationQuestion extends EditRecord
{
    protected static string $resource = EvaluationQuestionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}

<?php

namespace App\Filament\Admin\Resources\EvaluationQuestions\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class EvaluationQuestionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('question_text')
                    ->label('หัวข้อประเมิน')
                    ->required(),
                Toggle::make('is_active')
                    ->label('เปิดใช้งาน')
                    ->default(true)
                    ->required(),
                TextInput::make('sort_order')
                    ->label('ลำดับการแสดงผล')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }
}

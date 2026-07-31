<?php

namespace App\Filament\Admin\Resources\EvaluationQuestions;

use App\Filament\Admin\Resources\EvaluationQuestions\Pages\CreateEvaluationQuestion;
use App\Filament\Admin\Resources\EvaluationQuestions\Pages\EditEvaluationQuestion;
use App\Filament\Admin\Resources\EvaluationQuestions\Pages\ListEvaluationQuestions;
use App\Filament\Admin\Resources\EvaluationQuestions\Schemas\EvaluationQuestionForm;
use App\Filament\Admin\Resources\EvaluationQuestions\Tables\EvaluationQuestionsTable;
use App\Models\EvaluationQuestion;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class EvaluationQuestionResource extends Resource
{
    protected static ?string $model = EvaluationQuestion::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedClipboardDocumentCheck;

    protected static ?string $modelLabel = 'หัวข้อประเมิน';
    
    protected static ?string $pluralModelLabel = 'จัดการหัวข้อประเมิน';

    protected static ?string $recordTitleAttribute = 'question_text';

    public static function form(Schema $schema): Schema
    {
        return EvaluationQuestionForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return EvaluationQuestionsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListEvaluationQuestions::route('/'),
            'create' => CreateEvaluationQuestion::route('/create'),
            'edit' => EditEvaluationQuestion::route('/{record}/edit'),
        ];
    }
}

<?php

namespace App\Filament\Admin\Resources\EvaluationQuestions\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class EvaluationQuestionsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('question_text')
                    ->label('หัวข้อประเมิน')
                    ->searchable(),
                IconColumn::make('is_active')
                    ->label('ใช้งาน')
                    ->boolean(),
                TextColumn::make('sort_order')
                    ->label('ลำดับ')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->headerActions([
                \Filament\Actions\ImportAction::make()
                    ->importer(\App\Filament\Imports\EvaluationQuestionImporter::class)
                    ->label('นำเข้าหัวข้อ (Import)')
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}

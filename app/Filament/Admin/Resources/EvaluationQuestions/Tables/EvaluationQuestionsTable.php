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
                \Filament\Tables\Actions\Action::make('import_excel')
                    ->label('นำเข้าหัวข้อ (Excel/CSV)')
                    ->icon('heroicon-o-arrow-up-tray')
                    ->form([
                        \Filament\Forms\Components\FileUpload::make('file')
                            ->label('อัปโหลดไฟล์ (.xlsx, .xls, .csv)')
                            ->required()
                            ->acceptedFileTypes([
                                'application/vnd.ms-excel',
                                'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                                'text/csv'
                            ])
                            ->storeFiles(false),
                    ])
                    ->action(function (array $data) {
                        try {
                            \Maatwebsite\Excel\Facades\Excel::import(new \App\Imports\EvaluationQuestionExcelImport, $data['file']);
                            \Filament\Notifications\Notification::make()
                                ->title('นำเข้าข้อมูลสำเร็จ')
                                ->success()
                                ->send();
                        } catch (\Exception $e) {
                            \Filament\Notifications\Notification::make()
                                ->title('เกิดข้อผิดพลาดในการนำเข้า')
                                ->body($e->getMessage())
                                ->danger()
                                ->send();
                        }
                    })
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}

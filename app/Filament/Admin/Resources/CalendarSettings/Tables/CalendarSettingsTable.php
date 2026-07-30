<?php

namespace App\Filament\Admin\Resources\CalendarSettings\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;

class CalendarSettingsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                \Filament\Tables\Columns\TextColumn::make('category')
                    ->label('หมวดหมู่')
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'university' => 'มหาวิทยาลัย',
                        'faculty' => 'คณะครุศาสตร์',
                        default => $state,
                    })
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'university' => 'info',
                        'faculty' => 'success',
                        default => 'gray',
                    }),
                \Filament\Tables\Columns\IconColumn::make('pdf_file')
                    ->label('ไฟล์ PDF')
                    ->boolean()
                    ->getStateUsing(fn ($record) => $record->pdf_file !== null),
                \Filament\Tables\Columns\ImageColumn::make('image_file')
                    ->label('อินโฟกราฟิก'),
                \Filament\Tables\Columns\TextColumn::make('updated_at')
                    ->label('อัพเดทล่าสุด')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                DeleteBulkAction::make(),
            ]);
    }
}

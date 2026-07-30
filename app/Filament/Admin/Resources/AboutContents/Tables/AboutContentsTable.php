<?php

namespace App\Filament\Admin\Resources\AboutContents\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;

class AboutContentsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                \Filament\Tables\Columns\TextColumn::make('title')
                    ->label('หัวข้อ')
                    ->searchable(),
                \Filament\Tables\Columns\ImageColumn::make('image_1')
                    ->label('รูปภาพ 1'),
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

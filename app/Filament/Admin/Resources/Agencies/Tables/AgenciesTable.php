<?php

namespace App\Filament\Admin\Resources\Agencies\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;

class AgenciesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                \Filament\Tables\Columns\TextColumn::make('name')
                    ->label('ชื่อหน่วยงาน')
                    ->searchable(),
                \Filament\Tables\Columns\TextColumn::make('url')
                    ->label('ลิงก์')
                    ->limit(30),
                \Filament\Tables\Columns\TextColumn::make('icon_class')
                    ->label('ไอคอน'),
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

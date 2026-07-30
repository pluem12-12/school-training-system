<?php

namespace App\Filament\Admin\Resources\Documents\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class DocumentsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')->label('ชื่อเอกสาร')->searchable(),
                TextColumn::make('category')->label('หมวดหมู่')->searchable(),
                \Filament\Tables\Columns\ToggleColumn::make('is_pinned')->label('ปักหมุด'),
                TextColumn::make('created_at')->label('อัปโหลดเมื่อ')->dateTime()->sortable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                Action::make('download')
                    ->label('ดาวน์โหลด')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->url(fn (\App\Models\Document $record) => asset('storage/' . $record->file_path))
                    ->openUrlInNewTab(),
                EditAction::make(),
            ])
            ->toolbarActions([
                DeleteBulkAction::make(),
            ]);
    }
}

<?php

namespace App\Filament\Admin\Resources\FooterLinks\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class FooterLinksTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->label('ชื่อลิงก์/ข้อความ')
                    ->searchable(),
                TextColumn::make('category')
                    ->label('หมวดหมู่')
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'quick_link' => 'ลิงก์ด่วน (Quick Links)',
                        'contact' => 'ข้อมูลติดต่อ (Contact Us)',
                        default => $state,
                    })
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'quick_link' => 'info',
                        'contact' => 'success',
                        default => 'gray',
                    }),
                TextColumn::make('sort_order')
                    ->label('ลำดับ')
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
            ->toolbarActions([
                DeleteBulkAction::make(),
            ]);
    }
}

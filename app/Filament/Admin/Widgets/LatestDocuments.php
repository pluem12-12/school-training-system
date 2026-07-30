<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Document;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestDocuments extends BaseWidget
{
    protected static ?int $sort = 4;
    protected int | string | array $columnSpan = 'full';
    
    protected static ?string $heading = 'เอกสารล่าสุด';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Document::query()->latest()->limit(5)
            )
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('ชื่อเอกสาร')
                    ->limit(50),
                Tables\Columns\TextColumn::make('category')
                    ->label('หมวดหมู่'),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('อัปโหลดเมื่อ')
                    ->dateTime()
                    ->sortable(),
            ])
            ->paginated(false);
    }
}

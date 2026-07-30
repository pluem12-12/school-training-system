<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Announcement;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestAnnouncements extends BaseWidget
{
    protected static ?int $sort = 3;
    protected int | string | array $columnSpan = 'full';
    
    protected static ?string $heading = 'ข่าวประชาสัมพันธ์ล่าสุด';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Announcement::query()->latest()->limit(5)
            )
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('หัวข้อข่าว')
                    ->limit(50),
                Tables\Columns\TextColumn::make('category')
                    ->label('หมวดหมู่')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => match($state) {
                        'urgent' => 'ด่วน',
                        'event' => 'กิจกรรม',
                        default => 'ทั่วไป',
                    }),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('วันที่ประกาศ')
                    ->dateTime()
                    ->sortable(),
            ])
            ->paginated(false);
    }
}

<?php

namespace App\Filament\Admin\Resources\Announcements;

use App\Filament\Admin\Resources\Announcements\Pages\{CreateAnnouncement, EditAnnouncement, ListAnnouncements};
use App\Models\Announcement;
use BackedEnum;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables;
use Filament\Tables\Table;

class AnnouncementResource extends Resource
{
    protected static ?string $model = Announcement::class;
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedMegaphone;
    protected static string|\UnitEnum|null $navigationGroup = 'จัดการข้อมูล';
    protected static ?string $navigationLabel = 'ข่าวประชาสัมพันธ์';
    protected static ?string $modelLabel = 'ข่าว';
    protected static ?string $pluralModelLabel = 'ข่าวประชาสัมพันธ์';

    public static function form(Schema $schema): Schema
    {
        return $schema->schema([
            Forms\Components\TextInput::make('title')->label('หัวข้อ')->required()->maxLength(255),
            Forms\Components\Select::make('category')->label('หมวดหมู่')
                ->options(['general' => 'ทั่วไป', 'urgent' => 'ด่วน', 'event' => 'กิจกรรม'])
                ->default('general')->required(),
            Forms\Components\Textarea::make('content')->label('เนื้อหา')->required()->columnSpanFull(),
            Forms\Components\FileUpload::make('image')->label('รูปภาพ')->image()->disk('public')->directory('announcements'),
            Forms\Components\Toggle::make('is_active')->label('แสดงผล')->default(true),
            Forms\Components\Toggle::make('is_pinned')->label('ปักหมุด')->default(false),
            Forms\Components\DateTimePicker::make('published_at')->label('วันที่เผยแพร่'),
            Forms\Components\Hidden::make('user_id')->default(fn () => \Illuminate\Support\Facades\Auth::id()),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')->label('หัวข้อ')->searchable()->limit(40),
                Tables\Columns\TextColumn::make('category')->label('หมวดหมู่')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => match($state) {
                        'urgent' => 'ด่วน', 'event' => 'กิจกรรม', default => 'ทั่วไป',
                    }),
                Tables\Columns\IconColumn::make('is_active')->label('แสดงผล')->boolean(),
                Tables\Columns\IconColumn::make('is_pinned')->label('ปักหมุด')->boolean(),
                Tables\Columns\TextColumn::make('created_at')->label('สร้างเมื่อ')->dateTime()->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->actions([\Filament\Actions\EditAction::make(), \Filament\Actions\DeleteAction::make()])
            ->bulkActions([\Filament\Actions\DeleteBulkAction::make()]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListAnnouncements::route('/'),
            'create' => CreateAnnouncement::route('/create'),
            'edit' => EditAnnouncement::route('/{record}/edit'),
        ];
    }
}

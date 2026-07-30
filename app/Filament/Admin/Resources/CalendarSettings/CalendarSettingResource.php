<?php

namespace App\Filament\Admin\Resources\CalendarSettings;

use App\Filament\Admin\Resources\CalendarSettings\Pages\CreateCalendarSetting;
use App\Filament\Admin\Resources\CalendarSettings\Pages\EditCalendarSetting;
use App\Filament\Admin\Resources\CalendarSettings\Pages\ListCalendarSettings;
use App\Filament\Admin\Resources\CalendarSettings\Schemas\CalendarSettingForm;
use App\Filament\Admin\Resources\CalendarSettings\Tables\CalendarSettingsTable;
use App\Models\CalendarSetting;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class CalendarSettingResource extends Resource
{
    protected static ?string $model = CalendarSetting::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return CalendarSettingForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CalendarSettingsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListCalendarSettings::route('/'),
            'create' => CreateCalendarSetting::route('/create'),
            'edit' => EditCalendarSetting::route('/{record}/edit'),
        ];
    }
}

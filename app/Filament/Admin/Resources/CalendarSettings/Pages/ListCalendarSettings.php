<?php

namespace App\Filament\Admin\Resources\CalendarSettings\Pages;

use App\Filament\Admin\Resources\CalendarSettings\CalendarSettingResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListCalendarSettings extends ListRecords
{
    protected static string $resource = CalendarSettingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}

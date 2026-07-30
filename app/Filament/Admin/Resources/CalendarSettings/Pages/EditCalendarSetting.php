<?php

namespace App\Filament\Admin\Resources\CalendarSettings\Pages;

use App\Filament\Admin\Resources\CalendarSettings\CalendarSettingResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditCalendarSetting extends EditRecord
{
    protected static string $resource = CalendarSettingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}

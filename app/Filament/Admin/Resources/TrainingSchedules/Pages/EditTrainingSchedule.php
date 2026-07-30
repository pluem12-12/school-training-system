<?php
namespace App\Filament\Admin\Resources\TrainingSchedules\Pages;
use App\Filament\Admin\Resources\TrainingSchedules\TrainingScheduleResource;
use Filament\Resources\Pages\EditRecord;
class EditTrainingSchedule extends EditRecord { 
    protected static string $resource = TrainingScheduleResource::class; 
    
    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\DeleteAction::make(),
        ];
    }
}

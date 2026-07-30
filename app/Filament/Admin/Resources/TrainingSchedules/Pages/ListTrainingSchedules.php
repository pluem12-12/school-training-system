<?php
namespace App\Filament\Admin\Resources\TrainingSchedules\Pages;
use App\Filament\Admin\Resources\TrainingSchedules\TrainingScheduleResource;
use Filament\Resources\Pages\ListRecords;
class ListTrainingSchedules extends ListRecords
{
    protected static string $resource = TrainingScheduleResource::class;
    protected function getHeaderActions(): array { return [\Filament\Actions\CreateAction::make()]; }
}

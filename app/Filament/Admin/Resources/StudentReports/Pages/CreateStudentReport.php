<?php

namespace App\Filament\Admin\Resources\StudentReports\Pages;

use App\Filament\Admin\Resources\StudentReports\StudentReportResource;
use Filament\Resources\Pages\CreateRecord;

class CreateStudentReport extends CreateRecord
{
    protected static string $resource = StudentReportResource::class;
}

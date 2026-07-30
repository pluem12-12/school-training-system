<?php

namespace App\Filament\Exports;

use App\Models\Evaluation;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;
use Illuminate\Support\Number;

class EvaluationExporter extends Exporter
{
    protected static ?string $model = Evaluation::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('id')
                ->label('ID'),
            ExportColumn::make('type')
                ->label('ประเภทการประเมิน')
                ->formatStateUsing(fn (string $state): string => $state === 'training' ? 'การฝึกระหว่างเรียน' : 'การฝึกปฏิบัติการสอน'),
            ExportColumn::make('student.student_id')
                ->label('รหัสนักศึกษา'),
            ExportColumn::make('student.name')
                ->label('ชื่อนักศึกษา'),
            ExportColumn::make('student.memberProfile.subject_taught')
                ->label('รายวิชา/สาขา'),
            ExportColumn::make('mentor.name')
                ->label('ชื่อผู้ประเมิน'),
            ExportColumn::make('score')
                ->label('คะแนนรวม'),
            ExportColumn::make('comment')
                ->label('ข้อเสนอแนะ'),
            ExportColumn::make('created_at')
                ->label('วันที่ประเมิน'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your evaluation export has completed and ' . Number::format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . Number::format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}

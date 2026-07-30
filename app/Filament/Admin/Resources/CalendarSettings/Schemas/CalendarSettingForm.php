<?php

namespace App\Filament\Admin\Resources\CalendarSettings\Schemas;

use Filament\Schemas\Schema;

class CalendarSettingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                \Filament\Forms\Components\Select::make('category')
                    ->label('หมวดหมู่ปฏิทิน')
                    ->options([
                        'university' => 'มหาวิทยาลัย',
                        'faculty' => 'คณะครุศาสตร์',
                    ])
                    ->required()
                    ->unique(ignoreRecord: true),
                \Filament\Forms\Components\FileUpload::make('pdf_file')
                    ->label('ไฟล์ตารางปฏิทิน (PDF)')
                    ->acceptedFileTypes(['application/pdf'])
                    ->disk('public')
                    ->directory('calendar-pdfs')
                    ->maxSize(10240),
                \Filament\Forms\Components\FileUpload::make('image_file')
                    ->label('รูปภาพอินโฟกราฟิกสรุปรวม (Infographic)')
                    ->image()
                    ->disk('public')
                    ->directory('calendar-images')
                    ->maxSize(20480),
            ])->columns(1);
    }
}

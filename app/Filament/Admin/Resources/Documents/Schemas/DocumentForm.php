<?php

namespace App\Filament\Admin\Resources\Documents\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Schema;

class DocumentForm
{
    public static function configure(Schema $form): Schema
    {
        return $form->schema([
            TextInput::make('title')
                ->required()
                ->label('ชื่อเอกสาร')
                ->maxLength(255),
            \Filament\Forms\Components\Select::make('category')
                ->options([
                    'general' => 'เอกสารทั่วไป',
                    'orders' => 'คำสั่งแต่งตั้ง',
                    'memos' => 'บันทึกข้อความ',
                    'leaves' => 'ใบลาสำหรับนักศึกษา',
                ])
                ->required()
                ->label('หมวดหมู่'),
            \Filament\Forms\Components\Toggle::make('is_pinned')
                ->label('ปักหมุดให้อยู่บนสุด')
                ->default(false),
            FileUpload::make('file_path')
                ->disk('public')
                ->directory('documents')
                ->required()
                ->label('อัปโหลดไฟล์'),
        ]);
    }
}

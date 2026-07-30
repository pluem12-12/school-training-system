<?php

namespace App\Filament\Admin\Resources\FooterLinks\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class FooterLinkForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                \Filament\Forms\Components\Select::make('category')
                    ->label('หมวดหมู่')
                    ->options([
                        'quick_link' => 'ลิงก์ด่วน (Quick Links)',
                        'contact' => 'ข้อมูลติดต่อ (Contact Us)',
                    ])
                    ->required()
                    ->default('quick_link'),
                \Filament\Forms\Components\TextInput::make('title')
                    ->label('ข้อความ / ชื่อลิงก์')
                    ->required(),
                \Filament\Forms\Components\TextInput::make('url')
                    ->label('URL (ถ้ามี)')
                    ->nullable(),
                \Filament\Forms\Components\TextInput::make('icon')
                    ->label('Icon Class (เช่น fas fa-phone)')
                    ->helperText('ใช้คลาสจาก FontAwesome')
                    ->nullable(),
                \Filament\Forms\Components\TextInput::make('sort_order')
                    ->label('ลำดับการแสดงผล')
                    ->numeric()
                    ->default(0)
                    ->required(),
            ]);
    }
}

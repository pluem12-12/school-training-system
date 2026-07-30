<?php

namespace App\Filament\Admin\Resources\Agencies\Schemas;

use Filament\Schemas\Schema;

class AgencyForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                \Filament\Schemas\Components\TextInput::make('name')
                    ->label('ชื่อหน่วยงาน')
                    ->required()
                    ->maxLength(255),
                \Filament\Schemas\Components\TextInput::make('url')
                    ->label('ลิงก์เว็บไซต์')
                    ->url()
                    ->maxLength(255),
                \Filament\Schemas\Components\TextInput::make('icon_class')
                    ->label('คลาสไอคอน (FontAwesome)')
                    ->default('fas fa-building')
                    ->maxLength(255)
                    ->helperText('ตัวอย่าง: fas fa-university, fas fa-graduation-cap'),
            ]);
    }
}

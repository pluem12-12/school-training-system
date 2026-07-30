<?php

namespace App\Filament\Admin\Resources\AboutContents\Schemas;

use Filament\Schemas\Schema;

class AboutContentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                \Filament\Schemas\Components\Section::make('เนื้อหาเกี่ยวกับศูนย์')
                    ->schema([
                        \Filament\Schemas\Components\TextInput::make('title')
                            ->label('หัวข้อ')
                            ->required()
                            ->maxLength(255),
                        \Filament\Schemas\Components\Textarea::make('description_1')
                            ->label('รายละเอียดส่วนที่ 1')
                            ->rows(4),
                        \Filament\Schemas\Components\Textarea::make('description_2')
                            ->label('รายละเอียดส่วนที่ 2')
                            ->rows(4),
                    ]),
                \Filament\Schemas\Components\Section::make('รูปภาพประกอบ')
                    ->schema([
                        \Filament\Schemas\Components\FileUpload::make('image_1')
                            ->label('รูปภาพ 1')
                            ->image()
                            ->directory('about-images'),
                        \Filament\Schemas\Components\FileUpload::make('image_2')
                            ->label('รูปภาพ 2')
                            ->image()
                            ->directory('about-images'),
                        \Filament\Schemas\Components\FileUpload::make('image_3')
                            ->label('รูปภาพ 3')
                            ->image()
                            ->directory('about-images'),
                        \Filament\Schemas\Components\FileUpload::make('image_4')
                            ->label('รูปภาพ 4')
                            ->image()
                            ->directory('about-images'),
                    ])->columns(2),
            ]);
    }
}

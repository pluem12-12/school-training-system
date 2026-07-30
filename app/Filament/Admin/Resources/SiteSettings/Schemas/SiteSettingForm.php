<?php

namespace App\Filament\Admin\Resources\SiteSettings\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class SiteSettingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                \Filament\Forms\Components\Textarea::make('footer_description')
                    ->label('รายละเอียดเกี่ยวกับศูนย์ฯ')
                    ->rows(3)
                    ->default(null)
                    ->columnSpanFull(),
                \Filament\Forms\Components\TextInput::make('footer_copyright')
                    ->label('ข้อความลิขสิทธิ์ (Copyright)')
                    ->default(null)
                    ->columnSpanFull(),
            ]);
    }
}

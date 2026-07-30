<?php

namespace App\Filament\Admin\Resources\AboutContents;

use App\Filament\Admin\Resources\AboutContents\Pages\CreateAboutContent;
use App\Filament\Admin\Resources\AboutContents\Pages\EditAboutContent;
use App\Filament\Admin\Resources\AboutContents\Pages\ListAboutContents;
use App\Filament\Admin\Resources\AboutContents\Schemas\AboutContentForm;
use App\Filament\Admin\Resources\AboutContents\Tables\AboutContentsTable;
use App\Models\AboutContent;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class AboutContentResource extends Resource
{
    protected static ?string $model = AboutContent::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return AboutContentForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return AboutContentsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListAboutContents::route('/'),
            'create' => CreateAboutContent::route('/create'),
            'edit' => EditAboutContent::route('/{record}/edit'),
        ];
    }
}

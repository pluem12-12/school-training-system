<?php

namespace App\Filament\Admin\Resources\StudentReports;

use App\Filament\Admin\Resources\StudentReports\Pages\CreateStudentReport;
use App\Filament\Admin\Resources\StudentReports\Pages\EditStudentReport;
use App\Filament\Admin\Resources\StudentReports\Pages\ListStudentReports;
use App\Models\StudentReport;
use BackedEnum;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Filament\Tables;

class StudentReportResource extends Resource
{
    protected static ?string $model = StudentReport::class;

    protected static string|\UnitEnum|null $navigationGroup = 'จัดการข้อมูล';
    protected static ?string $navigationLabel = 'รายงานนักศึกษา';
    protected static ?string $modelLabel = 'รายงาน';
    protected static ?string $pluralModelLabel = 'รายงานนักศึกษา';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedDocumentArrowUp;

    protected $fillable = ['student_id', 'title', 'file_path'];

    public static function form(Schema $schema): Schema
    {
        return $schema->schema([
            Forms\Components\Select::make('student_id')
                ->label('นักศึกษา')
                ->relationship('student', 'name')
                ->required(),
            Forms\Components\TextInput::make('title')
                ->label('ชื่อรายงาน')
                ->required()
                ->maxLength(255),
            Forms\Components\FileUpload::make('file_path')
                ->label('ไฟล์รายงาน')
                ->disk('public')
                ->directory('reports')
                ->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('student.name')->label('นักศึกษา'),
                Tables\Columns\TextColumn::make('title')->label('ชื่อรายงาน'),
                Tables\Columns\TextColumn::make('created_at')->dateTime()->label('วันที่ส่ง'),
            ])
            ->actions([
                \Filament\Actions\EditAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListStudentReports::route('/'),
            'create' => CreateStudentReport::route('/create'),
            'edit' => EditStudentReport::route('/{record}/edit'),
        ];
    }
}

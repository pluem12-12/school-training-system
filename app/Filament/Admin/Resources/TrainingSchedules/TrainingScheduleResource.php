<?php

namespace App\Filament\Admin\Resources\TrainingSchedules;

use App\Filament\Admin\Resources\TrainingSchedules\Pages\{CreateTrainingSchedule, EditTrainingSchedule, ListTrainingSchedules};
use App\Models\TrainingSchedule;
use BackedEnum;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables;
use Filament\Tables\Table;

class TrainingScheduleResource extends Resource
{
    protected static ?string $model = TrainingSchedule::class;
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCalendarDays;
    protected static string|\UnitEnum|null $navigationGroup = 'จัดการข้อมูล';
    protected static ?string $navigationLabel = 'ตารางฝึกสอน';
    protected static ?string $modelLabel = 'ตารางฝึกสอน';
    protected static ?string $pluralModelLabel = 'ตารางฝึกสอน';

    public static function form(Schema $schema): Schema
    {
        return $schema->schema([
            Forms\Components\Hidden::make('category')->default('faculty'),
            Forms\Components\TextInput::make('title')->label('ชื่อกิจกรรม')->required(),
            Forms\Components\Textarea::make('description')->label('รายละเอียด')->columnSpanFull(),
            Forms\Components\DatePicker::make('start_date')->label('วันเริ่มต้น')->required(),
            Forms\Components\DatePicker::make('end_date')->label('วันสิ้นสุด'),
            Forms\Components\TextInput::make('semester')->label('ภาคเรียน')->required(),
            Forms\Components\TextInput::make('academic_year')->label('ปีการศึกษา')->required(),
            Forms\Components\TextInput::make('location')->label('สถานที่'),
            Forms\Components\Select::make('type')->label('ประเภท')
                ->options(['training' => 'ฝึกสอน', 'seminar' => 'สัมมนา', 'evaluation' => 'ประเมิน', 'other' => 'อื่นๆ'])
                ->default('training'),
            Forms\Components\Toggle::make('is_active')->label('แสดงผล')->default(true),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(fn (\Illuminate\Database\Eloquent\Builder $query) => $query->where('category', 'faculty'))
            ->columns([
                Tables\Columns\TextColumn::make('title')->label('กิจกรรม')->searchable(),
                Tables\Columns\TextColumn::make('start_date')->label('วันเริ่มต้น')->date()->sortable(),
                Tables\Columns\TextColumn::make('semester')->label('ภาคเรียน'),
                Tables\Columns\TextColumn::make('academic_year')->label('ปีการศึกษา'),
                Tables\Columns\TextColumn::make('type')->label('ประเภท')->badge(),
                Tables\Columns\IconColumn::make('is_active')->label('แสดง')->boolean(),
            ])
            ->defaultSort('start_date', 'desc')
            ->actions([\Filament\Actions\EditAction::make(), \Filament\Actions\DeleteAction::make()]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListTrainingSchedules::route('/'),
            'create' => CreateTrainingSchedule::route('/create'),
            'edit' => EditTrainingSchedule::route('/{record}/edit'),
        ];
    }
}

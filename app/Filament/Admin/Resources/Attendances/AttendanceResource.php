<?php

namespace App\Filament\Admin\Resources\Attendances;

use App\Filament\Admin\Resources\Attendances\Pages\{CreateAttendance, EditAttendance, ListAttendances};
use App\Models\Attendance;
use BackedEnum;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables;
use Filament\Tables\Table;

class AttendanceResource extends Resource
{
    protected static ?string $model = Attendance::class;
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedClipboardDocumentCheck;
    protected static string|\UnitEnum|null $navigationGroup = 'จัดการข้อมูล';
    protected static ?string $navigationLabel = 'บันทึกการเข้าฝึกสอน';
    protected static ?string $modelLabel = 'การเข้าฝึกสอน';
    protected static ?string $pluralModelLabel = 'การเข้าฝึกสอน';

    public static function form(Schema $schema): Schema
    {
        return $schema->schema([
            Forms\Components\Select::make('student_id')->label('นักศึกษา')
                ->relationship('student', 'name')->required()->searchable(),
            Forms\Components\DatePicker::make('date')->label('วันที่')->required(),
            Forms\Components\Select::make('status')->label('สถานะ')
                ->options(['present' => 'มา', 'absent' => 'ขาด', 'late' => 'สาย', 'leave' => 'ลา'])
                ->required()->default('present'),
            Forms\Components\TimePicker::make('check_in_time')->label('เวลาเข้า'),
            Forms\Components\TimePicker::make('check_out_time')->label('เวลาออก'),
            Forms\Components\Textarea::make('note')->label('หมายเหตุ'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('student.name')->label('นักศึกษา')->searchable(),
                Tables\Columns\TextColumn::make('date')->label('วันที่')->date()->sortable(),
                Tables\Columns\TextColumn::make('check_in_time')->label('เข้า'),
                Tables\Columns\TextColumn::make('check_out_time')->label('ออก'),
                Tables\Columns\TextColumn::make('status')->label('สถานะ')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => match($state) {
                        'present' => 'มา', 'late' => 'สาย', 'leave' => 'ลา', default => 'ขาด',
                    })
                    ->color(fn (string $state): string => match ($state) {
                        'present' => 'success', 'late' => 'warning', 'leave' => 'info', default => 'danger',
                    }),
            ])
            ->defaultSort('date', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('status')->label('สถานะ')
                    ->options(['present' => 'มา', 'absent' => 'ขาด', 'late' => 'สาย', 'leave' => 'ลา']),
            ])
            ->actions([\Filament\Actions\EditAction::make(), \Filament\Actions\DeleteAction::make()]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListAttendances::route('/'),
            'create' => CreateAttendance::route('/create'),
            'edit' => EditAttendance::route('/{record}/edit'),
        ];
    }
}

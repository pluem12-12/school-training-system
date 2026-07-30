<?php

namespace App\Filament\Admin\Resources\Schools;

use App\Filament\Admin\Resources\Schools\Pages\{CreateSchool, EditSchool, ListSchools};
use App\Models\School;
use BackedEnum;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables;
use Filament\Tables\Table;

class SchoolResource extends Resource
{
    protected static ?string $model = School::class;
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBuildingOffice;
    protected static string|\UnitEnum|null $navigationGroup = 'จัดการข้อมูล';
    protected static ?string $navigationLabel = 'สถานศึกษา';
    protected static ?string $modelLabel = 'สถานศึกษา';
    protected static ?string $pluralModelLabel = 'สถานศึกษา';

    public static function form(Schema $schema): Schema
    {
        return $schema->schema([
            Forms\Components\TextInput::make('school_name')->label('ชื่อโรงเรียน')->required(),
            Forms\Components\TextInput::make('affiliation')->label('สังกัด')->required(),
            Forms\Components\TextInput::make('province')->label('จังหวัด')->required(),
            Forms\Components\TextInput::make('mentor_name')->label('ชื่อครูพี่เลี้ยง'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('school_name')->label('ชื่อโรงเรียน')->searchable(),
                Tables\Columns\TextColumn::make('affiliation')->label('สังกัด'),
                Tables\Columns\TextColumn::make('province')->label('จังหวัด')->searchable(),
                Tables\Columns\TextColumn::make('mentor_name')->label('ครูพี่เลี้ยง'),
            ])
            ->headerActions([
                \Filament\Actions\Action::make('import')
                    ->label('นำเข้าข้อมูล (Excel/CSV)')
                    ->icon('heroicon-o-arrow-up-tray')
                    ->color('success')
                    ->form([
                        \Filament\Forms\Components\FileUpload::make('file')
                            ->label('ไฟล์ข้อมูล (.xlsx, .csv)')
                            ->disk('local')
                            ->directory('imports')
                            ->acceptedFileTypes([
                                'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                                'application/vnd.ms-excel',
                                'text/csv'
                            ])
                            ->required(),
                    ])
                    ->action(function (array $data) {
                        $path = storage_path('app/private/' . $data['file']);
                        
                        try {
                            \Maatwebsite\Excel\Facades\Excel::import(new class implements \Maatwebsite\Excel\Concerns\ToCollection, \Maatwebsite\Excel\Concerns\WithHeadingRow {
                                public function collection(\Illuminate\Support\Collection $rows)
                                {
                                    foreach ($rows as $row) {
                                        if (!isset($row['school_name'])) continue;
                                        
                                        \App\Models\School::updateOrCreate(
                                            ['school_name' => $row['school_name']],
                                            [
                                                'affiliation' => $row['affiliation'] ?? '-',
                                                'province' => $row['province'] ?? '-',
                                                'mentor_name' => $row['mentor_name'] ?? null,
                                            ]
                                        );
                                    }
                                }
                            }, $path);
                            
                            \Filament\Notifications\Notification::make()
                                ->title('นำเข้าข้อมูลสถานศึกษาสำเร็จ')
                                ->success()
                                ->send();
                                
                        } catch (\Exception $e) {
                            \Filament\Notifications\Notification::make()
                                ->title('เกิดข้อผิดพลาดในการนำเข้า')
                                ->body($e->getMessage())
                                ->danger()
                                ->send();
                        }
                    }),
            ])
            ->actions([\Filament\Actions\EditAction::make(), \Filament\Actions\DeleteAction::make()])
            ->bulkActions([
                \Filament\Actions\DeleteBulkAction::make(),
                    \pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction::make()
                        ->label('ส่งออกข้อมูล (Excel)'),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListSchools::route('/'),
            'create' => CreateSchool::route('/create'),
            'edit' => EditSchool::route('/{record}/edit'),
        ];
    }
}

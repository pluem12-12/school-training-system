<?php

namespace App\Filament\Admin\Resources\Users;

use App\Filament\Admin\Resources\Users\Pages\CreateUser;
use App\Filament\Admin\Resources\Users\Pages\EditUser;
use App\Filament\Admin\Resources\Users\Pages\ListUsers;
use App\Models\User;
use BackedEnum;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables;
use Filament\Tables\Table;

class UserResource extends Resource
{
    protected static ?string $model = User::class;
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedUsers;
    protected static string|\UnitEnum|null $navigationGroup = 'จัดการผู้ใช้';
    protected static ?string $navigationLabel = 'ผู้ใช้ทั้งหมด';
    protected static ?string $modelLabel = 'ผู้ใช้';
    protected static ?string $pluralModelLabel = 'ผู้ใช้';

    public static function form(Schema $schema): Schema
    {
        return $schema->schema([
            Forms\Components\TextInput::make('name')
                ->label('ชื่อ-สกุล')
                ->required()
                ->maxLength(255),
            Forms\Components\TextInput::make('student_id')
                ->label('รหัสนักศึกษา')
                ->maxLength(20),
            Forms\Components\TextInput::make('email')
                ->label('อีเมล')
                ->email()
                ->required()
                ->unique(ignoreRecord: true),
            Forms\Components\TextInput::make('phone')
                ->label('เบอร์โทร')
                ->tel(),
            Forms\Components\Select::make('role')
                ->label('บทบาท')
                ->options([
                    'admin' => 'ผู้ดูแลระบบ',
                    'teacher' => 'อาจารย์',
                    'mentor' => 'ครูพี่เลี้ยง',
                    'student' => 'นักศึกษา',
                ])
                ->required()
                ->default('student'),
            Forms\Components\TextInput::make('password')
                ->label('รหัสผ่าน')
                ->password()
                ->dehydrateStateUsing(fn (string $state): string => bcrypt($state))
                ->dehydrated(fn (?string $state): bool => filled($state))
                ->required(fn (string $operation): bool => $operation === 'create'),
                
            Forms\Components\Fieldset::make('ข้อมูลเพิ่มเติม')
                ->relationship('memberProfile')
                ->schema([
                    Forms\Components\TextInput::make('name_th')
                        ->label('ชื่อ-สกุล (ภาษาไทย)'),
                    Forms\Components\TextInput::make('subject_taught')
                        ->label('รายวิชา/สาขา (ที่เกี่ยวข้องกัน)'),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->label('ชื่อ-สกุล')->searchable(),
                Tables\Columns\TextColumn::make('student_id')->label('รหัสนักศึกษา')->searchable(),
                Tables\Columns\TextColumn::make('memberProfile.subject_taught')->label('รายวิชา/สาขา')->searchable(),
                Tables\Columns\TextColumn::make('email')->label('อีเมล')->searchable(),
                Tables\Columns\TextColumn::make('role')->label('บทบาท')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => match($state) {
                        'admin' => 'ผู้ดูแลระบบ',
                        'teacher' => 'อาจารย์',
                        'mentor' => 'ครูพี่เลี้ยง',
                        default => 'นักศึกษา',
                    })
                    ->color(fn (string $state): string => match ($state) {
                        'admin' => 'danger',
                        'teacher' => 'warning',
                        'mentor' => 'success',
                        default => 'primary',
                    }),
                Tables\Columns\TextColumn::make('created_at')->label('สร้างเมื่อ')->dateTime()->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('role')
                    ->label('บทบาท')
                    ->options([
                        'admin' => 'ผู้ดูแลระบบ',
                        'teacher' => 'อาจารย์',
                        'mentor' => 'ครูพี่เลี้ยง',
                        'student' => 'นักศึกษา',
                    ]),
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
                            \Maatwebsite\Excel\Facades\Excel::import(new \App\Imports\UsersImport, $path);
                            
                            \Filament\Notifications\Notification::make()
                                ->title('นำเข้าข้อมูลสำเร็จ')
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
            ->actions([
                \Filament\Actions\EditAction::make(),
                \Filament\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                \Filament\Actions\DeleteBulkAction::make(),
                    \pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction::make()
                        ->label('ส่งออกข้อมูล (Excel)'),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListUsers::route('/'),
            'create' => CreateUser::route('/create'),
            'edit' => EditUser::route('/{record}/edit'),
        ];
    }
}

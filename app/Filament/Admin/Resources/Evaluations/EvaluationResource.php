<?php

namespace App\Filament\Admin\Resources\Evaluations;

use App\Filament\Admin\Resources\Evaluations\Pages\CreateEvaluation;
use App\Filament\Admin\Resources\Evaluations\Pages\EditEvaluation;
use App\Filament\Admin\Resources\Evaluations\Pages\ListEvaluations;
use App\Filament\Admin\Resources\Evaluations\Tables\EvaluationsTable;
use App\Models\Evaluation;
use BackedEnum;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Filament\Actions\ExportAction;
use App\Filament\Exports\EvaluationExporter;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;

class EvaluationResource extends Resource
{
    protected static ?string $model = Evaluation::class;

    protected static string|\UnitEnum|null $navigationGroup = 'จัดการข้อมูล';
    protected static ?string $navigationLabel = 'การประเมิน';
    protected static ?string $modelLabel = 'การประเมิน';
    protected static ?string $pluralModelLabel = 'การประเมินผล';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return $schema->schema([
            Forms\Components\Select::make('student_id')
                ->label('เลือกนักศึกษา')
                ->relationship('student', 'name')
                ->required(),
            Forms\Components\TextInput::make('score')
                ->label('คะแนน (1-100)')
                ->numeric()
                ->required()
                ->minValue(0)
                ->maxValue(100),
            Forms\Components\Textarea::make('comment')
                ->label('ข้อเสนอแนะ')
                ->columnSpanFull(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                \Filament\Tables\Columns\TextColumn::make('student.name')->label('ชื่อนักศึกษา')->searchable(),
                \Filament\Tables\Columns\TextColumn::make('student.memberProfile.subject_taught')->label('รายวิชา/สาขา')->searchable(),
                \Filament\Tables\Columns\TextColumn::make('mentor.name')->label('ชื่อผู้ประเมิน')->searchable(),
                \Filament\Tables\Columns\TextColumn::make('type')->label('ประเภท')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => $state === 'training' ? 'การฝึกระหว่างเรียน' : 'การฝึกปฏิบัติการสอน')
                    ->color(fn (string $state): string => match ($state) {
                        'training' => 'primary',
                        'teaching' => 'warning',
                        default => 'gray',
                    }),
                \Filament\Tables\Columns\TextColumn::make('score')->label('คะแนน')->sortable(),
                \Filament\Tables\Columns\TextColumn::make('created_at')->dateTime()->label('วันที่ประเมิน')->sortable(),
            ])
            ->filters([
                SelectFilter::make('type')
                    ->label('ประเภทการประเมิน')
                    ->options([
                        'training' => 'การฝึกระหว่างเรียน',
                        'teaching' => 'การฝึกปฏิบัติการสอน',
                    ]),
                SelectFilter::make('subject')
                    ->label('สาขา/รายวิชา')
                    ->options(fn () => \App\Models\MemberProfile::whereNotNull('subject_taught')->pluck('subject_taught', 'subject_taught')->toArray())
                    ->query(function (Builder $query, array $data): Builder {
                        if (empty($data['value'])) {
                            return $query;
                        }
                        
                        return $query->whereHas('student.memberProfile', function (Builder $query) use ($data) {
                            $query->where('subject_taught', $data['value']);
                        });
                    })
                    ->searchable()
                    ->preload(),
            ])
            ->headerActions([
                ExportAction::make()
                    ->exporter(EvaluationExporter::class)
                    ->label('ส่งออกข้อมูล (Export)'),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListEvaluations::route('/'),
            'create' => CreateEvaluation::route('/create'),
            'edit' => EditEvaluation::route('/{record}/edit'),
        ];
    }
}

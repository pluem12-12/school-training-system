<?php
namespace App\Filament\Admin\Resources\Users\Pages;
use App\Filament\Admin\Resources\Users\UserResource;
use Filament\Resources\Pages\ListRecords;
class ListUsers extends ListRecords
{
    protected static string $resource = UserResource::class;
    protected function getHeaderActions(): array
    {
        return [\Filament\Actions\CreateAction::make()];
    }

    public function getTabs(): array
    {
        return [
            'all' => \Filament\Schemas\Components\Tabs\Tab::make('ทั้งหมด'),
            'student' => \Filament\Schemas\Components\Tabs\Tab::make('นักศึกษา')
                ->modifyQueryUsing(fn (\Illuminate\Database\Eloquent\Builder $query) => $query->where('role', 'student')),
            'teacher' => \Filament\Schemas\Components\Tabs\Tab::make('อาจารย์')
                ->modifyQueryUsing(fn (\Illuminate\Database\Eloquent\Builder $query) => $query->where('role', 'teacher')),
            'mentor' => \Filament\Schemas\Components\Tabs\Tab::make('ครูพี่เลี้ยง')
                ->modifyQueryUsing(fn (\Illuminate\Database\Eloquent\Builder $query) => $query->where('role', 'mentor')),
            'admin' => \Filament\Schemas\Components\Tabs\Tab::make('ผู้ดูแลระบบ')
                ->modifyQueryUsing(fn (\Illuminate\Database\Eloquent\Builder $query) => $query->where('role', 'admin')),
        ];
    }
}

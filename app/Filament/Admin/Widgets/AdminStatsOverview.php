<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Document;
use App\Models\School;
use App\Models\StudentReport;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class AdminStatsOverview extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        return [
            Stat::make('จำนวนนักศึกษาทั้งหมด', User::where('role', 'student')->count())
                ->description('นักศึกษาในระบบ')
                ->descriptionIcon('heroicon-m-user-group')
                ->color('primary'),
                
            Stat::make('จำนวนสถานศึกษา', School::count())
                ->description('เครือข่ายศูนย์ฝึกฯ')
                ->descriptionIcon('heroicon-m-building-office')
                ->color('success'),
                
            Stat::make('จำนวนเอกสารในระบบ', Document::count())
                ->description('แบบฟอร์มและคู่มือต่างๆ')
                ->descriptionIcon('heroicon-m-document-text')
                ->color('info'),

            Stat::make('รายงานที่ส่งแล้ว', StudentReport::count())
                ->description('รายงานการฝึกสอน')
                ->descriptionIcon('heroicon-m-document-arrow-up')
                ->color('warning'),
        ];
    }
}

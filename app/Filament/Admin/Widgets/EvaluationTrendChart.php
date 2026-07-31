<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Evaluation;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Carbon;

class EvaluationTrendChart extends ChartWidget
{
    protected ?string $heading = 'สถิติการประเมิน (รายเดือน)';
    protected static ?int $sort = 2;

    protected function getData(): array
    {
        $isPgsql = \Illuminate\Support\Facades\DB::connection()->getDriverName() === 'pgsql';
        $monthQuery = $isPgsql ? 'EXTRACT(MONTH FROM created_at)' : 'MONTH(created_at)';
        
        $data = Evaluation::selectRaw("{$monthQuery} as month, COUNT(*) as count, AVG(score) as average_score")
            ->whereYear('created_at', Carbon::now()->year)
            ->groupByRaw($monthQuery)
            ->orderByRaw($monthQuery)
            ->get();
            
        $months = ['ม.ค.', 'ก.พ.', 'มี.ค.', 'เม.ย.', 'พ.ค.', 'มิ.ย.', 'ก.ค.', 'ส.ค.', 'ก.ย.', 'ต.ค.', 'พ.ย.', 'ธ.ค.'];
        
        $chartData = array_fill(1, 12, 0); // Default counts
        $avgData = array_fill(1, 12, 0); // Default averages
        
        foreach ($data as $item) {
            $chartData[$item->month] = $item->count;
            $avgData[$item->month] = round($item->average_score, 2);
        }

        return [
            'datasets' => [
                [
                    'label' => 'จำนวนการประเมิน (ครั้ง)',
                    'data' => array_values($chartData),
                    'backgroundColor' => '#3b82f6',
                    'borderColor' => '#3b82f6',
                    'yAxisID' => 'y',
                ],
                [
                    'label' => 'คะแนนเฉลี่ย',
                    'data' => array_values($avgData),
                    'type' => 'line',
                    'backgroundColor' => '#10b981',
                    'borderColor' => '#10b981',
                    'yAxisID' => 'y1',
                ],
            ],
            'labels' => $months,
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
    
    protected function getOptions(): array
    {
        return [
            'scales' => [
                'y' => [
                    'type' => 'linear',
                    'display' => true,
                    'position' => 'left',
                    'title' => [
                        'display' => true,
                        'text' => 'จำนวนการประเมิน',
                    ],
                ],
                'y1' => [
                    'type' => 'linear',
                    'display' => true,
                    'position' => 'right',
                    'title' => [
                        'display' => true,
                        'text' => 'คะแนนเฉลี่ย',
                    ],
                    'grid' => [
                        'drawOnChartArea' => false,
                    ],
                ],
            ],
        ];
    }
}

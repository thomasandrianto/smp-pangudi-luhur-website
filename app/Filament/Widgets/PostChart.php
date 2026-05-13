<?php

namespace App\Filament\Widgets;

use App\Models\Post;
use Filament\Widgets\ChartWidget;

class PostChart extends ChartWidget
{
    protected static ?string $heading = 'Post per Bulan';

    protected int | string | array $columnSpan = 2;

    protected function getData(): array
    {
        $data = collect(range(1, 12))->map(function ($month) {
            return Post::whereMonth('created_at', $month)
                ->whereYear('created_at', now()->year)
                ->count();
        });

        return [
            'datasets' => [
                [
                    'label' => 'Post',
                    'data' => $data,
                ],
            ],
            'labels' => [
                'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun',
                'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des',
            ],
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }

    protected function getOptions(): array
    {
        return [
            'plugins' => [
                'legend' => [
                    'display' => false,
                ],
            ],
            'scales' => [
                'y' => [
                    'beginAtZero' => true,
                ],
            ],
        ];
    }
}
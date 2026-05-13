<?php

namespace App\Filament\Widgets;

use App\Models\Student;
use App\Models\Teacher;
use App\Models\Post;
use App\Models\Message;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected int | string | array $columnSpan = 'full';

    protected function getStats(): array
    {
        return [
            Stat::make('Total Siswa', Student::count())
                ->description('Jumlah siswa aktif')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success'),

            Stat::make('Total Guru', Teacher::count())
                ->description('Tenaga pengajar')
                ->descriptionIcon('heroicon-m-academic-cap')
                ->color('primary'),

            Stat::make('Total Post', Post::count())
                ->description('Artikel dibuat')
                ->descriptionIcon('heroicon-m-document-text')
                ->color('warning'),

            Stat::make('Pesan Masuk', Message::where('is_read', false)->count())
                ->description('Belum dibaca')
                ->descriptionIcon('heroicon-m-envelope')
                ->color('danger'),
        ];
    }
}
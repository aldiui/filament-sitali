<?php

namespace App\Filament\Widgets;

use App\Models\Pelanggan;
use App\Models\Tagihan;
use App\Models\TarifListrik;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class Stats extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Card::make('Tarif Listrik', TarifListrik::count()),
            Card::make('Pelanggan', Pelanggan::count()),
            Card::make('Tagihan', Tagihan::count()),
        ];
    }
}
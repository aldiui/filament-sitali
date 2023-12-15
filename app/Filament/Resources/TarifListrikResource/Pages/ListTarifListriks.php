<?php

namespace App\Filament\Resources\TarifListrikResource\Pages;

use App\Filament\Resources\TarifListrikResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTarifListriks extends ListRecords
{
    protected static string $resource = TarifListrikResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
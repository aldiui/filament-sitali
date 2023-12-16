<?php

namespace App\Filament\Resources\TarifListrikResource\Pages;

use App\Filament\Resources\TarifListrikResource;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;

class CreateTarifListrik extends CreateRecord
{
    protected static string $resource = TarifListrikResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->previousUrl ?? $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotification(): ?Notification
    {
        return Notification::make()
            ->title('Tarif Listrik')
            ->body('Tarif Listrik Berhasil di Tambahkan')
            ->success();
    }

}
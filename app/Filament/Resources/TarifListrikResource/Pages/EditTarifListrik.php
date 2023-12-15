<?php

namespace App\Filament\Resources\TarifListrikResource\Pages;

use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\TarifListrikResource;

class EditTarifListrik extends EditRecord
{
    protected static string $resource = TarifListrikResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->previousUrl ?? $this->getResource()::getUrl('index');
    }

    protected function getSavedNotification(): ?Notification
    {
        return Notification::make()
            ->title('Tarif Listrik')
            ->body('Tarif Listrik Berhasil di Ubah')
            ->success();
    }
}
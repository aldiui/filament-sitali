<?php

namespace App\Filament\Resources\PelangganResource\Pages;

use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\PelangganResource;

class EditPelanggan extends EditRecord
{
    protected static string $resource = PelangganResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->previousUrl ?? $this->getResource()::getUrl('index');
    }

    protected function getSavedNotification(): ?Notification
    {
        return Notification::make()
            ->title('Pelanggan')
            ->body('Pelanggan Berhasil di Ubah')
            ->success();
    }
}
<?php

namespace App\Filament\Resources\BannerAboutResource\Pages;

use App\Filament\Resources\BannerAboutResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBannerAbout extends EditRecord
{
    protected static string $resource = BannerAboutResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

<?php

namespace App\Filament\Resources\AboutResource\Pages;

use App\Filament\Resources\AboutResource;
use App\Models\About;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAbout extends EditRecord
{
    protected static string $resource = AboutResource::class;

    public function mount($record = null): void
    {
        // Найдёт первую запись или создаст пустую
        $about = About::firstOrCreate([]);

        // Передаём ID найденной/созданной записи родительскому методу
        parent::mount($about->id);
    }

    protected function getHeaderActions(): array
    {
        return [
//            Actions\DeleteAction::make(),
        ];
    }
}

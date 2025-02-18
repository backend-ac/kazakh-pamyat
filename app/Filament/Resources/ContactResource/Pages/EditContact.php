<?php

namespace App\Filament\Resources\ContactResource\Pages;

use App\Filament\Resources\ContactResource;
use App\Models\About;
use App\Models\Contact;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditContact extends EditRecord
{
    protected static string $resource = ContactResource::class;

    public function mount($record = null): void
    {
        // Найдёт первую запись или создаст пустую
        $contact = Contact::firstOrCreate([]);

        // Передаём ID найденной/созданной записи родительскому методу
        parent::mount($contact->id);
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

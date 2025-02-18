<?php

namespace App\Filament\Resources\UserStoryResource\Pages;

use App\Filament\Resources\UserStoryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditUserStory extends EditRecord
{
    protected static string $resource = UserStoryResource::class;


    protected function mutateFormDataBeforeSave(array $data): array
    {
        // Если админ поставил галочку "make_official" => переводим type в 'official'
        if (!empty($data['make_official'])) {
            $data['type'] = 'official';
        } else {
            $data['type'] = 'user_story';
            // Если хотите сохранять user_story,
            // или можно оставить как есть, если уже user_story
        }

        return $data;
    }
    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

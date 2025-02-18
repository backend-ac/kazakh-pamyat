<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;
use Illuminate\Support\Facades\Artisan;
use Filament\Notifications\Notification;

class ArtisanCommandsWidget extends Widget
{
    protected static string $view = 'filament.widgets.artisan-commands-widget';

    public function clearCache()
    {
        try {
            Artisan::call('cache:clear');
            Notification::make()
                ->title('Кэш успешно очищен.')
                ->success()
                ->send();
        } catch (\Exception $e) {
            Notification::make()
                ->title('Ошибка при очистке кэша.')
                ->body($e->getMessage())
                ->danger()
                ->send();
        }
    }

    public function createSymlink()
    {
        try {
            Artisan::call('storage:link');
            Notification::make()
                ->title('Символическая ссылка создана успешно.')
                ->success()
                ->send();
        } catch (\Exception $e) {
            Notification::make()
                ->title('Ошибка при создании символической ссылки.')
                ->body($e->getMessage())
                ->danger()
                ->send();
        }
    }

    // Добавьте другие методы для необходимых команд
}

<div class="space-y-4">
    <x-filament::card>
        <x-slot name="header">
            <h2 class="text-xl font-semibold">Управление Artisan Командами</h2>
        </x-slot>

        <div class="space-y-2 mt-4">
            <x-filament::button wire:click="clearCache" color="primary" class="w-full">
                Очистить Кэш
            </x-filament::button>

            <x-filament::button wire:click="createSymlink" color="primary" class="w-full">
                Создать Символическую Ссылку
            </x-filament::button>

            <!-- Добавьте другие кнопки для дополнительных команд -->
        </div>
    </x-filament::card>
</div>

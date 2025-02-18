<?php

namespace App\Providers;

use App\Models\Component;
use App\Models\Place;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // composer('*', ...) означает, что переменная будет доступна во всех шаблонах
        View::composer('*', function ($view) {
            // Получаем все компоненты, где is_general = true
            $generalComponents = Component::where('is_general', true)->get();

            // Прокидываем переменную $generalComponents во все blade-шаблоны
            $view->with('generalComponents', $generalComponents);
        });

        View::composer('layouts.header', function ($view) {
            $places = Place::with([
                'participants' => function($query) {
                    // Берём только "official" участников
                    $query->where('type', 'official');
                },
            ])
                ->orderBy('order')
                ->get();

            $view->with('places', $places);
        });
    }
}

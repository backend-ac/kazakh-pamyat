<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Banner;
use App\Models\Contact;
use App\Models\Gallery;
use App\Models\Page;
use App\Models\Participant;
use App\Models\Place;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        $page = Page::with('components')->where('slug', 'glavnaia')->first();
        $banners = Banner::query()->where('banner_type', 'home')->orderBy('sort_order')->get();

        // Получаем все изображения из верхнего ряда
        $topImages = Gallery::where('row', 'top')
            ->orderBy('sort_order')
            ->get();

        // Получаем все изображения из нижнего ряда
        $bottomImages = Gallery::where('row', 'bottom')
            ->orderBy('sort_order')
            ->get();
        $main = Participant::where('show_on_gs', true)->get();

        return view('home', compact('banners', 'page', 'topImages', 'bottomImages', 'main'));
    }

    public function about()
    {
        $about = About::first();
        $contacts = Contact::first();
        $banners = Banner::query()->where('banner_type', 'about')->orderBy('sort_order')->get();
        $page = Page::with('components')->where('slug', 'o-proekte')->first();
        return view('about', compact('page', 'banners', 'about', 'contacts'));
    }

    public function history(Request $request)
    {
        // Базовый запрос: только user_story
        $query = Participant::where('type', 'user_story')
            ->orderBy('created_at', 'desc');

        // Поиск по имени, если в GET есть 'q'
        if ($request->filled('q')) {
            $search = $request->input('q');
            $query->where('name', 'like', "%{$search}%");
        }

        // Фильтр "Только с фото"
        if ($request->has('with_photo')) {
            $query->whereNotNull('photo')
                ->where('photo', '!=', '');
        }

        // Фильтр "С неполной информацией"
        if ($request->has('incomplete')) {
            $query->where(function($q){
                $q->whereNull('date_of_birth')
                    ->orWhere('date_of_birth', '')
                    ->orWhereNull('bio')
                    ->orWhere('bio','');
            });
        }

        // Пагинация
        $stories = $query->paginate(12);

        // Страница (Page), как у вас
        $page = Page::with('components')->where('slug', 'vasi-istorii')->first();

        return view('history', [
            'page' => $page,
            'stories' => $stories,
        ]);
    }

    public function politics()
    {
        $page = Page::with('components')->where('slug', 'politika-konfidencialnosti')->first();
        return view('politics', compact('page'));
    }


}

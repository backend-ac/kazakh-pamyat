<?php

namespace App\Http\Controllers;

use App\Models\Participant;
use App\Models\Place;
use Illuminate\Http\Request;

class PlaceController extends Controller
{
    public function show(Place $place, Request $request)
    {
        // базовый запрос
        $query = $place->participants()->orderBy('name');

        // если есть поисковый запрос "q"
        if ($request->filled('q')) {
            $search = $request->input('q');
            // пример поиска по имени
            $query->where('name', 'like', "%{$search}%");
        }

        // если "with_photo" == 1
        if ($request->has('with_photo')) {
            // условие: photo != null и != ''
            $query->whereNotNull('photo')->where('photo', '!=', '');
        }

        // если "incomplete" == 1
        if ($request->has('incomplete')) {
            // Например, считаем запись неполной,
            // если нет date_of_birth ИЛИ нет bio
            // (или другое условие по вашему усмотрению)
            $query->where(function($q){
                $q->whereNull('date_of_birth')
                    ->orWhere('date_of_birth', '')
                    ->orWhereNull('bio')
                    ->orWhere('bio','');
            });
        }

        // пагинация
        $participants = $query->paginate(12);

        return view('place', [
            'place' => $place,
            'participants' => $participants,
        ]);
    }


    public function participant(Participant $participant)
    {
        // Загрузим связанные данные:
        // - 'place' ( belongsTo ) чтобы иметь доступ к $participant->place
        // - 'infos' ( hasMany ) если нужна дополнительная информация
        $participant->load(['place', 'infos' => function($query) {
            $query->orderBy('order');
        }]);

        // Если нужно место отдельно:
        $place = $participant->place;

        return view('participant', compact('participant', 'place'));
    }
}

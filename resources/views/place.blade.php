@extends('layouts.index')
@section('content')

    <main>
        <section class="breadcrumbs @@class">
            <div class="container">
                <div class="breadcrumbs__container">
                    <ul class="breadcrumbs__list">
                        <li class="breadcrumbs__list-item">
                            <a href="/" class="breadcrumbs__list-link">Главная</a>
                        </li>
                        <li class="breadcrumbs__list-item">
                            <a href="#" class="breadcrumbs__list-link active">{{ $place->title }}</a>
                        </li>
                    </ul>
                </div>
            </div>
        </section>
        <section class="about not-bg">
            <div class="container">
                <div class="about__container">
                    <div class="about__block">
                        <div class="about__block-img">
                            @if($place->place_image)
                                <img src="{{ asset('storage/' . $place->place_image) }}" alt="{{ $place->title }}"/>
                            @else
                                <img src="/img/about.jpg" alt="Заглушка"/>
                            @endif
                        </div>
                        <div class="about__block-info">
                            <h1 class="about__block-title title"> {{ $place->title }}</h1>
                            <div class="about__block-text">
                                {!! $place->text !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="search">
            <div class="container">
                <div class="search__container content">
                    <form action="{{ route('place.show', $place->id) }}" method="GET">
                        <div class="search__form">
                            <h2 class="search__form-title title">Поиск погибших</h2>
                            <div class="search__form-block">
                                <input
                                    type="text"
                                    name="q"
                                    class="search__form-input"
                                    placeholder="Поиск участники войны"
                                    value="{{ request('q') }}"
                                />
                                <button type="submit" class="search__form-submit">
                                   Поиск
                                </button>
                            </div>
                        </div>
                    </form>
                    <form action="" id="search-checkboxes">
                        <div class="search__checkboxes">
                            <label for="checkbox-1">
                                <input
                                    type="checkbox"
                                    id="checkbox-1"
                                    name="with_photo"
                                    value="1"
                                    {{ request('with_photo') ? 'checked' : '' }}
                                />
                                <span>Только с фото</span>
                            </label>
                            <label for="checkbox-2">
                                <input
                                    type="checkbox"
                                    id="checkbox-2"
                                    name="incomplete"
                                    value="1"
                                    {{ request('incomplete') ? 'checked' : '' }}
                                />
                                <span>С неполной информацией</span>
                            </label>
                        </div>
                    </form>
                    <div class="search__items">
                        @forelse($participants as $participant)
                            <div class="card__item">
                                @if($participant->photo)
                                    <div class="card__item-img">
                                        <img src="{{ asset('storage/' . $participant->photo) }}"
                                             alt="{{ $participant->name }}"/>
                                    </div>
                                @else
                                    <div class="card__item-img">
                                        <img src="{{asset('img/soldier-2.jpg')}}"
                                             alt="{{ $participant->name }}"/>
                                    </div>

                                @endif


                                <div class="card__item-name">{{ $participant->name }}</div>

                                <ul class="card__item-list">
                                    <li>
                                        <span>Дата рождения:</span>
                                        <span>{{ $participant->date_of_birth ?? 'Неизвестна' }}</span>
                                    </li>
                                    <li>
                                        <span>Причина выбытия:</span>
                                        <span>{{ $participant->date_of_death ?? 'Неизвестна' }}</span>
                                    </li>
{{--                                    <li>--}}
{{--                                        <span>Где воевал:</span>--}}
{{--                                        <span>{{ $participant->where_did_participate ?? 'Информация уточняется.' }}</span>--}}
{{--                                    </li>--}}
                                </ul>

                                <!-- Ссылка на детальную страницу участника (если уже есть маршрут 'participant.show') -->
                                <a href="{{ route('participant.show', $participant->id) }}" class="card__item-link">
                                    Подробнее
                                </a>
                            </div>
                        @empty
                            <!-- Если нет участников -->
                            <div class="empty">
                                <div class="empty__image">
                                    <img src="/img/empty.png" alt=""/>
                                </div>

                            </div>
                        @endforelse
                    </div>
                    {{ $participants->links('vendor.pagination.custom') }}

                </div>
            </div>
        </section>
    </main>
@endsection

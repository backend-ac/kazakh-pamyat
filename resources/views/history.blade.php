@extends('layouts.index')

@section('meta')
    <title>{{ $page->meta_title ?? 'Память в обелиске' }}</title>
    <meta name="description" content="{{ $page->meta_description ?? '' }}">
    <meta name="keywords" content="{{ $page->meta_keywords ?? '' }}">
@endsection

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
                            <a href="#" class="breadcrumbs__list-link active">Ваши истории</a>
                        </li>
                    </ul>
                </div>
            </div>
        </section>
        <section class="info">
            <div class="container">
                <div class="info__container">
                    <h1 class="info__title title">{{$page->components[0]->title}}</h1>
                    <div class="info__text">
                        {!! $page->components[0]->description !!}
                    </div>
                </div>
            </div>
        </section>
        <section class="search">
            <div class="container">
                <div class="search__container content">
                    <form action="{{ route('history') }}" method="GET">
                        <div class="search__form">
                            <h2 class="search__form-title title">Поиск истории</h2>
                            <div class="search__form-block">
                                <input
                                    type="text"
                                    name="q"
                                    class="search__form-input"
                                    placeholder="Поиск истории"
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
                        @forelse($stories as $story)
                            <div class="card__item">
                                @if($story->photo)
                                    <div class="card__item-img">
                                        <img
                                            src="{{ asset('storage/' . $story->photo) }}"
                                            alt="{{ $story->name }}"
                                        />
                                    </div>
                                @else
                                    <!-- Заглушка -->
                                    <div class="card__item-img">
                                        <img
                                            src="{{ asset('img/soldier-2.jpg') }}"
                                            alt="{{ $story->name }}"
                                        />
                                    </div>
                                @endif

                                <!-- ФИО погибшего (пользователь ввёл) -->
                                <div class="card__item-name">
                                    {{ $story->name }}
                                </div>

                                <!-- Список данных (пример) -->
                                <ul class="card__item-list">
                                    <li>
                                        <span>Дата рождения:</span>
                                        <span>{{ $story->date_of_birth ?? 'Неизвестна' }}</span>
                                    </li>
                                    <li>
                                        <span>Дата смерти:</span>
                                        <span>{{ $story->date_of_death ?? 'Неизвестна' }}</span>
                                    </li>
                                    <li>
                                        <span>Где воевал:</span>
                                        <span>{{ $story->where_did_participate ?? 'Информация уточняется.' }}</span>
                                    </li>
                                </ul>

                                <!-- Ссылка "Подробнее" - маршрут участника, если есть -->
                                <a
                                    href="{{ route('participant.show', $story->id) }}"
                                    class="card__item-link"
                                >
                                    Подробнее
                                </a>
                            </div>
                        @empty
                            <div class="empty">
                                <div class="empty__image">
                                    <img src="{{assert('img/empty.png')}}" alt=""/>
                                </div>
                                <span
                                >Пока здесь пусто, но скоро мы добавим что-то интересное!</span
                                >
                            </div>
                        @endforelse
                    </div>

                    <!-- если поиск не найден -->

                    {{ $stories->links('vendor.pagination.custom') }}
                </div>
            </div>
        </section>
        <x-feedback-form />
    </main>
@endsection

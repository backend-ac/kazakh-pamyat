@extends('layouts.index')
@section('content')
    <main>
        <section
            class="soldier"
            style="
        background: url('{{ optional($place)->banner
            ? asset('storage/' . $place->banner)
            : asset('img/soldier-1.jpg')
        }}') center/cover no-repeat
    "
        >
            <section class="breadcrumbs white">
                <div class="container">
                    <div class="breadcrumbs__container">
                        <ul class="breadcrumbs__list">
                            <li class="breadcrumbs__list-item">
                                <a href="/" class="breadcrumbs__list-link">Главная</a>
                            </li>
                            <li class="breadcrumbs__list-item">
                                <!-- Ссылка на место -->
                                @if($place)
                                    <a href="{{ route('place.show', $place->id) }}" class="breadcrumbs__list-link">
                                        {{ $place->title }}
                                    </a>
                                @endif
                            </li>
                            <li class="breadcrumbs__list-item">
                                <a href="#" class="breadcrumbs__list-link active">
                                    {{ $participant->name }}
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </section>
            <h1 class="soldier__title title">
                {{ $participant->name }}
            </h1>
        </section>
        <section class="bio">
            <div class="container">
                <div class="bio__container content">
                    <div class="bio__block">
                        <div class="bio__image">
                            @if($participant->photo)
                                <img src="{{ asset('storage/' . $participant->photo) }}"
                                     alt="{{ $participant->name }}"/>
                            @else
                                <img src="{{ asset('img/soldier-2.jpg') }}" alt="Заглушка"/>
                            @endif
                        </div>
                        <div class="bio__info">
                            <h2 class="bio__title title">БИОГРАФИЯ</h2>
                            <div class="bio__info-name">{{ $participant->name }}</div>
                            <div class="bio__info-list">
                                <li>Дата рождения: {{ $participant->date_of_birth ?? 'Неизвестна' }}</li>
                                <li>Причина выбытия: {{ $participant->date_of_death ?? 'Неизвестна' }}</li>
                                <!-- <li>Где
                                    воевал: {{ $participant->where_did_participate ?? 'Информация уточняется.' }}</li> -->
                            </div>
                            <!-- Если есть какое-то поле bio -->
{{--                            @if($participant->bio)--}}
{{--                                <div class="bio__info-list">--}}
{{--                                    <p class="bio__info-list">{!! $participant->bio !!}</p>--}}
{{--                                </div>--}}
{{--                            @endif--}}
                        </div>
                    </div>
                    <!-- Дополнительные блоки (infos), если есть -->
                    @if($participant->infos->count())
                        @foreach($participant->infos as $info)
                            <div class="bio__block">
                                <div class="bio__image">
                                    @if($info->image)
                                        <img src="{{ asset('storage/' . $info->image) }}" alt="">
                                    @endif
                                    @if($info->image_description)
                                        <span>{{ $info->image_description }}</span>
                                    @endif
                                </div>
                                <div class="bio__info">
                                    <div class="bio__info-text">
                                        {!! $info->text !!}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                    <div class="bio__more">
                        <span>Знаете больше? Отправьте нам информацию!</span>
                        <a href="/history">Отправить информацию</a>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection

@extends('layouts.index')

@section('meta')
    <title>{{ $page->meta_title ?? 'Память в обелиске' }}</title>
    <meta name="description" content="{{ $page->meta_description ?? '' }}">
    <meta name="keywords" content="{{ $page->meta_keywords ?? '' }}">
@endsection

@section('content')
    <main>
        <section class="hero">
            <div class="hero__slider swiper">
                <div class="swiper-wrapper">
                    @foreach($banners as $banner)
                        <div class="swiper-slide hero__slide">
                            <img src="{{ asset('storage/' . $banner->image) }}" alt="Banner"/>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="container">
                <div class="hero__container">
                    <a href="javascript:;" class="hero__arrow prev">
                        <svg
                            width="52"
                            height="52"
                            viewBox="0 0 52 52"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                d="M26 1C34.9316 1 43.1848 5.76497 47.6506 13.5C52.1165 21.235 52.1165 30.765 47.6506 38.5C43.1848 46.235 34.9316 51 26 51C12.1929 51 1 39.8071 1 26C1 12.1929 12.1929 1 26 1"
                                stroke="white"
                                stroke-width="2"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            />
                            <path
                                d="M15 26L26 15"
                                stroke="white"
                                stroke-width="2"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            />
                            <path
                                d="M15.6252 26H37"
                                stroke="white"
                                stroke-width="2"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            />
                            <path
                                d="M26 37L15 26"
                                stroke="white"
                                stroke-width="2"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            />
                        </svg>
                    </a>
                    <a href="javascript:;" class="hero__arrow next">
                        <svg
                            width="52"
                            height="52"
                            viewBox="0 0 52 52"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                d="M26 1C17.0684 1 8.81518 5.76497 4.34936 13.5C-0.116455 21.235 -0.116455 30.765 4.34936 38.5C8.81518 46.235 17.0684 51 26 51C39.8071 51 51 39.8071 51 26C51 12.1929 39.8071 1 26 1"
                                stroke="white"
                                stroke-width="2"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            />
                            <path
                                d="M37 26L26 15"
                                stroke="white"
                                stroke-width="2"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            />
                            <path
                                d="M36.3748 26H15"
                                stroke="white"
                                stroke-width="2"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            />
                            <path
                                d="M26 37L37 26"
                                stroke="white"
                                stroke-width="2"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            />
                        </svg>
                    </a>
                </div>
            </div>
        </section>


        <section class="preview">
            <div class="container">
                <div class="preview__container content">
                    <h2 class="preview__title title">{{$page->components[0]->title}}</h2>
                    <div class="preview__text">
                        {!! $page->components[0]->description !!}
                    </div>
                </div>
            </div>
            <div class="preview__images">
                @foreach($main as $image)
                    <div class="preview__image">
                        <img src="{{asset('storage/' . $image -> photo)}}" alt="{{$image -> name}}"/>
                    </div>
                @endforeach

            </div>
        </section>
        <section class="dead">
            <div class="container">
                <div class="dead__container content">
                    <h2 class="dead__title title">Поиск погибших</h2>
                    <div class="dead__items">
                        @php
                            // Возьмём первые 9 (на случай, если в `$main` больше
                            $participants = $main->take(9);
                        @endphp

                        @forelse($participants as $index => $participant)
                            {{-- Первые 3 без hidden, остальные с hidden --}}
                            <div class="dead__item @if($index >= 3) hidden @endif">
                                <div class="dead__item-img">
                                    {{-- Если есть photo, берём её, иначе заглушка --}}
                                    <img
                                        src="{{ $participant->photo
                                    ? asset('storage/'.$participant->photo)
                                    : asset('img/soldier-2.jpg') }}"
                                        alt="{{ $participant->name }}"
                                    />
                                </div>

                                <div class="dead__item-name">
                                    {{ $participant->name }}
                                </div>

                                <div class="dead__item-date">
                                    {{ $participant->date_of_birth ?? 'Неизвестно' }}
                                    -
                                    {{ $participant->date_of_death ?? 'Неизвестно' }}
                                </div>

                                <div class="dead__item-place">
                                    {{ $participant->where_did_participate ?? 'Информация уточняется' }}
                                </div>

                                <a
                                    href="{{ route('participant.show', $participant->id) }}"
                                    class="dead__item-link"
                                >
                                    Подробнее
                                </a>
                            </div>
                        @empty
                            <div class="dead__item">
                                <div class="dead__item-name">
                                    Нет участников
                                </div>
                            </div>
                        @endforelse
                    </div>
                    <div class="dead__more-wrapper">
                        <a href="javascript:;" class="dead__more">
                            <span> Показать все </span>
                            <span> Скрыть </span>
                        </a>
                    </div>
                </div>
            </div>
        </section>
        <section class="gallery">
            <div class="gallery__container content">
                <h2 class="gallery__title title">Галерея памятных фотографий</h2>
                <div class="gallery__ticker ticker-1" data-duplicated="true">
                    @foreach ($topImages as $image)
                        <img
                            src="{{ asset('storage/'.$image->image) }}"
                            alt=""
                            data-fancybox
                            data-src="{{ asset('storage/'.$image->image) }}"
                        />
                    @endforeach
                </div>
                <div class="gallery__ticker ticker-2" data-duplicated="true">
                    @foreach ($bottomImages as $image)
                        <img
                            src="{{ asset('storage/'.$image->image) }}"
                            alt=""
                            data-fancybox
                            data-src="{{ asset('storage/'.$image->image) }}"
                        />
                    @endforeach
                </div>
            </div>
        </section>
        <x-feedback-form/>
    </main>
@endsection

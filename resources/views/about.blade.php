@extends('layouts.index')

@section('meta')
    <title>{{ $page->meta_title ?? 'Память в обелиске' }}</title>
    <meta name="description" content="{{ $page->meta_description ?? '' }}">
    <meta name="keywords" content="{{ $page->meta_keywords ?? '' }}">
@endsection

@section('content')
    <main>
        <section class="hero">
            <section class="breadcrumbs white">
                <div class="container">
                    <div class="breadcrumbs__container">
                        <ul class="breadcrumbs__list">
                            <li class="breadcrumbs__list-item">
                                <a href="/" class="breadcrumbs__list-link">Главная</a>
                            </li>
                            <li class="breadcrumbs__list-item">
                                <!-- Ссылка на место -->
                                <a href="#" class="breadcrumbs__list-link">
                                    Ссылка
                                </a>
                            </li>
                            <li class="breadcrumbs__list-item">
                                <a href="#" class="breadcrumbs__list-link active">
                                    Ссылка
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </section>
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
        <section class="about">
            <div class="container">
                <div class="about__container content">

                    <div class="about__block">
                        <div class="about__block-img">
                            @if($about->project_manager_photo)
                                <img src="{{ asset('storage/' . $about->project_manager_photo) }}" alt=""/>
                            @else
                                <img src="{{asset('img/soldier-2.jpg')}}" alt=""/>
                            @endif
                        </div>
                        <div class="about__block-info">
                            <div class="about__block-info">
                                <h2 class="about__block-title title">
                                    {{ $about->project_manager_name }}
                                </h2>
                                <div class="about__block-text">
                                    {!! $about->project_manager_text !!}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="about__contact">
                        <div class="about__contact-block">
                            <div class="about__contact-img">
                                @if($about->project_goal_photo)
                                    <img src="{{ asset('storage/' . $about->project_goal_photo) }}" alt=""/>
                                @else
                                    <img src="{{asset('img/soldier-2.jpg')}}" alt=""/>
                                @endif
                            </div>
                            <div class="about__contact-info">
                                <div class="about__contact-title title">КОНТАКТЫ</div>
                                <ul class="about__contact-list">

                                    @if($contacts-> phone_1)
                                        <li>
                                            <a href="tel:{{$contacts->phone_1}}">{{$contacts->phone_1}}</a>
                                        </li>
                                    @endif
                                    @if($contacts-> phone_2)
                                        <li>
                                            <a href="tel:{{$contacts->phone_2}}">{{$contacts->phone_2}}</a>
                                        </li>
                                    @endif
                                    @if($contacts-> email)
                                        <li>
                                            <a href="mailto:{{$contacts->email}}">{{$contacts->email}}</a>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                        <div class="about__contact-text">
                            <div
                                class="about__contact-subtitle title">  {{ $about->project_goal_title ?? 'ЦЕЛЬ ПРОЕКТА' }}</div>
                            {!! $about->project_goal_text !!}
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <x-feedback-form/>

    </main>
@endsection

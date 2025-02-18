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
                            <a href="#" class="breadcrumbs__list-link active">Политика конфиденциальности</a>
                        </li>
                    </ul>
                </div>
            </div>
        </section>
        <section class="info politics">
            <div class="container">
                <div class="info__container">
                    <h1 class="info__title title">{{$page->components[0]->title}}</h1>
                    <div class="info__text">
                        {!! $page->components[0]->description !!}
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection

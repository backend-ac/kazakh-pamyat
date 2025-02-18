@extends('layouts.index')
@section('content')
    <main>
        <section class="breadcrumbs @@class">
            <div class="container">
                <div class="breadcrumbs__container">
                    <ul class="breadcrumbs__list">
                        <li class="breadcrumbs__list-item">
                            <a href="#" class="breadcrumbs__list-link">Главная</a>
                        </li>
                        <li class="breadcrumbs__list-item">
                            <a href="#" class="breadcrumbs__list-link active">О компании</a>
                        </li>
                    </ul>
                </div>
            </div>
        </section>
        <section class="notfound">
            <div class="container">
                <img src="img/404.png" alt=""/>
            </div>
        </section>
    </main>
@endsection

<header class="header way way-header">
    <div class="header__top">
        <div class="container">
            <div class="header__container">
                <a href="/" class="header__logo">
                    <img src="{{asset('img/logo.png')}}" alt="" />
                </a>
                <nav class="header__nav">
                    <ul class="header__nav-list">
                        <li class="header__nav-item">
                            <a href="/" class="header__nav-link {{ request()->routeIs('index') ? 'active' : '' }}">Главная</a>
                        </li>
                        <li class="header__nav-item">
                            <a href="/about" class="header__nav-link {{ request()->routeIs('about') ? 'active' : '' }}">О проекте</a>
                        </li>
                        <li class="header__nav-item">
                            <a
                                href="javascript:;"
                                class="header__nav-link js-dropdown-btn"
                            >Участники войны</a
                            >
                        </li>
                        <!-- <li class="header__nav-item">
                            <a href="/history" class="header__nav-link {{ request()->routeIs('history') ? 'active' : '' }}">Ваши истории</a>
                        </li> -->
                    </ul>
                </nav>
                <div class="burger" id="menu-icon">
                    <div
                        class="burger__dot burger__dot--line burger__dot--left-top"
                    ></div>
                    <div class="burger__dot burger__dot--aside"></div>
                    <div
                        class="burger__dot burger__dot--line burger__dot--right-top"
                    ></div>
                    <div class="burger__dot burger__dot--aside"></div>
                    <div class="burger__dot burger__dot--aside"></div>
                    <div class="burger__dot burger__dot--aside"></div>
                    <div
                        class="burger__dot burger__dot--line burger__dot--left-bottom"
                    ></div>
                    <div class="burger__dot burger__dot--aside"></div>
                    <div
                        class="burger__dot burger__dot--line burger__dot--right-bottom"
                    ></div>
                </div>
            </div>
        </div>

        <div class="header__dropdown">
            <div class="container">
                <div class="header__dropdown-block">
                    <div class="header__dropdown-list">
                        @foreach($places as $place)
                            <a
                                href="javascript:;"
                                data-id="{{ $place->id }}"
                                class="header__dropdown-village @if($loop->first) active @endif"
                            >
                                {{ $place->title }}
                            </a>
                        @endforeach
                    </div>
                    <div class="header__dropdown-heroes">
                        @foreach($places as $place)
                            @foreach($place->participants as $participant)
                                <a
                                    href="{{ route('participant.show', $participant->id) }}"
                                    data-id="{{ $place->id }}"
                                    class="header__dropdown-name @if($loop->parent->first) active @endif"
                                >
                                    {{ $participant->name }}
                                </a>
                            @endforeach
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="header__bot">
        <div class="container">
            <div class="header__villages">
                @foreach($places as $place)
                    <a href="{{ route('place.show', $place->id) }}">
                        {{ $place->title }}
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</header>
<div class="header-space"></div>

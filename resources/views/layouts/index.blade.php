<!doctype html>
<html lang="{{app()->getLocale()}}">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="{{asset('img/favicon.png')}}" type="image/x-icon" />
    @yield('meta')
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/8.4.5/swiper-bundle.css?_v=20250127180612"
    />
    <link rel="stylesheet" href="{{asset('css/style.css?_v=2.14')}}" />
</head>
<body>
@include('layouts.header')
@yield('content')
@include('layouts.footer')
<!-- Модальное окно -->
@if(session('success'))
    <div id="modal-overlay" class="modal-overlay">
        <div class="custom-modal">
            <div class="modal-header">
                <span class="modal-title">Успех!</span>
                <span class="close-btn" onclick="closeModal();">&times;</span>
            </div>
            <div class="modal-content">
                {{ session('success') }}
            </div>
        </div>
    </div>
@endif
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var modalOverlay = document.getElementById('modal-overlay');

        // Функция для закрытия модального окна
        function closeModal() {
            modalOverlay.classList.remove('show');
            setTimeout(function() {
                modalOverlay.style.display = 'none';
            }, 300); // Время должно совпадать с transition
        }

        // Показываем модальное окно с анимацией
        if (modalOverlay) {
            modalOverlay.style.display = 'flex';
            setTimeout(function() {
                modalOverlay.classList.add('show');
            }, 10); // Небольшая задержка для запуска анимации

            // Закрытие модального окна через 3 секунды
            setTimeout(function() {
                closeModal();
            }, 3000);

            // Закрытие модального окна при нажатии на затемненный фон
            modalOverlay.addEventListener('click', function(event) {
                if (event.target === modalOverlay) {
                    closeModal();
                }
            });
        }
    });
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/8.4.5/swiper-bundle.min.js?_v=20250127180612"></script>
<script src="{{asset('js/jquery-3.6.0.min.js?_v=20250127180612')}}"></script>
<script src="{{asset('js/jquery-marquee.js?_v=20250127180612')}}"></script>
<script src="{{asset('js/app.js?_v=20250127180612')}}"></script>
<div class="popup form_loader" id="form_loader ">
    <div class="form_loader_block">
        <div class="form_loader_animate"></div>
        <div class="form_loader_text" style="color: #000">
            Пожалуйста, подождите
        </div>
    </div>
</div>
</body>
</html>

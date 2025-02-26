<section class="feedback">
    <div class="container">
        <div class="feedback__container content">
            <h2 class="feedback__title title">Оставьте свою историю</h2>
            <h3 class="feedback__subtitle">
                Форма для занесения новых данных о погибших и исправления ошибок
            </h3>
            <form action="{{ route('stories.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="feedback__form">
                    <input
                        type="text"
                        name="sender_name"
                        required
                        placeholder="ФИО отправителя"
                        value="{{ old('sender_name') }}"
                    />
                    <input
                        type="text"
                        name="name"
                        required
                        placeholder="ФИО погибшего"
                        value="{{ old('name') }}"
                    />
                    <label for="file-1" class="feedback__file">
                        <input type="file" id="file-1" name="photo"/>
                        <svg
                            width="34"
                            height="42"
                            viewBox="0 0 34 42"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                d="M21 1V9.88889C21 11.1162 21.9949 12.1111 23.2222 12.1111H32.1111"
                                stroke="#1FA7F1"
                                stroke-width="2"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            />
                            <path
                                fill-rule="evenodd"
                                clip-rule="evenodd"
                                d="M27.6667 41H5.44444C2.98985 41 1 39.0102 1 36.5556V5.44444C1 2.98985 2.98985 1 5.44444 1H21L32.1111 12.1111V36.5556C32.1111 39.0102 30.1213 41 27.6667 41Z"
                                stroke="#1FA7F1"
                                stroke-width="2"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            />
                            <path
                                d="M16.5554 18.7778V32.1112"
                                stroke="#1FA7F1"
                                stroke-width="2"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            />
                            <path
                                d="M11 24.3334L16.5556 18.7778L22.1111 24.3334"
                                stroke="#1FA7F1"
                                stroke-width="2"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            />
                        </svg>
                        <span>
                            Прикрепите фото погибшего или документов при наличии
                        </span>
                    </label>
                    <textarea
                        name="user_message"
                        placeholder="Сообщение"
                    >{{ old('user_message') }}</textarea>
                    <button type="submit" class="feedback__submit">
                        Отправить
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>

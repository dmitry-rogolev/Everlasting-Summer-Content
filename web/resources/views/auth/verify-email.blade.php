<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <x-body>
        <x-element.background>
            <x-element.flex flex="align-items-center justify-content-center vh-100">
                <div class="col-xl-4 col-lg-5 col-md-7 col-sm-10 col-11 px-0 py-3">
                    <x-element.flex flex="flex-column" class="{{ 'bg-' . $theme }} shadow-lg pb-3" style="border-radius: 20px;">
                        <header class="col-12 px-0">
                            <a 
                                href="{{ url('/') }}"
                                class="d-block p-3 text-center cursor-pointer text-decoration-none {{ 'text-' . $inversion_themes->get($theme) }}"
                                style="border-top-left-radius: 20px; border-top-right-radius: 20px;"
                                >
                                <h2 class="mb-0">
                                    {{ $header }}
                                </h2>
                            </a>
                        </header>
                        <main class="col-12 pt-3 text-{{ $inversion_themes->get($theme) }}">
                            <p>
                                Спасибо, что зарегистрировались! Прежде чем приступить к работе, не могли бы вы подтвердить свой адрес электронной почты, перейдя по ссылке, которую мы только что отправили вам по электронной почте? Если вы не получили электронное письмо, мы с радостью вышлем вам другое. 
                            </p>
                            @if (session('status') == 'verification-link-sent')
                                <p>
                                    Новая ссылка для подтверждения была отправлена на адрес электронной почты, который вы указали при регистрации.
                                </p>
                            @endif
                            <x-element.flex flex="flex-sm-row flex-column align-items-center justify-content-sm-between justify-content-center">
                                <form method="POST" action="{{ route('verification.send') }}">
                                    <x-element.form.group>
                                        @csrf
                                    </x-element.form.group>
                                    <x-element.form.group>
                                        <x-element.form.button type="submit" class="btn-lg btn-{{ $inversion_themes->get($theme) }}" tabindex="1">
                                            Отправить письмо еще раз
                                        </x-element.form.button>
                                    </x-element.form.group>
                                </form>
                                <form class="mt-sm-0 mt-3" method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <a href="{{ route('logout') }}" tabindex="2" onclick="event.preventDefault();this.closest('form').submit();">
                                        Выйти
                                    </a>
                                </form>
                            </x-element.flex>
                        </main>
                    </x-element.flex>
                </div>
            </x-element.flex>
        </x-element.background>
    </x-body>
</x-layout>
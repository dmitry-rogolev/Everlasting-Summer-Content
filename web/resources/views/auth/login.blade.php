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
                            <h4 class="mb-0 text-center text-{{ $inversion_themes->get($theme) }}">Вход</h4>
                            <x-auth.session-status />
                            <x-auth.error />
                            <form method="POST" action="{{ route('login') }}">
                                <x-element.form.group>
                                    @csrf
                                </x-element.form.group>
                                <x-element.form.group>
                                    <x-element.form.input type="email" class="form-control-lg bg-{{ $theme }} text-{{ $inversion_themes->get($theme) }}" name="email" label="Электронная почта" placeholder="Электронная почта" :value="old('email')" required autocomplete="off" accesskey="e" autofocus tabindex="1" />
                                </x-element.form.group>
                                <x-element.form.group>
                                    <x-element.form.input type="password" class="form-control-lg bg-{{ $theme }} text-{{ $inversion_themes->get($theme) }}" name="password" label="Пароль" placeholder="Пароль" required autocomplete="off" accesskey="p" tabindex="2" />
                                </x-element.form.group>
                                <x-element.form.group>
                                    <x-element.form.custom.checkbox name="remember" label="Запомните меня" tabindex="3" />
                                </x-element.form.group>
                                @if (Route::has('password.request'))
                                    <x-element.form.group class="text-center">
                                        <a href="{{ route('password.request') }}">Забыли пароль?</a>
                                    </x-element.form.group>
                                @endif
                                <x-element.form.group class="text-center">
                                    <x-element.form.button type="submit" class="btn-lg btn-{{ $inversion_themes->get($theme) }}" tabindex="5">
                                        Войти
                                    </x-element.form.button>
                                </x-element.form.group>
                            </form>
                        </main>
                    </x-element.flex>
                </div>
            </x-element.flex>
        </x-element.background>
    </x-body>
</x-layout>
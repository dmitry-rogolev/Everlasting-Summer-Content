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
                            <x-auth.error />
                            <form method="POST" action="{{ route('password.update') }}">
                                <x-element.form.group>
                                    @csrf
                                </x-element.form.group>
                                <x-element.form.group>
                                    <x-element.form.input type="hidden" name="token" value="{{ $request->route('token') }}" />
                                </x-element.form.group>
                                <x-element.form.group>
                                    <x-element.form.input type="email" class="form-control-lg bg-{{ $theme }} text-{{ $inversion_themes->get($theme) }}" name="email" label="{{ __('auth.email') }}" placeholder="{{ __('auth.email') }}" :value="old('email')" required autocomplete="off" accesskey="e" tabindex="1" />
                                </x-element.form.group>
                                <x-element.form.group>
                                    <x-element.form.input type="password" class="form-control-lg bg-{{ $theme }} text-{{ $inversion_themes->get($theme) }}" name="password" label="{{ __('auth.reset-password.new-password') }}" placeholder="{{ __('auth.reset-password.new-password') }}" required autocomplete="off" accesskey="p" tabindex="2" />
                                </x-element.form.group>
                                <x-element.form.group>
                                    <x-element.form.input type="password" class="form-control-lg bg-{{ $theme }} text-{{ $inversion_themes->get($theme) }}" name="password_confirmation" label="{{ __('auth.confirm') }}" placeholder="{{ __('auth.confirm') }}" required autocomplete="off" accesskey="c" tabindex="3" />
                                </x-element.form.group>
                                <x-element.form.group class="text-center mt-4">
                                    <x-element.form.button type="submit" class="btn-lg btn-{{ $inversion_themes->get($theme) }}" tabindex="5">
                                        {{ __('auth.reset-password.reset') }}
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
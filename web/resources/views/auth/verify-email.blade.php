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
                                {{ __('auth.verify-email.thanks') }}
                            </p>
                            @if (session('status') == 'verification-link-sent')
                                <p>
                                    {{ __('auth.verify-email.sent') }}
                                </p>
                            @endif
                            <x-element.flex flex="flex-sm-row flex-column align-items-center justify-content-sm-between justify-content-center">
                                <form method="POST" action="{{ route('verification.send') }}">
                                    <x-element.form.group>
                                        @csrf
                                    </x-element.form.group>
                                    <x-element.form.group>
                                        <x-element.form.button type="submit" class="btn-lg btn-{{ $inversion_themes->get($theme) }}" tabindex="1">
                                            {{ __('auth.verify-email.send') }}
                                        </x-element.form.button>
                                    </x-element.form.group>
                                </form>
                                <x-element.form.logout class="mt-sm-0 mt-3 cursor-pointer" />
                            </x-element.flex>
                        </main>
                    </x-element.flex>
                </div>
            </x-element.flex>
        </x-element.background>
    </x-body>
</x-layout>
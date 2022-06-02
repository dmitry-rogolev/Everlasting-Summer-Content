<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <x-body>
        <x-element.background>
            <x-element.flex flex="flex-column align-items-center justify-content-center vh-100">
                <div class="col-xl-5 col-lg-6 col-md-7 col-sm-9 col-11 px-0">
                    <x-element.flex flex="flex-column">
                        <header class="col-12 px-0">
                            <a 
                                href="{{ url('/') }}"
                                class="d-block p-3 text-center shadow-lg {{ 'bg-' . $theme }} cursor-pointer text-decoration-none {{ 'text-' . $inversion_themes->get($theme) }}"
                                style="border-top-left-radius: 15px; border-top-right-radius: 15px;"
                                >
                                <h1 class="mb-0">
                                    {{ $title }}
                                </h1>
                            </a>
                        </header>
                        <main class="col-12 {{ 'bg-' . $theme }}">
                            <form method="POST" action="{{ route('register') }}">
                                <x-element.form.group>
                                    
                                </x-element.form.group>
                            </form>
                        </main>
                    </x-element.flex>
                </div>
            </x-element.flex>
        </x-element.background>
    </x-body>
</x-layout>
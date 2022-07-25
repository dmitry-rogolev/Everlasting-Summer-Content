<x-layout>
    <x-slot:lang>{{ $lang }}</x-slot:lang>
    <x-slot:title>{{ $title }}</x-slot:title>
    <x-slot:description>{{ $description }}</x-slot:description>
    <x-slot:keywords>{{ $keywords }}</x-slot:keywords>
    <x-body>
        <x-element.background>
            <x-element.flex flex="align-items-center justify-content-center vh-100">
                <div class="col-xl-4 col-lg-5 col-md-7 col-sm-10 col-11 px-0 py-3">
                    <x-element.flex flex="flex-column" class="bg-{{ $theme }} shadow-lg pb-3" style="border-radius: 20px;">
                        <header class="col-12 px-0">
                            <a 
                                href="{{ route('welcome') }}"
                                class="d-block p-3 text-center cursor-pointer text-decoration-none text-{{ $inversion_themes->get($theme) }}"
                                style="border-top-left-radius: 20px; border-top-right-radius: 20px;"
                                >
                                <h2 class="mb-0">
                                    {{ $header }}
                                </h2>
                            </a>
                        </header>
                        <main class="col-12 pt-3 text-{{ $inversion_themes->get($theme) }}">
                            <p>
                                {{ __("page.user.delete-text") }}
                            </p>
                            <form class="text-center" action="{{ route('user.delete', [ 'user' => $user->id ]) }}" method="POST">
                                @csrf 
                                <x-element.form.button class="btn-danger" type="submit">
                                    {{ __("page.user.delete") }}
                                </x-element.form.button>
                            </form>
                        </main>
                    </x-element.flex>
                </div>
            </x-element.flex>
        </x-element.background>
    </x-body>
</x-layout>
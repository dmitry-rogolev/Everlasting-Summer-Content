<x-layout>
    <x-slot:lang>{{ $lang }}</x-slot:lang>
    <x-slot:title>{{ $title }}</x-slot:title>
    <x-body>
        <x-element.background>
            <x-element.flex flex="flex-column align-items-center">
                <header class="col-12 max-width-xl">
                    <x-element.flex>
                        <nav class="col-12 px-0">
                            <x-element.flex>
                                <div class="col-12 my-2 px-0">
                                    <x-body.header.menu login="true" />
                                </div>
                                <div class="col-12 mb-2 px-0">
                                    <x-body.header.breadcrumbs />
                                </div>
                            </x-element.flex>
                        </nav>
                        <section class="col-12 px-0">
                            <x-element.flex flex="justify-content-between">
                                <div class="col-2 p-0">
                                    @if ($referer)
                                        <x-element.flex>
                                            <a href="{{ $referer }}">
                                                <x-element.form.button class="btn-lg btn-{{ $theme }}" title="{{ __('header.back') }}">
                                                    &lt;
                                                </x-element.form.button>
                                            </a>
                                        </x-element.flex>
                                    @endif
                                </div>
                                <div class="col-2 p-0">
                                    @if ($header)
                                        <x-element.flex flex="justify-content-center">
                                            <x-element.header3>
                                                {{ $header }}
                                            </x-element.header3>
                                        </x-element.flex>
                                    @endif
                                </div>
                                <div class="col-2 p-0">
                                    <x-element.flex flex="justify-content-end">
                                        <a href="{{ url()->current() . '/download/all' }}">
                                            <x-element.form.button class="btn-lg btn-{{ $theme }}" title="{{ __('header.download-all') }}">
                                                &#10515;
                                            </x-element.form.button>
                                        </a>
                                    </x-element.flex>
                                </div>
                            </x-element.flex>
                        </section>
                    </x-element.flex>
                </header>
                <main class="col-12 max-width-xl">
                    <x-element.flex flex="flex-column">

                    </x-element.flex>
                </main>
            </x-element.flex>
        </x-element.background>
    </x-body>
</x-layout>
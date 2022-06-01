<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <x-body>
        <x-element.background>
            <x-element.flex flex="flex-column align-items-center">
                <x-body.header class="col-12 max-width-xl">
                    <x-element.flex>
                        <x-element.nav class="col-12 px-0">
                            <x-element.flex>
                                <x-element.div class="col-12 my-2 px-0">
                                    <x-body.header.menu login="true" />
                                </x-element.div>
                                <x-element.div class="col-12 mb-2 px-0">
                                    <x-body.header.breadcrumbs />
                                </x-element.div>
                            </x-element.flex>
                        </x-element.nav>
                        <x-element.section class="col-12 px-0">
                            <x-element.flex flex="justify-content-between">
                                <x-element.div class="col-2 p-0">
                                    @if ($referer && is_string($referer))
                                        <x-element.flex>
                                            <x-element.a href="{{ $referer }}">
                                                <x-element.button title="Назад">
                                                    &lt;
                                                </x-element.button>
                                            </x-element.a>
                                        </x-element.flex>
                                    @endif
                                </x-element.div>
                                <x-element.div class="col-2 p-0">
                                    @if ($header && is_string($header))
                                        <x-element.flex class="justify-content-center">
                                            <x-element.header3>
                                                {{ $header }}
                                            </x-element.header3>
                                        </x-element.flex>
                                    @endif
                                </x-element.div>
                                <x-element.div class="col-2 p-0">
                                    <x-element.flex flex="justify-content-end">
                                        <x-element.a href="{{ url()->current() . '/download/all' }}">
                                            <x-element.button title="Скачать все">
                                                &#10515;
                                            </x-element.button>
                                        </x-element.a>
                                    </x-element.flex>
                                </x-element.div>
                            </x-element.flex>
                        </x-element.section>
                    </x-element.flex>
                </x-body.header>
                <x-body.main class="col-12 max-width-xl">
                    <x-element.flex flex="flex-column">

                    </x-element.flex>
                </x-body.main>
            </x-element.flex>
        </x-element.background>
    </x-body>
</x-layout>
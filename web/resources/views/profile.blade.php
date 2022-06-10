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
                                    
                                </div>
                            </x-element.flex>
                        </section>
                    </x-element.flex>
                </header>
                <main class="col-12 max-width-xl">
                    <x-element.flex class="mt-3" flex="justify-content-center">
                        <div>
                            <form action="{{ route('profile') }}" method="POST">
                                <x-element.form.group class="mb-0">
                                    @csrf
                                </x-element.form.group>
                                <x-element.form.group class="mb-0">
                                    <x-element.modal.button class="p-0" style="border-radius: 15px;" target="#{{ $avatar->get('id') }}">
                                        <x-element.ticket style="height: 250px; width: 250px;">

                                        </x-element.ticket>
                                    </x-element.modal.button>
                                    <x-element.modal id="{{ $avatar->get('id') }}" labelledby="{{ $avatar->get('labelledby') }}">
                                        <x-element.modal.header class="border-bottom-0">
                                            <x-element.modal.title id="{{ $avatar->get('labelledby') }}">
                                                {{ $avatar->get('header') }}
                                            </x-element.modal.title>
                                            <x-element.modal.quit />
                                        </x-element.modal.header>
                                        <x-element.modal.body>
                                            <x-element.form.custom.file name="avatar" label="{{ $avatar->get('header') }}" accept="image/*" lang="{{ $lang }}" />
                                        </x-element.modal.body>
                                        <x-element.modal.footer class="border-top-0">
                                            <x-element.modal.close>
                                                {{ __('element.modal.close') }}
                                            </x-element.modal.close>
                                            <x-element.modal.save type="submit">
                                                {{ __('element.modal.save') }}
                                            </x-element.modal.save>
                                        </x-element.modal.footer>
                                    </x-element.modal>
                                </x-element.form.group>
                            </form>
                        </div>
                    </x-element.flex>
                </main>
            </x-element.flex>
        </x-element.background>
    </x-body>
</x-layout>
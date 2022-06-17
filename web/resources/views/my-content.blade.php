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
                                <div class="col-8 p-0">
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
                    <x-element.flex flex="flex-column align-items-center">
                        <x-auth.session-status />
                        <x-auth.error />
                        <x-element.flex flex="justify-content-center">
                            <div class="m-2">
                                <x-element.modal.button class="p-0" style="border-radius: 15px;" target="#{{ $add->get('id') }}" title="{{ __('page.my-content.add') }}">
                                    <x-element.ticket.link class="add add-hover" style="height: 250px; width: 250px; background-size: 80% 80%;">

                                    </x-element.ticket.link>
                                </x-element.modal.button>
                                <x-element.modal id="{{ $add->get('id') }}" labelledby="{{ $add->get('labelledby') }}">
                                    <form action="{{ route('my-content.add') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <x-element.modal.header class="border-bottom-0">
                                            <x-element.modal.title id="{{ $add->get('labelledby') }}">
                                                {{ $add->get('header') }}
                                            </x-element.modal.title>
                                            <x-element.modal.quit />
                                        </x-element.modal.header>
                                        <x-element.modal.body>
                                            <x-element.form.group>
                                                <x-element.form.input name="title" label="{{ __('page.my-content.name') }}" placeholder="{{ __('page.my-content.name') }}" value="{{ old('name') }}" autocomplete="off" />
                                            </x-element.form.group>
                                            <x-element.form.custom.file name="file" label="{{ $add->get('header') }}" lang="{{ $lang }}" required />
                                        </x-element.modal.body>
                                        <x-element.modal.footer class="border-top-0">
                                            <x-element.modal.close>
                                                {{ __('element.modal.close') }}
                                            </x-element.modal.close>
                                            <x-element.modal.save type="submit">
                                                {{ __('element.modal.save') }}
                                            </x-element.modal.save>
                                        </x-element.modal.footer>
                                    </form>
                                </x-element.modal>
                            </div>
                            @foreach ($contents as $content)
                                <div class="m-2">
                                    <x-element.ticket.content.link style="height: 250px; width: 250px;" href="{{ route('my-content.content', [ 'content' => $content->title ]) }}" image="/storage/contents/{{ request()->user()->id }}/{{ $content->hash . '.' . $content->extension }}" title="{{ $content->title }}">
                                        <x-element.ticket.content.link.name>
                                            {{ $content->title }}
                                        </x-element.ticket.content.link.name>
                                    </x-element.ticket.content.link>
                                </div>
                            @endforeach
                        </x-element.flex>
                    </x-element.flex>
                </main>
            </x-element.flex>
        </x-element.background>
    </x-body>
</x-layout>
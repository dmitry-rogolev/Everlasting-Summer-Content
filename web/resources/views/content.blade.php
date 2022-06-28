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
                                    <x-element.flex flex="justify-content-end">
                                        <form action="{{ url()->current() . '/download' }}" method="POST">
                                            @csrf
                                            <x-element.form.button type="submit" class="btn-lg btn-{{ $theme }}" title="{{ __('header.download') }}">
                                                &#10515;
                                            </x-element.form.button>
                                        </form>
                                    </x-element.flex>
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
                                <x-element.ticket.link href="{{ url($user->id . '/' . ($path ? $path . '/' : '') . $content->title . '.' . $content->extension) }}">
                                    <x-element.image src="/storage/contents/{{ $user->id }}/{{ ($path ? $path . '/' : $path) . Str::lower($content->title) . '.' . $content->extension }}" style="border-radius: 10.5px;" title="{{ $content->title }}" />
                                </x-element.ticket.link>
                            </div>
                        </x-element.flex>
                        <x-element.flex flex="justify-content-center">
                            @if ($can)
                                <div class="m-2">
                                    <x-element.modal.button class="btn-{{ $theme }}" target="#{{ $rename->get('id') }}">
                                        {{ __("page.content.rename") }}
                                    </x-element.modal.button>
                                    <x-element.modal id="{{ $rename->get('id') }}" labelledby="{{ $rename->get('labelledby') }}">
                                        <form action="{{ url($user->id . '/' . ($path ? $path . '/' : $path) . $header . '/rename') }}" method="POST">
                                            @csrf
                                            <x-element.modal.header class="border-bottom-0">
                                                <x-element.modal.title id="{{ $rename->get('labelledby') }}">
                                                    {{ __("page.content.renaming") }}
                                                </x-element.modal.title>
                                                <x-element.modal.quit />
                                            </x-element.modal.header>
                                            <x-element.modal.body>
                                                <x-element.form.group>
                                                    <x-element.form.input name="title" label="{{ __('page.my.name') }}" placeholder="{{ __('page.my.name') }}" value="{{ old('name') }}" autocomplete="off" />
                                                </x-element.form.group>
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
                            @endif
                            @if ($can)
                                <div class="m-2">
                                    <x-element.modal.button class="btn-danger" target="#{{ $remove->get('id') }}">
                                        {{ __("page.content.remove") }}
                                    </x-element.modal.button>
                                    <x-element.modal id="{{ $remove->get('id') }}" labelledby="{{ $remove->get('labelledby') }}">
                                        <form action="{{ url($user->id . '/' . ($path ? $path . '/' : $path) . $header . '/remove') }}" method="POST">
                                            @csrf
                                            <x-element.modal.header class="border-bottom-0">
                                                <x-element.modal.title id="{{ $remove->get('labelledby') }}">
                                                    {{ __("page.content.removing") }}
                                                </x-element.modal.title>
                                                <x-element.modal.quit />
                                            </x-element.modal.header>
                                            <x-element.modal.body>
                                                <p>
                                                    {{ __("page.content.remove-text") }}
                                                </p>
                                            </x-element.modal.body>
                                            <x-element.modal.footer class="border-top-0">
                                                <x-element.modal.close>
                                                    {{ __('element.modal.close') }}
                                                </x-element.modal.close>
                                                <x-element.modal.save type="submit" class="btn-danger">
                                                    {{ __("page.content.remove") }}
                                                </x-element.modal.save>
                                            </x-element.modal.footer>
                                        </form>
                                    </x-element.modal>
                                </div>
                            @endif
                        </x-element.flex>
                    </x-element.flex>
                </main>
            </x-element.flex>
        </x-element.background>
    </x-body>
</x-layout>
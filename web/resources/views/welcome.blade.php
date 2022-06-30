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
                    <x-element.flex class="mt-4" flex="justify-content-center">
                        {{ $contents->links("components.element.pagination", [ "theme" => $theme, "inversion_themes" => $inversion_themes ]) }}
                    </x-element.flex>
                    <x-element.flex flex="justify-content-center">
                        @foreach ($contents as $content)
                            <div class="m-2">
                                <x-element.ticket.content.link style="height: 250px; width: 250px;" href="{{ url($content->user_id . '/' . ($content->path ? $content->path . '/' : '') . $content->title) }}" image="/storage/contents/{{ $content->user_id }}/{{ ($content->path ? $content->path . '/' : '') . $content->name }}" title="{{ $content->title }}">
                                    <x-element.ticket.content.link.name>
                                        {{ $content->title }}
                                    </x-element.ticket.content.link.name>
                                </x-element.ticket.content.link>
                            </div>
                        @endforeach
                    </x-element.flex>
                    <x-element.flex class="my-4" flex="justify-content-center">
                        {{ $contents->links("components.element.pagination", [ "theme" => $theme, "inversion_themes" => $inversion_themes ]) }}
                    </x-element.flex>
                </main>
            </x-element.flex>
        </x-element.background>
    </x-body>
</x-layout>
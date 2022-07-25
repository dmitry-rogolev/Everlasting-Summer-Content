<x-layout>
    <x-slot:lang>{{ $lang }}</x-slot:lang>
    <x-slot:title>{{ $title }}</x-slot:title>
    <x-slot:description>{{ $description }}</x-slot:description>
    <x-slot:keywords>{{ $keywords }}</x-slot:keywords>
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
                                    <x-body.header.breadcrumbs :breadcrumbs="$breadcrumbs" />
                                </div>
                            </x-element.flex>
                        </nav>
                        <section class="col-12 px-0">
                            <x-element.flex flex="justify-content-between">
                                <div class="col-2 p-0">
                                    @if ($referer)
                                        <x-element.flex>
                                            <a href="{{ $referer }}">
                                                <x-element.form.button class="btn-lg btn-{{ $theme }}" title="{{ __('element.back') }}">
                                                    &lt;
                                                </x-element.form.button>
                                            </a>
                                        </x-element.flex>
                                    @endif
                                </div>
                                <div class="col-8 p-0">
                                    @if ($header)
                                        <x-element.flex flex="justify-content-center">
                                            <x-element.header3 title="{{ $header }}">
                                                {{ Str::limit($header, 40) }}
                                            </x-element.header3>
                                        </x-element.flex>
                                    @endif
                                </div>
                                <div class="col-2 p-0">
                                    <x-element.flex flex="justify-content-end">
                                        <form action="{{ route('content.download', [ 'content' => $content->id ]) }}" method="POST">
                                            @csrf
                                            <x-element.form.button type="submit" class="btn-lg btn-{{ $theme }}" title="{{ __('element.download') }}">
                                                &#10515;
                                            </x-element.form.button>
                                        </form>
                                    </x-element.flex>
                                </div>
                            </x-element.flex>
                        </section>
                    </x-element.flex>
                </header>
                <main class="col-12 max-width-xl pb-3">
                    <x-element.flex flex="flex-column align-items-center">
                        <x-auth.session-status />
                        <x-auth.error />
                        <x-body.main.content.control-panel :content="$content" :can="$can" />
                        <x-element.flex flex="justify-content-center">
                            <div class="m-2">
                                <x-element.ticket.link href="{{ route('content.only', [ 'content' => $content->id ]) }}">
                                    <x-element.image src="/storage/contents/{{ $content->user_id }}/{{ $content->path ? $content->path . '/' : '' }}{{ $content->name }}" style="border-radius: 10.5px;" title="{{ $content->title }}" />
                                </x-element.ticket.link>
                            </div>
                        </x-element.flex>
                        <x-body.main.content.info-panel :user="$user" :content="$content" />
                        <x-body.main.content.comment-panel :sort="$sort" :comments="$comments" :content="$content" />
                    </x-element.flex>
                </main>
            </x-element.flex>
        </x-element.background>
    </x-body>
</x-layout>
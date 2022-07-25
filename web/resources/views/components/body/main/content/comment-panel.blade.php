<x-element.flex flex="justify-content-between">
    <div class="col-2 m-2 px-0">

    </div>
    <div class="col-2 m-2 px-0">
        <x-element.flex flex="justify-content-center">
            <x-element.header3>{{ __("page.content.comments") }}</x-element.header3>
        </x-element.flex>
    </div>
    <div class="col-2 m-2 px-0">
        @if ($sort)
            <x-element.sort sort="{{ $sort }}" />
        @endif
    </div>
</x-element.flex>
@auth
    <x-element.flex flex="justify-content-center">
        <div class="m-2">
            <x-element.modal.button class="btn-{{ $theme }}" target="#{{ $add_comment->get('id') }}">
                {{ __("page.content.add-comment") }}
            </x-element.modal.button>
            <x-element.modal id="{{ $add_comment->get('id') }}" labelledby="{{ $add_comment->get('labelledby') }}">
                <form action="{{ route('content.comment', [ 'content' => $content->id ]) }}" method="POST">
                    @csrf
                    <x-element.modal.header class="border-bottom-0">
                        <x-element.modal.title id="{{ $add_comment->get('labelledby') }}">
                            {{ __("page.content.add-comment") }}
                        </x-element.modal.title>
                        <x-element.modal.quit />
                    </x-element.modal.header>
                    <x-element.modal.body>
                        <x-element.form.group>
                            <x-element.form.textarea name="comment" class="bg-{{ $theme }} text-{{ $inversion_themes->get($theme) }}" style="height: 100px;" placeholder="{{ __('page.content.comment') }}" label="{{ __('page.content.comment') }}" autocomplete="off" spellcheck required></x-element.form.textarea>
                        </x-element.form.group>
                    </x-element.modal.body>
                    <x-element.modal.footer class="border-top-0">
                        <x-element.modal.close>
                            {{ __('element.modal.close') }}
                        </x-element.modal.close>
                        <x-element.modal.save type="submit">
                            {{ __("element.modal.save") }}
                        </x-element.modal.save>
                    </x-element.modal.footer>
                </form>
            </x-element.modal>
        </div>
    </x-element.flex>
@endauth
<x-element.flex flex="flex-column">
    @foreach ($comments as $comment)
        <x-element.comment :comment="$comment" :content="$content" class="col-12 py-2 my-2" />
    @endforeach
</x-element.flex>
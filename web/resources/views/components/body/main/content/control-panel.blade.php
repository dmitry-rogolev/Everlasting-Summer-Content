@auth 
    @if ($can)
        <x-element.flex flex="justify-content-center">
            <div class="m-2">
                <x-element.modal.button class="btn-{{ $theme }}" target="#{{ $rename->get('id') }}">
                    {{ __("page.content.rename") }}
                </x-element.modal.button>
                <x-element.modal id="{{ $rename->get('id') }}" labelledby="{{ $rename->get('labelledby') }}">
                    <form action="{{ route('content.rename', [ 'content' => $content->id ]) }}" method="POST">
                        @csrf
                        <x-element.modal.header class="border-bottom-0">
                            <x-element.modal.title id="{{ $rename->get('labelledby') }}">
                                {{ __("page.content.rename") }}
                            </x-element.modal.title>
                            <x-element.modal.quit />
                        </x-element.modal.header>
                        <x-element.modal.body>
                            <x-element.form.group>
                                <x-element.form.input name="title" label="{{ __('page.folder.name') }}" placeholder="{{ __('page.folder.name') }}" value="{{ old('name') }}" autocomplete="off" />
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
            <div class="m-2">
                <x-element.modal.button class="btn-{{ $theme }}" target="#{{ $description->get('id') }}">
                    {{ __("page.content.description") }}
                </x-element.modal.button>
                <x-element.modal id="{{ $description->get('id') }}" labelledby="{{ $description->get('labelledby') }}">
                    <form action="{{ route('content.description', [ 'content' => $content->id ]) }}" method="POST">
                        @csrf
                        <x-element.modal.header class="border-bottom-0">
                            <x-element.modal.title id="{{ $description->get('labelledby') }}">
                                {{ __("page.content.change-description") }}
                            </x-element.modal.title>
                            <x-element.modal.quit />
                        </x-element.modal.header>
                        <x-element.modal.body>
                            <x-element.form.group>
                                <x-element.form.textarea label="{{ __('page.content.description') }}" placeholder="{{ __('page.content.description') }}" name="description" spellcheck autocomplete="off" style="height: 100px;">{{ $content->description }}</x-element.form.textarea>
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
            <div class="m-2">
                <x-element.modal.button class="btn-{{ $theme }}" target="#{{ $tags->get('id') }}">
                    {{ __("page.content.tags") }}
                </x-element.modal.button>
                <x-element.modal id="{{ $tags->get('id') }}" labelledby="{{ $tags->get('labelledby') }}">
                    <form action="{{ route('content.tags', [ 'content' => $content->id ]) }}" method="POST">
                        @csrf
                        <x-element.modal.header class="border-bottom-0">
                            <x-element.modal.title id="{{ $tags->get('labelledby') }}">
                                {{ __("page.content.tags") }}
                            </x-element.modal.title>
                            <x-element.modal.quit />
                        </x-element.modal.header>
                        <x-element.modal.body>
                            <x-element.form.group>
                                <x-element.form.textarea name="tags" style="height: 150px;" placeholder="{{ __('page.content.tags') }}" label="{{ __('page.content.tags-text') }}" autocomplete="off" spellcheck>{{ $content->tags }}</x-element.form.textarea>
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
            <div class="m-2">
                <form action="{{ route('content.visibility', [ 'content' => $content->id ]) }}" method="POST">
                    @csrf 
                    <x-element.form.button type="submit" class="btn-{{ $theme }}" title="{{ $content->visibility ? __('page.folder.private-text') : __('page.folder.public-text') }}">
                        {{ $content->visibility ? __("page.folder.public") : __("page.folder.private"), }}
                    </x-element.form.button>
                </form>
            </div>
            <div class="m-2">
                <x-element.modal.button class="btn-danger" target="#{{ $remove->get('id') }}">
                    {{ __("page.content.remove") }}
                </x-element.modal.button>
                <x-element.modal id="{{ $remove->get('id') }}" labelledby="{{ $remove->get('labelledby') }}">
                    <form action="{{ route('content.remove', [ 'content' => $content->id ]) }}" method="POST">
                        @csrf
                        <x-element.modal.header class="border-bottom-0">
                            <x-element.modal.title id="{{ $remove->get('labelledby') }}">
                                {{ __("page.content.remove") }}
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
        </x-element.flex>
    @endif
@endauth
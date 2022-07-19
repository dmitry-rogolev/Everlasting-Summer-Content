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
                                            @if (!$can && !$path)
                                                <a class="text-decoration-none" href="{{ url($user->id . '/profile') }}">
                                                    <button class="btn btn-{{ $theme }} btn-lg">
                                                            {{ $header }}
                                                    </button>    
                                                </a>
                                            @else 
                                                <x-element.header3 title="{{ $header }}">
                                                    {{ Str::limit($header, 40) }}
                                                </x-element.header3>
                                            @endif
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
                        <x-element.flex flex="justify-content-center align-items-center">
                            @if ($can)
                                <div class="m-2">
                                    <x-element.modal.button class="p-0" style="border-radius: 10px;" target="#{{ $create_folder->get('id') }}" title="{{ __('page.my.create-folder') }}">
                                        <x-element.ticket class="create-folder border-0" style="height: 60px; width: 60px;">

                                        </x-element.ticket>
                                    </x-element.modal.button>
                                    <x-element.modal id="{{ $create_folder->get('id') }}" labelledby="{{ $create_folder->get('labelledby') }}">
                                        <form action="{{ url($user->id . '/' . ($path ? $path . '/' : $path) . 'create-folder') }}" method="POST">
                                            @csrf
                                            <x-element.modal.header class="border-bottom-0">
                                                <x-element.modal.title id="{{ $create_folder->get('labelledby') }}">
                                                    {{ __("page.my.create-folder") }}
                                                </x-element.modal.title>
                                                <x-element.modal.quit />
                                            </x-element.modal.header>
                                            <x-element.modal.body>
                                                <x-element.form.group>
                                                    <x-element.form.input name="title" label="{{ __('page.my.folder') }}" placeholder="{{ __('page.my.folder') }}" value="{{ old('folder') }}" autocomplete="off" />
                                                </x-element.form.group>
                                                <x-element.form.group>
                                                    <x-element.form.custom.checkbox name="visibility" label="{{ __('page.my.public-text') }}" value="true" />
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
                                    <x-element.modal.button class="p-0" style="border-radius: 10px;" target="#{{ $add_content->get('id') }}" title="{{ __('page.my.add') }}">
                                        <x-element.ticket class="add border-0" style="height: 60px; width: 60px; background-size: 80% 80%;">

                                        </x-element.ticket>
                                    </x-element.modal.button>
                                    <x-element.modal id="{{ $add_content->get('id') }}" labelledby="{{ $add_content->get('labelledby') }}">
                                        <form action="{{ url($user->id . '/' . ($path ? $path . '/' : $path) . 'add-content') }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <x-element.modal.header class="border-bottom-0">
                                                <x-element.modal.title id="{{ $add_content->get('labelledby') }}">
                                                    {{ __("page.my.add") }}
                                                </x-element.modal.title>
                                                <x-element.modal.quit />
                                            </x-element.modal.header>
                                            <x-element.modal.body>
                                                <x-element.form.group>
                                                    <x-element.form.custom.file name="files[]" label="{{ __('page.my.add') }}" lang="{{ $lang }}" required multiple />
                                                </x-element.form.group>
                                                <x-element.form.group>
                                                    <x-element.form.custom.checkbox name="visibility" label="{{ __('page.my.public-text') }}" value="true" />
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
                            @if ($can && $rename->get("show"))
                                <div class="m-2">
                                    <x-element.modal.button class="btn-{{ $theme }}" target="#{{ $rename->get('id') }}">
                                        {{ __("page.content.rename") }}
                                    </x-element.modal.button>
                                    <x-element.modal id="{{ $rename->get('id') }}" labelledby="{{ $rename->get('labelledby') }}">
                                        <form action="{{ url($user->id . '/' . ($path ? $path . '/' : $path) . 'rename') }}" method="POST">
                                            @csrf
                                            <x-element.modal.header class="border-bottom-0">
                                                <x-element.modal.title id="{{ $rename->get('labelledby') }}">
                                                    {{ __("page.content.rename") }}
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
                                        <form action="{{ url($user->id . '/' . ($path ? $path . '/' : $path) . 'remove') }}" method="POST">
                                            @csrf
                                            <x-element.modal.header class="border-bottom-0">
                                                <x-element.modal.title id="{{ $remove->get('labelledby') }}">
                                                    {{ __("page.content.remove") }}
                                                </x-element.modal.title>
                                                <x-element.modal.quit />
                                            </x-element.modal.header>
                                            <x-element.modal.body>
                                                <p>
                                                    {{ __("page.my.remove-text") }}
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
                            @if ($can)
                                <div class="m-2">
                                    <form action="{{ url($user->id . '/' . ($path ? $path . '/' : '') . 'visibility') }}" method="POST">
                                        @csrf 
                                        <x-element.form.button type="submit" class="btn-{{ $theme }}" title="{{ $visibility->get('title') }}">
                                            {{ $visibility->get("header") }}
                                        </x-element.form.button>
                                    </form>
                                </div>
                            @endif
                        </x-element.flex>
                        <x-element.flex class="mb-3" flex="justify-content-end">
                            <a href="{{ url()->current() . '/?sort=' . ($sort == 'asc' ? 'desc' : 'asc') }}">
                                <x-element.form.button class="btn-{{ $theme }} drop {{ $sort == 'asc' ? 'active' : '' }}" title="{{ $sort == 'asc' ? __('element.sort.up') : __('element.sort.down') }}"></x-element.form.button>
                            </a>
                        </x-element.flex>
                        <x-element.flex flex="justify-content-center">
                            @foreach ($contents as $content)
                                @if ($content instanceof App\Models\Folder)
                                    <div class="m-2">
                                        <x-element.ticket.content.link style="height: 250px; width: 250px; background-size: 70% 70%;" class="folder folder-hover" href="{{ url()->current() . '/' . $content->title }}" title="{{ __($content->title) }}">
                                            <x-element.ticket.content.link.name>
                                                {{ Str::limit($content->title, 40) }}
                                            </x-element.ticket.content.link.name>
                                        </x-element.ticket.content.link>
                                    </div>
                                @else 
                                    <div class="m-2">
                                        <x-element.ticket.content.link style="height: 250px; width: 250px;" href="{{ url($content->user_id . '/' . ($content->path ? $content->path . '/' : '') . $content->title) }}" image="/storage/contents/{{ $content->user_id }}/{{ ($content->path ? $content->path . '/' : '') . $content->name }}" title="{{ $content->title }}">
                                            <x-element.ticket.content.link.name>
                                                {{ Str::limit($content->title, 40) }}
                                            </x-element.ticket.content.link.name>
                                        </x-element.ticket.content.link>
                                    </div>
                                @endif
                            @endforeach
                        </x-element.flex>
                    </x-element.flex>
                </main>
            </x-element.flex>
        </x-element.background>
    </x-body>
</x-layout>
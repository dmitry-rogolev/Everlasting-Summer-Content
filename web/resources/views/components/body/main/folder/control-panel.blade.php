@auth
    @if ($can)
        <x-element.flex flex="justify-content-center align-items-center">
            <div class="m-2">
                <x-element.modal.button class="p-0" style="border-radius: 10px;" target="#{{ $new->get('id') }}" title="{{ __('page.folder.create-folder') }}">
                    <x-element.ticket class="create-folder border-0" style="height: 60px; width: 60px;">

                    </x-element.ticket>
                </x-element.modal.button>
                <x-element.modal id="{{ $new->get('id') }}" labelledby="{{ $new->get('labelledby') }}">
                    <form action="{{ route('folder.new', [ 'folder' => $folder->id ]) }}" method="POST">
                        @csrf
                        <x-element.modal.header class="border-bottom-0">
                            <x-element.modal.title id="{{ $new->get('labelledby') }}">
                                {{ __("page.folder.create-folder") }}
                            </x-element.modal.title>
                            <x-element.modal.quit />
                        </x-element.modal.header>
                        <x-element.modal.body>
                            <x-element.form.group>
                                <x-element.form.input name="title" label="{{ __('page.folder.folder') }}" placeholder="{{ __('page.folder.folder') }}" value="{{ old('folder') }}" autocomplete="off" />
                            </x-element.form.group>
                            <x-element.form.group>
                                <x-element.form.custom.checkbox name="visibility" label="{{ __('page.folder.public-text') }}" value="true" />
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
                <x-element.modal.button class="p-0" style="border-radius: 10px;" target="#{{ $add->get('id') }}" title="{{ __('page.folder.add') }}">
                    <x-element.ticket class="add border-0" style="height: 60px; width: 60px; background-size: 80% 80%;">

                    </x-element.ticket>
                </x-element.modal.button>
                <x-element.modal id="{{ $add->get('id') }}" labelledby="{{ $add->get('labelledby') }}">
                    <form action="{{ route('folder.add', [ 'folder' => $folder->id ]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <x-element.modal.header class="border-bottom-0">
                            <x-element.modal.title id="{{ $add->get('labelledby') }}">
                                {{ __("page.folder.add") }}
                            </x-element.modal.title>
                            <x-element.modal.quit />
                        </x-element.modal.header>
                        <x-element.modal.body>
                            <x-element.form.group>
                                <x-element.form.custom.file name="files[]" label="{{ __('page.folder.add') }}" required multiple accept="image/png, image/jpg, image/jpeg, image/gif" />
                            </x-element.form.group>
                            <x-element.form.group>
                                <x-element.form.custom.checkbox name="visibility" label="{{ __('page.folder.public-text') }}" value="true" />
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
            @if ($folder->folder_id)
                <div class="m-2">
                    <x-element.modal.button class="btn-{{ $theme }}" target="#{{ $rename->get('id') }}">
                        {{ __("page.content.rename") }}
                    </x-element.modal.button>
                    <x-element.modal id="{{ $rename->get('id') }}" labelledby="{{ $rename->get('labelledby') }}">
                        <form action="{{ route('folder.rename', [ 'folder' => $folder->id ]) }}" method="POST">
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
            @endif
            <div class="m-2">
                <x-element.modal.button class="btn-danger" target="#{{ $remove->get('id') }}">
                    {{ __("page.content.remove") }}
                </x-element.modal.button>
                <x-element.modal id="{{ $remove->get('id') }}" labelledby="{{ $remove->get('labelledby') }}">
                    <form action="{{ route('folder.remove', [ 'folder' => $folder->id ]) }}" method="POST">
                        @csrf
                        <x-element.modal.header class="border-bottom-0">
                            <x-element.modal.title id="{{ $remove->get('labelledby') }}">
                                {{ __("page.content.remove") }}
                            </x-element.modal.title>
                            <x-element.modal.quit />
                        </x-element.modal.header>
                        <x-element.modal.body>
                            <p>
                                {{ __("page.folder.remove-text") }}
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
            <div class="m-2">
                <form action="{{ route('folder.visibility', [ 'folder' => $folder->id ]) }}" method="POST">
                    @csrf 
                    <x-element.form.button type="submit" class="btn-{{ $theme }}" title="{{ $folder->visibility ? __('page.folder.private-text') : __('page.folder.public-text') }}">
                        {{ $folder->visibility ? __("page.folder.public") : __("page.folder.private") }}
                    </x-element.form.button>
                </form>
            </div>
        </x-element.flex>
    @endif
@endauth

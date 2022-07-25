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
                            @if ($can)
                                <div class="m-2">
                                    <x-element.modal.button class="p-0" style="border-radius: 15px;" target="#{{ $avatar->get('id') }}" title="{{ __('element.change') }}">
                                        @if ($user->avatar)
                                            <x-element.ticket.photo style="height: 250px; width: 250px;" image="/storage/avatars/{{ $user->id }}/{{ $user->avatar->title }}.{{ $user->avatar->extension }}"></x-element.ticket.photo>
                                        @else
                                            <x-element.ticket.photo style="height: 250px; width: 250px;"></x-element.ticket.photo>
                                        @endif
                                    </x-element.modal.button>
                                    <x-element.modal id="{{ $avatar->get('id') }}" labelledby="{{ $avatar->get('labelledby') }}">
                                        <form action="{{ route('user.avatar', [ 'user' => $user->id ]) }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <x-element.modal.header class="border-bottom-0">
                                                <x-element.modal.title id="{{ $avatar->get('labelledby') }}">
                                                    {{ __("page.user.avatar") }}
                                                </x-element.modal.title>
                                                <x-element.modal.quit />
                                            </x-element.modal.header>
                                            <x-element.modal.body>
                                                <x-element.form.custom.file name="avatar" label="{{ __('page.user.avatar') }}" accept="image/jpg, image/jpeg, image/png, image/gif" lang="{{ $lang }}" required />
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
                            @else 
                                <div class="m-2">
                                    @if ($user->avatar)
                                        <x-element.ticket.photo style="height: 250px; width: 250px;" image="/storage/avatars/{{ $user->id }}/{{ $user->avatar->title }}.{{ $user->avatar->extension }}"></x-element.ticket.photo>
                                    @else
                                        <x-element.ticket.photo style="height: 250px; width: 250px;"></x-element.ticket.photo>
                                    @endif
                                </div>
                            @endif
                            <div class="bg-{{ $theme }} text-{{ $inversion_themes->get($theme) }} shadow-lg p-3 m-2" style="border-radius: 15px; min-width: 250px; min-height: 250px;">
                                <x-element.flex flex="flex-column align-items-start">
                                    @if ($can)
                                        <x-element.modal.button class="w-100 text-{{ $inversion_themes->get($theme) }}" target="#{{ $name->get('id') }}" title="{{ __('element.change') }}">
                                            <h3>
                                                {{ $user->name }}
                                            </h3>
                                        </x-element.modal.button>
                                        <x-element.modal id="{{ $name->get('id') }}" labelledby="{{ $name->get('labelledby') }}">
                                            <form action="{{ route('user.name', [ 'user' => $user->id ]) }}" method="POST">
                                                @csrf 
                                                <x-element.modal.header class="border-bottom-0">
                                                    <x-element.modal.title id="{{ $name->get('labelledby') }}">
                                                        {{ __("page.user.name") }}
                                                    </x-element.modal.title>
                                                    <x-element.modal.quit />
                                                </x-element.modal.header>
                                                <x-element.modal.body>
                                                    <x-element.form.input name="name" placeholder="{{ __('page.user.name') }}" value="{{ old('name') }}" autocomplete="off" />
                                                </x-element.modal.body>
                                                <x-element.modal.footer class="border-top-0">
                                                    <x-element.modal.close>
                                                        {{ __("element.modal.close") }}
                                                    </x-element.modal.close>
                                                    <x-element.modal.save type="submit">
                                                        {{ __("element.modal.save") }}
                                                    </x-element.modal.save>
                                                </x-element.modal.footer>
                                            </form>
                                        </x-element.modal>
                                    @else 
                                        <h3 class="text-center w-100">
                                            {{ $user->name }}
                                        </h3>
                                    @endif
                                    <p class="text-secondary mb-0">{{ __("page.user.email") }}</p>
                                    @if (!$can && !$user->email_visibility)
                                        <p>{{ __("page.user.email-hidden") }}</p>
                                    @else 
                                        @if ($can)
                                            <x-element.modal.button class="text-{{ $inversion_themes->get($theme) }} mb-2" target="#{{ $email->get('id') }}" title="{{ __('element.change') }}">
                                                {{ $user->email }}
                                            </x-element.modal.button>
                                            <x-element.modal id="{{ $email->get('id') }}" labelledby="{{ $email->get('labelledby') }}">
                                                <form action="{{ route('user.email', [ 'user' => $user->id ]) }}" method="POST">
                                                    @csrf
                                                    <x-element.modal.header class="border-bottom-0">
                                                        <x-element.modal.title id="{{ $email->get('labelledby') }}">
                                                            {{ __("page.user.email") }}
                                                        </x-element.modal.title>
                                                        <x-element.modal.quit />
                                                    </x-element.modal.header>
                                                    <x-element.modal.body>
                                                        <x-element.form.input type="email" name="email" placeholder="{{ __('page.user.email') }}" value="{{ old('email') }}" autocomplete="off" required />
                                                    </x-element.modal.body>
                                                    <x-element.modal.footer class="border-top-0">
                                                        <x-element.modal.close>
                                                            {{ __("element.modal.close") }}
                                                        </x-element.modal.close>
                                                        <x-element.modal.save type="submit">
                                                            {{ __("element.modal.save") }}
                                                        </x-element.modal.save>
                                                    </x-element.modal.footer>
                                                </form>
                                            </x-element.modal>
                                        @else 
                                            <p>{{ $user->email }}</p>
                                        @endif
                                    @endif
                                    @if ($can)
                                        <form action="{{ route('user.email-visibility', [ 'user' => $user->id ]) }}" class="mb-2" method="POST">
                                            @csrf
                                            @if ($user->email_visibility)
                                                <x-element.form.custom.checkbox name="email_visibility" label="{{ __('page.user.email-visibility') }}" value="1" onchange="this.closest('form').submit()" />
                                            @else 
                                                <x-element.form.custom.checkbox name="email_visibility" label="{{ __('page.user.email-visibility') }}" checked value="1" onchange="this.closest('form').submit()" />
                                            @endif
                                        </form>
                                    @endif
                                    @if ($can)
                                        <x-element.modal.button class="text-primary" target="#{{ $password->get('id') }}">
                                            {{ __("page.user.change-password") }}
                                        </x-element.modal.button>
                                        <x-element.modal id="{{ $password->get('id') }}" labelledby="{{ $password->get('labelledby') }}">
                                            <form action="{{ route('user.password', [ 'user' => $user->id ]) }}" method="POST">
                                                @csrf 
                                                <x-element.modal.header class="border-bottom-0">
                                                    <x-element.modal.title id="{{ $password->get('labelledby') }}">
                                                        {{ __("page.user.changing-password") }}
                                                    </x-element.modal.title>
                                                    <x-element.modal.quit />
                                                </x-element.modal.header>
                                                <x-element.modal.body>
                                                    <x-element.form.group>
                                                        <x-element.form.input type="password" name="old_password" placeholder="{{ __('page.user.old-password') }}" label="{{ __('page.user.old-password') }}" autocomplete="off" required />
                                                    </x-element.form.group>
                                                    <x-element.form.group>
                                                        <x-element.form.input type="password" name="password" placeholder="{{ __('page.user.new-password') }}" label="{{ __('page.user.new-password') }}" autocomplete="off" required />
                                                    </x-element.form.group>
                                                    <x-element.form.group>
                                                        <x-element.form.input type="password" name="password_confirmation" placeholder="{{ __('page.user.confirm') }}" label="{{ __('page.user.confirm') }}" autocomplete="off" required />
                                                    </x-element.form.group>
                                                </x-element.modal.body>
                                                <x-element.modal.footer class="border-top-0">
                                                    <x-element.modal.close>
                                                        {{ __("element.modal.close") }}
                                                    </x-element.modal.close>
                                                    <x-element.modal.save type="submit">
                                                        {{ __("element.modal.save") }}
                                                    </x-element.modal.save>
                                                </x-element.modal.footer>
                                            </form>
                                        </x-element.modal>
                                    @endif
                                    @if ($can)
                                        <form action="{{ route('user.avatar.remove', [ 'user' => $user->id ]) }}" method="POST">
                                            @csrf
                                            <x-element.form.button class="text-danger" type="submit">
                                                {{ __("page.user.remove-avatar") }}
                                            </x-element.form.button>
                                        </form>
                                    @endif
                                    @if ($can)
                                        <div>
                                            <a class="btn text-danger" href="{{ route('user.delete', [ 'user' => $user->id ]) }}">
                                                {{ __("page.user.delete") }}
                                            </a>
                                        </div>
                                    @endif
                                </x-element.flex>
                            </div>
                        </x-element.flex>
                        <x-element.flex flex="justify-content-center">
                            @if ($can)
                                <div>
                                    <x-element.ticket.link class="m-2 no-preview" style="width: 250px; height: 250px;" href="{{ route('folder', [ 'folder' => $user->folder()->first()->id ]) }}">
                                        <x-element.ticket.link.name>
                                            {{ __("page.folder.header") }}
                                        </x-element.ticket.link.name>
                                    </x-element.ticket.link>
                                </div>
                            @else 
                                @can ("visible", $user->folder()->first())
                                    <div>
                                        <x-element.ticket.link class="m-2 no-preview" style="width: 250px; height: 250px;" href="{{ route('folder', [ 'folder' => $user->folder()->first()->id ]) }}">
                                            <x-element.ticket.link.name>
                                                {{ __("page.folder.content") }}
                                            </x-element.ticket.link.name>
                                        </x-element.ticket.link>
                                    </div>
                                @endcan
                            @endif
                        </x-element.flex>
                    </x-element.flex>
                </main>
            </x-element.flex>
        </x-element.background>
    </x-body>
</x-layout>
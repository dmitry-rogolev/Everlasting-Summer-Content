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
                    <x-element.flex flex="flex-column align-items-center">
                        <x-auth.session-status />
                        <x-auth.error />
                        <x-element.flex flex="justify-content-center">
                            <div class="m-2">
                                <x-element.modal.button class="p-0" style="border-radius: 15px;" target="#{{ $avatar->get('id') }}" title="{{ __('page.profile.change') }}">
                                    <x-element.ticket style="height: 250px; width: 250px;" image="{{ $avatar->get('path') }}">

                                    </x-element.ticket>
                                </x-element.modal.button>
                                <x-element.modal id="{{ $avatar->get('id') }}" labelledby="{{ $avatar->get('labelledby') }}">
                                    <form action="{{ route('profile.avatar') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <x-element.modal.header class="border-bottom-0">
                                            <x-element.modal.title id="{{ $avatar->get('labelledby') }}">
                                                {{ $avatar->get('header') }}
                                            </x-element.modal.title>
                                            <x-element.modal.quit />
                                        </x-element.modal.header>
                                        <x-element.modal.body>
                                            <x-element.form.custom.file name="avatar" label="{{ $avatar->get('header') }}" accept="image/jpg, image/jpeg, image/png, image/gif" lang="{{ $lang }}" required />
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
                            <div class="bg-{{ $theme }} text-{{ $inversion_themes->get($theme) }} shadow-lg p-3 m-2" style="border-radius: 15px; min-width: 250px; min-height: 250px;">
                                <x-element.flex flex="flex-column align-items-start">
                                    <x-element.modal.button class="w-100 text-{{ $inversion_themes->get($theme) }}" target="#{{ $name->get('id') }}" title="{{ __('page.profile.change') }}">
                                        <h3>
                                            {{ request()->user()->name }}
                                        </h3>
                                    </x-element.modal.button>
                                    <x-element.modal id="{{ $name->get('id') }}" labelledby="{{ $name->get('labelledby') }}">
                                        <form action="{{ route('profile.name') }}" method="POST">
                                            @csrf 
                                            <x-element.modal.header class="border-bottom-0">
                                                <x-element.modal.title id="{{ $name->get('labelledby') }}">
                                                    {{ $name->get("header") }}
                                                </x-element.modal.title>
                                                <x-element.modal.quit />
                                            </x-element.modal.header>
                                            <x-element.modal.body>
                                                <x-element.form.input name="name" placeholder="{{ $name->get('header') }}" value="{{ old('name') }}" autocomplete="off" />
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
                                    <p class="text-secondary ml-2 mb-0">{{ __("page.profile.email") }}</p>
                                    <x-element.modal.button class="text-{{ $inversion_themes->get($theme) }}" target="#{{ $email->get('id') }}" title="{{ __('page.profile.change') }}">
                                        {{ request()->user()->email }}
                                    </x-element.modal.button>
                                    <x-element.modal id="{{ $email->get('id') }}" labelledby="{{ $email->get('labelledby') }}">
                                        <form action="{{ route('profile.email') }}" method="POST">
                                            @csrf
                                            <x-element.modal.header class="border-bottom-0">
                                                <x-element.modal.title id="{{ $email->get('labelledby') }}">
                                                    {{ $email->get("header") }}
                                                </x-element.modal.title>
                                                <x-element.modal.quit />
                                            </x-element.modal.header>
                                            <x-element.modal.body>
                                                <x-element.form.input type="email" name="email" placeholder="{{ $email->get('header') }}" value="{{ old('email') }}" autocomplete="off" required />
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
                                    <x-element.modal.button class="text-primary mb-2" target="#{{ $password->get('id') }}">
                                        {{ __("page.profile.change-password") }}
                                    </x-element.modal.button>
                                    <x-element.modal id="{{ $password->get('id') }}" labelledby="{{ $password->get('labelledby') }}">
                                        <form action="{{ route('profile.password') }}" method="POST">
                                            @csrf 
                                            <x-element.modal.header class="border-bottom-0">
                                                <x-element.modal.title id="{{ $password->get('labelledby') }}">
                                                    {{ $password->get("header") }}
                                                </x-element.modal.title>
                                                <x-element.modal.quit />
                                            </x-element.modal.header>
                                            <x-element.modal.body>
                                                <x-element.form.group>
                                                    <x-element.form.input type="password" name="old_password" placeholder="{{ __('page.profile.old-password') }}" label="{{ __('page.profile.old-password') }}" autocomplete="off" required />
                                                </x-element.form.group>
                                                <x-element.form.group>
                                                    <x-element.form.input type="password" name="password" placeholder="{{ __('page.profile.new-password') }}" label="{{ __('page.profile.new-password') }}" autocomplete="off" required />
                                                </x-element.form.group>
                                                <x-element.form.group>
                                                    <x-element.form.input type="password" name="password_confirmation" placeholder="{{ __('page.profile.confirm') }}" label="{{ __('page.profile.confirm') }}" autocomplete="off" required />
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
                                    <div class="mt-5">
                                        <a class="btn text-danger" href="{{ route('profile.delete') }}">
                                            {{ __("page.profile.delete") }}
                                        </a>
                                    </div>
                                </x-element.flex>
                            </div>
                        </x-element.flex>
                        <x-element.flex flex="justify-content-center">
                            <div>
                                <x-element.ticket class="m-2" style="width: 250px; height: 250px;" image="{{ $my_content->get('preview') }}" href="{{ $my_content->get('href') }}">
                                    <x-element.ticket.name>
                                        {{ $my_content->get('header') }}
                                    </x-element.ticket.name>
                                </x-element.ticket>
                            </div>
                        </x-element.flex>
                    </x-element.flex>
                </main>
            </x-element.flex>
        </x-element.background>
    </x-body>
</x-layout>
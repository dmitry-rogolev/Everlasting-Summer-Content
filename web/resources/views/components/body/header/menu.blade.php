<section class="navbar navbar-{{ $theme }} bg-{{ $theme }} navbar-expand-md rounded shadow-lg {{ $class }}" {{ $attributes }}>
    <a class="navbar-brand" href="{{ $url }}">{{ $name }}</a>
    <button 
        class="navbar-toggler" 
        type="button" 
        data-toggle="collapse" 
        data-target="#{{ $id }}" 
        aria-controls="{{ $id }}" 
        aria-expanded="false" 
        aria-label="{{ __('element.menu.menu') }}">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="{{ $id }}">
        <ul class="navbar-nav w-100">
            <x-element.dropdown name="{{ __('element.menu.theme') }}">
                @foreach ($themes as $name => $theme)
                    <x-element.dropdown-item url="{{ url()->current() }}/?theme={{ $theme }}">
                        {!! $name !!}
                    </x-element.dropdown-item>
                @endforeach
            </x-element.dropdown>
            <x-element.dropdown name="{{ __('lang.lang') }}">
                @foreach ($langs as $name => $lang)
                    <x-element.dropdown-item url="{{ url()->current() }}/?lang={{ $lang }}">
                        {!! $name !!}
                    </x-element.dropdown-item>
                @endforeach
            </x-element.dropdown>
            @if ($login && Route::has("login"))
                @auth
                    <x-element.dropdown name="{{ request()->user()->name }}">
                        <x-element.dropdown-item url="{{ route('user', [ 'user' => request()->user()->id ]) }}">
                            {!! __("page.user.header") !!}
                        </x-element.dropdown-item>
                        <x-element.dropdown-item url="{{ route('folder', [ 'folder' => request()->user()->folder()->first()->id ]) }}">
                            {!! __("page.folder.header") !!}
                        </x-element.dropdown-item>
                        <x-element.dropdown-item url="{{ route('favorite') }}">
                            {!! __("page.favorite.favorite") !!}
                        </x-element.dropdown-item>
                        <div class="dropdown-item cursor-pointer">
                            <x-element.form.logout />
                        </div>
                    </x-element.dropdown>
                @else 
                    <x-element.dropdown name="{{ __('element.menu.user') }}">
                        <x-element.dropdown-item url="{{ route('login') }}">
                            {!! __('auth.login.login') !!}
                        </x-element.dropdown-item>
                        @if (Route::has("register"))
                            <x-element.dropdown-item url="{{ route('register') }}">
                                {!! __('auth.register.registration') !!}
                            </x-element.dropdown-item>
                        @endif
                    </x-element.dropdown>
                @endauth
            @endif
            <x-element.form.search class="ml-md-auto" />
        </ul>
    </div>
</section>

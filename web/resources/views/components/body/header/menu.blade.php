<section class="navbar {{ 'navbar-' . $theme }} {{ 'bg-' . $theme }} navbar-expand-md rounded shadow-lg {{ $class }}" {{ $attributes }}>
    <a class="navbar-brand" href="{{ $url }}">{{ $name }}</a>
    <button 
        class="navbar-toggler" 
        type="button" 
        data-toggle="collapse" 
        data-target="#navbarSupportedContent" 
        aria-controls="navbarSupportedContent" 
        aria-expanded="false" 
        aria-label="Toogle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            @foreach ($navigations as $navigation)
                @if ($navigation->sub->isEmpty())
                    <x-element.nav-item name="{{ $navigation->name }}" url="{{ url($navigation->path) }}" />    
                @else 
                    <x-element.dropdown name="{{ $navigation->name }}">
                        @foreach ($navigation->sub as $sub)
                            <x-element.dropdown-item url="{{ url($sub->path) }}">
                                {{ $sub->name }}
                            </x-element.dropdown-item>
                        @endforeach
                    </x-element.dropdown>
                @endif
            @endforeach
            <x-element.dropdown name="{{ __('header.menu.theme') }}">
                @foreach ($themes as $name => $theme)
                    <x-element.dropdown-item url="{{ url()->current() . '/?theme=' . $theme }}">
                        {{ $name }}
                    </x-element.dropdown-item>
                @endforeach
            </x-element.dropdown>
            @if ($login && Route::has("login"))
                @auth
                    <x-element.dropdown name="{{ Auth::user()->name }}">
                        <x-element.dropdown-item url="{{ route('profile') }}">
                            {{ __('header.menu.profile') }}
                        </x-element.dropdown-item>
                        <div class="dropdown-item cursor-pointer">
                            <x-element.form.logout />
                        </div>
                    </x-element.dropdown>
                @else 
                    <x-element.dropdown name="{{ __('header.menu.profile') }}">
                        <x-element.dropdown-item url="{{ route('login') }}">
                            {{ __('auth.login.login') }}
                        </x-element.dropdown-item>
                        @if (Route::has("register"))
                            <x-element.dropdown-item url="{{ route('register') }}">
                                {{ __('auth.register.registration') }}
                            </x-element.dropdown-item>
                        @endif
                    </x-element.dropdown>
                @endauth
            @endif
        </ul>
    </div>
</section>

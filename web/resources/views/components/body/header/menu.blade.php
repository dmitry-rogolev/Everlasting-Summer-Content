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
            <li class="nav-item dropdown">
                <a 
                    class="nav-link dropdown-toggle" 
                    href="" 
                    id="navbarDropdown" 
                    role="button" 
                    data-toggle="dropdown" 
                    aria-haspopup="true" 
                    aria-expanded="false">
                    Тема
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    @foreach ($themes as $name => $theme)
                        <a class="dropdown-item" href="{{ url()->current() . '/?theme=' . $theme }}">{{ $name }}</a>
                    @endforeach
                </div>
            </li>
            @if ($login && Route::has("login"))
                @auth
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/dashboard') }}">Профиль</a>
                    </li>
                @else 
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Вход</a>
                    </li>
                    @if (Route::has("register"))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">Регистрация</a>
                        </li>
                    @endif
                @endauth
            @endif
        </ul>
    </div>
</section>

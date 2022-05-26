<nav class="navbar {{ 'navbar-' . $theme }} {{ 'bg-' . $theme }} navbar-expand-md rounded shadow-lg {{ $class }}">
    <a class="navbar-brand" href="{{ url('/') }}">{{ $name }}</a>
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
            @foreach ($links as $link)
                @if (is_null($link->get("dropdowns")))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url($link->get('path') . $link->get('uri')) }}">{{ $link->get('name') }}</a>
                    </li>
                @else 
                    <li class="nav-item dropdown">
                        <a 
                            class="nav-link dropdown-toggle" 
                            href="" 
                            id="navbarDropdown" 
                            role="button" 
                            data-toggle="dropdown" 
                            aria-haspopup="true" 
                            aria-expanded="false">
                            {{ $link->get("name") }}
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            @foreach ($link->get('dropdowns') as $drowdown)
                                <a class="dropdown-item" href="{{ url($drowdown->get('path') . $drowdown->get('uri')) }}">{{ $drowdown->get('name') }}</a>
                            @endforeach
                        </div>
                    </li>
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
                    @foreach ($themes as $name => $url)
                        <a class="dropdown-item" href="{{ $url }}">{{ $name }}</a>
                    @endforeach
                </div>
            </li>
        </ul>
    </div>
</nav>

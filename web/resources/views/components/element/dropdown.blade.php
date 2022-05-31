<li class="nav-item dropdown" {{ $attributes }}>
    <a 
        class="nav-link dropdown-toggle" 
        href="" 
        id="{{ $id }}" 
        role="button" 
        data-toggle="dropdown" 
        aria-haspopup="true" 
        aria-expanded="false">
        {{ $name }}
    </a>
    <div class="dropdown-menu" aria-labelledby="{{ $id }}">
        {{ $slot }}
    </div>
</li>
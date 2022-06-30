<section class="ticket border-{{ $theme }} {{ $class }}" style="@if ($image) background-image: url('{{ $image }}'); @endif {{ $style }}" {{ $attributes }}>
    @if ($href)
        <a href="{{ $href }}" class="text-decoration-none d-block h-100" style="border-radius: 15px;">    
            {{ $slot }}
        </a>
    @else 
        {{ $slot }}
    @endif
</section>
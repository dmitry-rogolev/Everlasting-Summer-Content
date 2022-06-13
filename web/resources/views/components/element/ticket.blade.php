<section class="ticket border-{{ $theme }} border-{{ $theme }}-hover no-photo {{ $class }}" style="@if ($image) background-size: cover; background-image: url({{ $image }}); @endif {{ $style }}" {{ $attributes }}>
    <a @if ($href) href="{{ $href }}" @endif class="text-decoration-none d-block h-100" style="border-radius: 15px;">    
        {{ $slot }}
    </a>
</section>
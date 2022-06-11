<section class="ticket border-{{ $theme }} no-photo {{ $class }}" style="@if ($image) background-size: cover; background-image: url({{ $image }}); @endif {{ $style }}" {{ $attributes }}>
    {{ $slot }}
</section>
<section style="@if ($image) background-image: url(images/{{ $image }}.{{ $theme . config('theme.extension') }}); @endif {{ $style }}" class="ticket border-{{ $theme }} border-{{ $theme }}-hover cursor-pointer {{ $class }}" {{ $attributes }}>
    {{ $slot }}
</section>
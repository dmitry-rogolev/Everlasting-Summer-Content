@if ($image)
    <x-element.ticket class="no-photo {{ $class }}" image="{{ $image }}" style="{{ $style }}" {{ $attributes }}>
        {{ $slot }}
    </x-element.ticket>
@else 
    <x-element.ticket class="no-photo {{ $class }}" style="background-size: 60% 60%; {{ $style }}" {{ $attributes }}>
        {{ $slot }}
    </x-element.ticket>
@endif

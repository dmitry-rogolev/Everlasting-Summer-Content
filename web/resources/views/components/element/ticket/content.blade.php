@if ($image)
    <x-element.ticket class="{{ $class }}" image="{{ $image }}" style="background-size: contain; background-position: center top; {{ $style }}" href="{{ $href }}" {{ $attributes }}>
        {{ $slot }}
    </x-element.ticket>
@else 
    <x-element.ticket class="no-preview {{ $class }}" image="{{ $image }}" style="{{ $style }}" href="{{ $href }}" {{ $attributes }}>
        {{ $slot }}
    </x-element.ticket>
@endif

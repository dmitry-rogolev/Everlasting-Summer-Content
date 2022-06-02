@if ($label)
    <x-element.form.label for="{{ $id }}">
        {{ $label }}
    </x-element.form.label>
@endif
<input type="range" class="custom-range {{ $class }}" id="{{ $id }}" {{ $attributes }} />
<x-element.form.custom.control class="custom-radio">
    <input type="radio" id="{{ $id }}" class="custom-control-input {{ $class }}" {{ $attributes }} />
    @if ($label)
        <x-element.form.label for="{{ $id }}" class="custom-control-label">
            {{ $label }}
        </x-element.form.label>
    @endif
</x-element.form.custom.control>
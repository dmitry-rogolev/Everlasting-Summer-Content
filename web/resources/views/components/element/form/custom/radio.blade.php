<x-element.form.custom.control class="custom-radio">
    <input type="radio" id="{{ $id }}" class="custom-control-input {{ $class }}" {{ $attributes }} />
    @if ($label)
        <label for="{{ $id }}" class="custom-control-label">
            {{ $label }}
        </label>
    @endif
</x-element.form.custom.control>
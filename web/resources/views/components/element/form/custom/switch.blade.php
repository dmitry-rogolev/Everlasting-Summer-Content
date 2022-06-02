<x-element.form.custom.control class="custom-switch">
    <input type="checkbox" class="custom-control-input {{ $class }}" {{ $attributes }} id="{{ $id }}" />
    @if ($label)
        <label class="custom-control-label" for="{{ $id }}">
            {{ $label }}
        </label>
    @endif
</x-element.form.custom.control>
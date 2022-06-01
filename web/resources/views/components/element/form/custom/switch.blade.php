<x-element.form.custom.control class="custom-switch">
    <input type="checkbox" class="custom-control-input {{ $class }}" {{ $attributes }} id="{{ $id }}" />
    @if ($label)
        <x-element.form.label class="custom-control-label" for="{{ $id }}">
            {{ $label }}
        </x-element.form.label>
    @endif
</x-element.form.custom.control>
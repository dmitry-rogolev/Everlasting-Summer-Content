<x-element.form.custom.control class="custom-checkbox">
    <input type="checkbox" class="custom-control-input {{ $class }}" id="{{ $id }}" {{ $attributes }} />
    @if ($label) 
        <x-element.form.label class="custom-control-label" for="{{ $id }}">
            {{ $label }}
        </x-element.form.label>
    @endif
</x-element.form.custom.control>
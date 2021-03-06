<x-element.flex>
    <x-element.form.custom.control class="custom-checkbox cursor-pointer">
        <input type="checkbox" class="custom-control-input {{ $class }}" id="{{ $id }}" {{ $attributes }} />
        @if ($label) 
            <label class="custom-control-label" for="{{ $id }}">
                {{ $label }}
            </label>
        @endif
    </x-element.form.custom.control>
</x-element.flex>

<div class="custom-control custom-radio">
    <input type="radio" id="{{ $id }}" class="custom-control-input" />
    @if ($label)
        <x-element.form.label for="{{ $id }}" class="custom-control-label">
            {{ $label }}
        </x-element.form.label>
    @endif
</div>
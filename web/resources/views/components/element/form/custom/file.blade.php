<div class="custom-file">
    <input type="file" class="custom-file-input {{ $class }}" id="{{ $id }}" />
    @if ($label)
        <x-element.form.label class="custom-file-label" for="{{ $id }}">
            {{ $label }}
        </x-element.form.label>
    @endif
</div>
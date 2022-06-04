<div class="custom-file">
    <input type="file" class="custom-file-input {{ $class }}" {{ $attributes }} id="{{ $id }}" />
    @if ($label)
        <label class="custom-file-label" for="{{ $id }}">
            {!! $label !!}
        </label>
    @endif
</div>
<div class="form-check">
    <input type="checkbox" class="form-check-input {{ $class }}" id="{{ $id }}" {{ $attributes }} />
    @if ($label) 
        <label class="form-check-label" for="{{ $id }}">
            {!! $label !!}
        </label>
    @endif
</div>
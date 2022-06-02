@if ($label) 
    <label for="{{ $id }}">
        {{ $label }}
    </label>
@endif
<input type="file" class="form-control-file {{ $class }}" id="{{ $id }}" {{ $attributes }} />
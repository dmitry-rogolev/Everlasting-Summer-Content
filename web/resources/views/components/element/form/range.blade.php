@if ($label) 
    <label for="{{ $id }}">
        {{ $label }}
    </label>
@endif
<input type="range" class="form-control-range {{ $class }}" id="{{ $id }}" {{ $attributes }} /> 
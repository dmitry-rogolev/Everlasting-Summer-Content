@if ($label) 
    <label for="{{ $id }}">
        {{ $label }}
    </label>
@endif
<textarea class="form-control {{ $class }}" id="{{ $id }}" {{ $attributes }}>{{ $slot }}</textarea>